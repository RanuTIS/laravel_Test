@extends('shopify-app::layouts.default')
@section('content')
  @section('styles')
    @include('layout.header')
    <style>
  .instruction-wrapper .card_shadow {
    box-shadow: 0px 7px 17px #e5e2ff80;
    border-radius: 5px;
  }

  .instruction-wrapper .containers {
    width: 90%;
    margin: 0 auto;
  }

  .instruction-wrapper .main_heading {
    font-size: 18px;
    font-weight: 600;
    font-family: 'Inter', sans-serif;
  }

  .instruction-wrapper .card-header {
    border: none;
    padding: 10px 0px;
    background-color: #F9F9F9;
  }

  .instruction-wrapper .card-header button {
    width: 100%;
    text-align: left;
    display: flex;
    border: none;
    justify-content: space-between;
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    font-weight: 600;
    color: black;
    text-decoration: none;
    height: 40px;
    padding: 10px 0px;
  }

  .instruction-wrapper .accordion {
    padding: 20px;
    background-color: #F9F9F9;
  }

  .instruction-wrapper .form-control {
    border: 1px solid black;
    font-size: 12px !important;
    background: #F9F9F9;
    font-family: 'Inter', sans-serif;
    color: black;
  }

  .instruction-wrapper select option {
    border: none;
  }

  .instruction-wrapper select:focus {
    box-shadow: none;
  }

  .instruction-wrapper .card-header button:focus-visible {
    outline: none;
  }

  .instruction-wrapper .card-header button::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    background: url("assets/images/down-arrow (4).png") no-repeat;
    width: 20px;
    height: 20px;
    margin-top: 11px;
    transform: rotate(0deg);
  }

  .instruction-wrapper .card-header button.collapsed::after {
    transform: rotate(-90deg);
    margin-top: -3px;
  }

  .instruction-wrapper .card {
    border: none;
  }

  .instruction-wrapper .card-body {
    padding: 11px 30px;
    margin-top: 20px;
  }

  .instruction-wrapper .card-body label {
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    color: black;
  }

  .instruction-wrapper .install_btn button {
    min-width: 125px;
    height: 35px;
    border-radius: none !important;
    font-size: 14px;
    font-family: 'Inter', sans-serif;
  }

  .instruction_head {
    text-align: center;
  }

  ul li {
    list-style: none;
    position: relative;
    padding: 3px 0 2px 25px;
  }

  .card-body ul li::before {
/*    content: '🔔';*/
    position: absolute;
    top: 6px;
    left: 0;
  }

  .app_embed {
/*    background: #EE2E64;*/
/*    padding: 10px;*/
    text-align: center;
    border-radius: 5px;
/*    color: white;*/
    font-weight: bold;
    line-height: 25px;
  }

  .app_embed:hover {
/*    background: #d2144a;*/
    
/*    padding: 10px;*/
    text-align: center;
    border-radius: 5px;
/*    color: white;*/
    font-weight: bold;
    line-height: 25px;
    text-decoration: none;
  }

  body {
    background: #EFF1F9 !important;
  }
  .instruction-wrapper .content-wrapper{
   width:90%;
   margin:0 auto;
  }
  .instruction-wrapper .content-wrapper .card{
    padding: 20px;
    overflow: hidden;
    background-color: white;
    margin-bottom: 25px;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    border: none;
    border-radius: 8px;
  }
  .instruction-wrapper{
    background: #EFF1F9 !important;
    min-height:80vh;
    padding-top:20px;
  }
</style>
  @endsection
  @include('layout.topbar')
  <div class="instruction-wrapper">
    <div class="content-wrapper">
      <div class="card">
        <div class="card-body">
          @php
            $stomeName = str_replace(".myshopify.com","",$_GET['shop']);
          @endphp
          <ul>
            <li>1. Open the theme customizer.</li>
            <li>2. Navigate to app embed blocks or <a href="https://admin.shopify.com/store/{{$stomeName}}/themes/{{$themeId}}/editor?context=apps&amp;activateAppId=1ad57813-79bf-42ba-92ca-c74767f45c6c%2Flgenie-App" target="_blank" class="app_embed">Click Here</a> to open the app embed section directly.</li>
            <li>3. Enable "Login Genie".</li>
            <li>4. Now click on the save button.</li>
            <li>5. Now check the account page and you can see the enabled social login providers.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('scripts')
    @parent
    @include('layout.footer')
    <script>
      $(document).ready(function(){
        $("body").LoadingOverlay("show");
        setTimeout(function() {
          $("body").LoadingOverlay("hide");
        }, 3000);
        $("ul.nav-links li a").removeClass("active_nav");
        $(".instruction_nav").addClass("active_nav"); 
        
          
      });
    </script>
  @endsection