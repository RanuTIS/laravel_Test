<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiKeysModel;
use App\Models\SettingModel;
use Illuminate\Support\Facades\Auth;
use Hybridauth\Hybridauth;
use Hybridauth\Storage\Session;
use Osiset\ShopifyApp\Services\ChargeHelper;
use App\Models\User;
use Osiset\ShopifyApp\Storage\Models\Charge;
use App\Models\CustomerModel;

class SocialController extends Controller
{
    public function showLogins(){
      $shop = Auth::user()->name;
      $shopOauth = Auth::user();
      $hybrid = new Hybridauth($this->getHybridConfig());
      $providers = $hybrid->getProviders();
      // echo "<pre>";print_r($hybrid);
      // die();
      $settingData = SettingModel::where('shop_url',$shop)->first();
      $disabledProviders = json_decode(str_replace("'", '"', env('DISABLED_PROVIDERS')), true);
      $html = '';
      $markConsenthtml = '';
      $userPlan = 'free';
      try {
        $chargeHelper = app()->make(ChargeHelper::class);
        $charges = $chargeHelper->chargeForPlan($shopOauth->plan->getId(), $shopOauth);
        if($charges->status == 'ACTIVE')
          $userPlan = 'plus';
      } catch (\Throwable $th) { }
      if($settingData){
        $settingDetails = json_decode($settingData->details,true);
        // echo "<pre>";print_r($settingDetails);
        if(isset($settingDetails['servicesOrder'])){
          $providers =  explode(',', $settingDetails['servicesOrder']);
        }
        // print_r($providers);
        foreach ($providers as $provider) {
          // $href = sprintf(base_url('%s/auth/%s/'), strtolower($this->router->fetch_class()), $provider);
          $googleFlag = 0;
          $fbFlag = 0;
          $tweetFlag = 0;
          if ($provider == 'Google') {
            $googleFlag = 0;
            if ($userPlan == "free") {
              $googleFlag = 1;
              if (($settingDetails['facebook_status'] == 'off' && $settingDetails['twitter_status'] == 'off') || ($settingDetails['facebook_status'] == 'on' && $settingDetails['twitter_status'] == 'off') || ($settingDetails['facebook_status'] == 'off' && $settingDetails['twitter_status'] == 'on'))
                $googleFlag = 0;
            }
            if ($googleFlag == 0 && $settingDetails['google_status'] == 'on' && $disabledProviders['Google'] == 1)
              $html .= '<div><a class="app_icons clickme_google" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-google" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Facebook') {
            $fbFlag = 0;
            if ($userPlan == "free") {
              $fbFlag = 1;
              if (($settingDetails['google_status'] == 'off' && $settingDetails['twitter_status'] == 'off') || ($settingDetails['google_status'] == 'on' && $settingDetails['twitter_status'] == 'off') || ($settingDetails['google_status'] == 'off' && $settingDetails['twitter_status'] == 'on'))
                $fbFlag = 0;
            }
            if ($fbFlag == 0 && $settingDetails['facebook_status'] == 'on' && $disabledProviders['Facebook'] == 1)
              $html .= '<div><a class="app_icons clickme_face" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-facebook-f" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Twitter') {
            $tweetFlag = 0;
            if ($userPlan == "free") {
              $tweetFlag = 1;
              if (($settingDetails['facebook_status'] == 'off' && $settingDetails['google_status'] == 'off') || ($settingDetails['facebook_status'] == 'on' && $settingDetails['google_status'] == 'off') || ($settingDetails['facebook_status'] == 'off' && $settingDetails['google_status'] == 'on'))
                $tweetFlag = 0;
            }
            if ($tweetFlag == 0 && $settingDetails['twitter_status'] == 'on' && $disabledProviders['Twitter'] == 1)
              $html .= '<div><a class="app_icons clickme_twitter" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-twitter" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'LinkedIn' && $userPlan == "plus" && $disabledProviders['LinkedIn'] == 1) {
            $html .= '<div><a class="app_icons clickme_linkedIn" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-linkedin-in" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Amazon' && $userPlan == "plus" && $disabledProviders['Amazon'] == 1) {
            $html .= '<div><a class="app_icons clickme_amazon" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-amazon" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Yahoo' && $userPlan == "plus" && $disabledProviders['Yahoo'] == 1) {
            $html .= '<div><a class="app_icons clickme_yahoo" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-yahoo" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Vkontakte' && $userPlan == "plus" && $disabledProviders['Vkontakte'] == 1) {
            $html .= '<div><a class="app_icons clickme_vkontakte" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-vk" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Spotify' && $userPlan == "plus" && $disabledProviders['Spotify'] == 1) {
            $html .= '<div><a class="app_icons clickme_spotify" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-spotify" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Paypal' && $userPlan == "plus" && $disabledProviders['Paypal'] == 1) {
            $html .= '<div><a class="app_icons clickme_paypal" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-paypal" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'MicrosoftGraph' && $userPlan == "plus" && $disabledProviders['MicrosoftGraph'] == 1) {
            $html .= '<div><a class="app_icons clickme_microsoft" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-windows" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Discord' && $userPlan == "plus" && $disabledProviders['Discord'] == 1) {
            $html .= '<div><a class="app_icons clickme_discord" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-discord" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Disqus' && $userPlan == "plus" && $disabledProviders['Disqus'] == 1) {
            $html .= '<div><a class="app_icons clickme_disqus" href="javascript:void(0);" data-provider="' . $provider . '"><svg class="svg-inline--fa fa-disqus fa-w-14 role="img" viewBox="5 5 18 17" xmlns="http://www.w3.org/2000/svg"><title>Disqus</title><path fill="#fff" d="M12.438 23.654c-2.853 0-5.46-1.04-7.476-2.766L0 21.568l1.917-4.733C1.25 15.36.875 13.725.875 12 .875 5.564 6.05.346 12.44.346 18.82.346 24 5.564 24 12c0 6.438-5.176 11.654-11.562 11.654zm6.315-11.687v-.033c0-3.363-2.373-5.76-6.462-5.76H7.877V17.83h4.35c4.12 0 6.525-2.5 6.525-5.863h.004zm-6.415 2.998h-1.29V9.04h1.29c1.897 0 3.157 1.08 3.157 2.945v.03c0 1.884-1.26 2.95-3.157 2.95z"/></svg><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Foursquare' && $userPlan == "plus" && $disabledProviders['Foursquare'] == 1) {
            $html .= '<div><a class="app_icons clickme_foursquare" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-foursquare" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Wordpress' && $userPlan == "plus" && $disabledProviders['WordPress'] == 1) {
            $html .= '<div><a class="app_icons clickme_wordpress" href="javascript:void(0);" data-provider="WordPress"><i class="fab fa-wordpress-simple" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'TwitchTV' && $userPlan == "plus" && $disabledProviders['TwitchTV'] == 1) {
            $html .= '<div><a class="app_icons clickme_twitchTV" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-twitch" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Yandex' && $userPlan == "plus" && $disabledProviders['Yandex'] == 1) {
            $html .= '<div><a class="app_icons clickme_yandex" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-yandex" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'GitHub' && $userPlan == "plus" && $disabledProviders['GitHub'] == 1) {
            $html .= '<div><a class="app_icons clickme_github" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-github" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Apple' && $userPlan == "plus" && $disabledProviders['Apple'] == 1) {
            $html .= '<div><a class="app_icons clickme_apple" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-apple" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
          if ($provider == 'Kakao' && $userPlan == "plus" && $disabledProviders['Kakao'] == 1) {
            $html .= '<div><a class="app_icons clickme_kakao" href="javascript:void(0);" data-provider="' . $provider . '"><i class="fab fa-kickstarter" style="font-size:17px;"></i><span class="provider_name">' . $provider . '</span></div>';
          }
        }
        if(isset($settingDetails['magicLink']) && $settingDetails['magicLink'] == "on"){
          $html .='<div><a class="app_icons lg_magicLink" id="lg_magicLink" href="#"><i class="fas fa-magic" style="font-size:17px;"></i></a></div>'; 
        }
        if(isset($settingDetails['mark_consent']) && $settingDetails['mark_consent'] == 'on'){
          $checkStatus = 'checked';
          if(isset($settingDetails['mark_consent_check']) && $settingDetails['mark_consent_check'] == 'off')
            $checkStatus = 'unchecked';
          $markConsenthtml .= '<div class="markConsentSec"><input type="checkbox"  class="marketingConsentCheck" '.$checkStatus.'><lable for="marketingConsent" id="marketingConsentLable">'.$settingDetails['mark_consent_name'].'</lable></div>';
        }
        // return $html.','.$markConsenthtml;
      }

      return $html.','.$markConsenthtml;

    }
    public function socialAuthentication($provider = NULL){
      $storage = new Session();
      // print_r($_GET['deviceDetails']);
      // die();
      if (isset($_GET['shop'])) {
        $shop = $_GET['shop'];
        $markConsentOption = (isset($_GET['markConsent']) ? $_GET['markConsent'] :0);
        $storage->set('shop', $shop);
        $storage->set('markConsentOption', $markConsentOption);
        $storage->set('deviceDetails', $_GET['deviceDetails']);
        //Apply validation on login when free plan is activated
        $disabledProviders = json_decode(str_replace("'", '"', env('DISABLED_PROVIDERS')), true);
        $userData =  User::where('name',$shop)->first();
        $chargeData = Charge::where('user_id',$userData->id)->where('status','ACTIVE')->first();
        if(isset($chargeData->status) == "ACTIVE"){
          $userPlan = 'plus';
        }else{
          $freePlanLogins = env('FREEPLANLOGINS');
          $firstDate = date('Y-m-01');
          $lastDate = date('Y-m-t');
          $currentLogins = CustomerModel::whereBetween('created_at', [$firstDate, $lastDate])->where('shop_url',$shop)->count();
          if ($freePlanLogins <= $currentLogins)
            die("Plan Limit Reached Social Login Disabled <script>setTimeout(function(){self.close();}, 3000);</script>");
        
        }
        if($disabledProviders[$_GET['provider']] != 1) {
          die(env('MSG_DISABLED_PROVIDERS'));
        }
      }
      $service = NULL;
      try {
        $hybrid = new Hybridauth($this->getHybridConfig());
        $error = false;
        if (isset($_GET['provider'])) {
          // Validate provider exists in the $config
          if (in_array($_GET['provider'], $hybrid->getProviders())) {
            $provider = $_GET['provider'];
            // Store the provider for the callback event
            $storage->set('provider', $_GET['provider']);
          } else {
            $error = $_GET['provider'];
          }
        }
        //Check if given provider is enabled
        if ((isset($provider)) && in_array($provider, $hybrid->getProviders())) {
          $storage->set('provider', $provider);
        }
        //Update variable with the valid provider
        // echo "Provider->".$provider;
        // die();
        if ($provider = $storage->get('provider')) {
          try {
            $service = $hybrid->authenticate($provider);
            echo "provider => ". $provider;
          } catch (\Throwable $th) {
            try {
              $service = $hybrid->authenticate($provider);
            } catch (\Throwable $th) {
              //   echo "<pre>".$th;
              echo "Sorry! We couldn\'t authenticate your identity";
            }
          }
          
          $service = $hybrid->authenticate($provider);
          // echo "<pre>";print_r($service);
          if ($service->isConnected()) {
            // $service->disconnect();
            // echo "isConnected";
            $profile = $service->getUserProfile();
            // print_r($profile);
            $login_type = $provider;
            /*
            Disconnect the service else HA would reuse stored session data
            rather making a fresh request in case the user has denied permissions
            in the previous authorization request
            */
            $storage->set('provider', null);
            $service->disconnect();
            // $this->session->unset_userdata('provider');
            // echo $storage->get('deviceDetails');
            // die();
            $cust_data = array(
              'email' => $profile->email,
              'first_name' => $profile->firstName,
              'last_name' => $profile->lastName,
              'login_type' => $login_type,
              'shop' => $storage->get('shop'),
              'emailConsent'=> $storage->get('markConsentOption'),
              "deviceTrackDetail"=>json_decode($storage->get('deviceDetails'),true)
            );
            // print_r($cust_data);
            // die();
            $json_data = json_encode($cust_data);
            $storage->set('customer_data', $json_data);
            $redct_url = route('create-customer');
            // echo $storage->get('customer_data');
            // return redirect($redct_url);
            die("<script language=\"javascript\">window.opener.location.href=\"$redct_url\"; self.close();</script>");
          } else {
            // echo "error";
            session(['showmsg', array('msg' => 'Sorry! We couldn\'t authenticate your identity.')]);
          }
        }

      }catch (Exception $e) {
        if (isset($service) && $service->isConnected())
          $service->disconnect();

        $error = 'Sorry! We couldn\'t authenticate you.';
        $storage->set('showmsg', array('msg' => $error));
        // $error .= '\nError Code: ' . $e->getCode();
        // $error .= '\nError Message: ' . $e->getMessage();
        log_message('error', $error);
        
      }
    }
    private function getHybridConfig(){
      $shop = session('shop');
      $keysSettingData = ApiKeysModel::where('shop_url',$shop)->first();
      if($keysSettingData)
        $keysDetails = json_decode($keysSettingData->details,true);
      else
        $keysDetails = [];
      if(isset($keysDetails['google_key']) && isset($keysDetails['google_secret']) && ($keysDetails['google_key']!='' && $keysDetails['google_secret']!='')){
        $googleKey = $keysDetails['google_key'];
        $googleSecret = $keysDetails['google_secret'];
      }
      else {
        $googleKey = env('GOOGLE_ID');
        $googleSecret = env('GOOGLE_SECRET');
      }
      if(isset($keysDetails['facebook_key']) && isset($keysDetails['facebook_secret']) && ($keysDetails['facebook_key']!='' && $keysDetails['facebook_secret']!='')){
        $facebookKey = $keysDetails['facebook_key'];
        $facebookSecret = $keysDetails['facebook_secret'];
      }
      else {
        $facebookKey = env('FACEBOOK_ID');
        $facebookSecret = env('FACEBOOK_SECRET');
      }
      if(isset($keysDetails['twitter_key']) && isset($keysDetails['twitter_secret']) && ($keysDetails['twitter_key']!='' && $keysDetails['twitter_secret']!='')){
        $twitterKey = $keysDetails['twitter_key'];
        $twitterSecret = $keysDetails['twitter_secret'];
      }
      else {
        $twitterKey = env('TWITTER_ID');
        $twitterSecret = env('TWITTER_SECRET');
      }
      if(isset($keysDetails['linkedIN_key']) && isset($keysDetails['linkedIN_secret']) && ($keysDetails['linkedIN_key']!='' && $keysDetails['linkedIN_secret']!='')){
        $linkedInKey = $keysDetails['linkedIN_key'];
        $linkedInSecret = $keysDetails['linkedIN_secret'];
      }
      else {
        $linkedInKey = env('LINKEDIN_ID');
        $linkedInSecret = env('LINKEDIN_SECRET');
      }
      if(isset($keysDetails['amazon_key']) && isset($keysDetails['amazon_secret']) && ($keysDetails['amazon_key']!='' && $keysDetails['amazon_secret']!='')){
        $amazonKey = $keysDetails['amazon_key'];
        $amazonSecret = $keysDetails['amazon_secret'];
      }
      else {
        $amazonKey = env('AMAZON_ID');
        $amazonSecret = env('AMAZON_SECRET');
      }
      if(isset($keysDetails['yahoo_key']) && isset($keysDetails['yahoo_secret']) && ($keysDetails['yahoo_key']!='' && $keysDetails['yahoo_secret']!='')){
        $yahooKey = $keysDetails['yahoo_key'];
        $yahooSecret = $keysDetails['yahoo_secret'];
      }
      else {
        $yahooKey = env('YAHOO_ID');
        $yahooSecret = env('YAHOO_SECRET');
      }
      if(isset($keysDetails['vkontakte_key']) && isset($keysDetails['vkontakte_secret']) && ($keysDetails['vkontakte_key']!='' && $keysDetails['vkontakte_secret']!='')){
        $vkontakteKey = $keysDetails['vkontakte_key'];
        $vkontakteSecret = $keysDetails['vkontakte_secret'];
      }
      else {
        $vkontakteKey = env('VKONTAKTE_ID');
        $vkontakteSecret = env('VKONTAKTE_SECRET');
      }
      if(isset($keysDetails['spotify_key']) && isset($keysDetails['spotify_secret']) && ($keysDetails['spotify_key']!='' && $keysDetails['spotify_secret']!='')){
        $spotifyKey = $keysDetails['spotify_key'];
        $spotifySecret = $keysDetails['spotify_secret'];
      }
      else {
        $spotifyKey = env('SPOTIFY_ID');
        $spotifySecret = env('SPOTIFY_SECRET');
      }
      if(isset($keysDetails['paypal_key']) && isset($keysDetails['paypal_secret']) && ($keysDetails['paypal_key']!='' && $keysDetails['paypal_secret']!='')){
        $paypalKey = $keysDetails['paypal_key'];
        $paypalSecret = $keysDetails['paypal_secret'];
      }
      else {
        $paypalKey = env('PAYPAL_ID');
        $paypalSecret = env('PAYPAL_SECRET');
      }
      if(isset($keysDetails['discord_key']) && isset($keysDetails['discord_secret']) && ($keysDetails['discord_key']!='' && $keysDetails['discord_secret']!='')){
        $discordKey = $keysDetails['discord_key'];
        $discordSecret = $keysDetails['discord_secret'];
      }
      else {
        $discordKey = env('DISCORD_ID');
        $discordSecret = env('DISCORD_SECRET');
      }
      if(isset($keysDetails['disqus_key']) && isset($keysDetails['disqus_secret']) && ($keysDetails['disqus_key']!='' && $keysDetails['disqus_secret']!='')){
        $disqusKey = $keysDetails['disqus_key'];
        $disqusSecret = $keysDetails['disqus_secret'];
      }
      else {
        $disqusKey = env('DISQUS_ID');
        $disqusSecret = env('DISQUS_SECRET');
      }
      if(isset($keysDetails['foursquare_key']) && isset($keysDetails['foursquare_secret']) && ($keysDetails['foursquare_key']!='' && $keysDetails['foursquare_secret']!='')){
        $foursquareKey = $keysDetails['foursquare_key'];
        $foursquareSecret = $keysDetails['foursquare_secret'];
      }
      else {
        $foursquareKey = env('FOURSQUARE_ID');
        $foursquareSecret = env('FOURSQUARE_SECRET');
      }
      if(isset($keysDetails['microsoftGraph_key']) && isset($keysDetails['microsoftGraph_secret']) && ($keysDetails['microsoftGraph_key']!='' && $keysDetails['microsoftGraph_secret']!='')){
        $microsoftGraphKey = $keysDetails['microsoftGraph_key'];
        $microsoftGraphSecret = $keysDetails['microsoftGraph_secret'];
      }
      else {
        $microsoftGraphKey = env('MICROSOFTGRAPH_ID');
        $microsoftGraphSecret = env('MICROSOFTGRAPH_SECRET');
      }
      if(isset($keysDetails['wordpress_key']) && isset($keysDetails['wordpress_secret']) && ($keysDetails['wordpress_key']!='' && $keysDetails['wordpress_secret']!='')){
        $wordpressKey = $keysDetails['wordpress_key'];
        $wordpressSecret = $keysDetails['wordpress_secret'];
      }
      else {
        $wordpressKey = env('WORDPRESS_ID');
        $wordpressSecret = env('WORDPRESS_SECRET');
      }
      if(isset($keysDetails['twitchTV_key']) && isset($keysDetails['twitchTV_secret']) && ($keysDetails['twitchTV_key']!='' && $keysDetails['twitchTV_secret']!='')){
        $twitchTVKey = $keysDetails['twitchTV_key'];
        $twitchTVSecret = $keysDetails['twitchTV_secret'];
      }
      else {
        $twitchTVKey = env('TWITCHTV_ID');
        $twitchTVSecret = env('TWITCHTV_SECRET');
      }
      if(isset($keysDetails['yandex_key']) && isset($keysDetails['yandex_secret']) && ($keysDetails['yandex_key']!='' && $keysDetails['yandex_secret']!='')){
        $yandexKey = $keysDetails['yandex_key'];
        $yandexSecret = $keysDetails['yandex_secret'];
      }
      else {
        $yandexKey = env('YANDEX_ID');
        $yandexSecret = env('YANDEX_SECRET');
      }
      if(isset($keysDetails['github_key']) && isset($keysDetails['github_secret']) && ($keysDetails['github_key']!='' && $keysDetails['github_secret']!='')){
        $githubKey = $keysDetails['github_key'];
        $githubSecret = $keysDetails['github_secret'];
      }
      else {
        $githubKey = env('GITHUB_ID');
        $githubSecret = env('GITHUB_SECRET');
      }
      if(isset($keysDetails['kakao_key']) && isset($keysDetails['kakao_secret']) && ($keysDetails['kakao_key']!='' && $keysDetails['kakao_secret']!='')){
        $kakaoKey = $keysDetails['kakao_key'];
        $kakaoSecret = $keysDetails['kakao_secret'];
      }
      else {
        $kakaoKey = env('KAKAO_ID');
        $kakaoSecret = env('KAKAO_SECRET');
      }
      $config = [
        'callback' => env('SOCIAL_AUTH_PATH'),
        'providers' => [
          'Google' => [
            'enabled' => true,
            'keys' => ['id' => $googleKey, 'secret' => $googleSecret],
            'scope' => 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
            'authorize_url_parameters' =>[
              'approval_prompt' => 'force',
              'access_type' => 'offline'
            ]
          ],
          'Facebook' => [
            'enabled' => true,
            'keys' => [
              'id' => $facebookKey,
              'secret' => $facebookSecret
            ],
            'scope' => 'email, public_profile'
          ],
          'Twitter' => [
            'enabled' => true,
            'keys' => [
              'id' => $twitterKey,
              'secret' =>$twitterSecret 
            ]
          ],
          'LinkedIn' => [
            'enabled' => true,
            'keys' => [
              'key' => $linkedInKey,
              'secret' => $linkedInSecret
            ],
            'scope' => 'r_liteprofile r_emailaddress'
          ],
          'Amazon' => [
            'enabled' => true,
            'keys' => [
              'key' => $amazonKey,
              'secret' => $amazonSecret
            ]
          ],
          'Yahoo' => [
            'enabled' => true,
            'keys' => [
              'key' => $yahooKey,
              'secret' => $yahooSecret
            ],
            'scope' => 'profile email'
          ],
          'Vkontakte' => [
            'enabled' => true,
            'keys' => [
              'id' => $vkontakteKey,
              'secret' => $vkontakteSecret
            ]
          ],
          'Spotify' => [
            'enabled' => true,
            'keys' => [
              'id' => $spotifyKey,
              'secret' => $spotifySecret
            ]
          ],
          'Paypal' => [
            'enabled' => true,
            'keys' => [
              'id' => $paypalKey,
              'secret' => $paypalSecret
            ],
            'scope' => 'profile email'
          ],
          'Discord' => [
            'enabled' => true,
            'keys' => [
              'id' => $discordKey,
              'secret' => $discordSecret
            ]
          ],
          'Disqus' => [
            'enabled' => true,
            'keys' => [
              'id' => $disqusKey,
              'secret' => $disqusSecret
            ]
          ],
          'Foursquare' => [
            'enabled' => true,
            'keys' => [
              'id' => $foursquareKey,
              'secret' => $foursquareSecret
            ]
          ],
          'MicrosoftGraph' => [
            'enabled' => true,
            'keys' => [
              'id' => $microsoftGraphKey,
              'secret' => $microsoftGraphSecret
            ]
  
          ],
          'WordPress' => [
            'enabled' => true,
            'keys' => [
              'id' => $wordpressKey,
              'secret' => $wordpressSecret
            ]
          ],
          'TwitchTV' => [
            'enabled' => true,
            'keys' => [
              'id' => $twitchTVKey,
              'secret' => $twitchTVSecret
            ]
          ],
          'Yandex' => [
            'enabled' => true,
            'keys' => [
              'id' => $yandexKey,
              'secret' => $yandexSecret
            ]
          ],
          'GitHub' => [
            'enabled' => true,
            'keys' => [
              'id' => $githubKey,
              'secret' => $githubSecret
            ]
          ],
          'Kakao' => [
            'enabled' => true,
            'keys' => [
              'id' => $kakaoKey,
              'secret' => $kakaoSecret
            ]
          ]
          // 'Apple' => [
          //   'enabled' => true,
          //   'keys' => [
          //     "id" => "sketchthemes.loginGenieApp",
          //     "team_id" => "8D3M3V9BAF",
          //     "key_id" => "K2U8YPQP3W",
          //     "key_file" => APPPATH . 'controllers/appleKey.txt'
          //   ],
          //   "scope" => "name email",
          //   "verifyTokenSignature" => false
          // ]
        ]
      ];
      return $config;
    }      
}
