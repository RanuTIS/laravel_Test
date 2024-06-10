<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Osiset\ShopifyApp\Services\ChargeHelper;
use Illuminate\Support\Facades\Auth;

class InstructionController extends Controller
{
    public function instruction(){
        $shopOauth = Auth::user();
        $apiVersion = env('SHOPIFY_API_VERSION'); 
        //Getting Current Plan
        $userPlan = 'free';
        try {
            $chargeHelper = app()->make(ChargeHelper::class);
            $charges = $chargeHelper->chargeForPlan($shopOauth->plan->getId(), $shopOauth);
            if($charges->status == 'ACTIVE')
                $userPlan = 'plus';
        } catch (\Throwable $th) { }
        //Getting Current Plan
        $themeId = '';
        $themes = $shopOauth->api()->rest('GET', '/admin/api/'.$apiVersion.'/themes.json');
        // echo "<pre>";print_r($themes['body']['container']['themes']);
        foreach($themes['body']['container']['themes'] as $themeKey=>$themeValue){
            if($themeValue['role'] == 'main')
                $themeId = $themeValue['id'];
        }

        return view('instruction',compact('userPlan','themeId'));
    }
}
