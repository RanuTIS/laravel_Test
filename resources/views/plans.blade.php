
@extends('shopify-app::layouts.default')
@section('content')
  @section('styles')
    @include('layout.header')
    <style>
    body{background: transparent;} a,a:hover,a:focus,a:active{text-decoration:none;outline:none}a,a:active,a:focus{color:#333;text-decoration:none;transition-timing-function:ease-in-out;-ms-transition-timing-function:ease-in-out;-moz-transition-timing-function:ease-in-out;-webkit-transition-timing-function:ease-in-out;-o-transition-timing-function:ease-in-out;transition-duration: .2s;-ms-transition-duration: .2s;-moz-transition-duration: .2s;-webkit-transition-duration: .2s;-o-transition-duration: .2s}ul{margin:0;padding:0;list-style:none}img{max-width:100%;height:auto}.sec-title{position:relative;margin-bottom:30px}.sec-title .title{position:relative;display:block;font-size:22px;line-height:1em;color:#ff8a01;font-weight:500;background:rgb(247,0,104);background:-moz-linear-gradient(to left, rgba(247,0,104,1) 0%, rgba(68,16,102,1) 25%, rgba(247,0,104,1) 75%, rgba(68,16,102,1) 100%);background:-webkit-linear-gradient(to left, rgba(247,0,104,1) 0%,rgba(68,16,102,1) 25%,rgba(247,0,104,1) 75%,rgba(68,16,102,1) 100%);background:linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 25%,rgba(247,0,104,1) 75%,rgba(68,16,102,1) 100%);filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#F70068', endColorstr='#441066',GradientType=1 );color:transparent;-webkit-background-clip:text;-webkit-text-fill-color:transparent;text-transform:uppercase;letter-spacing:5px;margin-bottom:15px}.sec-title h2{position:relative;display:inline-block;font-size:48px;line-height:1.2em;color:#1e1f36;font-weight:700}.sec-title .text{position:relative;font-size:16px;line-height:28px;color:#888;margin-top:30px}.sec-title.light h2, .sec-title.light .title{color:#fff;-webkit-text-fill-color:inherit}.pricing-section{position:relative;padding:28px 0 0px;overflow:hidden}.pricing-section .outer-box{max-width:1100px;margin:0 auto}.pricing-section .row{margin:0 -30px}.pricing-block{position:relative;padding:0 30px;margin-bottom:40px}.pricing-block .inner-box{position:relative;background-color:#fff;box-shadow:0 20px 40px rgba(0,0,0,0.08);padding:0 0 30px;max-width:370px;margin:0 auto;border-bottom:20px solid #40cbb4}.pricing-block .icon-box{position:relative;padding:50px 30px 0;background-color:#40cbb4;text-align:center}.pricing-block .icon-box:before{position:absolute;left:0;bottom:0;height:75px;width:100%;border-radius:50% 50% 0 0;background-color:#fff;content:""}.pricing-block .icon-box .icon-outer{position:relative;height:150px;width:150px;background-color:#fff;border-radius:50%;margin:0 auto;padding:10px}.pricing-block .icon-box i{position:relative;display:block;height:130px;width:130px;line-height:120px;border:5px solid #40cbb4;border-radius:50%;font-size:50px;color:#40cbb4;-webkit-transition:all 600ms ease;-ms-transition:all 600ms ease;-o-transition:all 600ms ease;-moz-transition:all 600ms ease;transition:all 600ms ease}.pricing-block .inner-box:hover .icon-box i{transform:rotate(360deg)}.pricing-block .price-box{position:relative;text-align:center;padding:10px 20px}.pricing-block .title{position:relative;display:block;font-size:24px;line-height:1.2em;color:#222;font-weight:600}.pricing-block .price{display:block;font-size:30px;color:#222;font-weight:700;color:#40cbb4}.pricing-block .features{position:relative;max-width:200px;margin:0 auto 20px}.pricing-block .features li{position:relative;display:block;font-size:14px;line-height:30px;font-weight:500;padding:5px 0;padding-left:30px;border-bottom:1px dashed #ddd}.pricing-block .features li a{color:#848484}.pricing-block .features li:last-child{border-bottom:0}.pricing-block .btn-box{position:relative;text-align:center}.pricing-block .btn-box a{position:relative;display:inline-block;font-size:14px;line-height:25px;color:#fff;font-weight:500;padding:8px 30px;background-color:#40cbb4;border-radius:10px;border-top:2px solid transparent;border-bottom:2px solid transparent;-webkit-transition:all 400ms ease;-moz-transition:all 400ms ease;-ms-transition:all 400ms ease;-o-transition:all 400ms ease;transition:all 300ms ease}.pricing-block .btn-box a:hover{color:#fff}.pricing-block .inner-box:hover .btn-box a{color:#40cbb4;background:none;border-radius:0px;border-color:#40cbb4}.pricing-block:nth-child(2) .icon-box i, .pricing-block:nth-child(2) .inner-box{border-color:#1d95d2}.pricing-block:nth-child(2) .btn-box a, .pricing-block:nth-child(2) .icon-box{background-color:#1d95d2}.pricing-block:nth-child(2) .inner-box:hover .btn-box a{color:#1d95d2;background:none;border-radius:0px;border-color:#1d95d2}.pricing-block:nth-child(2) .icon-box i, .pricing-block:nth-child(2) .price{color:#1d95d2}.pricing-block:nth-child(3) .icon-box i, .pricing-block:nth-child(3) .inner-box{border-color:#ffc20b}.pricing-block:nth-child(3) .btn-box a, .pricing-block:nth-child(3) .icon-box{background-color:#ffc20b}.pricing-block:nth-child(3) .icon-box i, .pricing-block:nth-child(3) .price{color:#ffc20b}.pricing-block:nth-child(3) .inner-box:hover .btn-box a{color:#ffc20b;background:none;border-radius:0px;border-color:#ffc20b}.pricing-block .features li:before {position: absolute;left: 0;top: 50%;font-size: 16px;color: #2bd40f;-moz-osx-font-smoothing: grayscale;-webkit-font-smoothing: antialiased;display: inline-block;font-style: normal;font-variant: normal;text-rendering: auto;line-height: 1;content: "\f058";font-family: "Font Awesome 5 Free";margin-top: -8px;}.pricing-block .features li.false:before{color: #e1137b;content: "\f057";}.planActive{box-shadow: 0px 2px 10px 5px #6c757d !important;}.ribbon{width:150px;height:150px;overflow:hidden;position:absolute;z-index: 9;}.ribbon::before,.ribbon::after{position:absolute;z-index:-1;content:'';display:block;border:5px solid black}.ribbon span{position:absolute;display:block;width:225px;padding:15px 0;background-color:black;box-shadow:0 5px 10px rgba(0,0,0,.1);color:#fff;font:700 18px/1 'Lato', sans-serif;text-shadow:0 1px 1px rgba(0,0,0,.2);text-transform:uppercase;text-align:center}.ribbon-top-left{top:-10px;left:-10px}.ribbon-top-left::before,.ribbon-top-left::after{border-top-color:transparent;border-left-color:transparent}.ribbon-top-left::before{top:0;right:0}.ribbon-top-left::after{bottom:0;left:0}.ribbon-top-left span{right:-25px;top:30px;transform:rotate(-45deg)}
  </style>
  @endsection
  @include('layout.topbar')
  <section class="pricing-section">
    <div class="container">
      <div class="sec-title text-center">
        <span class="title h3 font-weight-bold">Choose a Plan</span>
      </div>
      <div class="outer-box">
        <div class="row">
          <div class="pricing-block col-lg-6 col-md-6 col-sm-12 wow fadeInUp">
            <div class="inner-box shadow @if($charges) @isset($charges->status){{($charges->status == 'CANCELLED')?'planActive':''}}@endisset @elseif($userPlan =='free'){{ 'planActive'}}@endif">
            @if($charges)
              @isset($charges->status)
                @if($charges->status == 'CANCELLED')
                  <div class="ribbon ribbon-top-left"><span>Active</span></div>  
                @endif
              @endisset
            @elseif($userPlan == 'free')
              <div class="ribbon ribbon-top-left"><span>Active</span></div>
            @endif            
              <div class="icon-box">
                <div class="icon-outer"><i class="fas fa-paper-plane"></i></div>
              </div>
              <div class="price-box">
                <div class="title">Free Plan</div>
                <h4 class="price">${{($plansDetails['free']['price'])?$plansDetails['free']['price']:'0.00'}}</h4>
              </div>
              <ul class="features text-secondary">
                  <li class="true">2 Social network at a time</li>
                  <li class="true">150 Registration/Login per month</li>
                  <li class="true">Automatic code installation</li>
                  <li class="true">Customizable login widget</li>
                  <li class="true">Dashboard statistics</li>
                  <li class="true">Registered customer list</li>
                  <li class="true">Custom API key option</li>
                  <!-- <li class="false">Free Contacts</li> -->
              </ul>
            <div class="btn-box">
              @isset($charges->status)
                @if($charges->status == 'ACTIVE')
                  <a href="javascript:" onclick="canclePlan({{$charges->id}},{{$charges->charge_id}});">Downgrade</a>
                @endif
              @endisset
              </div>
            </div>
          </div>
          <div class="pricing-block col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
            <div class="inner-box shadow @isset($charges->status){{($charges->status == 'ACTIVE')?'planActive':''}}@endisset">
            @isset($charges->status)
              @if($charges->status == 'ACTIVE')
                <div class="ribbon ribbon-top-left"><span>Active</span></div>  
              @endif
            @endisset            
              <div class="icon-box">
                <div class="icon-outer"><i class="fas fa-gem"></i></div>
              </div>
              <div class="price-box">
                <div class="title">Plus Plan</div>
                <h4 class="price">${{($plansDetails['plus']['price'])?$plansDetails['plus']['price']:'5.99'}}</h4>
              </div>
              <ul class="features text-secondary">
                <li class="true">All Free Plan Features</li>
                <li class="true">20+ Social networks</li>
                <li class="true">Unlimited Registration/Logins</li>
                <li class="true">Graphs and Analytics</li>
                <li class="true">Modal popup login widget</li>
                <li class="true">Login redirection</li>
                <li class="true">Customer list export</li>
                <li class="true">White labelling</li>
              </ul>
              <div class="btn-box">
              @if($charges)
                @isset($charges->status)
                  @if($charges->status == 'CANCELLED')
                    <a href="{{ URL::tokenRoute('billing', ['plan' => ($plansDetails['plus']['id'])?$plansDetails['plus']['id']:0, 'shop' => Auth::user()->name ]) }}">Upgrade</a>
                  @endif
                @endisset
              @elseif($userPlan == 'free')
                <a href="{{ URL::tokenRoute('billing', ['plan' => ($plansDetails['plus']['id'])?$plansDetails['plus']['id']:0, 'shop' => Auth::user()->name ]) }}">Upgrade</a>
              @endif
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
  @section('scripts')
    @parent
    @include('layout.footer')
    <script>
      function canclePlan(id,chargeId){
        // console.log("id",id,"ChargeId",chargeId);
        if(id !='' && chargeId != ''){
          $("body").LoadingOverlay("show");
          shopifyAuthenticatedFetch('cancel-plan', {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body:JSON.stringify({'id': id,'chargeId':chargeId,'shop':"{{ Auth::user()->name }}"})
          })
          .then(async (response) => { 
              $("body").LoadingOverlay("hide");
              var result = await response.text();
              if(result == "Success")
                redirect.dispatch(Redirect.Action.APP, '/settings?click=saved');
              else 
               ShopifyApp.flashNotice("Something went wrong.");

          });
        }
        
      }
      $("body").LoadingOverlay("show");
      $(document).ready(function(){
        setTimeout(function() {
          $("body").LoadingOverlay("hide");
        }, 3000);
        $("ul.nav-links li a").removeClass("active_nav");
        $(".plans_nav").addClass("active_nav"); 
      });
    </script>
  @endsection