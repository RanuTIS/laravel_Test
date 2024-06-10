@extends('shopify-app::layouts.default')
@section('content')
  @section('styles')
    @include('layout.header')
  @endsection
  @include('layout.topbar')
  <!-- <div class="container-fluid"> -->
  <form id="apiKeysSettingsForm">
     <div class="containers">
       <div class="row myform-content">
         <!-- -----------Google------------------->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Google</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your Google App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label for="PolarisTextField19">Client Id</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['google_key']){{ $keysDetails['google_key'] }} @endisset" id="google_key" name="google_key">
                   <div class="Polaris-TextField__Backdrop"></div>
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['google_secret']){{ $keysDetails['google_secret'] }} @endisset" id="google_secret" name="google_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Authorized redirect URIs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- -----------Twitter------------------->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Twitter</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your Twitter App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label for="PolarisTextField19">Consumer Key</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['twitter_key']){{ $keysDetails['twitter_key'] }} @endisset" id="twitter_key" name="twitter_key">
                   <div class="Polaris-TextField__Backdrop"></div>
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Consumer Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['twitter_secret']){{ $keysDetails['twitter_secret'] }} @endisset" id="twitter_secret" name="twitter_secret">
                   <div class="Polaris-TextField__Backdrop"></div>
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Callback URL</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- -----------Facebook------------------->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Facebook</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your Facebook App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">App ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['facebook_key']){{ $keysDetails['facebook_key'] }} @endisset" id="facebook_key" name="facebook_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20" class="Polaris-Label__Text">App Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['facebook_secret']){{ $keysDetails['facebook_secret'] }} @endisset" id="facebook_secret" name="facebook_secret">
                   <div class="Polaris-TextField__Backdrop"></div>
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- -----------LinkedIn------------------->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">LinkedIn</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your LinkedIn App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">App Id</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['linkedIN_key']){{ $keysDetails['linkedIN_key'] }} @endisset" id="linkedIN_key" name="linkedIN_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">App Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['linkedIN_secret']){{ $keysDetails['linkedIN_secret'] }} @endisset" id="linkedIN_secret" name="linkedIN_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20" class="Polaris-Label__Text">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- --------------- amazon setting key-->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Amazon</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your amazon App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">Client ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['amazon_key']){{ $keysDetails['amazon_key'] }} @endisset" id="amazon_key" name="amazon_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['amazon_secret']){{ $keysDetails['amazon_secret'] }} @endisset" id="amazon_secret" name="amazon_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- ---------------Yahoo setting key-->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Yahoo</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your yahoo App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">Client ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['yahoo_key']){{ $keysDetails['yahoo_key'] }} @endisset" id="yahoo_key" name="yahoo_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['yahoo_secret']){{ $keysDetails['yahoo_secret'] }} @endisset" id="yahoo_secret" name="yahoo_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- ---------------Vkontakte setting key-->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Vkontakte</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your yahoo App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">App ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['vkontakte_key']){{ $keysDetails['vkontakte_key'] }} @endisset" id="vkontakte_key" name="vkontakte_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">App Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['vkontakte_secret']){{ $keysDetails['vkontakte_secret'] }} @endisset" id="vkontakte_secret" name="vkontakte_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- ---------------Spotify setting key-->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Spotify</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your spotify App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">Client ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['spotify_key']){{ $keysDetails['spotify_key'] }} @endisset" id="spotify_key" name="spotify_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['spotify_secret']){{ $keysDetails['spotify_secret'] }} @endisset" id="spotify_secret" name="spotify_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- ---------------Paypal setting key-->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Paypal</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your paypal App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">Client ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['paypal_key']){{ $keysDetails['paypal_key'] }} @endisset" id="paypal_key" name="paypal_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['paypal_secret']){{ $keysDetails['paypal_secret'] }} @endisset" id="paypal_secret" name="paypal_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- ---------------Discord setting key-->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Discord</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your discord App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">Client ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['discord_key']){{ $keysDetails['discord_key'] }} @endisset" id="discord_key" name="discord_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['discord_secret']){{ $keysDetails['discord_secret'] }} @endisset" id="discord_secret" name="discord_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- ---------------Disqus setting key-->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Disqus</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your disqus App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">Client ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['disqus_key']){{ $keysDetails['disqus_key'] }} @endisset" id="disqus_key" name="disqus_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['disqus_secret']){{ $keysDetails['disqus_secret'] }} @endisset" id="disqus_secret" name="disqus_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- ------------Github--- -->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">GitHub</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your GitHub App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">Client ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['github_key']){{ $keysDetails['github_key'] }} @endisset" id="github_key" name="github_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['github_secret']){{ $keysDetails['github_secret'] }} @endisset" id="github_secret" name="github_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- ---------------TwitchTV setting key-->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">TwitchTV</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your twitchTV App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">Client ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['twitchTV_key']) {{ $keysDetails['twitchTV_key'] }} @endisset" id="twitchTV_key" name="twitchTV_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['twitchTV_secret']) {{ $keysDetails['twitchTV_secret'] }} @endisset" id="twitchTV_secret" name="twitchTV_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- ---------------Yandex setting key-->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Yandex</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your yandex App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">Client ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['yandex_key']){{ $keysDetails['yandex_key'] }} @endisset" id="yandex_key" name="yandex_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['yandex_secret']){{ $keysDetails['yandex_secret'] }} @endisset" id="yandex_secret" name="yandex_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- ---------------Wordpress setting key-->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Wordpress</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your wordpress App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">Client ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['wordpress_key']) {{ $keysDetails['wordpress_key'] }} @endisset" id="wordpress_key" name="wordpress_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['wordpress_secret']) {{ $keysDetails['wordpress_secret'] }} @endisset" id="wordpress_secret" name="wordpress_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- ---------------Foursquare setting key-->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Foursquare</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your foursquare App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">Client ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['foursquare_key']){{ $keysDetails['foursquare_key'] }} @endisset" id="foursquare_key" name="foursquare_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['foursquare_secret']){{ $keysDetails['foursquare_secret'] }} @endisset" id="foursquare_secret" name="foursquare_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- ---------------MicrosoftGraph setting key-->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">MicrosoftGraph</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your microsoftGraph App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">Client ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['microsoftGraph_key']){{ $keysDetails['microsoftGraph_key'] }} @endisset" id="microsoftGraph_key" name="microsoftGraph_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                    <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['microsoftGraph_secret']){{ $keysDetails['microsoftGraph_secret'] }} @endisset" id="microsoftGraph_secret" name="microsoftGraph_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
         <!-- ---------------Kakao setting key-->
         <div class="col-lg-6 mt-3">
           <div class="box_wrapper card_shadow ">
             <div class="txt_container">
               <h2 class="heading">Kakao</h2>
               <div class="sub_heading">
                 <p>Download detailed manual how to configure your Kakao App here.</p>
               </div>
             </div>
             <div class="box_content">
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField19Label" for="PolarisTextField19">Client ID</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($keysDetails['kakao_key']){{ $keysDetails['kakao_key'] }} @endisset" id="kakao_key" name="kakao_key">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Client Secret</label>
                 </div>
                 <div class="input_wrapper">
                   <input class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="@isset($keysDetails['kakao_secret']){{ $keysDetails['kakao_secret'] }} @endisset" id="kakao_secret" name="kakao_secret">
                 </div>
               </div>
               <div class="box_input_wrapper">
                 <div class="label">
                   <label id="PolarisTextField20Label" for="PolarisTextField20">Valid OAuth redirect URLs</label>
                 </div>
                 <div class="input_wrapper">
                   <input id="PolarisTextField20" class="Polaris-TextField__Input" type="" aria-labelledby="PolarisTextField20Label" aria-invalid="false" value="https://logingenie.sketchappslab.com/social/auth/" disabled="">
                 </div>
                 <small>Please copy this url and paste to redirect url input field on the created app.</small>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="save-btn">
        <button type="button" id="save_btn">Save</button>
       </div>
     </div>
   </form>
  <!-- </div> -->
  @endsection
  @section('scripts')
    @parent
    @include('layout.footer')
    <script>
    //   const titleBarOptions = {
    //     title: 'API Keys Settings',
    //   };
    //   const myTitleBar = TitleBar.create(app, titleBarOptions);
    $("body").LoadingOverlay("show");
    $(document).ready(function(){
      setTimeout(function() {
        $("body").LoadingOverlay("hide");
      }, 3000);
      $("ul.nav-links li a").removeClass("active_nav");
      $(".apikey_nav").addClass("active_nav"); 
      $(document).on('click','#save_btn',function(){
          var apiKeysSettingData = new FormData(document.getElementById("apiKeysSettingsForm"));
          $("body").LoadingOverlay("show");
          shopifyAuthenticatedFetch('/save-apikeys-settings', {
              method: "POST",
              body:apiKeysSettingData
          })
          .then(async (response) => { 
              console.log(response);
              var result = await response.text();
              $("body").LoadingOverlay("hide");
              if(result == "Sucessfully Updated")
                ShopifyApp.flashNotice("Successfully Saved.");
              else
                ShopifyApp.flashNotice(result);
              //do something awesome that makes the world a better place
          });
      });
    });
    </script>
  @endsection