<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;
use Osiset\ShopifyApp\Storage\Queries\Shop as ShopQuery;
use App\Models\User;
use App\Models\ShopDetail;
use App\Models\Shop;
use App\Models\SettingModel;
use App\Models\ModalSetting;
use App\Models\Uninstall;
use App\Models\AppLoad;
use App\Models\ShopActivation;
use App\Mail\AppInstallMail;
use Illuminate\Support\Facades\Mail;


class AfterAuthenticateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Shop's myshopify domain
     *
     * @var ShopDomain|string
     */
    public $shopDomain;

    /**
     * The webhook data
     *
     * @var object
     */
    public $data;

    /**
     * Create a new job instance.
     */
    public function __construct($shopDomain)
    {
        $this->shopDomain = $shopDomain;
       
    }

    /**
     * Execute the job.
     */
    public function handle(ShopQuery $shopQuery): void
    {
        // echo "<pre>"; 
        if($this->shopDomain){
            $apiVersion = env('SHOPIFY_API_VERSION');
            $shop = $this->shopDomain->name;
            $shopOauth =  User::where('name',$shop)->get();
            $getShopDetail = $shopOauth[0]->api()->rest("GET", "/admin/api/" . $apiVersion . "/shop.json");
            // print_r($getShopDetail);
            $shop_id = $getShopDetail['body']['container']['shop']['id'];
			$shop_url = $getShopDetail['body']['container']['shop']['myshopify_domain'];
			$shop_name = $getShopDetail['body']['container']['shop']['name'];
			$custom_domain = $getShopDetail['body']['container']['shop']['domain'];
			$admin_email = $getShopDetail['body']['container']['shop']['customer_email'];
			$admin_name = $getShopDetail['body']['container']['shop']['shop_owner'];
			$shop_json = $getShopDetail['body']['shop'];
            //Inserting data in the shop details table
            //Sending Installation Mail to user
            $userData = [
                'app_name'=> env('SHOPIFY_APP_NAME')
            ];
            $shopDetailUp = ShopDetail::where('shop_url',$shop)->first();
            if($shopDetailUp){
                $shopDetailUp->shop_url = $shop_url;
                $shopDetailUp->shop_id = $shop_id;
                $shopDetailUp->shop_name = $shop_name;
                $shopDetailUp->custom_domain = $custom_domain;
                $shopDetailUp->admin_email = $admin_email;
                $shopDetailUp->admin_name = $admin_name;
                $shopDetailUp->more_details = json_encode(array('welcome_email_status' => 1));
                $shopDetailUp->shop_json = json_encode($shop_json);
                $shopDetailUp->save();
            }else{
                $shopDetail = new ShopDetail();
                $shopDetail->shop_url = $shop_url;
                $shopDetail->shop_id = $shop_id;
                $shopDetail->shop_name = $shop_name;
                $shopDetail->custom_domain = $custom_domain;
                $shopDetail->admin_email = $admin_email;
                $shopDetail->admin_name = $admin_name;
                $shopDetail->more_details = json_encode(array('welcome_email_status' => 1));
                $shopDetail->shop_json = json_encode($shop_json);
                $shopDetail->save();
                // $admin_email
                $sendMail = Mail::to('ranu.sisodiya900@gmail.com')->send(new AppInstallMail($userData));
            }
            //Inserting data in the shop table
            $shopTableUp = Shop::where('shop_url',$shop)->first();
            if($shopTableUp){
                $shopTableUp->shop_url = $shop;
                $shopTableUp->status = 1;
                $shopTableUp->save();
            }else{
                $shopTable = new Shop();
                $shopTable->shop_url = $shop;
                $shopTable->status = 1;
                $shopTable->save();
            }
            //Inserting Default Setting of social login in the Setting table 
            $settingData = array("code_mode" => "on", "whiteLable1" => "on", "shopifyFormStatus" => "off","mark_terms"=> "off","mark_terms_check"=> "off", "shape_status" => "circle", "icon_position" => "above", "socialHoverColor"=> "#4d4f53", "google_status" => "on", "twitter_status" => "off", "facebook_status" => "on", "linkedIn_status" => "off", "amazon_status" => "off", "yahoo_status" => "off", "vkontakte_status" => "off", "spotify_status" => "off", "paypal_status" => "off", "discord_status" => "off", "disqus_status" => "off","apple_status"=>"off","kakao_status"=>"off", "foursquare_status" => "off", "microsoft_status" => "off", "wordpress_status" => "off", "twitchTV_status" => "off", "yandex_status" => "off", "gitHub_status" => "off", "title_name" => "LoginGenie - Social Login", "title_size" => "20", "title_color" => "#2a1b79", "socialHoverCOl" => "#4d4f53","redirectOn" => "0","socialSeperator" => "Use Social Features", "redirectUrl" => "https://" . $shop . "/account","customer_tags"=>'','mark_consent_name'=> '', "clientid"=>"", "mark_consent_check"=> "off","mark_consent"=> "off", "servicesOrder"=> "Google,Facebook,Twitter,LinkedIn,Amazon,Yahoo,Vkontakte,Spotify,Paypal,Discord,Disqus,GitHub,TwitchTV,Yandex,Wordpress,Foursquare,MicrosoftGraph,Apple,Kakao","append_type"=> "auto");
            $getSettingData = SettingModel::where("shop_url",$shop)->first();
            if($getSettingData){
                $getSettingData->details = json_encode($settingData);
                $result = $getSettingData->save();
            }else{
                $setting = new SettingModel();
                $setting->shop_url = $shop;
                $setting->details = json_encode($settingData);
                $result = $setting->save();
            }
            //Inserting defaulting settings for modal popup in the Modal settingtable
            $popUpSettingData = array("popUpModel" => "off", "background" => "on", "popUpBackColor" => "#fffefe", "popUpbordeSize" => "0", "popUpborderType" => "solid", "popUpbordeRadius" => "2", "popUpBorderColor" => "#ffffff", "loginPageHeading" => "Sign In", "logintitle_size" => "18", "logintitle_color" => "#000000", "loginPageBttnTitle" => "LOGIN", "loginBttontitle_color" => "#ffffff", "loginBttonback_color" => "#1e72b3", "loginBttonbackHover_color" => "#4c7ba5", "signUpPageHeading" => "Sign Up", "signUpPageBttnTitle" => "REGISTER", "resetPageHeading" => "Reset your password", "resetPageBttnTitle" => "SEND", "newimage" => "", "image" => "", "imageUrl" => "", "backStatus" => "color","popup_append_type"=> "auto",'popup_appendOn'=>"","gpopUpmodel"=>"off");
            $getModalSetting = ModalSetting::where('shop_url',$shop)->first();
            // echo "<pre>";print_r($getModalSetting);
            // die();
            if($getModalSetting){
                $getModalSetting->details = json_encode($popUpSettingData);
                $result = $getModalSetting->save();
            }else{
                $modalSetting = new ModalSetting();
                $modalSetting->shop_url = $shop;
                $modalSetting->details = json_encode($popUpSettingData);
                $result = $modalSetting->save();
            }
            //deleting records from unistall table if exist
            $unistallCheck = Uninstall::where('shop_url',$shop)->first();
            if($unistallCheck){
                $unistallCheck->delete();
            }
            //Inserting data in the shop activation table
            $shopActivationUp = ShopActivation::where('shop_url',$shop)->first();
            if($shopActivationUp){
                $shopActivationUp->shop_url = $shop;
                $shopActivationUp->status = 1;
                $shopActivationUp->save();
            }else{
                $shopActivation = new ShopActivation();
                $shopActivation->shop_url = $shop;
                $shopActivation->status = 1;
                $shopActivation->save();
            }
        }
    }
}
