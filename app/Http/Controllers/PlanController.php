<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Osiset\ShopifyApp\Services\ChargeHelper;
use Osiset\ShopifyApp\Storage\Models\Charge;
use Osiset\ShopifyApp\Actions\CancelCurrentPlan;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\Redirect;
use App\Mail\UninstallAppMail;
use Illuminate\Support\Facades\Mail;

class PlanController extends Controller
{
    public function plans(){
        $shopOauth = Auth::user();
        $getAllPlans = Plan::get()->all();
        $plansDetails = [];
        foreach($getAllPlans as $value){
            if($value['name'] == 'free'){
                $plansDetails['free']['price'] = $value['price']; 
            }else if($value['name'] == 'plus'){
                $plansDetails['plus']['price'] = $value['price'];  
                $plansDetails['plus']['id'] = $value['id'];  
            } 
        }
        $userPlan = 'free';
        $charges = false;
        try {
            $chargeHelper = app()->make(ChargeHelper::class);
            $charges = $chargeHelper->chargeForPlan($shopOauth->plan->getId(), $shopOauth);
            if($charges->status == 'ACTIVE')
                $userPlan = 'plus';
        } catch (\Throwable $th) { }
        // echo "<pre>";print_r($charges);
        return view('plans',compact('charges','userPlan','plansDetails'));
    }
    public function cancelPlan(Request $request){
        $shop = $request->shop;
        $id = $request->id;
        $chargeId = $request->chargeId;
        $apiVersion = env('SHOPIFY_API_VERSION');
        if($shop !='' && $chargeId !=''){
            $shopOauth =  User::where('name',$shop)->get();
            $cancelPlan = $shopOauth[0]->api()->rest('DELETE', '/admin/api/'.$apiVersion.'/recurring_application_charges/'.$chargeId.'.json');
            if(isset($cancelPlan['errors']) && $cancelPlan['errors'] == ''){
                $chargeData = Charge::where('charge_id',$chargeId)->where('id',$id)->first();
                $chargeData->status = "CANCELLED";
                $chargeData->cancelled_on = date("Y-m-d H:i:s");
                $chargeData->expires_on = date("Y-m-d H:i:s");
                $chargeData->save();
                return "Success";
            }
        }else{
            return "Missing data";
        }
    }
}
