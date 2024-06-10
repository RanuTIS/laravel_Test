<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Actions\CancelCurrentPlan;
use Osiset\ShopifyApp\Contracts\Commands\Shop as IShopCommand;
use Osiset\ShopifyApp\Contracts\Queries\Shop as IShopQuery;
use Osiset\ShopifyApp\Messaging\Events\AppUninstalledEvent;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;
use Osiset\ShopifyApp\Util;
use stdClass;
use App\Models\ShopDetail;
use App\Models\Shop;
use App\Models\SettingModel;
use App\Models\ModalSetting;
use App\Models\Uninstall;
use App\Models\AppLoad;
use App\Models\ShopActivation;
use Illuminate\Support\Facades\Log;
use App\Mail\UninstallAppMail;
use Illuminate\Support\Facades\Mail;

class AppUninstalledJob extends \Osiset\ShopifyApp\Messaging\Jobs\AppUninstalledJob
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    public function handle(
        IShopCommand $shopCommand,
        IShopQuery $shopQuery,
        CancelCurrentPlan $cancelCurrentPlanAction
    ): bool {
        $this->domain = ShopDomain::fromNative($this->domain);
        // Get the shop
        $shop = $shopQuery->getByDomain($this->domain);
        $shopId = $shop->getId();
        // Cancel the current plan
        $cancelCurrentPlanAction($shopId);
        // Purge shop of token, plan, etc.
        $shopCommand->clean($shopId);
        // Check freemium mode
        $freemium = Util::getShopifyConfig('billing_freemium_enabled');
        if ($freemium === true) {
            // Add the freemium flag to the shop
            $shopCommand->setAsFreemium($shopId);
        }
        // Soft delete the shop.
        $shopCommand->softDelete($shopId);
        //Deleting and updating table data 
    
        //Adding records in Uninstall App
        $unistall = new Uninstall();
        $unistall->shop_url = $shop->name;
        $unistall->json_data = json_encode($this->data);
        $unistall->save();
        // //Deleting setting details from settings table
        //Deleting data from shopActivation table
        $shopActivationUp = ShopActivation::where('shop_url',$shop->name)->first();
        if($shopActivationUp){
            $shopActivationUp->shop_url = $shop->name;
            $shopActivationUp->status = 0;
            $shopActivationUp->save();
        }
        $shopTableUp = Shop::where('shop_url',$shop->name)->first();
        if($shopTableUp){
            $shopTableUp->shop_url = $shop->name;
            $shopTableUp->status = 0;
            $shopTableUp->save();
        }
        //Inserting and updating data in the app load table.
        $appLoad = AppLoad::where('shop_url',$shop->name)->first();
        if($appLoad){
            $appLoad->load_count = 0;
            $appLoad->status = 0;
            $appLoad->save();
        }
        $shopDetailUp = ShopDetail::where('shop_url',$shop->name)->first();
        // Log::info('shopDetailUp -> ', ['shopDetailUp' => $shopDetailUp]);
        if($shopDetailUp){
            // Log::info($shopDetailUp['admin_email']);
            $userData = [
                'shop_owner' => $shopDetailUp['admin_name'],
                'app_name'=> env('SHOPIFY_APP_NAME')
            ];
            // Log::info($shopDetailUp['admin_email']);
            $sendMail = Mail::to('ranu.sisodiya900@gmail.com')->send(new UninstallAppMail($userData));
            $shopDetailUp->delete();
        }
        Log::info('successfully run');
        return true;

    }
    
}
