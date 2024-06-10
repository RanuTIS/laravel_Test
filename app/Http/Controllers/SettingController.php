<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingModel;
use App\Models\ModalSetting;
use Illuminate\Support\Facades\Auth;
use Osiset\ShopifyApp\Services\ChargeHelper;
use Hybridauth\Hybridauth;
use Hybridauth\HttpClient;

class SettingController extends Controller
{
  public function settingPage(){
    $shopOauth = Auth::user();
    $shop = Auth::user()->name;
    $disabledProviders = json_decode(str_replace("'", '"', env('DISABLED_PROVIDERS')), true);
    //Getting Current Plan
    $userPlan = 'free';
    try {
      $chargeHelper = app()->make(ChargeHelper::class);
      $charges = $chargeHelper->chargeForPlan($shopOauth->plan->getId(), $shopOauth);
      if($charges->status == 'ACTIVE')
          $userPlan = 'plus';
    } catch (\Throwable $th) { }
    //Getting Current Plan
    $settingData = SettingModel::where('shop_url',$shop)->first();
    $modalSettingData = ModalSetting::where('shop_url',$shop)->first();
    if($settingData){
      $details = json_decode($settingData->details,true);
      $modalSettings = json_decode($modalSettingData->details,true);
      // print_r($modalSettings);
      // die();
    }
    else{
      $details = [];
      $modalSettings = [];
    }
    // echo "<pre>";print_r($details);
    // echo "</pre>";
    return view('setting',compact('details','modalSettings','userPlan','disabledProviders'));
  }
  public function settingSaved(Request $request){
    $shop = Auth::user()->name;
    $settingUpdate = SettingModel::where('shop_url',$shop)->first();
    // SettingModel::where('shop_url', $shop)->exists()
    // print_r($request->all());
    // die();
    if($settingUpdate) {
      $settingUpdate->details = json_encode($request->all());
      $settingUpdate->shop_url = $shop;
      $result = $settingUpdate->save();
      if($result)
        return "Sucessfully";
      else
        return "Something went wrong";

    }else {
      $setting = new SettingModel();
      $setting->shop_url = $shop;
      $setting->details = json_encode($request->all());
      $result = $setting->save();
      if($result)
        return "Sucessfully";
      else
        return "Something went wrong";
    }
  }
  public function modalSettingSave(Request $request){
    $shop = Auth::user()->name;
    $modalData = $request->all();
    $modalSetUpdate = ModalSetting::where('shop_url',$shop)->first();
    //background Image Uploading
    if($request->fileToUpload != '' && $request->image == 'true') {
      $file = $request->file('fileToUpload');
      $fileName = $file->getClientOriginalName();
      $uploaded = $request->fileToUpload->move(public_path('uploads'), $fileName);
      if($uploaded)
      $modalData['newimage'] = 'uploads/'.$fileName;
		}else if($request->image == 'true' && $request->backStatus == 'imagetype'){
      $filter = explode("/",$request->imageUrl);
      $modalData['newimage'] = 'uploads/'.$filter[count($filter)-1];
    }else if($request->imageUrl !=''){
      $filter = explode("/",$request->imageUrl);
      $modalData['newimage'] = 'uploads/'.$filter[count($filter)-1];
    }
    //background Image Uploading
    if($modalSetUpdate) {
      $modalSetUpdate->details = json_encode($modalData);
      $modalSetUpdate->shop_url = $shop;
      $result = $modalSetUpdate->save();
      if($result)
        return "Sucessfully Updated";
      else
        return "Something went wrong";

    }else {
      $modalSetting = new ModalSetting();
      $modalSetting->shop_url = $shop;
      $modalSetting->details = json_encode($modalData);
      $result = $modalSetting->save();
      if($result)
        return "Sucessfully Updated";
      else
        return "Something went wrong";
    }
  }
  
  public function hybridCallback(string $provider){
    echo $provider;
    $config = [
      'callback' => 'https://ef24-125-99-173-2.ngrok-free.app/callback/Google',
      'providers' => [
        'Google' => [
          'enabled' => true,
         'keys' => ['id' => '562311522384-4j7gqqjgigpgsn0mb4rq3t2tfsvaesg2.apps.googleusercontent.com', 'secret' => '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'],
       ]
      ]
    ];
    try {
      $hybridauth = new Hybridauth($config);
      $adapter = $hybridauth->authenticate($provider);
      $tokens = $adapter->getAccessToken();
      $userProfile = $adapter->getUserProfile();
      print_r($userProfile);
      $adapter->disconnect();
    } catch (\Exception $e) {
      echo $e->getMessage();
    }

  }
}
