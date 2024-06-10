<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiKeysModel;
use Illuminate\Support\Facades\Auth;
use Osiset\ShopifyApp\Services\ChargeHelper;

class ApikeysController extends Controller
{
    public function apikeySettings(){
        $shop = Auth::user()->name;
        $shopOauth = Auth::user();
        //Getting Current Plan
        $userPlan = 'free';
        try {
            $chargeHelper = app()->make(ChargeHelper::class);
            $charges = $chargeHelper->chargeForPlan($shopOauth->plan->getId(), $shopOauth);
            if($charges->status == 'ACTIVE')
              $userPlan = 'plus';
        } catch (\Throwable $th) { }
        $keysSettingData = ApiKeysModel::where('shop_url',$shop)->first();
        if($keysSettingData)
            $keysDetails = json_decode($keysSettingData->details,true);
        else
            $keysDetails = [];
        return view('apikeys' ,compact('keysDetails','userPlan'));
    }
    public function saveApiKeysSettings(Request $request){
        $shop = Auth::user()->name;
        $keysetUpdate = ApiKeysModel::where('shop_url',$shop)->first();
        // ModalSetting::where('shop_url', $shop)->exists()
        if($keysetUpdate) {
        $keysetUpdate->details = json_encode($request->all());
        $keysetUpdate->shop_url = $shop;
        $result = $keysetUpdate->save();
        if($result)
            return "Sucessfully Updated";
        else
            return "Something went wrong";

        }else {
        $keysSet = new ApiKeysModel();
        $keysSet->shop_url = $shop;
        $keysSet->details = json_encode($request->all());
        $result = $keysSet->save();
        if($result)
            return "Sucessfully Updated";
        else
            return "Something went wrong";
        }
        print_r($request->all());
        
    }
}
