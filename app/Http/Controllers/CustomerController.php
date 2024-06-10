<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hybridauth\Hybridauth;
use Hybridauth\Storage\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Osiset\ShopifyApp\Services\ChargeHelper;
use App\Models\User;
use Osiset\ShopifyApp\Storage\Models\Charge;
use App\Models\CustomerModel;
use App\Models\SettingModel;
use App\Models\IntegrationModel;
use Klaviyo\Client;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function showCustomers(){
        $shopOauth = Auth::user();
        //Getting Current Plan
        $userPlan = 'free';
        try {
            $chargeHelper = app()->make(ChargeHelper::class);
            $charges = $chargeHelper->chargeForPlan($shopOauth->plan->getId(), $shopOauth);
            if($charges->status == 'ACTIVE')
                $userPlan = 'plus';
        } catch (\Throwable $th) { }
        //Getting Current Plan
        return view('customer',compact('userPlan'));
    }
    public function customerTableAjax(){
        if(isset($_GET['action']) == 'fetchCustomers'){
			$respoArr = ["data"=>[]];
			$shop = $_GET['shop'];
			$setting = SettingModel::where('shop_url',$shop);
            $customers = CustomerModel::where('shop_url',$shop)->get()->all();
			// $allCustResult = $this->Database_model->getCustomer($shop, $customerTable);
            // echo "<pre>";
            // print_r($customers);
            foreach($customers as $key=>$value){
                // print_r($value->customer_id);
                $firstIndex = "<tr class='bodyContent'><th class='colomContent'></th>";
				$secondIndex = "<th class='colomContent'><i class='fa fa-user'></i>".($value->first_name == null ? substr($value->customer_email,0,strpos($value->customer_email,"@")) : $value->first_name.$value->last_name)."</th>";
				if($value->is_subscribed == 1){
					$subs =  "subscribed";
					$subsContent = "Subscribed";
				}
				else{
                	$subs =  "not_subscribed";
                	$subsContent = "Not Subscribed";
				} 

				$thirdIndex = "<th class='colomContent'><span class='$subs'>".$subsContent."</span></th>";
				$forthIndex = '<th class="colomContent"><a href="#" class="customer_email" onclick=customer("'.$value->customer_id.'","'.$value->shop_url.'")>'.$value->customer_email.'</a></th>';
				// $fifthIndex = '<th class="colomContent">'.$value->login_medium.'</th>';
				$fifthIndex = '<th class="colomContent"><span style="">'.$value->login_medium.'</span></th>';
				$sixthIndex = '<th class="colomContent">'.date_format(date_create($value->created_at), "d F Y").'</th>';
				$seventhIndex = '<th class="colomContent"><div class="active_box"><a href="#" onclick=customer("'.$value->customer_id.'","'.$value->shop_url.'")><i class="fa-regular fa-eye"></i></a></div></th></tr>';
				$respoArr['data'][] = [$firstIndex,$secondIndex,$thirdIndex,$forthIndex,$fifthIndex,$sixthIndex,$seventhIndex];
                
            }
		    die(json_encode($respoArr));
		}

    }
    public function createCustomer(){
        $apiVersion = env('SHOPIFY_API_VERSION'); 
        $storage = new Session();
        $cust_data = json_decode($storage->get('customer_data'), true);
        // print_r($cust_data);
        // die();
        if($storage->get('shop') !=''){
            $shop =  $storage->get('shop');
            $shopOauth =  User::where('name',$shop)->get();
            $hashedPass = md5(rand(0, 100) . $cust_data['email']);
            $b64Hash = base64_encode(rand(0, 100) . ":" . $hashedPass . ":" . $cust_data['email']);
            //Get Integration table and Integration details
            $integrationData = IntegrationModel::where('shop_url',$shop)->first();
            $klaviyoListId = '';
            $klaviyoId = '';
            if($integrationData){
                $records = json_decode($integrationData->details,true);
                if($records['klaviyoLists'] != '')
                    $klaviyoListId = $records['klaviyoLists'];
                    $klaviyoId = $records['klaviyo_api_key'];
            }
            //Check customer exist or not
            $checkCustomer = CustomerModel::where('shop_url',$shop)->where('customer_email',$cust_data['email'])->where('created_at',date('Y-m-d'))->where('login_medium',$cust_data['login_type'])->first();
            // echo "<pre>";print_r($checkCustomer);
            if($checkCustomer){
                $passWord = $checkCustomer->password;
                $checkCustomer->providercount += 1;
                $checkCustomer->save();
                if($passWord){
                    $b64Hash1 = base64_encode(rand(0, 100) . ":" . $passWord . ":" . $cust_data['email']);
                    // echo "already";
                    $login_url = "https://" . $shop. "/account/login?code=" . $b64Hash1;
                    return redirect($login_url);
                }
                // echo "Exist";
            }else{
                echo "Not Exist";
                if ($cust_data['emailConsent'] > 0){
                    $createCustomer = $shopOauth[0]->api()->rest("POST", "/admin/api/" . $apiVersion . "/customers.json", ["customer" => ["first_name" => $cust_data['first_name'], "last_name" => $cust_data['last_name'], "email" => $cust_data['email'], "password" => $hashedPass, "password_confirmation" => $hashedPass, "email_marketing_consent" => ["state" => "subscribed", "consent_updated_at" => '', "opt_in_level" => 'confirmed_opt_in']]]);
                } 
                else {
                    $createCustomer = $shopOauth[0]->api()->rest("POST", "/admin/api/" . $apiVersion . "/customers.json", ["customer" => ["first_name" => $cust_data['first_name'], "last_name" => $cust_data['last_name'], "email" => $cust_data['email'], "password" => $hashedPass, "password_confirmation" => $hashedPass]]);
                }
                $customerId = '';
                if(isset($createCustomer['errors']) == 1){
                    //search customer
                    $searchCustomer = $shopOauth[0]->api()->rest("GET", "/admin/api/" . $apiVersion . "/customers/search.json", ["query" => ["email" => $cust_data['email']]]);
                    $customerId = $searchCustomer['body']['container']['customers'][0]['id'];
                    if (!empty($customerId)) {
                        //if customer already created,So Update password, then redirect on login
                        $updatePassword = $shopOauth[0]->api()->rest("PUT", "/admin/api/".$apiVersion."/customers/" . $customerId . ".json", ["customer" => ["id" => $customerId, "password" => $hashedPass, "password_confirmation" => $hashedPass, "send_email_welcome" => "false"]]);
                        // echo "<pre>";print_r($updatePassword);
                        //Inserting data in the DB
                        $insertCustomer = new CustomerModel();
                        $insertCustomer->shop_url = $shop;
                        $insertCustomer->customer_id = $customerId;
                        $insertCustomer->customer_email = $cust_data['email'];
                        $insertCustomer->first_name = $cust_data['first_name'];
                        $insertCustomer->last_name = $cust_data['last_name'];
                        $insertCustomer->password = $hashedPass;
                        $insertCustomer->login_medium = $cust_data['login_type'];
                        $insertCustomer->created_at = date('Y-m-d');
                        $insertCustomer->providercount = 1;
                        $insertCustomer->is_subscribed = ($cust_data['emailConsent'] > 0 ? 1 : 0);
                        $insertCustomer->tracking_json = json_encode($cust_data['deviceTrackDetail']);
                        $saveResult = $insertCustomer->save();
                        if($saveResult) {
                            //Add Email in Klaviyo 
                            // if ($klaviyoListId != '' && $klaviyoId !='') {
                            //     try {
                            //     $client = new Client(
                            //         $klaviyoId,
                            //         $num_retries = 3,
                            //         $wait_seconds = 3
                            //     );
                            //     $listId = $klaviyoListId;
                            //     $profileArray = ["profiles" => [["email" => $cust_data['email']]]];
                            //     // Add email in List
                            //     $response = $client->ListsSegments->addMembers($listId, $profileArray);
                            //     } catch (Exception $e) {
                            //     }
                            // }

                            $login_url = "https://" . $shop . "/account/login?code=" . $b64Hash;
                            // redirect($login_url);
                            return redirect($login_url);
                        }
                    }
                } 
                else {
                    $cust_data['customer_id'] = $createCustomer['body']['container']['customer']['id'];
                    $insertCustomer = new CustomerModel();
                    $insertCustomer->shop_url = $shop;
                    $insertCustomer->customer_id = $customerId;
                    $insertCustomer->customer_email = $cust_data['email'];
                    $insertCustomer->first_name = $cust_data['first_name'];
                    $insertCustomer->last_name = $cust_data['last_name'];
                    $insertCustomer->password = $hashedPass;
                    $insertCustomer->login_medium = $cust_data['login_type'];
                    $insertCustomer->providercount = 1;
                    $insertCustomer->created_at = date('Y-m-d');
                    $insertCustomer->is_subscribed = ($cust_data['emailConsent'] > 0 ? 1 : 0);
                    $insertCustomer->tracking_json = json_encode($cust_data['deviceTrackDetail']);
                    $saveResult = $insertCustomer->save();
                    if ($saveResult) {
                        $login_url = "https://" . $shop . "/account/login?code=" . $b64Hash;
                        return redirect($login_url);
                    }
                }
            }
        }
    }
    // GOOGLE POPUP FLOW
    public function googlePopupCustomer(Request $request){
        $shop = $request->shop;
        $shopOauth =  User::where('name',$shop)->get();
        $emailMarketingConsent = $request->markConsent;
        $gPopupCustData = $request->customer_data;
        $gPopupCustData = json_decode($gPopupCustData, true);
        $gCustomerData = array(
          'email' => $gPopupCustData['email'],
          'first_name' => $gPopupCustData['given_name'],
          'last_name' => $gPopupCustData['family_name'],
          'login_type' => 'Google',
          'shop' => $shop
        );
        $apiVersion = env('SHOPIFY_API_VERSION');
        //Get Integration table and Integration details
        $integrationData = IntegrationModel::where('shop_url',$shop)->first();
        $klaviyoListId = '';
        $klaviyoId = '';
        if($integrationData){
            $records = json_decode($integrationData->details,true);
            if($records['klaviyoLists'] != '')
                $klaviyoListId = $records['klaviyoLists'];
                $klaviyoId = $records['klaviyo_api_key'];
        }
        //Get Setting table and setting details
        $hashedPass = md5(rand(0, 100) . $gCustomerData['email']);
        $b64Hash = base64_encode(rand(0, 100) . ":" . $hashedPass . ":" . $gCustomerData['email']);
        $checkCustomer = CustomerModel::where('shop_url',$shop)->where('customer_email',$gCustomerData['email'])->where('created_at',date('Y-m-d'))->where('login_medium','Google')->first();
        // print_r($checkCustomer);
        if($checkCustomer){
            $passWord = $checkCustomer->password;
            $checkCustomer->providercount += 1;
            $checkCustomer->save();
            if($passWord){
                $b64Hash1 = base64_encode(rand(0, 100) . ":" . $passWord . ":" . $gCustomerData['email']);
                $login_url = "https://" . $shop . "/account/login?code=" . $b64Hash1;
                return response($login_url)
                    ->header('Access-Control-Allow-Origin', '*')
                    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            }
        }
        else {
            //Customer create 
            if ($emailMarketingConsent > 0) {
              $createCustomer = $shopOauth[0]->api()->rest("POST", "/admin/api/" . $apiVersion . "/customers.json", ["customer" => ["first_name" => $gCustomerData['first_name'], "last_name" => $gCustomerData['last_name'], "email" => $gCustomerData['email'], "password" => $hashedPass, "password_confirmation" => $hashedPass, "email_marketing_consent" => ["state" => "subscribed", "consent_updated_at" => '', "opt_in_level" => 'confirmed_opt_in']]]);
            } else {
              $createCustomer = $shopOauth[0]->api()->rest("POST", "/admin/api/" . $apiVersion . "/customers.json", ["customer" => ["first_name" => $gCustomerData['first_name'], "last_name" => $gCustomerData['last_name'], "email" => $gCustomerData['email'], "password" => $hashedPass, "password_confirmation" => $hashedPass]]);
            }
            $customerId = '';
            
            if ($createCustomer['errors'] == 'true') {
              //search customer
              $searchCustomer = $shopOauth[0]->api()->rest("GET", "/admin/api/" . $apiVersion . "/customers/search.json", ["query" => ["email" => $gCustomerData['email']]]);
              //Customer Id
              $customerId = $searchCustomer['body']['customers'][0]['id'];
              if (!empty($customerId)) {
                //if customer already created,So Update password, then redirect on login
                $updatePassword = $shopOauth[0]->api()->rest("PUT", "/admin/api/" . $apiVersion . "/customers/" . $customerId . ".json", ["customer" => ["id" => $customerId, "password" => $hashedPass, "password_confirmation" => $hashedPass, "send_email_welcome" => "false"]]);
                $insertCustomer = new CustomerModel();
                $insertCustomer->shop_url = $shop;
                $insertCustomer->customer_id = $customerId;
                $insertCustomer->customer_email = $gCustomerData['email'];
                $insertCustomer->first_name = $gCustomerData['first_name'];
                $insertCustomer->last_name = $gCustomerData['last_name'];
                $insertCustomer->password = $hashedPass;
                $insertCustomer->login_medium = $gCustomerData['login_type'];
                $insertCustomer->providercount = 1;
                $insertCustomer->created_at = date('Y-m-d');
                $insertCustomer->is_subscribed =  0;
                $insertCustomer->tracking_json = '';
                $saveResult = $insertCustomer->save();
                if($saveResult) {
                    //Add Email in Klaviyo 
                    if ($klaviyoListId != '' && $klaviyoId !='') {
                        try {
                        $client = new Client(
                            $klaviyoId,
                            $num_retries = 3,
                            $wait_seconds = 3
                        );
                        $profileArray = ["profiles" => [["email" => $gCustomerData['email']]]];
                        // Add email in List
                        $response = $client->ListsSegments->addMembers($klaviyoListId, $profileArray);
                        } catch (Exception $e) {
                        }
                    }
                    $login_url = "https://" . $shop . "/account/login?code=" . $b64Hash;
                    return response($login_url)
                    ->header('Access-Control-Allow-Origin', '*')
                    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
                }
              }
            } else {
                $customerId = $createCustomer['body']['customer']['id'];
                $insertCustomer = new CustomerModel();
                $insertCustomer->shop_url = $shop;
                $insertCustomer->customer_id = $customerId;
                $insertCustomer->customer_email = $gCustomerData['email'];
                $insertCustomer->first_name = $gCustomerData['first_name'];
                $insertCustomer->last_name = $gCustomerData['last_name'];
                $insertCustomer->password = $hashedPass;
                $insertCustomer->login_medium = $gCustomerData['login_type'];
                $insertCustomer->providercount = 1;
                $insertCustomer->created_at = date('Y-m-d');
                $insertCustomer->is_subscribed = 0;
                $insertCustomer->tracking_json = '';
                $saveResult = $insertCustomer->save();
                if ($saveResult) {
                    $login_url = "https://" . $shop . "/account/login?code=" . $b64Hash;
                    return response($login_url)
                    ->header('Access-Control-Allow-Origin', '*')
                    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
                }
            }
        }
    }

    public function checkAndCreateMagicLink(Request $request){
        $apiVersion = env('SHOPIFY_API_VERSION');
        $data = array();
        $login_url  = '';
        if ($request->shop!='' && $request->customer_data !='') {
            $shop = $request->shop;
            $shopOauth =  User::where('name',$shop)->get();
            $userData =  User::where('name',$shop)->first();
            $userPlan = 'free';
            $chargeData = Charge::where('user_id',$userData->id)->where('status','ACTIVE')->first();
            if(isset($chargeData->status) == "ACTIVE"){
             $userPlan = 'plus';
            }else{
                $data['msg'] = 'Please Upgrade Plan';
                return response($data)
                    ->header('Access-Control-Allow-Origin', '*')
                    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            }
            $settingData = SettingModel::where('shop_url',$shop)->first();
            $settingArrayData = json_decode($settingData->details, true);
            // print_r($settingArrayData);
            $customer_tags = "login_genie_customer".",".$settingArrayData['customer_tags'];
            //Get shop details data
            $hashedPass = md5(rand(0, 100) . $request->customer_data);
            $b64Hash = base64_encode(rand(0, 100) . ":" . $hashedPass . ":" . $request->customer_data);
            $userFirstname = explode('@', $request->customer_data);
            $custDetails = array(
                'customer_id' => '',
                'shop_url' => $shop,
                'customer_email' => $request->customer_data,
                'first_name' => $userFirstname[0],
                'last_name' => '',
                'password' => $hashedPass,
                'login_medium' => 'Magic Link',
                'created_at' => date('Y-m-d'),
                'providercount' => 1
            );
            //Check customer exist or not
            $checkCustomer = CustomerModel::where('shop_url',$shop)->where('customer_email',$request->customer_data)->where('created_at',date('Y-m-d'))->where('login_medium','Magic Link')->first();
            if($checkCustomer){
                $passWord = $checkCustomer->password;
                $customerId = $checkCustomer->customer_id;
                $b64Hash1 = base64_encode(rand(0, 100) . ":" . $passWord . ":" . $request->customer_data . ":" . $customerId);
                // echo "already";
                $login_url = route("redirect-link")."?code=" . $b64Hash1 . "&shop=" . $shop . "&time=" . strtotime('+5 minutes', strtotime(date('Y-m-d H:i:s'))) . "&markConsent=" . $request->markConsent.'&details='.$request->deviceDetails;
            } 
            else {
                if ($request->markConsent > 0) {
                    $createCustomer = $shopOauth[0]->api()->rest("POST", "/admin/api/" . $apiVersion . "/customers.json", ["customer" => ["first_name" => $custDetails['first_name'], "last_name" => $custDetails['last_name'], "email" => $custDetails['customer_email'], "password" => $hashedPass, "password_confirmation" => $hashedPass, "tags" => $customer_tags, "email_marketing_consent" => ["state" => "subscribed", "consent_updated_at" => '', "opt_in_level" => 'confirmed_opt_in']]]);
                } else {
                    $createCustomer = $shopOauth[0]->api()->rest("POST", "/admin/api/" . $apiVersion . "/customers.json", ["customer" => ["first_name" => $custDetails['first_name'], "last_name" => $custDetails['last_name'], "email" => $custDetails['customer_email'], "password" => $hashedPass, "password_confirmation" => $hashedPass, "tags" => $customer_tags]]);
                }
                $customerId = '';
                if ($createCustomer['errors'] == "true") {
                    //search customer
                    $searchCustomer = $shopOauth[0]->api()->rest("GET", "/admin/api/" . $apiVersion . "/customers/search.json", ["query" => ["email" => $custDetails['customer_email']]]);
                    if (count($searchCustomer['body']['customers']) > 0) {
                        $customerId = $searchCustomer['body']['customers'][0]['id'];
                        $custDetails['customer_id'] = $customerId;
                        if (!empty($customerId)) {
                            //if customer already created,So Update password, then redirect on login
                            $updatePassword = $shopOauth[0]->api()->rest("PUT", "/admin/api/" . $apiVersion . "/customers/" . $customerId . ".json", ["customer" => ["id" => $customerId, "password" => $hashedPass, "password_confirmation" => $hashedPass, "tags" => $customer_tags, "send_email_welcome" => "false"]]);
                            $b64Hash1 = base64_encode(rand(0, 100) . ":" . $hashedPass . ":" . $request->customer_data . ":" . $customerId);

                            $login_url = route('redirect-link').'?code=' . $b64Hash1 . '&shop=' . $shop . '&time=' . strtotime('+5 minutes', strtotime(date('Y-m-d H:i:s'))) . '&markConsent=' . $request->markConsent.'&details='.$request->deviceDetails;
                        }
                    } 
                    else {
                        $data['msg'] = 'Please Enter Correct Email.';
                        return response($data)
                        ->header('Access-Control-Allow-Origin', '*')
                        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
                    }
                }
            }
            //Send Grid API
            // echo $login_url;
            if ($login_url != '') {
                $userData = [
                    'link' => $login_url,
                ];
                // Send the email with dynamic data
                try {
                    $sendMail = Mail::to($request->customer_data)->send(new SendMail($userData));
                    $data['msg'] = 'Sucessfully sent, Please check your mail.';
                    return response($data)
                    ->header('Access-Control-Allow-Origin', '*')
                    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
                } catch (Exception $e) {
                    $data['msg'] = "There are some error to sending email.".$e->getMessage();
                    return response($data)
                    ->header('Access-Control-Allow-Origin', '*')
                    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
                }
            } else {
                $data['msg'] = 'Some errors.';
                return response($data)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            }
        }
    }
    public function checkValidLink(){
        if (isset($_GET['time']) && isset($_GET['code']) && isset($_GET['shop'])) {
            $shop = $_GET['shop'];
            $urlTime = $_GET['time'];
            $hashCode = $_GET['code'];
            $customer_email = explode(":", base64_decode($hashCode))[2];
            $currentTime = strtotime(date('Y-m-d H:i:s'));
            $userFirstname = explode('@', $customer_email);
            if ($urlTime >= $currentTime) {
                $login_url = "https://" . $shop . "/account/login?code=" . $hashCode;
                
                //Get Integration table and Integration details
                $integrationData = IntegrationModel::where('shop_url',$shop)->first();
                $klaviyoListId = '';
                $klaviyoId = '';
                if($integrationData){
                    $records = json_decode($integrationData->details,true);
                    if($records['klaviyoLists'] != '')
                        $klaviyoListId = $records['klaviyoLists'];
                        $klaviyoId = $records['klaviyo_api_key'];
                }
                // Add Mail to Klaviyo List
                if ($_GET['markConsent'] > 0 &&  $klaviyoId !='' && $klaviyoListId !='') {
                    try {
                        $client = new Client(
                            $klaviyoId,
                            $num_retries = 3,
                            $wait_seconds = 3
                        );
                        $profileArray = ["profiles" => [["email" => $customer_email]]];
                        // Add email in List
                        $response = $client->ListsSegments->addMembers($klaviyoListId, $profileArray);
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    
                }
                // check customer and update if already Login with current email and provider
                // echo date('Y-m-d');
                $checkCustomer = CustomerModel::where('shop_url',$shop)->where('customer_email',$customer_email)->where('created_at',date('Y-m-d'))->where('login_medium','Magic Link')->first();
                // print_r($checkCustomer);
                // die();
                if($checkCustomer){
                    $checkCustomer->providercount += 1;
                    $checkCustomer->save();
                    // redirect($login_url);
                    return redirect($login_url);
                }else{
                    $insertCustomer = new CustomerModel();
                    $insertCustomer->shop_url = $shop;
                    $insertCustomer->customer_id = explode(":", base64_decode($hashCode))[3];
                    $insertCustomer->customer_email = $customer_email;
                    $insertCustomer->first_name = $userFirstname[0];
                    $insertCustomer->last_name = '';
                    $insertCustomer->password = '';
                    $insertCustomer->login_medium = 'Magic Link';
                    $insertCustomer->providercount = 1;
                    $insertCustomer->is_subscribed = ($_GET['markConsent'] > 0 ? 1 : 0);
                    $insertCustomer->tracking_json = $_GET['details'];
                    $insertCustomer->save();
                    return redirect($login_url);
                }
            }
             else {
                die('A link has been expired.');
            }
        }
    }
}
