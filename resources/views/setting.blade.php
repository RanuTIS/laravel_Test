@extends('shopify-app::layouts.default')
@section('content')
  @section('styles')
    @include('layout.header')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/social_login.css') }}?_<?= time()?>">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/settings.css') }}?_<?= time()?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style type="text/css">
        .social_icons_container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  #selector_setting {
    margin-bottom: 5px;
  }
  .widget_head {
    margin-top: 13px;
    margin-bottom: 5px;
  }
    </style>
  @endsection
  @include('layout.topbar')
  @php
    $isSocialDisabled = "";
    if ($userPlan == "free")
      $isSocialDisabled = "*";

    $popupImageSrc = $modalSettings['newimage'];
    if ($popupImageSrc == '' || $popupImageSrc == null) {
      $popupImgTag = "background-color:".$modalSettings['popUpBackColor'];
    } else {
      $popupImgTag = "background-image:url(".asset($popupImageSrc).")";
    }
  @endphp
  <div class="setting_section">
    <div class="container-fluid">
      <div class="row m-2">
        <div class="col-md-5">
          <ul class="left_tabs">
            <li class="customizer_setting btn_style active_tab" onclick="customizertabs('Settings')"> <span><i class="fa-solid fa-gears"></i></span> Settings</li>
            <li class="customizer_widget btn_style" onclick="customizertabs('Widget')"> <span><i class="fa-solid fa-desktop"></i></span> Widget</li>
            <li class="customizer_popup btn_style" onclick="customizertabs('PopUp')"> <span><i class="fa-solid fa-mobile"></i></span> PopUp</li>
          </ul>
          <div class="setting_settings">
            <form id="settingsForm" method="post">
              <div class="card_wrapper card_shadow">
                <div class="card_head">
                  <h2 class="card_heading">Manage Sections</h2>
                  <div class="card_desc">
                    <p>Page where customers will be redirected after successful login.</p>
                  </div>
                </div>
                <div class="card_body">
                  <div class="FormLayout__Item">
                    <div class="toggle_wrapper">
                      <div class="">
                        <h2 class="heading">Enable App</h2>
                      </div>
                      <div class="">
                        <div class="active_code">
                          <label class="switch">
                            <input type="checkbox" name="code_mode" 
                            id="code_on" @isset($details['code_mode']) @if($details['code_mode'] == 'on') {{ "checked" }} @endif @endisset >
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <!-- --------------- -->
                    <div class="toggle_wrapper">
                      <div class="">
                        <h2 class="heading">{{ $isSocialDisabled }}Enable White Labelling </h2>
                      </div>
                      <div class="" style="">
                        <div class="active_code" style="text-align: right;">
                          <label class="switch">
                            <input type="checkbox" id="whiteLable1" @isset($details['whiteLable1']) @if($details['whiteLable1'] == 'on' || $userPlan == 'free') {{ "checked" }} @endif @endisset name="whiteLable1" {{($isSocialDisabled)?'disabled':''}}>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <!-- ------------ -->
                    <div class="toggle_wrapper">
                      <div class="">
                        <h2 class="heading">{{ $isSocialDisabled }}Disable Shopify Login/Signup Form </h2>
                      </div>
                      <div class="">
                        <div class="active_code">
                          <label class="switch">
                            <input type="checkbox" id="shopifyFormStatus" @isset($details['shopifyFormStatus']) @if($details['shopifyFormStatus'] == 'on') {{ "checked" }} @endif @endisset name="shopifyFormStatus" {{($isSocialDisabled)?'disabled':''}}>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card_wrapper card_shadow">
                <div class="card_head">
                  <h2 class="card_heading">Icons Design</h2>
                  <div class="card_desc">
                    <p>Use different styles to make your icons better and more attractive.</p>
                  </div>
                </div>
                <div class="card_body">
                  <div class=" FormLayout__Item">
                    <div class="">
                      <div class="">
                        <h3 aria-label="Shape and Size" class="card_heading"> Social Logo Shape and Size</h3>
                      </div>
                    </div>
                    <div class="second icon_wrapper">
                      <section>
                        <div>
                          <input type="radio" id="control_01" @isset($details['shape_status']) @if($details['shape_status'] == 'circle') {{ "checked" }} @endif @endisset name="select">
                          <label for="control_01">
                            <img src="https://logingenie.sketchappslab.com/assets/uploads/circle-icon.png">
                          </label>
                        </div>
                        <div>
                          <input type="radio" id="control_02" @isset($details['shape_status']) @if($details['shape_status'] == 'square') {{ "checked" }} @endif @endisset name="select">
                          <label for="control_02">
                            <img src="https://logingenie.sketchappslab.com/assets/uploads/square-icon.png">
                          </label>
                        </div>
                        <div>
                          <input type="radio" id="control_03" @isset($details['shape_status']) @if($details['shape_status'] == 'rectangle') {{ "checked" }} @endif @endisset name="select">
                          <label for="control_03">
                            <img src="https://logingenie.sketchappslab.com/assets/uploads/ractangle-icon.png">
                          </label>
                        </div>
                        <div>
                          <input type="radio" id="control_04" @isset($details['shape_status']) @if($details['shape_status'] == 'iconName') {{ "checked" }} @endif @endisset name="select">
                          <label for="control_04">
                            <img src="https://logingenie.sketchappslab.com/assets/uploads/icons-name.png">
                          </label>
                        </div>
                      </section>
                    </div>
                    <div class="">
                      <div class="">
                        <h3 aria-label="Shape and Size" class="card_heading"> Social Logo Hover Color</h3>
                      </div>
                    </div>
                    <div class="iconhoverClass">
                      <img style="min-width:16px;min-height:16px;box-sizing:unset;box-shadow:none;background:unset;padding:0 6px 0 0;cursor:pointer;" src="chrome-extension://ohcpnigalekghcmgcdcenkpelffpdolg/img/icon16.png" title="Select with ColorPick Eyedropper - See advanced option: &quot;Add ColorPick Eyedropper near input[type=color] fields on websites&quot;" class="colorpick-eyedropper-input-trigger">
                      <input type="color" name="socialHoverColor" id="socialHoverColor" value="@isset($details['socialHoverColor']){{($details['socialHoverColor'] !='')?$details['socialHoverColor']:'#4d4f53'}}@endisset" style="width: 25%;height: 45px;padding:5px 10px 5px 10px; border-radius: 6px;" colorpick-eyedropper-active="true">
                    </div>
                  </div>
                </div>
              </div>
              <!-- Redirect Url -->
              <div class=" redirect_section">
                <div class="card_wrapper card_shadow">
                  <div class="card_head">
                    <h2 class="card_heading">{{ $isSocialDisabled }} Redirect URL</h2>
                    <div class="card_desc">
                      <p>Page where customers will be redirected after successful login.</p>
                    </div>
                  </div>
                  <div class="card_body">
                    <div class="FormLayout__Item">
                      <div class="Polaris-LegacyStack__Item">
                        <div>
                          <label class="Polaris-Choice radio-box" for="disabled">
                            <span class="Polaris-Choice__Label">
                              <span>Redirect on Account Page</span>
                            </span>
                            <span class="Polaris-Choice__Control">
                              <div class="">
                                <div class="active_code">
                                  <label class="switch">
                                    <input type="checkbox" name="redirectOn" id="account_page" class="radiobtncustom redirectOption" @isset($details['redirectOn']) @if($details['redirectOn'] == "0") {{ "checked" }} @endif @endisset value="0" >
                                    <span class="slider round"></span>
                                  </label>
                                </div>
                              </div>
                            </span>
                          </label>
                        </div>
                      </div>
                      <div class="Polaris-LegacyStack__Item">
                        <div>
                          <label class="Polaris-Choice radio-box" for="disabled">
                            <span class="Polaris-Choice__Label">
                              <span>Redirect on Same Page</span>
                            </span>
                            <span class="Polaris-Choice__Control">
                              <div class="">
                                <div class="active_code">
                                  <label class="switch">
                                    <input type="checkbox" name="redirectOn" id="same_page" class="radiobtncustom redirectOption" @isset($details['redirectOn']) @if($details['redirectOn'] == "1") {{ "checked" }} @endif @endisset value="1" {{($isSocialDisabled)?'disabled':''}}>
                                    <span class="slider round"></span>
                                  </label>
                                </div>
                              </div>
                            </span>
                          </label>
                        </div>
                      </div>
                      <div class="Polaris-LegacyStack__Item">
                        <div>
                          <label class="Polaris-Choice radio-box" for="disabled">
                            <span class="Polaris-Choice__Label">
                              <span>Custom URL</span>
                            </span>
                            <span class="Polaris-Choice__Control">
                              <div class="">
                                <div class="active_code">
                                  <label class="switch">
                                    <input type="checkbox" name="redirectOn" id="custom_url" class="radiobtncustom redirectOption" value="2" @isset($details['redirectOn']) @if($details['redirectOn'] == "2") {{ "checked" }} @endif @endisset {{($isSocialDisabled)?'disabled':''}}>
                                    <span class="slider round"></span>
                                  </label>
                                </div>
                              </div>
                            </span>
                          </label>
                        </div>
                      </div>
                      <div class="input_wrapper">
                        <div class="Polaris-TextField">
                          <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="{{ 'https://' . $_GET['shop'] . '/account' }}" id="accountPage_url" name="redirectUrl" placeholder="If it is empty,So it redirect on account page" {{($isSocialDisabled)?'readonly':''}}>
                          <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="" id="customPage_url" style="display:none" placeholder="If it is empty,So it redirect on account page" {{($isSocialDisabled)?'readonly':''}}>
                          <div class="Polaris-TextField__Backdrop"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Redirect Url -->
              <!-- Customers Tag -->
              <div class="integration_section">
                <div class="card_wrapper card_shadow">
                  <div class="card_head">
                    <h2 class="card_heading">Customer Tags</h2>
                    <div class="card_desc">
                      <p></p>
                    </div>
                  </div>
                  <div class="card_body">
                    <div class="FormLayout__Item">
                      <div class="Polaris-LegacyStack__Item">
                        <div>
                          <div class="Polaris-TextField">
                            <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($details['customer_tags']) {{ $details['customer_tags'] }} @endisset" id="customer_tags" placeholder="Enter Customers Tags" name="customer_tags">
                            <div class="Polaris-TextField__Backdrop"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Customers Tag -->
              <div class="card_wrapper card_shadow">
                <div class="card_head">
                  <h2 class="card_heading"> Social Icon Positions </h2>
                  <div class="card_desc">
                    <p>Choose social Icon positon,That will appear on login and register page.</p>
                  </div>
                </div>
                <div class="card_body">
                  <div class=" FormLayout__Item">
                    <h2 class="card_heading">Choose Above and Below Positions.</h2>
                    <div class="positions">
                      <section>
                        <div>
                          <input type="radio" id="control_1" @isset($details['icon_position']) @if($details['icon_position']=='above') {{ "checked" }} @endif @endisset name="position">
                          <label for="control_1" class="ripple-button">
                            <div>Above Form</div>
                          </label>
                        </div>
                        <div>
                          <input type="radio" id="control_2" @isset($details['icon_position']) @if($details['icon_position']=='below') {{ "checked" }} @endif @endisset name="position">
                          <label for="control_2" class="ripple-button">
                            <div>Below Form</div>
                          </label>
                        </div>
                      </section>
                    </div>
                  </div>
                </div>
              </div>
              <div class=" Social_Services ">
                <div class="card_wrapper card_shadow">
                  <div class="card_head">
                    <h2 class="card_heading">Social Services</h2>
                    <div class="card_desc">
                      <p>Choose social networks that will be displayed on the page.</p>
                    </div>
                  </div>
                  <div class="card_body">
                    <div id="sortable" class="FormLayout__Item ui-sortable">
                      <div id="LinkedIn" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }} LinkedIn </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['LinkedIn']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" @if($disabledProviders['LinkedIn']!=1){{ 'disabled' }} @else @isset($details['linkedIn_status']) @if($details['linkedIn_status'] == "on") {{ "checked" }} @endif @endisset @endif onchange="iconsstatus('linkedin_status')" name="linkedIn_status" id="linkedin_status" class="inputBox socialChecks" {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Wordpress" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}Wordpress </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['WordPress']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('wordpress_status')" id="wordpress_status" name="wordpress_status" @if($disabledProviders['WordPress']!=1){{ 'disabled' }} @else @isset($details['wordpress_status']) @if($details['wordpress_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Google" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">Google</h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['Google']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" data-friend1="facebook_status" data-friend2="twitter_status" id="google_status" onchange="iconsstatus('google_status')" name="google_status" 
                              @if($disabledProviders['Google']!= 1) {{ 'disabled' }} @else 
                               @isset($details['google_status']) @if($details['google_status'] == "on") {{ "checked" }} @endif @endisset @endif>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Facebook" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">Facebook</h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['Facebook']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" onchange="iconsstatus('facebook_status')" class="socialChecks" data-friend1="google_status" data-friend2="twitter_status" name="facebook_status" id="facebook_status"@if($disabledProviders['Facebook']!=1){{ 'disabled' }} @else @isset($details['facebook_status']) @if($details['facebook_status'] == "on") {{ "checked" }} @endif @endisset @endif>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="GitHub" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading"> {{ $isSocialDisabled }}GitHub </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['GitHub']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('github_status')" name="gitHub_status" id="github_status" @if($disabledProviders['GitHub']!=1){{ 'disabled' }} @else @isset($details['gitHub_status']) @if($details['gitHub_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Twitter" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">Twitter</h2>
                        </div>
                        <div class="">
                          <div class="active_code" style="text-align: right;">
                            <label class="switch {{($disabledProviders['Twitter']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" onchange="iconsstatus('twitter_status')" class="socialChecks" data-friend1="facebook_status" data-friend2="google_status" name="twitter_status" id="twitter_status" @if($disabledProviders['Twitter']!=1){{ 'disabled' }} @else @isset($details['twitter_status']) @if($details['twitter_status'] == "on") {{ "checked" }} @endif @endisset @endif>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Amazon" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}Amazon </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['Amazon']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('amazon_status')" name="amazon_status" id="amazon_status" @if($disabledProviders['Amazon']!=1){{ 'disabled' }} @else @isset($details['amazon_status']) @if($details['amazon_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Kakao" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}Kakao </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['Kakao']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('kakao_status')" id="kakao_status" name="kakao_status" @if($disabledProviders['Kakao']!=1){{ 'disabled' }} @else @isset($details['kakao_status']) @if($details['kakao_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Yahoo" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}Yahoo </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['Yahoo']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('yahoo_status')" name="yahoo_status" id="yahoo_status" @if($disabledProviders['Yahoo']!=1){{ 'disabled' }} @else @isset($details['yahoo_status']) @if($details['yahoo_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Vkontakte" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}Vkontakte </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['Vkontakte']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('vkontakte_status')" name="vkontakte_status" id="vkontakte_status" @if($disabledProviders['Vkontakte']!=1){{ 'disabled' }} @else @isset($details['vkontakte_status']) @if($details['vkontakte_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Spotify" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}Spotify </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['Spotify']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('spotify_status')" id="spotify_status" name="spotify_status" @if($disabledProviders['Spotify']!=1){{ 'disabled' }} @else @isset($details['spotify_status']) @if($details['spotify_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Paypal" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}Paypal </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['Paypal']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('paypal_status')" id="paypal_status" name="paypal_status" @if($disabledProviders['Paypal']!=1){{ 'disabled' }} @else @isset($details['paypal_status']) @if($details['paypal_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Discord" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}Discord </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['Discord']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('discord_status')" name="discord_status" id="discord_status" @if($disabledProviders['Discord']!=1){{ 'disabled' }} @else @isset($details['discord_status']) @if($details['discord_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Disqus" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}Disqus </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['Disqus']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('disqus_status')" name="disqus_status" id="disqus_status" @if($disabledProviders['Disqus']!=1){{ 'disabled' }} @else @isset($details['disqus_status']) @if($details['disqus_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="TwitchTV" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}TwitchTV </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['TwitchTV']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('twitchtv_status')" name="twitchTV_status" id="twitchtv_status" @if($disabledProviders['TwitchTV']!=1){{ 'disabled' }} @else @isset($details['twitchTV_status']) @if($details['twitchTV_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Yandex" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}Yandex </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['Yandex']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('yandex_status')" name="yandex_status" id="yandex_status" @if($disabledProviders['Yandex']!=1){{ 'disabled' }} @else @isset($details['yandex_status']) @if($details['yandex_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Foursquare" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}Foursquare </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['Foursquare']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('foursquare_status')" name="foursquare_status" id="foursquare_status" @if($disabledProviders['Foursquare']!=1){{ 'disabled' }} @else @isset($details['foursquare_status']) @if($details['foursquare_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="MicrosoftGraph" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}Microsoft </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['MicrosoftGraph']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('microsoftgraph_status')" id="microsoftgraph_status" name="microsoft_status" @if($disabledProviders['MicrosoftGraph']!=1){{ 'disabled' }} @else @isset($details['microsoft_status']) @if($details['microsoft_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div id="Apple" class="toggle_wrapper socialLginDivs">
                        <div class="">
                          <span>
                            <i class="fa-solid fa-arrows-up-down-left-right reOrderHandle"></i>
                          </span>
                          <h2 class="heading">{{ $isSocialDisabled }}Apple </h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch {{($disabledProviders['Apple']!= 1)?'disabled_providers':''}}">
                              <input type="checkbox" class="socialChecks" onchange="iconsstatus('apple_status')" name="apple_status" id="apple_status" @if($disabledProviders['Apple']!=1){{ 'disabled' }} @else @isset($details['apple_status']) @if($details['apple_status'] == "on") {{ "checked" }} @endif @endisset @endif {{($isSocialDisabled)?'disabled':''}}>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      @if($isSocialDisabled == "*")
                        <br/><b>*</b> - Only Available on Plus Plan
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <!-- ------------Magic Link------------------ -->
              <div class="card_wrapper card_shadow">
                <div class="card_head">
                  <h2 class="card_heading"> Magic Link Login </h2>
                  <div class="card_desc">
                    <p>Customer easily login with magic link.</p>
                  </div>
                </div>
                <div class="card_body">
                  <div class=" FormLayout__Item">
                    <div class="toggle_wrapper">
                      <div class="">
                        <h2 class="heading">{{ $isSocialDisabled }}Enable Magic link</h2>
                      </div>
                      <div class="">
                        <div class="active_code">
                          <label class="switch">
                            <input type="checkbox" class="socialChecks" name="magicLink" id="magicLink" @isset($details['magicLink']) @if($details['magicLink'] == "on") {{ "checked" }} @endif @endisset {{($isSocialDisabled)?'disabled':''}}>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ------------Magic Link------------------ -->
              <div class="Widget_setting ">
                <!-- -----------------Marketing Consent Integration--------------- -->
                <div class="card_wrapper card_shadow">
                  <div class="card_head">
                    <h2 class="card_heading"> Marketing Consent </h2>
                    <div class="card_desc">
                      <p>Customer agree to receive marketing emails.</p>
                    </div>
                  </div>
                  <div class="card_body">
                    <div class=" FormLayout__Item">
                      <div class="toggle_wrapper">
                        <div class="">
                          <h2 class="heading">Enable</h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch">
                              <input type="checkbox" class="socialChecks" name="mark_consent" id="mark_consent" @isset($details['mark_consent']) @if($details['mark_consent'] == "on") {{ "checked" }} @endif @endisset>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" FormLayout__Item">
                      <div class="toggle_wrapper">
                        <div class="">
                          <h2 class="heading">Checked/Unchecked</h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch">
                              <input type="checkbox" class="socialChecks" name="mark_consent_check" id="mark_consent_check" @isset($details['mark_consent_check']) @if($details['mark_consent_check'] == "on") {{ "checked" }} @endif @endisset>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="Polaris-FormLayout__Item">
                      <div class="">
                        <div class="Polaris-Labelled__LabelWrapper">
                          <div class="Polaris-Label">
                            <label for="PolarisTextField19" class="Polaris-Label__Text">Checkbox Name</label>
                          </div>
                        </div>
                        <div class="Polaris-Connected">
                          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                            <div class="Polaris-TextField">
                              <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($details['mark_consent_name']) @if($details['mark_consent_name'] !='') {{ $details['mark_consent_name'] }} @else {{ 'Agree to receive marketing emails' }} @endif @endisset" id="mark_consent_name" name="mark_consent_name" placeholder="Enter message">
                              <div class="Polaris-TextField__Backdrop"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- -----------------Marketing Consent Integration--------------- -->
              </div>
              <!-- ------------ Terms & Condition------------------ -->
              <div class="Widget_setting ">
                <!-- -----------------Terms & Conditions-------------- -->
                <div class="card_wrapper card_shadow">
                  <div class="card_head">
                    <h2 class="card_heading"> Terms & Conditions </h2>
                    <div class="card_desc">
                      <p></p>
                    </div>
                  </div>
                  <div class="card_body">
                    <div class="FormLayout__Item">
                      <div class="toggle_wrapper">
                        <div class="">
                          <h2 class="heading">Enable</h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch">
                              <input type="checkbox" class="socialChecks" name="mark_terms" id="mark_terms"  @isset($details['mark_terms']) @if($details['mark_terms'] == "on") {{ "checked" }} @endif @endisset>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" FormLayout__Item">
                      <div class="toggle_wrapper">
                        <div class="">
                          <h2 class="heading">Checked/Unchecked</h2>
                        </div>
                        <div class="">
                          <div class="active_code">
                            <label class="switch">
                              <input type="checkbox" class="socialChecks" name="mark_terms_check" id="mark_terms_check" @isset($details['mark_terms_check']) @if($details['mark_terms_check'] == "on") {{ "checked" }} @endif @endisset>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- -----------------Terms&Conditions--------------- -->
              </div>
              <div>
                <div class="toggle card_shadow">
                  <div class="toggle_wrapper">
                    <div class="toggle_heading">
                      <h2>{{ $isSocialDisabled }}Enable google popup login </h2>
                    </div>
                    <div class="active_code" style="text-align: right;">
                      <label class="switch">
                        <input type="checkbox" id="gpopUpmodel" name="gpopUpmodel" @isset($details['gpopUpmodel']) @if($details['gpopUpmodel'] == "on") {{ "checked" }} @endif @endisset {{($isSocialDisabled)?'disabled':''}}>
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="content_wrapper">
                  <div class="box_wrapper card_shadow ">
                    <div class="txt_container">
                      <h2 class="heading">Google Popup Modal</h2>
                      <div class="sub_heading">
                        <p>If you using google popup, So you must provide google client id and then add Authorized JavaScript origins to you google console developer.</p>
                      </div>
                    </div>
                    <div class="box_content">
                      <div class="box_input_wrapper">
                        <div class="label">
                          <label for="PolarisTextField19" class="Polaris-Label__Text">Google client id</label>
                        </div>
                        <div class="input_wrapper">
                          <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($details['clientid']) {{ $details['clientid'] }} @endisset" name="clientid" id="" placeholder="google client id" required="">
                        </div>
                      </div>
                      <div class="box_input_wrapper">
                        <div class="label">
                          <label for="PolarisTextField19" class="Polaris-Label__Text">Authorized JavaScript origins</label>
                        </div>
                        <div class="input_wrapper">
                          <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="https://{{Auth::user()->name}}" name="shop-url" id="" placeholder="Shop Url" readonly="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="Widget_settings" style="display: none;">
            <form id="widgetFormSetting" method="post">
              <div class="card_wrapper card_shadow">
                <div class="card_head">
                  <h2 class="card_heading">Widget Title Settings</h2>

                  <div class="card_desc">
                    <p>Style widget to match the look and feel of your theme.</p>
                    <p>Write separator text for separating social login buttons from default login form.</p>
                  </div>
                </div>
                <div class="card_body">
                  <div class=" FormLayout__Item">

                    <div class="second">
                      <section>
                        <div class="content_wrapper">
                          <div class="Polaris-FormLayout__Item">
                            <div class="">
                              <div class="Polaris-Labelled__LabelWrapper">
                                <div class="widget_head"><h2 class="heading">Widget Heading</h2></div>
                              </div>
                              <div class="Polaris-Connected">
                                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                  <div class="Polaris-TextField"><input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($details['title_name']) @if($details['title_name'] !='') {{ $details['title_name'] }} @else {{ '' }} @endif @endisset" id="wedget_tag" name="title_name" placeholder="Enter title name">
                                    <div class="Polaris-TextField__Backdrop"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- -------wedget font size----------- -->
                          <div class="Polaris-FormLayout__Item">
                            <div>
                              <div class="">
                                <div class="Polaris-Labelled__LabelWrapper">
                                  <div class="widget_head"><h2 class="heading">Widget Font Size </h2></div>
                                </div>
                                <div class="Polaris-Connected">
                                  <input type="number" class="Polaris-TextField__Input" name="title_size" id="wedget_size" value="@isset($details['title_size']){{($details['title_size']!='')?$details['title_size']:'20'}}@endisset" min="15" max="32">
                                </div>
                              </div>
                              <div id="PolarisPortalsContainer"></div>
                            </div>
                          </div>
                          <!-- -------wedget font text color----------- -->
                          <div class="Polaris-FormLayout__Item">
                            <div>
                              <div class="font_color_wraper">
                                <div class="">
                                  <div class="widget_head"><h2 class="heading">Widget Font Color</h2></div>
                                </div>
                                <div class="Polaris-Connected">
                                  <img style="min-width:16px;min-height:16px;box-sizing:unset;box-shadow:none;background:unset;padding:0 6px 0 0;cursor:pointer;" src="chrome-extension://ohcpnigalekghcmgcdcenkpelffpdolg/img/icon16.png" title="Select with ColorPick Eyedropper - See advanced option: &quot;Add ColorPick Eyedropper near input[type=color] fields on websites&quot;" class="colorpick-eyedropper-input-trigger">
                                  <input type="color" name="title_color" id="wedget_color" value="@isset($details['title_color']) @if($details['title_color'] !='') {{ $details['title_color'] }} @else {{ '#000000' }} @endif @endisset" colorpick-eyedropper-active="true">
                                </div>
                              </div>
                              <div id="PolarisPortalsContainer"></div>
                            </div>
                          </div>
                          <!-- ---------------- -->
                          <div class="Polaris-FormLayout__Item">
                            <div class="">
                              <div class="Polaris-Labelled__LabelWrapper">
                                <div class="widget_head"><h2 class="heading">Social Login Form Separator Text</h2></div>
                              </div>
                              <div class="Polaris-Connected">
                                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                  <div class="Polaris-TextField"><input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($details['socialSeperator']) @if($details['socialSeperator'] !=''){{ $details['socialSeperator'] }} @else {{ 'Use Social Features' }} @endif @endisset" id="socialpalcehoder" name="socialSeperator" placeholder="Write login page Title" required="">
                                    <div class="Polaris-TextField__Backdrop"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                    </div>

                  </div>

                </div>
              </div>
              <!-- Custom Integration Setting for Widget -->
              <div class="integration_section">

                <div class="card_wrapper card_shadow">
                  <div class="card_head">
                    <h2 class="card_heading">{{ $isSocialDisabled }}Custom Integration With Theme</h2>
                    <div class="card_desc">
                      <p></p>
                    </div>
                  </div>
                  <div class="card_body">
                    <div class="FormLayout__Item">
                      <div class="Polaris-LegacyStack__Item">
                        <div>
                          <label class="Polaris-Choice radio-box" for="disabled">

                            <span class="Polaris-Choice__Label">
                              <span>Auto append</span>
                            </span>
                            <span class="Polaris-Choice__Control">
                              <div class="">
                                <div class="active_code"> <label class="switch"> <input type="checkbox" name="append_type" id="auto_append" class="radiobtncustom integrationOption" value="auto" @isset($details['append_type']) @if($details['append_type'] == 'auto' || $userPlan == "free") {{ "checked" }} @endif @endisset {{($isSocialDisabled)?'disabled':''}}> <span class="slider round"></span> </label> </div>
                              </div>
                            </span>
                          </label>
                        </div>
                      </div>

                      <div class="Polaris-LegacyStack__Item">
                        <div>
                          <label class="Polaris-Choice radio-box" for="disabled">
                            <span class="Polaris-Choice__Label">
                              <span>Id Selector</span>
                            </span>
                            <span class="Polaris-Choice__Control">

                              <div class="">
                                <div class="active_code"> <label class="switch"> <input type="checkbox" name="append_type" id="selector_append" class="radiobtncustom integrationOption" value="selector" @isset($details['append_type']) @if($details['append_type'] == 'selector' && $userPlan != "free") {{ "checked" }} @endif @endisset {{($isSocialDisabled)?'disabled':''}}> <span class="slider round"></span> </label> </div>
                              </div>
                            </span>
                          </label>
                          <div class="Polaris-TextField">
                            <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($details['append_type'])@if($details['append_type']=='selector')?{{$details['append_type']}}:{{''}} @endif @endisset" id="selector_setting" placeholder="Enter Class Name or Id Name" @isset($details['append_type']) @if($details['append_type'] != 'selector'){{ "style='display:none;'" }} @else {{ "name='appendOn'" }} @endif @endisset {{($isSocialDisabled)?'readonly':''}} >
                            <div class="Polaris-TextField__Backdrop"></div>
                          </div>
                        </div>
                      </div>
                      <div class="Polaris-LegacyStack__Item">
                        <div>
                          <label class="Polaris-Choice radio-box" for="disabled">

                            <span class="Polaris-Choice__Label">
                              <span>Custom Installation snippet</span>
                            </span>
                            <span class="Polaris-Choice__Control">
                              <div class="">
                                <div class="active_code"> <label class="switch"> <input type="checkbox" name="append_type" id="snippet" class="radiobtncustom integrationOption" value="snippet" @isset($details['append_type']) @if($details['append_type'] == 'snippet' && $userPlan != "free") {{ "checked" }} @endif @endisset {{($isSocialDisabled)?'disabled':''}}> <span class="slider round"></span> </label> </div>
                              </div>
                            </span>
                          </label>
                        </div>
                      </div>
                      <div class="input_wrapper">
                        <div class="Polaris-TextField">
                          <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="<div class='login_genie_snippet'></div>" id="snippet_setting" @isset($details['append_type']) @if($details['append_type']!="snippet"){{"style='display:none;'"}} @else {{"name='appendOn'"}} @endif @endisset readonly="">
                          <div class="Polaris-TextField__Backdrop"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Custom Integration Setting -->

            </form>
          </div>
          <div class="popup_settings" style="display: none;">
            <div class="model_setting">
              <div class="containers">
                <form id="popUpForm" method="post" enctype="multipart/form-data">
                  <div>
                    <div class="toggle card_shadow ">
                      <div class="toggle_wrapper">
                        <div class="toggle_heading">
                          <h2>{{ $isSocialDisabled }}Enable/Disable Popup Modal </h2>
                        </div>
                        <div class="active_code" style="text-align: right;">
                          <label class="switch">
                            <input type="checkbox" id="popUpmodel" @isset($modalSettings['popUpmodel']) @if($modalSettings['popUpmodel'] == "on") {{ "checked" }} @endif @endisset name="popUpmodel" {{($isSocialDisabled)?'disabled':''}}>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="content_wrapper">
                      <div class="box_wrapper card_shadow ">
                        <div class="txt_container">
                          <h2 class="heading">PopUp Modal</h2>
                          <div class="sub_heading">
                            <p>Style Popup Modal to match the look and feel of your theme.</p>
                          </div>
                        </div>
                        <div class="box_content pop_model">
                          <div class="box_left">
                            <div class="left_Card">
                              <div class="left_Card__Section">
                                <div class="left_Card_heading">
                                  <h3 aria-label="Shape and Size">Choose background Color Or Image.</h3>
                                </div>
                              </div>
                              <!-- ------ -->
                              <div class="positions">
                                <section>
                                  <div>
                                    <input type="radio" id="control_color" name="background" @isset($modalSettings['backStatus']) @if($modalSettings['backStatus'] == 'color') {{ "checked" }} @endif @endisset>
                                    <label class="section_btn" for="control_color">
                                      <div class="btn_txt">Color</div>
                                    </label>
                                  </div>
                                  <div>
                                    <input type="radio" id="control_image" @isset($modalSettings['backStatus']) @if($modalSettings['backStatus'] == 'imagetype') {{ "checked" }} @endif @endisset name="background">
                                    <label class="section_btn" for="control_image">
                                      <div class="btn_txt">Image</div>
                                    </label>
                                  </div>
                                </section>
                              </div>
                              <!-- ---- -->
                              <div class=" color_wrapper">
                                <div class="modelbackcolor" style="display: none;">
                                  <div class="">
                                    <div class="">
                                      <label for="PolarisTextField19" class="Polaris-Label__Text">Back Ground Color</label>
                                    </div>
                                  </div>
                                  <div class="">
                                    <img style="min-width:16px;min-height:16px;box-sizing:unset;box-shadow:none;background:unset;padding:0 6px 0 0;cursor:pointer;" src="chrome-extension://ohcpnigalekghcmgcdcenkpelffpdolg/img/icon16.png" title="Select with ColorPick Eyedropper - See advanced option: &quot;Add ColorPick Eyedropper near input[type=color] fields on websites&quot;" class="colorpick-eyedropper-input-trigger"><input type="color" name="popUpBackColor" id="popUpBackColor" value="@isset($modalSettings['popUpBackColor']){{($modalSettings['popUpBackColor'])?$modalSettings['popUpBackColor']:'#d3e8f2'}}@endisset" style="width: 25%;height: 40px;padding:5px 10px 5px 10px; border-radius: 6px;margin-bottom: 14px;" colorpick-eyedropper-active="true">
                                  </div>
                                </div>
                                <div class="modelBackImage" style="display: block;">
                                  <div class="">
                                    <div class="Polaris-Label">
                                      <label for="PolarisTextField19" class="Polaris-Label__Text">Upload Image</label>
                                    </div>
                                  </div>
                                  <div class="Polaris-Connected">
                                    <input type="file" name="fileToUpload" id="popUpBackimage" accept="image/png, image/jpeg" onchange="fileSelected(this)">
                                    <input type="hidden" id="imageHidden" name="" data-image="https://apps.sketchthemes.com/a/login-genie/uploads/login_image.jpg">
                                    <span class="uploadError" style="display:none;">Please Upload Valid Image</span>
                                  </div>
                                  <div class="imageBox" style="@isset($modalSettings['backStatus']){{($modalSettings['backStatus']=='imagetype')?'display: block;':'display: none;'}}@endisset">
                                    @if($modalSettings['newimage'] !='' || $modalSettings['newimage'] != null)
                                    <img id="asgnmnt_file_img" src="{{ asset($modalSettings['newimage']) }}" onclick="passFileUrl()">
                                    @else
                                    <img id="asgnmnt_file_img" src="" onclick="passFileUrl()">
                                    @endif
                                    
                                  </div>
                                </div>
                                <div class="modelbordercolor" style="display:none">
                                  <div class="">
                                    <div class="">
                                      <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Border Color</label>
                                    </div>
                                  </div>
                                  <div class="">
                                    <img style="min-width:16px;min-height:16px;box-sizing:unset;box-shadow:none;background:unset;padding:0 6px 0 0;cursor:pointer;" src="chrome-extension://ohcpnigalekghcmgcdcenkpelffpdolg/img/icon16.png" title="Select with ColorPick Eyedropper - See advanced option: &quot;Add ColorPick Eyedropper near input[type=color] fields on websites&quot;" class="colorpick-eyedropper-input-trigger"><input type="color" name="popUpBorderColor" id="popUpBorderColor" value="#080808" style="width: 25%;height: 45px;padding:5px 10px 5px 10px; border-radius: 6px;" required="" colorpick-eyedropper-active="true">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="box_right" style="display:none">
                            <div class="box_input_wrapper">
                              <div class="label">
                                <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Border Size(In px)</label>
                              </div>
                              <div class="input_wrapper">
                                <input type="number" name="popUpbordeSize" value="@isset($details['popUpbordeSize']){{$details['popUpbordeSize']}}:{{'5'}} @endisset" id="popUpbordeSize" min="0" max="10" style="width: 100%;padding: 9px 0px 10px 10px; border-radius: 6px;" required="">
                              </div>
                            </div>
                            <div class="box_input_wrapper" style="display:none">
                              <div class="label">
                                <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Border Type</label>
                              </div>
                              <div class="input_wrapper">
                                <select id="popUpborderType" name="popUpborderType">
                                  <option value="solid"> Solid </option>
                                  <option value="dashed"> Dashed </option>
                                  <option value="dotted" selected=""> Dotted </option>
                                </select>
                              </div>
                            </div>
                            <div class="box_input_wrapper">
                              <div class="label">
                                <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Border Radius(In px)</label>
                              </div>
                              <div class="input_wrapper">
                                <input type="number" name="popUpbordeRadius" value="10" id="popUpbordeRadius" min="0" max="30" style="width: 100%;padding: 9px 0px 10px 10px; border-radius: 6px;" required="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form_design">
                    <div>
                      <div class="box_wrapper card_shadow">
                        <div class="txt_container">
                          <h2 class="heading">Form Designs</h2>
                          <div class="sub_heading">
                            <p>Style form to match the look and feel of your theme.</p>
                          </div>
                        </div>
                        <div class="box_content">
                          <div>
                            <div class="">
                              <div class="box_input_wrapper">
                                <div class="label">
                                  <label for="PolarisTextField19" class="Polaris-Label__Text">Login Form Title</label>
                                </div>
                                <div class="input_wrapper">
                                  <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($modalSettings['loginPageHeading']){{(!empty($modalSettings['loginPageHeading']))?$modalSettings['loginPageHeading']:'Sign In Please'}}@endisset" name="loginPageHeading" id="loginPageHeading" placeholder="Write login page Title" required="">
                                </div>
                              </div>
                              <div class="box_input_wrapper">
                                <div class="label">
                                  <label for="PolarisTextField19" class="Polaris-Label__Text">Login Form Button Title</label>
                                </div>
                                <div class="input_wrapper">
                                  <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($modalSettings['loginPageBttnTitle']){{(!empty($modalSettings['loginPageBttnTitle']))?$modalSettings['loginPageBttnTitle']:'LOGIN'}}@endisset" name="loginPageBttnTitle" id="loginPageBttnTitle" placeholder="Write Sign In Button Title" required="">
                                </div>
                              </div>
                              <div class="box_input_wrapper">
                                <div class="label">
                                  <label for="PolarisTextField19" class="Polaris-Label__Text">Register Form Title</label>
                                </div>
                                <div class="input_wrapper">
                                  <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($modalSettings['signUpPageHeading']){{(!empty($modalSettings['signUpPageHeading']))?$modalSettings['signUpPageHeading']:'Sign Up'}}@endisset" id="signUpPageHeading" name="signUpPageHeading" placeholder="Write login page Title" required="">
                                </div>
                              </div>
                              <div class="box_input_wrapper">
                                <div class="label">
                                  <label for="PolarisTextField19" class="Polaris-Label__Text">Register Form Button Title</label>
                                </div>
                                <div class="input_wrapper">
                                  <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($modalSettings['signUpPageBttnTitle']){{(!empty($modalSettings['signUpPageBttnTitle']))?$modalSettings['signUpPageBttnTitle']:'REGISTER'}}@endisset" name="signUpPageBttnTitle" id="signUpPageBttnTitle" placeholder="Write Sign Up Button Title" required="">
                                </div>
                              </div>
                              <div class="box_input_wrapper">
                                <div class="label">
                                  <label for="PolarisTextField19" class="Polaris-Label__Text">Forgot Password Form Title</label>
                                </div>
                                <div class="input_wrapper">
                                  <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($modalSettings['resetPageHeading']){{(!empty($modalSettings['resetPageHeading']))?$modalSettings['resetPageHeading']:'Reset your password'}}@endisset" name="resetPageHeading" id="resetPageHeading" placeholder="Write login page Title" required="">
                                </div>
                              </div>
                              <div class="box_input_wrapper">
                                <div class="label">
                                  <label for="PolarisTextField19" class="Polaris-Label__Text">Forgot Password Form Button Title Name</label>
                                </div>
                                <div class="input_wrapper">
                                  <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($modalSettings['resetPageBttnTitle']){{(!empty($modalSettings['resetPageBttnTitle']))?$modalSettings['resetPageBttnTitle']:'SEND'}}@endisset" name="resetPageBttnTitle" id="resetPageBttnTitle" placeholder="Write Sign In Button Title" required="">
                                </div>
                              </div>
                              <div class="box_input_wrapper">
                                <div class="label">
                                  <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Title Size(In px)</label>
                                </div>
                                <div class="input_wrapper">
                                  <input type="number" name="logintitle_size" id="title_size" value="@isset($modalSettings['logintitle_size']){{(!empty($modalSettings['logintitle_size']))?$modalSettings['logintitle_size']:'18'}}@endisset" min="15" max="32" style="width: 100%;padding: 9px 0px 10px 10px;border-radius: 6px;" required="">
                                </div>
                              </div>
                            </div>
                            <div class=" color_section">
                              <div class="box_input_wrapper">
                                <div class="label">
                                  <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Title Color</label>
                                </div>
                                <div class="input_wrapper">
                                  <input type="color" name="logintitle_color" id="title_color" value="@isset($modalSettings['logintitle_color']){{(!empty($modalSettings['logintitle_color']))?$modalSettings['logintitle_color']:'#000000'}}@endisset" colorpick-eyedropper-active="true">
                                </div>
                              </div>
                              <div class="box_input_wrapper">
                                <div class="label">
                                  <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Form Button Title Color</label>
                                </div>
                                <div class="input_wrapper">
                                  <input type="color" name="loginBttontitle_color" id="loginBttontitle_color" value="@isset($modalSettings['loginBttontitle_color']){{(!empty($modalSettings['loginBttontitle_color']))?$modalSettings['loginBttontitle_color']:'#ffffff'}}@endisset" colorpick-eyedropper-active="true">
                                </div>
                              </div>
                              <div class="box_input_wrapper">
                                <div class="label">
                                  <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Button Back Ground Color</label>
                                </div>
                                <div class="input_wrapper">
                                  <input type="color" name="loginBttonback_color" id="loginBttonback_color" value="@isset($modalSettings['loginBttonback_color']){{(!empty($modalSettings['loginBttonback_color']))?$modalSettings['loginBttonback_color']:'#2772b3'}}@endisset" colorpick-eyedropper-active="true">
                                </div>
                              </div>
                              <div class="box_input_wrapper">
                                <div class="label">
                                  <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Button Hover Color</label>
                                </div>
                                <div class="input_wrapper">
                                 <input type="color" name="loginBttonbackHover_color" id="loginBttonbackHover_color" value="@isset($modalSettings['loginBttonbackHover_color']){{(!empty($modalSettings['loginBttonbackHover_color']))?$modalSettings['loginBttonbackHover_color']:'#2772b3'}}@endisset" colorpick-eyedropper-active="true">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Custom Integration Setting for popup -->
                      <div class="integration_section">

                        <div class="card_wrapper card_shadow">
                          <div class="card_head">
                            <h2 class="card_heading">{{ $isSocialDisabled }}Custom Popup Integration With Theme </h2>
                            <div class="card_desc">
                              <p></p>
                            </div>
                          </div>
                          <div class="card_body">
                            <div class="FormLayout__Item">
                              <div class="Polaris-LegacyStack__Item">
                                <div>
                                  <label class="Polaris-Choice radio-box" for="disabled">

                                    <span class="Polaris-Choice__Label">
                                      <span>Auto append</span>
                                    </span>
                                    <span class="Polaris-Choice__Control">
                                      <div class="">
                                        <div class="active_code"> <label class="switch"> <input type="checkbox" name="popup_append_type" id="popup_auto_append" class="radiobtncustom popup_integrationOption" value="auto" @isset($modalSettings['popup_append_type']) @if($modalSettings['popup_append_type'] == 'auto' || $userPlan == "free") {{ 'checked' }} @endif @endisset {{($isSocialDisabled)?'disabled':''}}> <span class="slider round"></span> </label> </div>
                                      </div>
                                    </span>
                                  </label>
                                </div>
                              </div>

                              <div class="Polaris-LegacyStack__Item">
                                <div>
                                  <label class="Polaris-Choice radio-box" for="disabled">
                                    <span class="Polaris-Choice__Label">
                                      <span>Id Selector</span>
                                    </span>
                                    <span class="Polaris-Choice__Control">

                                      <div class="">
                                        <div class="active_code"> <label class="switch"> <input type="checkbox" name="popup_append_type" id="popup_selector_append" class="radiobtncustom popup_integrationOption" value="selector"  @isset($modalSettings['popup_append_type']) @if($modalSettings['popup_append_type'] == 'selector' && $userPlan != "free") {{ 'checked' }} @endif @endisset {{($isSocialDisabled)?'disabled':''}}> <span class="slider round"></span> </label> </div>
                                      </div>
                                    </span>
                                  </label>
                                  <div class="Polaris-TextField">
                                    <input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" name="popup_appendOn" value="@isset($modalSettings['popup_appendOn']){{($modalSettings['popup_appendOn'])?$modalSettings['popup_appendOn']:''}}@endisset" id="popup_selector_setting" placeholder="Enter Class Name or Id Name" style="@isset($modalSettings['popup_append_type']) @if($modalSettings['popup_append_type'] == 'auto') {{ 'display:none;' }} @endif @endisset">
                                    <div class="Polaris-TextField__Backdrop"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Custom Integration Setting For popup -->
                    </div>
                  </div>
                  <button type="button" id="popUpSettingButtn" style="display:none;">Save</button>
                </form>
              </div>
            </div>
          </div>
          <div class="save-btn">
            <button type="button" id="saveSettingButtn">Save</button>
          </div>
        </div>
        <div class="col-md-7">
          <div class="view_port">
            <div class="view_type_selector">
              <button class="widget btn_style active_view" onclick="viewtype(&quot;widget&quot;)">Widget</button>
              <button class="popup_open btn_style" onclick="viewtype(&quot;popup&quot;)">Pop Up</button>
            </div>
            <div class="destop_view">
              <div class="BarPreview-content">
                <div class="BarPreview-content-header">
                  <div>
                    <div class="menu">
                      <span></span><span></span><span></span>
                    </div>
                  </div>
                  <div class="url"><span></span> </div>
                </div>
              </div>
              <div class="destop_viewed_container">
                <div class="destop_viewed_contant">
                  <div class="social_icons" style="order: 1;">
                    <h4 id="socil_icon" style="color: rgb(0, 0, 0);"></h4>

                    <div class="social_icons_container">

                      <div id="view_google_status" class="icon_boxes bg-google" style="display: none; border-radius: 0%; order: 2;">
                        <i class="fa-brands fa-google"></i> <span class="icon_name">google </span>
                      </div>
                      <div id="view_facebook_status" class="icon_boxes bg-facebook" style="display: none; border-radius: 0%; order: 3;">
                        <i class="fa-brands fa-facebook-f"></i> <span class="icon_name">facebook </span>
                      </div>
                      <div id="view_twitter_status" class="icon_boxes bg-twitter" style="display: none; border-radius: 0%; order: 5;">
                        <i class="fa-brands fa-twitter"></i> <span class="icon_name">twitter </span>
                      </div>
                      <div id="view_linkedin_status" class="icon_boxes bg-linkedIn" style="display: none; border-radius: 0%;">
                        <i class="fa-brands fa-linkedin"></i> <span class="icon_name">linkedin </span>
                      </div>
                      <div id="view_amazon_status" class="icon_boxes bg-amazon" style="display: none; border-radius: 0%; order: 6;">
                        <i class="fa-brands fa-amazon"></i> <span class="icon_name">amazon </span>
                      </div>
                      <div id="view_yahoo_status" class="icon_boxes bg-yahoo" style="display: none; border-radius: 0%; order: 8;">
                        <i class="fa-brands fa-yahoo"></i> <span class="icon_name">yahoo </span>
                      </div>
                      <div id="view_vkontakte_status" class="icon_boxes bg-vkontakte" style="display: none; border-radius: 0%; order: 9;">
                        <svg class="svg-inline--fa fa-vk fa-w-18" style="font-size: 17px" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="vk" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                          <path fill="currentColor" d="M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z"></path>
                        </svg>
                        <span class="icon_name">vkontakte</span>
                      </div>
                      <div id="view_yandex_status" class="icon_boxes bg-yandex" style="display: none; border-radius: 0%; order: 15;">
                        <svg class="svg-inline--fa fa-yandex fa-w-8" style="font-size: 17px;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="yandex" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                          <path fill="currentColor" d="M153.1 315.8L65.7 512H2l96-209.8c-45.1-22.9-75.2-64.4-75.2-141.1C22.7 53.7 90.8 0 171.7 0H254v512h-55.1V315.8h-45.8zm45.8-269.3h-29.4c-44.4 0-87.4 29.4-87.4 114.6 0 82.3 39.4 108.8 87.4 108.8h29.4V46.5z"></path>
                        </svg>
                        <span class="icon_name">Yandex</span>
                      </div>
                      <div id="view_spotify_status" class="icon_boxes bg-spotify" style="display: none; border-radius: 0%; order: 10;">
                        <i class="fa-brands fa-spotify"></i> <span class="icon_name">spotify </span>
                      </div>
                      <div id="view_paypal_status" class="icon_boxes bg-paypal" style="display: none; border-radius: 0%; order: 11;">
                        <i class="fa-brands fa-paypal"></i> <span class="icon_name"> paypal </span>
                      </div>
                      <div id="view_discord_status" class="icon_boxes bg-discord" style="display: none; border-radius: 0%; order: 12;">
                        <i class="fa-brands fa-discord"></i> <span class="icon_name">discord </span>
                      </div>
                      <div id="view_disqus_status" class="icon_boxes bg-disqus" style="display: none; border-radius: 0%; order: 13;">
                        <svg class="svg-inline--fa fa-disqus fa-w-14 role=" img="" viewBox="5 5 18 17" xmlns="http://www.w3.org/2000/svg">
                          <title>Disqus</title>
                          <path fill="#fff" d="M12.438 23.654c-2.853 0-5.46-1.04-7.476-2.766L0 21.568l1.917-4.733C1.25 15.36.875 13.725.875 12 .875 5.564 6.05.346 12.44.346 18.82.346 24 5.564 24 12c0 6.438-5.176 11.654-11.562 11.654zm6.315-11.687v-.033c0-3.363-2.373-5.76-6.462-5.76H7.877V17.83h4.35c4.12 0 6.525-2.5 6.525-5.863h.004zm-6.415 2.998h-1.29V9.04h1.29c1.897 0 3.157 1.08 3.157 2.945v.03c0 1.884-1.26 2.95-3.157 2.95z"></path>
                        </svg>
                        <span class="icon_name">disqus</span>
                      </div>
                      <div id="view_github_status" class="icon_boxes bg-gitHub" style="display: none; border-radius: 0%;">
                        <i class="fa-brands fa-github"></i> <span class="icon_name"> github </span>
                      </div>
                      <div id="view_twitchtv_status" class="icon_boxes bg-twitchTV" style="display: none; border-radius: 0%;">
                        <i class="fa-brands fa-twitch"></i> <span class="icon_name"> twitch </span>
                      </div>
                      <div id="view_wordpress_status" class="icon_boxes bg-wordpress" style="display: none; border-radius: 0%; order: 1;">
                        <i class="fa-brands fa-wordpress"></i> <span class="icon_name">wordpress </span>
                      </div>
                      <div id="view_foursquare_status" class="icon_boxes bg-foursquare" style="display: none; border-radius: 0%; order: 16;">
                        <i class="fa-brands fa-foursquare"></i> <span class="icon_name">foursquare </span>
                      </div>
                      <div id="view_microsoftgraph_status" class="icon_boxes bg-microsoft" style="display: none; border-radius: 0%;">
                        <i class="fa-brands fa-microsoft"></i> <span class="icon_name">microsoft </span>
                      </div>
                      <div id="view_apple_status" class="icon_boxes bg-apple" style="display: none; border-radius: 0%; order: 18;">
                        <i class="fa-brands fa-apple"></i> <span class="icon_name">apple </span>
                      </div>
                      <div id="view_kakao_status" class="icon_boxes bg-kakao" style="display: none; border-radius: 0%; order: 7;">
                        <svg class="svg-inline--fa fa-kickstarter fa-w-14" style="font-size: 17px" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="kickstarter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                          <path fill="currentColor" d="M400 480H48c-26.4 0-48-21.6-48-48V80c0-26.4 21.6-48 48-48h352c26.4 0 48 21.6 48 48v352c0 26.4-21.6 48-48 48zM199.6 178.5c0-30.7-17.6-45.1-39.7-45.1-25.8 0-40 19.8-40 44.5v154.8c0 25.8 13.7 45.6 40.5 45.6 21.5 0 39.2-14 39.2-45.6v-41.8l60.6 75.7c12.3 14.9 39 16.8 55.8 0 14.6-15.1 14.8-36.8 4-50.4l-49.1-62.8 40.5-58.7c9.4-13.5 9.5-34.5-5.6-49.1-16.4-15.9-44.6-17.3-61.4 7l-44.8 64.7v-38.8z"></path>
                        </svg>
                        <span class="icon_name">kakao</span>
                      </div>
                      <div class="icon_boxes fa-magic_icon" style="display: none; border-radius: 0%; order: 20;">
                        <svg class="svg-inline--fa fa-magic fa-w-16" style="font-size: 17px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magic" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                          <path fill="currentColor" d="M224 96l16-32 32-16-32-16-16-32-16 32-32 16 32 16 16 32zM80 160l26.66-53.33L160 80l-53.34-26.67L80 0 53.34 53.33 0 80l53.34 26.67L80 160zm352 128l-26.66 53.33L352 368l53.34 26.67L432 448l26.66-53.33L512 368l-53.34-26.67L432 288zm70.62-193.77L417.77 9.38C411.53 3.12 403.34 0 395.15 0c-8.19 0-16.38 3.12-22.63 9.38L9.38 372.52c-12.5 12.5-12.5 32.76 0 45.25l84.85 84.85c6.25 6.25 14.44 9.37 22.62 9.37 8.19 0 16.38-3.12 22.63-9.37l363.14-363.15c12.5-12.48 12.5-32.75 0-45.24zM359.45 203.46l-50.91-50.91 86.6-86.6 50.91 50.91-86.6 86.6z"></path>
                        </svg>
                        <span class="icon_name">Magic Link</span>
                      </div>

                    </div>
                    <p class="whitelabel">Powerd by <a href="#">Sketch App</a></p>

                  </div>
                  <div class="header__center" style="order: 2;">Use Social Features</div>
                  <div class="login_fornm" style="order: 3;">

                    <h5>Login</h5>
                    <div class="input_feilds">
                      <input type="email" placeholder="Email">
                      <input type="text" placeholder="Password">
                    </div>
                    <p><a>Forgot your password?</a></p>
                    <button class="signIn">Sign In</button>
                    <div class="market_consent" style="display: none;">
                      <input type="checkbox" name="mc_consent" id="mc_consent">
                      <label for="mc_consent">Agree to receive marketing emails</label>
                    </div>
                    <span class="terms_div"><input type="checkbox" name="terms_check" class="terms_check">
                      <lable for="mark_terms" id="terms_check_lable">I agree to <a href="#" target="_blank">Terms of Use</a></lable>
                    </span>
                    <p><a href="#">Create Account</a></p>
                  </div>
                </div>
                <div class="destop_popus">
                  <div class="modal is-visible" style="">
                    <div class="modal-overlay modal-toggle"></div>
                    <div class="modal-wrapper modal-transition">
                      <div class="modal-body">
                        <button class="modal-close modal-toggle"><i class="fa fa-times" aria-hidden="true"></i></button>

                        <div class="login_box">
                          <div class="left">
                            <div class="socil_icon" style="order: 1;">
                              <h2 class="heading" id="des_pop_social_text" style="color: rgb(0, 0, 0);"></h2>
                              <div class="social_icons_container">

                                <div id="des_popup_view_google_status" class="icon_boxes bg-google" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-google"></i> <span class="icon_name">google </span>
                                </div>
                                <div id="des_popup_view_facebook_status" class="icon_boxes bg-facebook" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-facebook-f"></i> <span class="icon_name">facebook </span>
                                </div>
                                <div id="des_popup_view_twitter_status" class="icon_boxes bg-twitter" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-twitter"></i> <span class="icon_name">twitter </span>
                                </div>
                                <div id="des_popup_view_linkedin_status" class="icon_boxes bg-linkedIn" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-linkedin"></i> <span class="icon_name">linkedin </span>
                                </div>
                                <div id="des_popup_view_amazon_status" class="icon_boxes bg-amazon" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-amazon"></i> <span class="icon_name">amazon </span>
                                </div>
                                <div id="des_popup_view_yahoo_status" class="icon_boxes bg-yahoo" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-yahoo"></i> <span class="icon_name">yahoo </span>
                                </div>
                                <div id="des_popup_view_vkontakte_status" class="icon_boxes bg-vkontakte" style="display: none; border-radius: 0%;">
                                  <svg class="svg-inline--fa fa-vk fa-w-18" style="font-size: 17px" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="vk" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z"></path>
                                  </svg>
                                  <span class="icon_name">vkontakte</span>
                                </div>
                                <div id="des_popup_view_yandex_status" class="icon_boxes bg-yandex" style="display: none; border-radius: 0%;">
                                  <svg class="svg-inline--fa fa-yandex fa-w-8" style="font-size: 17px;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="yandex" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M153.1 315.8L65.7 512H2l96-209.8c-45.1-22.9-75.2-64.4-75.2-141.1C22.7 53.7 90.8 0 171.7 0H254v512h-55.1V315.8h-45.8zm45.8-269.3h-29.4c-44.4 0-87.4 29.4-87.4 114.6 0 82.3 39.4 108.8 87.4 108.8h29.4V46.5z"></path>
                                  </svg>
                                  <span class="icon_name">Yandex</span>
                                </div>
                                <div id="des_popup_view_spotify_status" class="icon_boxes bg-spotify" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-spotify"></i> <span class="icon_name">spotify </span>
                                </div>
                                <div id="des_popup_view_paypal_status" class="icon_boxes bg-paypal" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-paypal"></i> <span class="icon_name"> paypal </span>
                                </div>
                                <div id="des_popup_view_discord_status" class="icon_boxes bg-discord" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-discord"></i> <span class="icon_name">discord </span>
                                </div>
                                <div id="des_popup_view_disqus_status" class="icon_boxes bg-disqus" style="display: none; border-radius: 0%;">
                                  <svg class="svg-inline--fa fa-disqus fa-w-14 role=" img="" viewBox="5 5 18 17" xmlns="http://www.w3.org/2000/svg">
                                    <title>Disqus</title>
                                    <path fill="#fff" d="M12.438 23.654c-2.853 0-5.46-1.04-7.476-2.766L0 21.568l1.917-4.733C1.25 15.36.875 13.725.875 12 .875 5.564 6.05.346 12.44.346 18.82.346 24 5.564 24 12c0 6.438-5.176 11.654-11.562 11.654zm6.315-11.687v-.033c0-3.363-2.373-5.76-6.462-5.76H7.877V17.83h4.35c4.12 0 6.525-2.5 6.525-5.863h.004zm-6.415 2.998h-1.29V9.04h1.29c1.897 0 3.157 1.08 3.157 2.945v.03c0 1.884-1.26 2.95-3.157 2.95z"></path>
                                  </svg>
                                  <span class="icon_name">disqus </span>
                                </div>
                                <div id="des_popup_view_github_status" class="icon_boxes bg-gitHub" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-github"></i> <span class="icon_name"> github </span>
                                </div>
                                <div id="des_popup_view_twitchtv_status" class="icon_boxes bg-twitchTV" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-twitch"></i> <span class="icon_name"> twitch </span>
                                </div>
                                <div id="des_popup_view_wordpress_status" class="icon_boxes bg-wordpress" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-wordpress"></i> <span class="icon_name">wordpress </span>
                                </div>
                                <div id="des_popup_view_foursquare_status" class="icon_boxes bg-foursquare" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-foursquare"></i> <span class="icon_name">foursquare </span>
                                </div>
                                <div id="des_popup_view_microsoftgraph_status" class="icon_boxes bg-microsoft" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-microsoft"></i> <span class="icon_name">microsoft </span>
                                </div>
                                <div id="des_popup_view_apple_status" class="icon_boxes bg-apple" style="display: none; border-radius: 0%;">
                                  <i class="fa-brands fa-apple"></i> <span class="icon_name">apple </span>
                                </div>
                                <div id="des_popup_view_kakao_status" class="icon_boxes bg-kakao" style="display: none; border-radius: 0%;">
                                  <svg class="svg-inline--fa fa-kickstarter fa-w-14" style="font-size: 17px" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="kickstarter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M400 480H48c-26.4 0-48-21.6-48-48V80c0-26.4 21.6-48 48-48h352c26.4 0 48 21.6 48 48v352c0 26.4-21.6 48-48 48zM199.6 178.5c0-30.7-17.6-45.1-39.7-45.1-25.8 0-40 19.8-40 44.5v154.8c0 25.8 13.7 45.6 40.5 45.6 21.5 0 39.2-14 39.2-45.6v-41.8l60.6 75.7c12.3 14.9 39 16.8 55.8 0 14.6-15.1 14.8-36.8 4-50.4l-49.1-62.8 40.5-58.7c9.4-13.5 9.5-34.5-5.6-49.1-16.4-15.9-44.6-17.3-61.4 7l-44.8 64.7v-38.8z"></path>
                                  </svg>
                                  <span class="icon_name">kakao</span>
                                </div>
                                <div class="icon_boxes fa-magic_icon" style="display: none; border-radius: 0%; order: 20;">
                                  <svg class="svg-inline--fa fa-magic fa-w-16" style="font-size: 17px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magic" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M224 96l16-32 32-16-32-16-16-32-16 32-32 16 32 16 16 32zM80 160l26.66-53.33L160 80l-53.34-26.67L80 0 53.34 53.33 0 80l53.34 26.67L80 160zm352 128l-26.66 53.33L352 368l53.34 26.67L432 448l26.66-53.33L512 368l-53.34-26.67L432 288zm70.62-193.77L417.77 9.38C411.53 3.12 403.34 0 395.15 0c-8.19 0-16.38 3.12-22.63 9.38L9.38 372.52c-12.5 12.5-12.5 32.76 0 45.25l84.85 84.85c6.25 6.25 14.44 9.37 22.62 9.37 8.19 0 16.38-3.12 22.63-9.37l363.14-363.15c12.5-12.48 12.5-32.75 0-45.24zM359.45 203.46l-50.91-50.91 86.6-86.6 50.91 50.91-86.6 86.6z"></path>
                                  </svg>
                                  <span class="icon_name">Magic Link</span>

                                </div>
                              </div>
                              <p class="whitelabel">Powerd by <a href="#">Sketch App</a></p>
                            </div>
                            <div class="header__center" style="order: 2;">Use Social Features</div>
                            <div class="sign_in_mini" style="order: 3;">
                              <h4 class="signingFormHeading" style="color:@isset($modalSettings['loginBttontitle_color']){{(!empty($modalSettings['loginBttontitle_color']))?$modalSettings['loginBttontitle_color']:'#ffffff'}}@endisset;">@isset($modalSettings['loginPageHeading']){{(!empty($modalSettings['loginPageHeading']))?$modalSettings['loginPageHeading']:'Sign In Please'}}@endisset</h4>
                              <div class="sign_form">
                                <div class="input_box">
                                  <input type="text" placeholder="Email or Phone">
                                  <input type="text" placeholder="Password">
                                </div>
                                <div class="forgotPasss">
                                  <span>Forgot Password</span>
                                  <span>Sign Up</span>
                                </div>
                                <div class="market_consent" style="display: none;">
                                  <input type="checkbox" name="mc_consent" id="mc_consent">
                                  <label for="mc_consent">Agree to receive marketing emails</label>
                                </div>
                                <span class="terms_div"><input type="checkbox" name="terms_check" class="terms_check">
                                  <lable for="mark_terms" id="terms_check_lable">I agree to <a class="tacm"> Terms of Use </a></lable>
                                </span>
                                <div class="submit_btn">
                                  <button class="signingButtonText" style="color:@isset($modalSettings['loginBttontitle_color']){{(!empty($modalSettings['loginBttontitle_color']))?$modalSettings['loginBttontitle_color']:'#ffffff'}}@endisset;">@isset($modalSettings['loginPageBttnTitle']){{(!empty($modalSettings['loginPageBttnTitle']))?$modalSettings['loginPageBttnTitle']:'LOGIN'}}@endisset</button>
                                </div>

                              </div>
                            </div>
                          </div>
                          <div class="right" style="{{$popupImgTag}};">
                            <div class="overlay"></div>
                            <div class="right-text">
                              <div class="logo_img"><img src="https://cdn.shopify.com/s/files/1/0597/6496/5550/files/CLCBiZqrpvICEAE.png?v=1677834387" style="height:100%;width:100%" alt=""></div>
                              <h2>Login Genie</h2>

                            </div>
                            <div class="right-inductor"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="screen_overlay" style="display: none;"></div>
              <div class="fb_btn">
                <span class="zoom-in"><i class="fa-solid fa-up-right-and-down-left-from-center"></i></span> <span class="zoom-out"><i class="fa-solid fa-down-left-and-up-right-to-center"></i></span>
              </div>
            </div>

            <div class="mobile_view">
              <div class="BarPreview-content-mobile-block">
                <div class="BarPreview-content-mobile-header">
                  <div class="mic"></div>
                  <div class="cam"></div>
                </div>
                <div class="BarPreview-content-mobile-body">
                  <div class="destop_popus">

                    <div class="modal is-visible">
                      <div class="modal-overlay modal-toggle"></div>
                      <div class="modal-wrapper modal-transition">
                        <div class="modal-body">
                          <button class="modal-close modal-toggle"><i class="fa fa-times" aria-hidden="true"></i></button>

                          <div class="login_box">
                            <div class="left">
                              <div class="socil_icon" style="order: 1;">
                                <h2 class="heading" id="mob_pop_social_text" style="color: rgb(0, 0, 0);"></h2>
                                <div class="social_icons_container">

                                  <div id="mob_popup_view_google_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-google" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-google"></i> <span class="icon_name">google </span>
                                  </div>
                                  <div id="mob_popup_view_facebook_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-facebook" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-facebook-f"></i> <span class="icon_name">facebook </span>
                                  </div>
                                  <div id="mob_popup_view_twitter_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-twitter" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-twitter"></i> <span class="icon_name">twitter </span>
                                  </div>
                                  <div id="mob_popup_view_linkedin_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-linkedIn" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-linkedin"></i> <span class="icon_name">linkedin </span>
                                  </div>
                                  <div id="mob_popup_view_amazon_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-amazon" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-amazon"></i> <span class="icon_name">amazon </span>
                                  </div>
                                  <div id="mob_popup_view_yahoo_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-yahoo" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-yahoo"></i> <span class="icon_name">yahoo </span>
                                  </div>
                                  <div id="mob_popup_view_vkontakte_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-vkontakte" style="display: none; border-radius: 0%;">
                                    <svg class="svg-inline--fa fa-vk fa-w-18" style="font-size: 17px;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="vk" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                      <path fill="currentColor" d="M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z"></path>
                                    </svg>
                                    <span class="icon_name">vkontakte</span>
                                  </div>
                                  <div id="mob_popup_view_yandex_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-yandex" style="display: none; border-radius: 0%;">
                                    <svg class="svg-inline--fa fa-yandex fa-w-8" style="font-size: 17px;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="yandex" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                                      <path fill="currentColor" d="M153.1 315.8L65.7 512H2l96-209.8c-45.1-22.9-75.2-64.4-75.2-141.1C22.7 53.7 90.8 0 171.7 0H254v512h-55.1V315.8h-45.8zm45.8-269.3h-29.4c-44.4 0-87.4 29.4-87.4 114.6 0 82.3 39.4 108.8 87.4 108.8h29.4V46.5z"></path>
                                    </svg>
                                    <span class="icon_name">Yandex</span>
                                  </div>
                                  <div id="mob_popup_view_spotify_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-spotify" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-spotify"></i> <span class="icon_name">spotify </span>
                                  </div>
                                  <div id="mob_popup_view_paypal_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-paypal" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-paypal"></i> <span class="icon_name"> paypal </span>
                                  </div>
                                  <div id="mob_popup_view_discord_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-discord" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-discord"></i> <span class="icon_name">discord </span>
                                  </div>
                                  <div id="mob_popup_view_disqus_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-disqus" style="display: none; border-radius: 0%;">
                                    <svg class="svg-inline--fa fa-disqus fa-w-14 role=" img="" viewBox="5 5 18 17" xmlns="http://www.w3.org/2000/svg">
                                      <title>Disqus</title>
                                      <path fill="#fff" d="M12.438 23.654c-2.853 0-5.46-1.04-7.476-2.766L0 21.568l1.917-4.733C1.25 15.36.875 13.725.875 12 .875 5.564 6.05.346 12.44.346 18.82.346 24 5.564 24 12c0 6.438-5.176 11.654-11.562 11.654zm6.315-11.687v-.033c0-3.363-2.373-5.76-6.462-5.76H7.877V17.83h4.35c4.12 0 6.525-2.5 6.525-5.863h.004zm-6.415 2.998h-1.29V9.04h1.29c1.897 0 3.157 1.08 3.157 2.945v.03c0 1.884-1.26 2.95-3.157 2.95z"></path>
                                    </svg>
                                    <span class="icon_name">disqus</span>
                                  </div>
                                  <div id="mob_popup_view_github_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-gitHub" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-github"></i> <span class="icon_name"> github </span>
                                  </div>
                                  <div id="mob_popup_view_twitchtv_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-twitchTV" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-twitch"></i> <span class="icon_name"> twitch </span>
                                  </div>
                                  <div id="mob_popup_view_wordpress_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-wordpress" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-wordpress"></i> <span class="icon_name">wordpress </span>
                                  </div>
                                  <div id="mob_popup_view_foursquare_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-foursquare" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-foursquare"></i> <span class="icon_name">foursquare </span>
                                  </div>
                                  <div id="mob_popup_view_microsoftgraph_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-microsoft" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-microsoft"></i> <span class="icon_name">microsoft </span>
                                  </div>
                                  <div id="mob_popup_view_apple_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-apple" style="display: none; border-radius: 0%;">
                                    <i class="fa-brands fa-apple"></i> <span class="icon_name">apple </span>
                                  </div>
                                  <div id="mob_popup_view_kakao_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-kakao" style="display: none; border-radius: 0%;">
                                    <svg class="svg-inline--fa fa-kickstarter fa-w-14" style="font-size: 17px" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="kickstarter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                      <path fill="currentColor" d="M400 480H48c-26.4 0-48-21.6-48-48V80c0-26.4 21.6-48 48-48h352c26.4 0 48 21.6 48 48v352c0 26.4-21.6 48-48 48zM199.6 178.5c0-30.7-17.6-45.1-39.7-45.1-25.8 0-40 19.8-40 44.5v154.8c0 25.8 13.7 45.6 40.5 45.6 21.5 0 39.2-14 39.2-45.6v-41.8l60.6 75.7c12.3 14.9 39 16.8 55.8 0 14.6-15.1 14.8-36.8 4-50.4l-49.1-62.8 40.5-58.7c9.4-13.5 9.5-34.5-5.6-49.1-16.4-15.9-44.6-17.3-61.4 7l-44.8 64.7v-38.8z"></path>
                                    </svg>
                                    <span class="icon_name">kakao</span>
                                  </div>
                                  <div onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes fa-magic_icon" style="display: none; border-radius: 0%; order: 20;">
                                    <svg class="svg-inline--fa fa-magic fa-w-16" style="font-size: 17px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magic" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                      <path fill="currentColor" d="M224 96l16-32 32-16-32-16-16-32-16 32-32 16 32 16 16 32zM80 160l26.66-53.33L160 80l-53.34-26.67L80 0 53.34 53.33 0 80l53.34 26.67L80 160zm352 128l-26.66 53.33L352 368l53.34 26.67L432 448l26.66-53.33L512 368l-53.34-26.67L432 288zm70.62-193.77L417.77 9.38C411.53 3.12 403.34 0 395.15 0c-8.19 0-16.38 3.12-22.63 9.38L9.38 372.52c-12.5 12.5-12.5 32.76 0 45.25l84.85 84.85c6.25 6.25 14.44 9.37 22.62 9.37 8.19 0 16.38-3.12 22.63-9.37l363.14-363.15c12.5-12.48 12.5-32.75 0-45.24zM359.45 203.46l-50.91-50.91 86.6-86.6 50.91 50.91-86.6 86.6z"></path>
                                    </svg>
                                    <span class="icon_name">Magic Link</span>
                                  </div>
                                </div>
                                <p class="whitelabel">Powerd by <a href="#">Sketch App</a></p>

                              </div>
                              <div class="header__center" style="order: 2;">Use Social Features</div>
                              <div class="sign_in_mini" style="order: 3;">
                                <h4 class="signingFormHeading">Sign In</h4>
                                <div class="sign_form">
                                  <div class="input_box">
                                    <input type="text" placeholder="Email or Phone">
                                    <input type="text" placeholder="Password">
                                  </div>
                                  <div class="forgotPasss">
                                    <span>Forgot Password</span>
                                    <span>Sign Up</span>
                                  </div>
                                  <div class="market_consent" style="display: none;">
                                    <input type="checkbox" name="mc_consent" id="mc_consent">
                                    <label for="mc_consent">Agree to receive marketing emails</label>
                                  </div>
                                  <span class="terms_div"><input type="checkbox" name="terms_check" class="terms_check">
                                    <lable for="mark_terms" id="terms_check_lable">I agree to <a href="#" target="_blank">Terms of Use</a></lable>
                                  </span>
                                  <div class="submit_btn">
                                    <button class="signingButtonText" style="color:@isset($modalSettings['loginBttontitle_color']){{(!empty($modalSettings['loginBttontitle_color']))?$modalSettings['loginBttontitle_color']:'#ffffff'}}@endisset;">@isset($modalSettings['loginPageBttnTitle']){{(!empty($modalSettings['loginPageBttnTitle']))?$modalSettings['loginPageBttnTitle']:'LOGIN'}}@endisset</button>
                                  </div>

                                </div>
                              </div>
                            </div>
                            <div class="right" style="{{$popupImgTag}};">
                              <div class="overlay">.</div>
                              <div class="right-text">
                                <div class="logo_img"><img src="https://cdn.shopify.com/s/files/1/0597/6496/5550/files/CLCBiZqrpvICEAE.png?v=1677834387" style="height:100%;width:100%" alt=""></div>
                                <h2>Login Genie</h2>

                              </div>
                              <div class="right-inductor"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="destop_viewed_contant">
                    <div class="social_icons" style="order: 1;">
                      <h4 id="mob_social_text" style="color: rgb(0, 0, 0);"></h4>
                      <div class="social_icons_container">
                        <div id="mob_view_google_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-google" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-google"></i> <span class="icon_name">google </span>
                        </div>
                        <div id="mob_view_facebook_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-facebook" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-facebook-f"></i> <span class="icon_name">facebook </span>
                        </div>
                        <div id="mob_view_twitter_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-twitter" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-twitter"></i> <span class="icon_name">twitter </span>
                        </div>
                        <div id="mob_view_linkedin_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-linkedIn" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-linkedin"></i> <span class="icon_name">linkedin </span>
                        </div>
                        <div id="mob_view_amazon_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-amazon" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-amazon"></i> <span class="icon_name">amazon </span>
                        </div>
                        <div id="mob_view_yahoo_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-yahoo" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-yahoo"></i> <span class="icon_name">yahoo </span>
                        </div>
                        <div id="mob_view_vkontakte_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-vkontakte" style="display: none; border-radius: 0%;">
                          <svg class="svg-inline--fa fa-vk fa-w-18" style="font-size: 17px;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="vk" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z"></path>
                          </svg>
                          <span class="icon_name">vkontakte</span>
                        </div>
                        <div id="mob_view_yandex_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-yandex" style="display: none; border-radius: 0%;">
                          <svg class="svg-inline--fa fa-yandex fa-w-8" style="font-size: 17px;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="yandex" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M153.1 315.8L65.7 512H2l96-209.8c-45.1-22.9-75.2-64.4-75.2-141.1C22.7 53.7 90.8 0 171.7 0H254v512h-55.1V315.8h-45.8zm45.8-269.3h-29.4c-44.4 0-87.4 29.4-87.4 114.6 0 82.3 39.4 108.8 87.4 108.8h29.4V46.5z"></path>
                          </svg>
                          <span class="icon_name">yandex</span>
                        </div>
                        <div id="mob_view_spotify_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-spotify" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-spotify"></i> <span class="icon_name">spotify </span>
                        </div>
                        <div id="mob_view_paypal_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-paypal" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-paypal"></i> <span class="icon_name"> paypal </span>
                        </div>
                        <div id="mob_view_discord_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-discord" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-discord"></i> <span class="icon_name">discord </span>
                        </div>
                        <div id="mob_view_disqus_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-disqus" style="display: none; border-radius: 0%;">
                          <svg class="svg-inline--fa fa-disqus fa-w-14 role=" img="" viewBox="5 5 18 17" xmlns="http://www.w3.org/2000/svg">
                            <title>Disqus</title>
                            <path fill="#fff" d="M12.438 23.654c-2.853 0-5.46-1.04-7.476-2.766L0 21.568l1.917-4.733C1.25 15.36.875 13.725.875 12 .875 5.564 6.05.346 12.44.346 18.82.346 24 5.564 24 12c0 6.438-5.176 11.654-11.562 11.654zm6.315-11.687v-.033c0-3.363-2.373-5.76-6.462-5.76H7.877V17.83h4.35c4.12 0 6.525-2.5 6.525-5.863h.004zm-6.415 2.998h-1.29V9.04h1.29c1.897 0 3.157 1.08 3.157 2.945v.03c0 1.884-1.26 2.95-3.157 2.95z"></path>
                          </svg>
                          <span class="icon_name">disqus</span>
                        </div>
                        <div id="mob_view_github_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-gitHub" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-github"></i> <span class="icon_name"> github </span>
                        </div>
                        <div id="mob_view_twitchtv_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-twitchTV" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-twitch"></i> <span class="icon_name"> twitch </span>
                        </div>
                        <div id="mob_view_wordpress_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-wordpress" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-wordpress"></i> <span class="icon_name">wordpress </span>
                        </div>
                        <div id="mob_view_foursquare_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-foursquare" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-foursquare"></i> <span class="icon_name">foursquare </span>
                        </div>
                        <div id="mob_view_microsoftgraph_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-microsoft" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-microsoft"></i> <span class="icon_name">microsoft </span>
                        </div>
                        <div id="mob_view_apple_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-apple" style="display: none; border-radius: 0%;">
                          <i class="fa-brands fa-apple"></i> <span class="icon_name">apple </span>
                        </div>
                        <div id="mob_view_kakao_status" onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes bg-kakao" style="display: none; border-radius: 0%;">
                          <svg class="svg-inline--fa fa-kickstarter fa-w-14" style="font-size: 17px" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="kickstarter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M400 480H48c-26.4 0-48-21.6-48-48V80c0-26.4 21.6-48 48-48h352c26.4 0 48 21.6 48 48v352c0 26.4-21.6 48-48 48zM199.6 178.5c0-30.7-17.6-45.1-39.7-45.1-25.8 0-40 19.8-40 44.5v154.8c0 25.8 13.7 45.6 40.5 45.6 21.5 0 39.2-14 39.2-45.6v-41.8l60.6 75.7c12.3 14.9 39 16.8 55.8 0 14.6-15.1 14.8-36.8 4-50.4l-49.1-62.8 40.5-58.7c9.4-13.5 9.5-34.5-5.6-49.1-16.4-15.9-44.6-17.3-61.4 7l-44.8 64.7v-38.8z"></path>
                          </svg>
                          <span class="icon_name">kakao</span>
                        </div>
                        <div onmouseover="hoverapply(this)" onmouseout="hoverremove(this)" class="icon_boxes fa-magic_icon" style="display: none; border-radius: 0%; order: 20;">
                          <svg class="svg-inline--fa fa-magic fa-w-16" style="font-size: 17px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magic" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M224 96l16-32 32-16-32-16-16-32-16 32-32 16 32 16 16 32zM80 160l26.66-53.33L160 80l-53.34-26.67L80 0 53.34 53.33 0 80l53.34 26.67L80 160zm352 128l-26.66 53.33L352 368l53.34 26.67L432 448l26.66-53.33L512 368l-53.34-26.67L432 288zm70.62-193.77L417.77 9.38C411.53 3.12 403.34 0 395.15 0c-8.19 0-16.38 3.12-22.63 9.38L9.38 372.52c-12.5 12.5-12.5 32.76 0 45.25l84.85 84.85c6.25 6.25 14.44 9.37 22.62 9.37 8.19 0 16.38-3.12 22.63-9.37l363.14-363.15c12.5-12.48 12.5-32.75 0-45.24zM359.45 203.46l-50.91-50.91 86.6-86.6 50.91 50.91-86.6 86.6z"></path>
                          </svg>
                          <span class="icon_name">Magic Link</span>
                        </div>

                      </div>
                      <p class="whitelabel">Powerd by <a href="#">Sketch App</a></p>
                    </div>
                    <div class="login_fornm" style="order: 3;">
                      <div class="header__center" style="order: 2;">Use Social Features</div>
                      <h5>Login</h5>
                      <div class="input_feilds">
                        <input type="email" placeholder="Email">
                        <input type="text" placeholder="Password">
                      </div>
                      <p><a>Forgot your password?</a></p>
                      <button class="signIn">Sign In</button>
                      <div class="market_consent" style="display: none;">
                        <input type="checkbox" name="mc_consent" id="mc_consent">
                        <label for="mc_consent">Agree to receive marketing emails</label>
                      </div>

                      <span class="terms_div"><input type="checkbox" name="terms_check" class="terms_check">
                        <lable for="mark_terms" id="terms_check_lable">I agree to <a href="#" target="_blank">Terms of Use</a></lable>
                      </span>
                      <p><a href="#">Create Account</a></p>

                    </div>
                  </div>
                  <div class="screen_overlay" style="display: none;"></div>
                </div>
                <div class="BarPreview-content-mobile-footer">
                  <div class="mic"></div>
                </div>
              </div>
            </div>

            <div class="view_btns">
              <span class="icon active_btn" onclick="viewopen('destop')"><i class="fa-solid fa-display"></i></span>
              <span class="icon" onclick="viewopen('mobile')"><i class="fa-solid fa-mobile-screen-button"></i></span>

            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <!-- <p>You are: {{ $shopDomain ?? Auth::user()->name }}</p> -->
  @endsection
  @section('scripts')
    @parent
    @include('layout.footer')
  <script>
      var disabledIcons = ["linkedIn_status", "amazon_status", "yahoo_status", "vkontakte_status", "spotify_status", "paypal_status", "discord_status", "disqus_status", "foursquare_status", "microsoft_status", "wordpress_status", "twitchTV_status", "yandex_status", "gitHub_status", "apple_status", "kakao_status","gpopUpmodel"];
      var finalArray = [];
      var currentPagePath = '/settings';
      function passFileUrl() {
        document.getElementById('popUpBackimage').click();
      }
      function GetUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) {
          var sParameterName = sURLVariables[i].split('=');
          if (sParameterName[0] == sParam) {
            return sParameterName[1];
          }
        }
      }
      function fileSelected(inputData) {
        document.getElementById('asgnmnt_file_img').src = window.URL.createObjectURL(inputData.files[0]);
        $('.right').css('background-image', 'url(' + window.URL.createObjectURL(inputData.files[0]) + ')');
      }
      function customizertabs(clname) {
        if(clname == 'Settings') {
          $(".customizer_setting").addClass("active_tab");
          $(".customizer_widget").removeClass("active_tab");
          $(".customizer_popup").removeClass("active_tab");
          $('.setting_settings').show();
          $(".Widget_settings").hide();
          $(".popup_settings").hide();

        }else if (clname == 'Widget') {
          $(".customizer_widget").addClass("active_tab");
          $(".customizer_setting").removeClass("active_tab");
          $(".customizer_popup").removeClass("active_tab");
          $('.Widget_settings').show();
          $(".setting_settings").hide();
          $(".popup_settings").hide();

        }else {
          $(".customizer_widget").removeClass("active_tab");
          $(".customizer_setting").removeClass("active_tab");
          $(".customizer_popup").addClass("active_tab");
          $('.popup_settings').show();
          $(".setting_settings").hide();
          $(".Widget_settings").hide();

        }
      }
      var checkboxValues = $('.socialChecks:checked').map(function() {
        return $(this).attr('id');
      }).get();
      // console.log("checkboxValues",checkboxValues);
      function viewtype(viewType){
        if(viewType === "widget"){
          $(".destop_viewed_contant").show();
          $(".destop_popus").hide();
          $(".widget").addClass('active_view');
          $(".popup_open").removeClass('active_view');
        }else{
          $(".destop_viewed_contant").hide();
          $(".destop_popus").show();
          $(".widget").removeClass('active_view');
          $(".popup_open").addClass('active_view');
        }
      }
      function iconsstatus(elmid) {
        var planStatus = "{{ $userPlan }}";
        if (planStatus == 'free') {
          if ($('#google_status').prop('checked') == true) {
            $(`#view_google_status`).css('display', 'flex');
            $(`#mob_view_google_status`).css('display', 'flex');
            $(`#mob_popup_view_google_status`).css('display', 'flex');
            $(`#des_popup_view_google_status`).css('display', 'flex');
          } else {
            $(`#view_google_status`).hide();
            $(`#mob_view_google_status`).css('display', 'none');
            $(`#mob_popup_view_google_status`).css('display', 'none');
            $(`#des_popup_view_google_status`).css('display', 'none');
          }
          if ($('#facebook_status').prop('checked') == true) {
            $(`#view_facebook_status`).css('display', 'flex');
            $(`#mob_view_facebook_status`).css('display', 'flex');
            $(`#mob_popup_view_facebook_status`).css('display', 'flex');
            $(`#des_popup_view_facebook_status`).css('display', 'flex');
          } else {
            $(`#view_facebook_status`).hide();
            $(`#mob_view_facebook_status`).css('display', 'none');
            $(`#mob_popup_view_facebook_status`).css('display', 'none');
            $(`#des_popup_view_facebook_status`).css('display', 'none');
          }
          if ($('#twitter_status').prop('checked') == true) {
            $(`#view_twitter_status`).css('display', 'flex');
            $(`#mob_view_twitter_status`).css('display', 'flex');
            $(`#mob_popup_view_twitter_status`).css('display', 'flex');
            $(`#des_popup_view_twitter_status`).css('display', 'flex');
          } else {
            $(`#view_twitter_status`).hide();
            $(`#mob_view_twitter_status`).css('display', 'none');
            $(`#mob_popup_view_twitter_status`).css('display', 'none');
            $(`#des_popup_view_twitter_status`).css('display', 'none');
          }

        } else {
          if ($(`#${elmid}`).prop('checked') == true) {
            $(`#view_${elmid}`).css('display', 'flex');
            $(`#mob_view_${elmid}`).css('display', 'flex');
            $(`#mob_popup_view_${elmid}`).css('display', 'flex');
            $(`#des_popup_view_${elmid}`).css('display', 'flex');
          } else {
            $(`#view_${elmid}`).hide();
            $(`#mob_view_${elmid}`).css('display', 'none');
            $(`#mob_popup_view_${elmid}`).css('display', 'none');
            $(`#des_popup_view_${elmid}`).css('display', 'none');
          }
        }
      }
      //Manage Popup Background image and color
      $('.modelBackImage').css('display', 'none');
      var image = "@isset($modalSettings['backStatus']){{ $modalSettings['backStatus'] }} @endisset";
      if (image == 'color') {
        $('.modelbackcolor').css('display', 'block');
        $('.modelBackImage').css('display', 'none');
        $('.imageBox').css('display', 'none');
      }
      if (image == 'imagetype') {
        $('.modelbackcolor').css('display', 'none');
        $('.modelBackImage').css('display', 'block');
        $('.imageBox').css('display', 'block');
      }
      $('input[type=radio][name=background]').on('change', function() {
        if ($('#control_color').prop("checked") == true) {
          $('.modelbackcolor').css('display', 'block');
          var currentColor = $('#popUpBackColor').val();
          $('.right').css('background', currentColor);
          $('.modelBackImage').css('display', 'none');
          $('.imageBox').css('display', 'none');
        }
        if ($('#control_image').prop("checked") == true) {
          $('.modelBackImage').css('display', 'block');
          $('.modelbackcolor').css('display', 'none');
          if ($('#imageHidden').attr("data-image") == "no")
            $('.imageBox').css('display', 'none');
          else {
            $('.imageBox').css('display', 'block');
            var currentImagePath = $('#asgnmnt_file_img').attr('src');
            $('.right').css('background-image', 'url(' + currentImagePath + ')');
            //  console.log(currentImagePath);
          }
        }
      });
      $('input[type="file"]').change(function() {
        var ext = $(this).val().split(".").pop().toLowerCase();
        var extensions = ["png", "jpg", "jpeg"];
        console.log(extensions);
        if (extensions.indexOf(ext) > -1) {
          $('.uploadError').hide();
        } else {
          $('input[type="file"]').val("");
          $('.uploadError').show();
        }
      });
      //Selecting background Image or color
      $('input[type=radio][name=background]').on('change', function() {
        if($('#control_color').prop("checked") == true){
        $('.modelbackcolor').css('display','block');
        $('.modelBackImage').css('display','none');
        $('.imageBox').css('display','none');
        }
        if($('#control_image').prop("checked") == true){
        $('.modelBackImage').css('display','block');
        $('.modelbackcolor').css('display','none');
        if($('#imageHidden').attr("data-image")=="no")
        $('.imageBox').css('display','none');
        else
        $('.imageBox').css('display','block');
        }
      });
      //Selecting background Image or color
      $('input[name=position]').change(function() {
        var value = $('input[name=position]:checked').attr('id');
        if (value == 'control_2') {
          $(".social_icons").css('order', '3')
          $('.header__center').css('order', '2')
          $(".login_fornm").css('order', '1')

          $(".socil_icon").css('order', '3')
          $('.header__center').css('order', '2')
          $(".sign_in_mini").css('order', '1')
        } else {
          $(".social_icons").css('order', '1')
          $('.header__center').css('order', '2')
          $(".login_fornm").css('order', '3')

          $(".socil_icon").css('order', '1')
          $('.header__center').css('order', '2')
          $(".sign_in_mini").css('order', '3')
        }
      });
      $('input[name=select]').change(function() {
        $(".icon_name").css('display', 'none')
        $(".icon_boxes").css({
          'width': '30px',
          'border-radius': '0%'
        })
        $(".social_icons_container").css('display', 'flex');
        var value = $('input[name=select]:checked').attr('id');
        if (value == 'control_01') {
          $(".icon_boxes").css('border-radius', '50%')
        } else if (value == 'control_02') {
          $(".icon_boxes").css('border-radius', '5px')
        } else if (value == 'control_03') {
          $(".icon_boxes").css('border-radius', '0%')
        } else {
          $(".social_icons_container").css('display', 'grid')
          $(".icon_boxes").css({
            'width': 'auto',
            'gap': '5px',
            'padding': '2px 5px',
            'border-radius': '0%'
          })
          $(".icon_name").css('display', 'inline-block')
        }
      });
      $("#wedget_tag").keyup(() => {
        let headtext = $("#wedget_tag").val()
        if (headtext) {
          $("#socil_icon").text(headtext)
          $('#mob_social_text').text(headtext)
          $('#mob_pop_social_text').text(headtext)
          $('#des_pop_social_text').text(headtext)
        } else {
          $("#socil_icon").text('Login via Social Plateforms')
          $('#mob_social_text').text('Login via Social Plateforms')
          $('#mob_pop_social_text').text('Login via Social Plateforms')
          $('#des_pop_social_text').text('Login via Social Plateforms')
        }

      })
      $("#wedget_size").keyup(() => {
        let textsize = $("#wedget_size").val();
        if (textsize) {
          $("#socil_icon").css('font-size', textsize + 'px')
        } else {
          $("#socil_icon").css('font-size', '16px')
        }
      })
      document.getElementById('wedget_color').onchange = function() {
        let coler = this.value
        $("#socil_icon").css('color', `${coler}`)
        $("#mob_pop_social_text").css('color', `${coler}`)
        $("#des_pop_social_text").css('color', `${coler}`)
        $("#mob_social_text").css('color', `${coler}`)
      }
      $("#socialpalcehoder").keyup(() => {
        let headtext = $("#socialpalcehoder").val();
        if (headtext) {
          $(".header__center").text(headtext)
        } else {
          $(".header__center").text('OR')
        }
      })
      $("#magicLink").on('change', () => {
        if ($('#magicLink').prop('checked') == true) {
          $('.fa-magic_icon').css("display", 'flex')
        } else {
          $('.fa-magic_icon').css("display", 'none')
        }
      })
      $("#mark_consent").on('change', () => {
        if ($('#mark_consent').prop('checked') == true) {
          $('.market_consent').css("display", 'flex')
        } else {
          $('.market_consent').css("display", 'none')
        }
      })
      $("#mark_terms").on('change', () => {
        if ($('#mark_terms').prop('checked') == true) {
          $('.terms_div').css("display", 'flex')
        } else {
          $('.terms_div').css("display", 'none')
        }
      })
      $("#mark_consent_check").on('change', () => {
        if ($('#mark_consent_check').prop('checked') == true) {
          $('.market_consent input').prop('checked', true);
        } else {
          $('.market_consent input').prop('checked', false);
        }
      })
      $("#mark_terms_check").on('change', () => {
        if ($('#mark_terms_check').prop('checked') == true) {
          $('.terms_check').prop('checked', true);
        } else {
          $('.terms_check').prop('checked', false);
        }
      })
      $(".fb_btn").on('click', () => {
        $(".destop_viewed_container").toggleClass('full_view')
        if ($(".destop_viewed_container").hasClass('full_view')) {
          $('.zoom-in').hide()
          $('.zoom-out').show()
          // $(".fb_btn").css('bottom', '0')
          // $(".fb_btn").css('position', 'fixed')
          // $(".fb_btn").css('right', '0')
        } else {
          $('.zoom-in').show()
          $('.zoom-out').hide()
          // $(".fb_btn").css('bottom', '0')
          // $(".fb_btn").css('position', 'absolute')
          // $(".fb_btn").css('right', '0')

        }
      })
      $('.ripple-button').click(function(e) {
        $btn = $(this);
        var $offset = $(this).offset();
        $span = $('<span/>');
        var x = e.pageX - $offset.left
        var y = e.pageY - $offset.top;
        $span.addClass('ripple-span');
        $span.css({
          top: y + 'px',
          left: x + 'px',
        });
        $btn.append($span);
        window.setTimeout(function() {
          $span.remove();
        }, 2200);
      });
      $('#whiteLable1').on('change', () => {
        if ($('#whiteLable1').is(':checked')) {
          $(".whitelabel").show()
        } else {
          $(".whitelabel").hide()
        }
      })
      $("#mark_consent_name").keyup(() => {
        let headtext = $("#mark_consent_name").val();
        if (headtext) {
          $(".market_consent label").text(headtext)

        } else {
          $(".market_consent label").text('Agree to receive marketing emails')

        }
      })
      $('#shopifyFormStatus').on('change', () => {
        if ($('#shopifyFormStatus').is(':checked')) {
          $(".login_fornm").hide();
          $(".sign_in_mini").hide();
          $('.header__center').hide();
          // console.log('hello world')
        } else {
          $('.login_fornm').show();
          $(".sign_in_mini").show();
          $('.header__center').show();
        }
      });
      $('#code_on').on('change', () => {
        if ($('#code_on').is(':checked')) {
          $(".screen_overlay").hide()
        } else {
          $(".screen_overlay").show()
        }
      });
      function viewopen(viewType) {
        if (viewType === "destop") {
          $(".destop_view").show();
          $(".mobile_view").hide();
        } else {
          $(".destop_view").hide();
          $(".mobile_view").show();
        }
      }
      function removeQueryParam(url, paramToRemove) {
        // Split the URL into different components
        var urlParts = url.split('?');
        if (urlParts.length >= 2) {
            // Extract query parameters
            var queryParams = urlParts[1].split('&');
            // Filter out the parameter to remove
            var updatedParams = queryParams.filter(function(param) {
                return !param.startsWith(paramToRemove + '=');
            });
            // Reconstruct the URL
            var updatedUrl = urlParts[0] + (updatedParams.length > 0 ? '?' + updatedParams.join('&') : '');
            return updatedUrl;
        }
        return url;
      }
      $('#saveSettingButtn').click(function(){
        var form = document.querySelector('#settingsForm');
        var settingData = new FormData(document.getElementById("settingsForm"));
        var widgetsettingData = new FormData(document.getElementById("widgetFormSetting"));
        if ($("#shopifyFormStatus").prop('checked') == false) {
          settingData.append("shopifyFormStatus", 'off');
        }
        @php if ($isSocialDisabled == "*") { @endphp
          settingData.append("google_status", 'on');
          settingData.append("facebook_status", 'on');
          settingData.append("whiteLable1", 'on');
          settingData.append("shopifyFormStatus", 'off');
          settingData.append("redirectOn", 0);
          disabledIcons.forEach(function(item, index){
            settingData.append(item, 'off');
          });
          settingData.append("append_type",'auto');
        @php } @endphp
        if ($("#mark_consent_check").prop('checked') == false) {
          settingData.append("mark_consent_check", 'off');
        }
        if ($("#mark_consent").prop('checked') == false) {
          settingData.append("mark_consent", 'off');
        }

        if ($("#mark_terms").prop('checked') == false) {
          settingData.append("mark_terms", 'off');
        }
        if ($("#mark_terms_check").prop('checked') == false) {
          settingData.append("mark_terms_check", 'off');
        }
        
        if ($("#code_on").prop('checked') == false) {
          settingData.append("code_mode", 'off');
        }
        var shape_status = '';
        if ($("#control_01").prop("checked") == true) {
          shape_status = 'circle';
        }
        if ($("#control_02").prop("checked") == true) {
          shape_status = 'square';
        }
        if ($("#control_03").prop("checked") == true) {
          shape_status = 'rectangle';
        }
        if ($("#control_04").prop("checked") == true) {
          shape_status = 'iconName';
        }
        var icon_position = '';
        if ($("#control_1").prop("checked") == true) {
          icon_position = 'above';
        }
        if ($("#control_2").prop("checked") == true) {
          icon_position = 'below';
        }
        if ($("#whiteLable1").prop("checked") == false) {
          settingData.append('whiteLable1', 'off');
        }
        $('#sortable input[type=checkbox]').each(function() {
          if (!this.checked)
            settingData.append($(this).attr('name'), 'off');
        });
        settingData.append("servicesOrder", finalArray);
        settingData.append("icon_position", icon_position);
        settingData.append("shape_status", shape_status);
        $('#popUpSettingButtn').trigger('click');
        //Merging two Forms values
        for (var pair of widgetsettingData.entries()) {
          settingData.append(pair[0], pair[1]);
        }
        //Merging two Forms values
        $("body").LoadingOverlay("show");
        shopifyAuthenticatedFetch('/save-settings', {
          method: form.method,
          body:settingData
        })
        .then(async (response) => { 
          var result = await response.text();
          if(result == "Sucessfully"){
            shopifyAuthenticatedFetch('/?action=UpdateMeata', {
              method: "GET"
            })
            .then(async (response) => { 
              $("body").LoadingOverlay("hide");
              var result = await response.text();
              if(result == "Success"){
                ShopifyApp.flashNotice("Successfully Saved.");
                if (window.gettingParameter == "saved"){ 
                  var originalUrl = window.location.href;
                  var paramToRemove = "click";
                  var newUrl = removeQueryParam(originalUrl, paramToRemove);
                  setTimeout(() => {
                    window.location.href = newUrl;
                  }, 1000);
                }
              }
              else{
                ShopifyApp.flashError("Something went wrong.");
              } 
            });
          }
          else 
            ShopifyApp.flashError("Something went wrong.");
            $("body").LoadingOverlay("hide");
          //do something awesome that makes the world a better place
        });
      });
      $('#popUpSettingButtn').click(function() {
        var formData = new FormData(document.getElementById("popUpForm"));
        var popUpbackColor = '';
        var popUpimage = '';
        var imageUrl = '';
        var backgrountSt = '';
        if ($("#control_color").prop("checked") == true) {
          popUpbackColor = $("#popUpBackColor").val();
          backgrountSt = 'color';
        }
        if ($("#control_image").prop("checked") == true) {
          popUpimage = 'true';
          backgrountSt = 'imagetype';
        }
        if (popUpimage == 'true') {
          if (!$('input[type="file"]').val() && $('#imageHidden').attr("data-image") == "") {
            $('.uploadError').css("display", "block");
            return false;
          } else {
            imageUrl = $('#asgnmnt_file_img').attr("src");
          }
        }
        var newImage = '';
        if ($("#popUpBackimage").val() != '') {
          newImage = $("#popUpBackimage").val();
        }
        if ($("#gpopUpmodel").prop("checked") == false) {
          formData.append('gpopUpmodel', 'off');
        }
        if ($("#popUpmodel").prop("checked") == false) {
          formData.append('popUpmodel', 'off');
        }
        formData.append('newimage', newImage);
        formData.append('image', popUpimage);
        formData.append('imageUrl', imageUrl);
        formData.append('backStatus', backgrountSt);
        @php if($isSocialDisabled == "*"){ @endphp
          formData.append('popup_append_type', 'auto');
        @php } @endphp
        // console.log(formData);
        // return false;
        $("body").LoadingOverlay("show");
        shopifyAuthenticatedFetch('/save-modal-settings', {
          method: "POST",
          body:formData
        })
        .then((response) => { 
          console.log(response);
            //do something awesome that makes the world a better place
        });
      });
      var gettingParameter = '';
      $("body").LoadingOverlay("show");
      $(document).ready(function(){
        setTimeout(function() {
          $("body").LoadingOverlay("hide");
        }, 3000);
        gettingParameter = GetUrlParameter("click");
        if (gettingParameter == "saved") {
          console.log(gettingParameter);
          $("#google_status").prop('checked', true);
          $("#facebook_status").prop('checked', true);
          $("#twitter_status").prop('checked', false);
          $('#saveSettingButtn').trigger('click');
          
        }
        @php if($isSocialDisabled == "*"){ @endphp
          $('.reOrderHandle').css('display', 'none');
        @php } @endphp
        //Active tab
        $("ul.nav-links li a").removeClass("active_nav");
        $(".settings_nav").addClass("active_nav");
        //Active tab
        $('.modelBackImage').css('display','none');
        var image = "@isset($modalSettings['backStatus']){{ $modalSettings['backStatus'] }}@endisset";
        if(image == 'color'){
        $('.modelbackcolor').css('display','block');
        $('.modelBackImage').css('display','none');
        $('.imageBox').css('display','none');
        }
        if(image == 'imagetype'){
          $('.modelbackcolor').css('display','none');
          $('.modelBackImage').css('display','block');
          $('.imageBox').css('display','block');
        }
        //default settings
        if ($('#code_on').is(':checked')) {
          $(".screen_overlay").hide()
        } else {
          $(".screen_overlay").show()
        }
        const checkboxes = document.querySelectorAll('.socialChecks');
        // console.log("checkboxes",checkboxes);
        checkboxes.forEach((checkbox) => {
          // console.log(checkbox.id) 
          if (checkbox.checked) {
            // console.log(checkbox.id) 
            $(`#view_${checkbox.id}`).css('display', 'flex');
            $(`#mob_view_${checkbox.id}`).css('display', 'flex');
            $(`#mob_popup_view_${checkbox.id}`).css('display', 'flex');
            $(`#des_popup_view_${checkbox.id}`).css('display', 'flex');
          }
        });
        //Hiding term and codition code
        var temEnable =  "@isset($details['mark_terms']){{($details['mark_terms'])?$details['mark_terms']:''}}@endisset";
        var temCheckEnable = "@isset($details['mark_terms_check']){{($details['mark_terms_check'])?$details['mark_terms_check']:''}}@endisset";
        if (temEnable == 'off')
          $('.terms_div').css("display", 'none');
        if (temCheckEnable == 'off')
          $('.terms_check').prop('checked', false);
        else
          $('.terms_check').prop('checked', true);
        //Hiding term and codition code
        var orderingData = "@isset($details['servicesOrder']){{($details['servicesOrder'])?$details['servicesOrder']:''}}@endisset";
        var userOrder = ["Google", "Facebook", "Twitter", "LinkedIn", "Amazon", "Yahoo", "Vkontakte", "Spotify", "Paypal", "Discord", "Disqus", "GitHub", "TwitchTV", "Yandex", "Wordpress", "Foursquare", "MicrosoftGraph", "Apple", "Kakao"];
        if (orderingData != '') {
          var orderingData = orderingData.split(',');
          userOrder = orderingData;
        }
        var ul = $("#sortable");
        var items = $("#sortable div");
        for (var item of userOrder) {
          ul.append($('#' + item + ''));
        }
        $(function() {
          var sortable = $("#sortable").sortable({
            handle: '.reOrderHandle',
            animation: 150,
            update: function(event, ui) {
              getIdsOfImages();
            } //end update         
          });
        });

        function getIdsOfImages() {
          var values = [];
          $('.socialLginDivs').each(function(index) {
            values.push($(this).attr("id"));
          });
          finalArray = values;
          console.log(finalArray,'finalArray')
          finalArray.forEach((elem,indax)=>{
             console.log(elem + "+" + indax)
            let nm = elem.toLowerCase();
            console.log(`view_${nm}_status`)
            $(`#view_${nm}_status`).css('order',indax);
          })
          let last_order = finalArray.length + 1
          console.log(last_order)
          $(".fa-magic_icon").css('order', last_order )
        }
        if ($('#magicLink').prop('checked') == true) {
          $('.fa-magic_icon').css("display", 'flex')
        } else {
          $('.fa-magic_icon').css("display", 'none')
        }

        var value = $('input[name=select]:checked').attr('id');
        if (value == 'control_01') {
          $(".icon_boxes").css('border-radius', '50%')
        } else if (value == 'control_02') {
          $(".icon_boxes").css('border-radius', '5px')
        } else if (value == 'control_03') {
          $(".icon_boxes").css('border-radius', '0%')
        } else {
          $(".social_icons_container").css('display', 'grid')
          $(".icon_boxes").css({
            'width': 'auto',
            'gap': '5px',
            'padding': '2px 5px',
            'border-radius': '0%'
          })
          $(".icon_name").css('display', 'inline-block')
        }

        // Redirect URL Setting
        $(document).on('change', '.redirectOption', function() {
          $('.redirectOption').each(function name(params) {
            $(this).prop("checked", false);
          });
          var currentCboxEl = $(this);
          setTimeout(function() {
            currentCboxEl.prop("checked", true);
          }, 100);
          var currentCboxVal = currentCboxEl.val();
          if (currentCboxVal == 0) {
            console.log($(this).val());
            $('#customPage_url').css('display', 'none');
            $('#accountPage_url').attr('name', 'redirectUrl');
            $('#customPage_url').removeAttr('name');
          } else if (currentCboxVal == 1) {
            $('#customPage_url').css('display', 'none');
          } else {
            $('#customPage_url').css('display', 'block');
            $('#accountPage_url').removeAttr('name');
            $('#customPage_url').attr('name', 'redirectUrl');
          }
        });
        getIdsOfImages();
        // Page Load Setting for Custom Integration Settings
        var integration = $("input[type=checkbox][name=append_type]:checked").val();
        if (integration == "auto") {
          $('#snippet_setting').css('display', 'none').removeAttr("name", "appendOn");
          $('#selector_setting').css('display', 'none').removeAttr("name");
        } else if (integration == "selector") {
          $('#selector_setting').css('display', '').attr("name", "appendOn");
          $('#snippet_setting').css('display', 'none').removeAttr("name", "appendOn");
        } else {
          $('#selector_setting').css('display', 'none').removeAttr("name");
          $('#snippet_setting').css('display', '').attr("name", "appendOn");
        }
        $(document).on('change', '.integrationOption', function() {
          $('.integrationOption').each(function name(params) {
            $(this).prop("checked", false);
          });
          var currentIntegration = $(this);
          setTimeout(function() {
            currentIntegration.prop("checked", true);
          }, 100);
          var currentVal = currentIntegration.val();
          if (currentVal == "auto") {
            $('#snippet_setting').css('display', 'none').removeAttr("name", "appendOn");
            $('#selector_setting').css('display', 'none').removeAttr("name");
          } else if (currentVal == "selector") {
            $('#selector_setting').css('display', '').attr("name", "appendOn");
            $('#snippet_setting').css('display', 'none').removeAttr("name", "appendOn");
          } else {
            $('#selector_setting').css('display', 'none').removeAttr("name");
            $('#snippet_setting').css('display', '').attr("name", "appendOn");
          }
        });
        $('#loginPageHeading').change(function(){
          $('.left .signingFormHeading').text($(this).val()); 
        });
        $('#loginPageBttnTitle').change(function(){
          $('.left .signingButtonText').html($(this).val()); 
        });
        $('#title_color').change(function(){
          $('.left .signingFormHeading').css("color",$(this).val()); 
        });
        $('#loginBttontitle_color').change(function(){
          $('.left .signingButtonText').css("color",$(this).val()); 
        });
        $('#loginBttonback_color').change(function(){
          $('.left .signingButtonText').css("background-color",$(this).val()); 
        });
        
        $(document).on('change','.popup_integrationOption',function(){
          $('.popup_integrationOption').each(function name(params){
            $(this).prop("checked",false);
          });
          var currentPopIntegration = $(this);
          setTimeout(function() {
            currentPopIntegration.prop("checked", true);
          }, 100);
          console.log(currentPopIntegration);
          currentVal = currentPopIntegration.val();
          if(currentVal == "auto")
          {
            $('#popup_selector_setting').css('display', 'none');
          }
          else {
            console.log("Here we are");
            $('#popup_selector_setting').css('display', '');
          }
        });
        $('.disabled_providers').mouseenter(function() {
          var message = 'This Service Is Temporarily Unavailable';
          $(this).css('cursor', 'pointer', ).attr('title', message);
        });
        @php if ($isSocialDisabled == "*") { @endphp
          $(".switch_op input[type='checkbox']").each(function(index) {
            if (index > 2) $(this).prop("checked", false);
          });
          $(document).on("click", ".socialChecks", function() {
            var friend1 = $(this).data("friend1");
            var friend2 = $(this).data("friend2");
            $(this).is(":checked") ? ($("#" + friend1).is(":checked") ? $("#" + friend2).prop("checked", false) : "") : ($("#" + friend2).is(":checked") ? $("#" + friend1).prop("checked", false) : "");
          });
        @php } @endphp
        $('#code_on').on('change', () => {
          if ($('#code_on').is(':checked')) {
            $(".screen_overlay").hide()
          } else {
            $(".screen_overlay").show()
          }
        });
        $('#popUpBackColor').on('input',
            function() {
                // console.log($(this).val());
                $('.right').css('background', $(this).val());
            }
        );
      });
      var value = $('input[name=position]:checked').attr('id');
      if (value == 'control_2') {
        $(".social_icons").css('order', '3')
        $('.header__center').css('order', '2')
        $(".login_fornm").css('order', '1')

        $(".socil_icon").css('order', '3')
        $('.header__center').css('order', '2')
        $(".sign_in_mini").css('order', '1')
      } else {
        $(".social_icons").css('order', '1')
        $('.header__center').css('order', '2')
        $(".login_fornm").css('order', '3')

        $(".socil_icon").css('order', '1')
        $('.header__center').css('order', '2')
        $(".sign_in_mini").css('order', '3')
      }
      let headtext = $("#wedget_tag").val()
      $("#socil_icon").text(headtext)
      $('#mob_social_text').text(headtext)
      $('#mob_pop_social_text').text(headtext)
      $('#des_pop_social_text').text(headtext)

      let headbttext = $("#socialpalcehoder").val();
      $(".header__center").text(headbttext)


      let coler = $('#wedget_color').val()
      $("#socil_icon").css('color', `${coler}`)
      $("#mob_pop_social_text").css('color', `${coler}`)
      $("#des_pop_social_text").css('color', `${coler}`)
      $("#mob_social_text").css('color', `${coler}`)


      let textsize = $("#wedget_size").val();
      $("#socil_icon").css('font-size', textsize + 'px')

      if ($('#mark_consent').prop('checked') == true) {
        $('.market_consent').css("display", 'flex')
      } else {
        $('.market_consent').css("display", 'none')
      }
      if ($('#mark_consent').prop('checked') == true) {
        $('.market_consent').css("display", 'flex')
      } else {
        $('.market_consent').css("display", 'none')
      }
      if ($('#mark_consent_check').prop('checked') == true) {
        $('.market_consent input').prop('checked', true);
      } else {
        $('.market_consent input').prop('checked', false);
      }
      let headcctext = $("#mark_consent_name").val();
      $(".market_consent label").text(headcctext)

      if ($('#mark_consent').prop('checked') == true) {
        $('.market_consent').css("display", 'flex')
      } else {
        $('.market_consent').css("display", 'none')
      }
      var element = $(".icon_boxes")
      var initialColor = element.css('#fff');

      var newHoverColor = $("#socialHoverColor").val();
      document.getElementById('socialHoverColor').onchange = function() {

        newHoverColor = this.value

      }
      element.hover(
        function() {
          // Mouse enter
          $(this).css('color', newHoverColor);
        },
        function() {
          // Mouse leave
          $(this).css('color', '#fff');
          $('.fa-magic_icon').css('color', '#000')
        }
      );
  </script>
@endsection
