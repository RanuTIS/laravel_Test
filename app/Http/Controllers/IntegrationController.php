<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Klaviyo\Client;
use Osiset\ShopifyApp\Services\ChargeHelper;
use App\Models\IntegrationModel;

class IntegrationController extends Controller
{
    public function integrations(){
        $shopOauth = Auth::user();
        $shop = Auth::user()->name;
        //Getting Current Plan
        $userPlan = 'free';
        try {
            $chargeHelper = app()->make(ChargeHelper::class);
            $charges = $chargeHelper->chargeForPlan($shopOauth->plan->getId(), $shopOauth);
            if($charges->status == 'ACTIVE')
                $userPlan = 'plus';
        } catch (\Throwable $th) { }
        //Getting Current Plan
        $response = [];
        $integrationData = IntegrationModel::where('shop_url',$shop)->first();
        if($integrationData){
            $records = json_decode($integrationData->details,true);
            // print_r($records);
            if($records['klaviyo_api_key'] !=''){
                $client = new Client(
                    $records['klaviyo_api_key'], 
                    $num_retries = 3, 
                    $wait_seconds = 3
                );
                $response['klaviyoList'] = $client->ListsSegments->getLists();
                $response['data'] = $records;
            }
        }
        return view('integration',compact('response','userPlan'));
    }
    public function addKlaviyoIntegration(Request $request){
        $shop = Auth::user()->name;
        if($shop){
            $integrationData = IntegrationModel::where('shop_url',$shop)->first();
            // print_r($request->all());
            if($integrationData){
                $integrationData->shop_url = $shop;
                $integrationData->details = json_encode($request->all());
                $result = $integrationData->save();
                if($result)
                    return json_encode(array('status' => 200, 'message' => 'Saved'));
                else
                    return json_encode(array('status' => 500, 'message' => 'Something Wrong'));
            }else{
                $integration = new IntegrationModel();
                $integration->shop_url = $shop;
                $integration->details = json_encode($request->all());
                $result = $integration->save();
                if($result)
                    return json_encode(array('status' => 200, 'message' => 'Saved'));
                else
                    return json_encode(array('status' => 500, 'message' => 'Something Wrong'));
            }
           
        }
    }
    public function getKlaviyoList(Request $request){
        $shop = Auth::user()->name;
        if ($request->klaviyoKeyValue !='') {
            $key = $request->klaviyoKeyValue;
            $data = array();
            $stringList = '';
            try {
              $client = new Client(
                $key,
                $num_retries = 3,
                $wait_seconds = 3
              );
              $response = $client->ListsSegments->getLists();
              foreach ($response as $result) {
                $stringList .= '<option value="' . $result['list_id'] . '">' . $result['list_name'] . '</option>';
              }
              $data['msg'] = '<div class="Polaris-Labelled__LabelWrapper"><div class="Polaris-Label"><label id="klaviyoListsLabel" for="klaviyoLists" class="Polaris-Label__Text">List</label></div></div><div class="Polaris-Select"><select id="klaviyoLists" name="klaviyoLists" class="Polaris-Select__Input" aria-invalid="false">' . $stringList . '</select><div class="Polaris-Select__Backdrop"></div></div>';
            } catch (\Klaviyo\ApiException $e) {
              $data['msg'] = 'The Key is not valid';
            }
            return json_encode($data);
        }
    }
}
