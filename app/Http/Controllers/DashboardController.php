<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Osiset\ShopifyApp\Services\ChargeHelper;
use App\Models\SettingModel;
use App\Models\ModalSetting;
use App\Models\CustomerModel;
use App\Models\AppLoad;
use DateTime;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function home(){
    $shopOauth = Auth::user(); 
    $shop = Auth::user()->name;
    $apiVersion = env('SHOPIFY_API_VERSION'); 
    $baseUrl = env('SOCIAL_AUTH_PATH');
    $userPlan = 'free';
    try {
      $chargeHelper = app()->make(ChargeHelper::class);
      $charges = $chargeHelper->chargeForPlan($shopOauth->plan->getId(), $shopOauth);
      if($charges->status == 'ACTIVE')
        $userPlan = 'plus';
    } catch (\Throwable $th) { }
    
    //Getting Setting Detais from DB
    $settingData = SettingModel::where('shop_url',$shop)->first();
    $modalSettingData = ModalSetting::where('shop_url',$shop)->first();
    if($settingData){
      $settingsData = json_decode($settingData->details,true);
      $modalSettings = json_decode($modalSettingData->details,true);
    }else{
      $settingsData = [];
      $modalSettings = [];
    }
    $shape = '';
    $iconName = '';
    $popupImageSrc = '';
    $popupImgTag = '';
    $popupSts = '';
    $g_popSts = '';
    if (isset($settingsData['shape_status']) == 'circle') {
      $shape = 'border-radius:50%;';
    }
    if (isset($settingsData['shape_status']) == 'square') {
      $shape = 'border-radius:20%;';
    }
    if (isset($settingsData['shape_status']) == 'iconName') {
      $shape = 'border-radius:0px;';
    }
    if (isset($settingsData['shape_status']) == 'rectangle') {
      $shape = 'border-radius:0%;';
    }
    // Selector to Append in theme For widget
    $append_type = "auto";
    $appendOn = "";
    if($settingsData['append_type'] == "snippet" || $settingsData['append_type'] == "selector"){
      $append_type = $settingsData['append_type'];
      $appendOn = $settingsData["appendOn"];
    }
    $socialLoginHtml = new SocialController();
    $htmlData = $socialLoginHtml->showLogins();
    $allHTML = explode(',', $htmlData);
    $htmlData = $allHTML[0];
    $markConsentHtml = $allHTML[1];
    $loginSocialDetails = array('popupsts' => 'off', 'logingenieServices' => 'off', 'basepath' => $baseUrl);
    // print_r($htmlData);
    // die();
    if (count($modalSettings)>0) {
      $popupImageSrc = $modalSettings['newimage'];
      $gclientId = isset($settingsData['clientid'])? $settingsData['clientid']:'';
      if ($userPlan == "free") {
        $popupSts = 'on';
        $g_popSts = 'off';
      } else {
        $popupSts = isset($modalSettings['popUpmodel'])? $modalSettings['popUpmodel']:'';
        $g_popSts = isset($settingsData['gpopUpmodel'])? $settingsData['gpopUpmodel']:'';
      }
      if ($popupImageSrc == '' || $popupImageSrc == null) {
        $popupImgTag = $modalSettings['popUpBackColor'];
      } else {
        $popupImgTag = asset($popupImageSrc);
      }
      // Selector to Append in theme For popup
      $popup_append_type = "auto";
      $popup_appendOn = "";
      if(isset($modalSettings['popup_append_type']) == "selector"){
        $popup_append_type = $modalSettings['popup_append_type'];
        $popup_appendOn = $modalSettings['popup_appendOn'];
      }
      $popupBorderRadius = $modalSettings['popUpbordeRadius'] . "px";
      if ($popupSts == 'on' || $settingsData['code_mode'] == 'on') {
        $loginSocialDetails = array('planStatus' => $userPlan, 'gpopUp' => $g_popSts, 'gclientId' => $gclientId, 'popupsts' => $popupSts, 'socialIconState' => $settingsData['code_mode'], 'basepath' => $baseUrl, 'redirectUrl' => $settingsData['redirectUrl'], 'backgrounMain' => $popupImgTag, 'popUpBorRAdius' => $popupBorderRadius, 'borderType' => $modalSettings['popUpborderType'], 'borderCol' => $modalSettings['popUpBorderColor'], 'borderwidth' => $modalSettings['popUpbordeSize'] . "px", 'forgotCont' => $modalSettings['resetPageHeading'], 'forgotBTNText' => $modalSettings['resetPageBttnTitle'], 'loginText' => $modalSettings['loginPageHeading'], 'loginBtn' => $modalSettings['loginPageBttnTitle'], 'reGisText' => $modalSettings['signUpPageHeading'], 'reGisBTN' => $modalSettings['signUpPageBttnTitle'], 'socialSeperator' => $settingsData['socialSeperator'], 'widgetSize' => $settingsData['title_size'] . "px", 'widgetColr' => $settingsData['title_color'], 'widgetText' => $settingsData['title_name'], 'socialContainerData' => $htmlData, 'shape' => $settingsData['shape_status'], 'googleOnOff' => $settingsData['google_status'], 'twitterOnOff' => $settingsData['twitter_status'], 'faceOnOff' => $settingsData['facebook_status'], 'linkedInOnOff' => $settingsData['linkedIn_status'], 'amazonOnOff' => $settingsData['amazon_status'], 'yahooOnOff' => $settingsData['yahoo_status'], 'vkontakteOnOff' => $settingsData['vkontakte_status'], 'spotifyOnOff' => $settingsData['spotify_status'], 'paypalOnOff' => $settingsData['paypal_status'], 'discordOnOff' => $settingsData['discord_status'], 'disqusOnOff' => $settingsData['disqus_status'], 'foursquareOnOff' => $settingsData['foursquare_status'], 'microsoftOnOff' => $settingsData['microsoft_status'], 'wordpressOnOff' => $settingsData['wordpress_status'], 'twitchTVOnOff' => $settingsData['twitchTV_status'], 'yandexOnOff' => $settingsData['yandex_status'], 'githubOnOff' => $settingsData['gitHub_status'], 'appleOnOff' => $settingsData['apple_status'], 'kakaoOnOff' => $settingsData['kakao_status'], 'loginBTNBackCol' => $modalSettings['loginBttonback_color'], 'loginBTNCol' => $modalSettings['loginBttontitle_color'], 'loginHoverCol' => $modalSettings['loginBttonbackHover_color'], 'logintextsize' => $modalSettings['logintitle_size'] . "px", 'logintextCol' => $modalSettings['logintitle_color'], 'socialHoverColor' => $settingsData['socialHoverColor'], 'socialsPosition' => $settingsData['icon_position'], 'whiteLable1' => $settingsData['whiteLable1'], 'shopifyFormStatus' => $settingsData['shopifyFormStatus'], 'redirectOn' => $settingsData['redirectOn'], 'mark_terms' => $settingsData['mark_terms'], 'mark_terms_check' => $settingsData['mark_terms_check'], 'markConsentHtml' => $markConsentHtml,"append_type" => $append_type,"appendOn" => $appendOn,'popup_append_type' => $popup_append_type,'popup_appendOn' => $popup_appendOn);
      }
    }
    $jsonMetadata = json_encode($loginSocialDetails);
    $socialLoginMetaArr = array('metafield' => array(
      'namespace' => 'sktLoginGenie',
      'key' => 'sktLoginGenieData',
      'value' => $jsonMetadata,
      'type' => 'json'
    ));
    try {
      $createMetafield = $shopOauth->api()->rest('POST', '/admin/api/'.$apiVersion.'/metafields.json', $socialLoginMetaArr);
      // echo "<pre> Created";print_r($createMetafield);
    } catch (Exception $e) {
    }
    if (isset($_REQUEST['action']) == 'UpdateMeata') 
      die("Success");
    //Inserting and updating data in the app load table.
    $appLoad = AppLoad::where('shop_url',$shop)->first();
    If($appLoad){
        $appLoad->shop_url = $shop;
        $appLoad->load_count = $appLoad->load_count+1;
        $appLoad->status = 1;
        $appLoad->save();
    }else{
        $appInsert = new AppLoad();
        $appInsert->shop_url = $shop;
        $appInsert->load_count = 1;
        $appInsert->status = 1;
        $appInsert->save();
    }
    $result = [];
    $platformsNames = array('Google', 'Facebook', 'Twitter', 'LinkedIn', 'Amazon', 'Yahoo', 'Spotify', 'Vkontakte', 'Paypal', 'Discord', 'Disqus', 'GitHub', 'TwitchTV', 'Yandex', 'WordPress', 'Foursquare', 'MicrosoftGraph', 'Apple', 'Kakao','Magic Link');
		foreach ($platformsNames as $key => $value) {
			$customers = CustomerModel::where('shop_url',$shop)->where('login_medium',$value)->get()->all();
			$totalCount = 0;
			foreach ($customers as $custKey) {
				$totalCount = $totalCount + $custKey->providercount;
			}
			$result[$value] = $totalCount;
		}
    $customersCount = CustomerModel::where('shop_url',$shop)->get()->all();
		$totalCutomer = 0;
		foreach ($customersCount as $customersCountKry) {
			$totalCutomer = $totalCutomer + $customersCountKry->providercount;
		}
		$customerCounts = $totalCutomer;
    // print_r($result);
    // die();
    return view('welcome',compact('userPlan','customerCounts','result'));
  }
  public function getChartData(Request $request){
    if($request->shop!=''){
      $shop = $request->shop;
      $customers = CustomerModel::where('shop_url',$shop)->get()->all();
      $dt = new DateTime();
      $dates = [];
      $googleArr = [];
      $magikLinkArr = [];
      $paypalArr = [];
      $amazonArr = [];
      $facebookArr = [];
      $linkedInArr = [];
      $yahooArr = [];
      $vkontakteArr = [];
      $spotifyArr = [];
      $microsoftGraphArr = [];
      $discordArr = [];
      $disqusArr = [];
      $foursquareArr = [];
      $wordPressArr = [];
      $TwitchTVArr = [];
      $YandexArr = [];
      $GitHubArr = [];
      $AppleArr = [];
      $KakaoArr = [];
      $TwitterArr = [];
      $loginSession = 0;
      $i = 0;
      for ($d = 1; $d <= 7; $d++) {
        $dt->setISODate($dt->format('o'), $dt->format('W'), $d);
        $dates[$i] = $dt->format('Y-m-d');
        $currentDate = $dt->format('Y-m-d');
        $googleArr[$currentDate] = 0;
        $magikLinkArr[$currentDate] = 0;
        $paypalArr[$currentDate] = 0;
        $amazonArr[$currentDate] = 0;
        $facebookArr[$currentDate] = 0;
        $linkedInArr[$currentDate] = 0;
        $yahooArr[$currentDate] = 0;
        $vkontakteArr[$currentDate] = 0;
        $spotifyArr[$currentDate] = 0;
        $microsoftGraphArr[$currentDate] = 0;
        $discordArr[$currentDate] = 0;
        $disqusArr[$currentDate] = 0;
        $foursquareArr[$currentDate] = 0;
        $wordPressArr[$currentDate] = 0;
        $TwitchTVArr[$currentDate] = 0;
        $YandexArr[$currentDate] = 0;
        $GitHubArr[$currentDate] = 0;
        $AppleArr[$currentDate] = 0;
        $KakaoArr[$currentDate] = 0;
        $TwitterArr[$currentDate] = 0;
        $i++;
      }
      foreach ($customers as $key => $val) {
        $currentDate = explode(' ',$val['created_at'])[0];
        if($val['login_medium'] == "Google") {
          if(array_key_exists("$currentDate",$googleArr))
            $googleArr["$currentDate"] = $googleArr["$currentDate"] + $val['providercount'];
          else
            $googleArr["$currentDate"] = $val['providercount'];
        } 
        else if ($val['login_medium'] == "Magic Link") {
          if(array_key_exists("$currentDate",$magikLinkArr))
            $magikLinkArr["$currentDate"] = $magikLinkArr["$currentDate"] + $val['providercount'];
          else
            $magikLinkArr["$currentDate"] = $val['providercount'];
        } else if ($val['login_medium'] == "Twitter") {
          if(array_key_exists("$currentDate",$TwitterArr))
            $TwitterArr["$currentDate"] = $TwitterArr["$currentDate"] + $val['providercount'];
          else
            $TwitterArr["$currentDate"] = $val['providercount'];
        } else if ($val['login_medium'] == "Paypal") {
          if(array_key_exists("$currentDate",$paypalArr))
            $paypalArr["$currentDate"] = $paypalArr["$currentDate"] + $val['providercount'];
          else
            $paypalArr["$currentDate"] = $val['providercount'];
        } else if ($val['login_medium'] == "Amazon") {
          if(array_key_exists("$currentDate",$amazonArr))
            $amazonArr["$currentDate"] = $amazonArr["$currentDate"] + $val['providercount'];
          else
            $amazonArr["$currentDate"] = $val['providercount'];
        } else if ($val['login_medium'] == "Facebook") {
          if(array_key_exists("$currentDate",$facebookArr))
            $facebookArr["$currentDate"] = $facebookArr["$currentDate"] + $val['providercount'];
          else
            $facebookArr["$currentDate"] = $val['providercount'];
        } else if ($val['login_medium'] == "LinkedIn") {
          if(array_key_exists("$currentDate",$linkedInArr))
            $linkedInArr["$currentDate"] = $linkedInArr["$currentDate"] + $val['providercount'];
          else
            $linkedInArr["$currentDate"] = $val['providercount'];
        } else if ($val['login_medium'] == "Yahoo") {
          if(array_key_exists("$currentDate",$yahooArr))
            $yahooArr["$currentDate"] = $yahooArr["$currentDate"] + $val['providercount'];
          else
            $yahooArr["$currentDate"] = $val['providercount'];
        } else if ($val['login_medium'] == "Vkontakte") {
          if(array_key_exists("$currentDate",$vkontakteArr))
            $vkontakteArr["$currentDate"] = $vkontakteArr["$currentDate"] + $val['providercount'];
          else
            $vkontakteArr["$currentDate"] = $val['providercount'];
        } else if ($val['login_medium'] == "Spotify") {
          if(array_key_exists("$currentDate",$spotifyArr))
            $spotifyArr["$currentDate"] = $spotifyArr["$currentDate"] + $val['providercount'];
          else
            $spotifyArr["$currentDate"] = $val['providercount'];
        } else if ($val['login_medium'] == "MicrosoftGraph") {
          if(array_key_exists("$currentDate",$microsoftGraphArr))
            $microsoftGraphArr["$currentDate"] = $microsoftGraphArr["$currentDate"] + $val['providercount'];
          else
            $microsoftGraphArr["$currentDate"] = $val['providercount'];
        } else if ($val['login_medium'] == "Discord") {
          if(array_key_exists("$currentDate",$discordArr))
            $discordArr["$currentDate"] = $discordArr["$currentDate"] + $val['providercount'];
          else
            $discordArr["$currentDate"] = $val['providercount'];
        } else if ($val['login_medium'] == "Disqus") {
          if(array_key_exists("$currentDate",$disqusArr))
            $disqusArr["$currentDate"] = $disqusArr["$currentDate"] + $val['providercount'];
          else
            $disqusArr["$currentDate"] = $val['providercount'];
        } else if ($val['login_medium'] == "Foursquare") {
          if(array_key_exists("$currentDate",$foursquareArr))
            $foursquareArr["$currentDate"] = $foursquareArr["$currentDate"] + $val['providercount'];
          else
            $foursquareArr["$currentDate"] = $val['providercount'];
        } else if ($val['login_medium'] == "WordPress") {
          if(array_key_exists("$currentDate",$wordPressArr))
            $wordPressArr["$currentDate"] = $wordPressArr["$currentDate"] + $val['providercount'];
          else
            $wordPressArr["$currentDate"] = $val['providercount'];          
        } else if ($val['login_medium'] == "TwitchTV") {
          if(array_key_exists("$currentDate",$TwitchTVArr))
            $TwitchTVArr["$currentDate"] = $TwitchTVArr["$currentDate"] + $val['providercount'];
          else
            $TwitchTVArr["$currentDate"] = $val['providercount'];          
        } else if ($val['login_medium'] == "Yandex") {
          if(array_key_exists("$currentDate",$YandexArr))
            $YandexArr["$currentDate"] = $YandexArr["$currentDate"] + $val['providercount'];
          else
            $YandexArr["$currentDate"] = $val['providercount'];          
        } else if ($val['login_medium'] == "GitHub") {
          if(array_key_exists("$currentDate",$GitHubArr))
            $GitHubArr["$currentDate"] = $GitHubArr["$currentDate"] + $val['providercount'];
          else
            $GitHubArr["$currentDate"] = $val['providercount'];          
        } else if ($val['login_medium'] == "Apple") {
          if(array_key_exists("$currentDate",$AppleArr))
            $AppleArr["$currentDate"] = $AppleArr["$currentDate"] + $val['providercount'];
          else
            $AppleArr["$currentDate"] = $val['providercount'];         
        } else if ($val['login_medium'] == "Kakao") {
          if(array_key_exists("$currentDate",$KakaoArr))
            $KakaoArr["$currentDate"] = $KakaoArr["$currentDate"] + $val['providercount'];
          else
            $KakaoArr["$currentDate"] = $val['providercount'];
        } else {
          $j = 0;
        }
      }
      $providerData = array("googleArr" => array_values($googleArr), "magicLinkArr" => array_values($magikLinkArr), 'paypalArr' => array_values($paypalArr), 'amazonArr' => array_values($amazonArr), 'facebookArr' => array_values($facebookArr), 'linkedInArr' => array_values($linkedInArr), 'yahooArr' => array_values($yahooArr), 'vkontakteArr' => array_values($vkontakteArr), 'spotifyArr' => array_values($spotifyArr), 'microsoftGraphArr' => array_values($microsoftGraphArr), 'discordArr' => array_values($discordArr), 'disqusArr' => array_values($disqusArr), 'foursquareArr' => array_values($foursquareArr), "wordPressArr" => array_values($wordPressArr), "TwitchTVArr" => array_values($TwitchTVArr), "YandexArr" => array_values($YandexArr), "GitHubArr" => array_values($GitHubArr), 'AppleArr' => array_values($AppleArr), 'KakaoArr' => array_values($KakaoArr),'TwitterArr' => array_values($TwitterArr));
      $response = json_encode(['status' => 200, 'DatesArr' => $dates, 'providerData' => $providerData]);
      return $response;
    }
  }
  public function getAllAnalytics(Request $request){
    if($request->shop !=''){
      $shop = $request->shop;
      $dt = new DateTime();
      $dt->setISODate($dt->format('o'), $dt->format('W'), 0);
      $currentWeekDate = $dt->format('Y-m-d');
      $lastWeekDate = date('Y-m-d', strtotime($currentWeekDate. ' -6 days'));
      //Getting Last weeek Data
      $customers = CustomerModel::whereBetween('created_at', [$lastWeekDate, $currentWeekDate])->where('shop_url',$shop)->get()->all();
      //Getting Last weeek Data
      //Getting current  weeek Data
      $newDate = $dt->format('Y-m-d');
      $currweekData = CustomerModel::where('created_at','>',$newDate)->where('shop_url',$shop)->get()->all();
      //Getting current  weeek Data
      // print_r($currweekData);
      // die();
      $osArr = ["Windows" => 0,"Linux" => 0,"Mac" => 0];
      $deviceArr = ["desktop" => 0,"mobile" => 0,"tablet" => 0];
      $loginSession = 0;
      $loginCustomer = [];
      $lastLoginCustomer = [];
      $lastLoginSession = 0;
      $providerArr = [];
      $totalLoginProviderCount = 0;
      $totalCountryLogin = [];
      //Get Last Week Data For analytics
      foreach($customers as $custKey => $custVal){
        $lastLoginSession += 1;
        if(array_key_exists($custVal['customer_email'], $lastLoginCustomer))
          $lastLoginCustomer[$custVal['customer_email']] = $lastLoginCustomer[$custVal['customer_email']] + 1;
        else
          $lastLoginCustomer[$custVal['customer_email']] = 1;
      }
      // Get New User Login in last week which is not repeated Login on Last week
      $lastWeekNewUser = 0;
      foreach($lastLoginCustomer as $key => $val){
        if($val == 1)
          $lastWeekNewUser += 1;
      }
      // Get Current Week Data For analyticss 
		  foreach($currweekData as $custKey => $custVal){
        $loginSession += 1;
        // Get Login Customers
        if(array_key_exists($custVal['customer_email'],$loginCustomer))
          $loginCustomer[$custVal['customer_email']] = $loginCustomer[$custVal['customer_email']] + 1; 
        else 
          $loginCustomer[$custVal['customer_email']] = 1;
        // Get Login OS 
        if($custVal['tracking_json'] != null){
          $details = json_decode($custVal['tracking_json'],true);
          // Get OS Name and update
          if($details['os_name'] == "Windows")
            $osArr['Windows'] = $osArr['Windows'] + 1;
          else if($details['os_name'] == "Linux")
            $osArr['Linux'] = $osArr['Linux'] +1;
          else if($details['os_name'] == "Mac")
            $osArr['Mac'] = $osArr['Mac'] +1 ;
          else {
            $i = 0; // set else 
          }
          // Get Device Type
          if($details["device_name"] == "desktop")
            $deviceArr["desktop"] = $deviceArr["desktop"] + 1;
          else if($details["device_name"] == "mobile")
            $deviceArr["mobile"] = $deviceArr["mobile"] + 1;
          else if($details["device_name"] == "tablet")
            $deviceArr["tablet"] = $deviceArr["tablet"] + 1;
          else {
            $i = 0;
          }
          // Add Country Login
          if(array_key_exists($details['country_name'],$totalCountryLogin))
            $totalCountryLogin[$details['country_name']] = $totalCountryLogin[$details['country_name']] + 1; 
          else 
            $totalCountryLogin[$details['country_name']] = 1;
        }
        // Get Total Provider
        $totalLoginProviderCount += $custVal["providercount"];
        if(array_key_exists($custVal['login_medium'], $providerArr))
          $providerArr[$custVal['login_medium']] += $custVal['providercount'];
        else
          $providerArr[str_replace(" ","",$custVal['login_medium'])] =  $custVal['providercount'];
      }
      // Get  New User Count using number of login user
      $newUser = 0;
      $repeatLogin = 0;
      foreach($loginCustomer as $key => $val){
        if($val == 1)
          $newUser += 1;
        else 
          $repeatLogin += 1;
      }
      return json_encode(["status" => 200,"osArr" => $osArr,"deviceArr" => $deviceArr,"loginSession" => $loginSession,"newUser" => $newUser,"repeatLogin" => $repeatLogin,"totalLoginProviderCount" => $totalLoginProviderCount,"providerArr" => $providerArr,"lastLoginSession" => $lastLoginSession,"lastWeekNewUser" => $lastWeekNewUser,"totalCountryLogin" => $totalCountryLogin]);

    }
  }
  public function totalLogins(){
    $shop = Auth::user()->name;
		//get current month count
    $firstDate = date('Y-m-01');
    $lastDate = date('Y-m-t');
    $customers = CustomerModel::whereBetween('created_at', [$firstDate, $lastDate])->where('shop_url',$shop)->get()->all();
    $totalLogin = 0;
    // echo "<pre>";
    // return print_r($customers);
		if($customers){
			$totalLogin = count($customers);
      return json_encode(["status" => 200, "totalLogin" => $totalLogin]);
		}else{
      return json_encode(["status" => 303, "totalLogin" => $totalLogin]);
    } 
    

  }
}
