@extends('shopify-app::layouts.default')
@section('content')
  @section('styles')
    @include('layout.header')
    <style>
  .integration_wrapper {
    margin-top: 8px;
    font-size: 11px;
  }
  body{
    background-color: transparent !important;
  }

  .containers {
    width: 90%;
    margin: 20px auto;
  }

  .card_wrapper {
    padding: 20px;
    overflow: hidden;
    background-color: white;
    margin-bottom: 25px;
  }

  .card_shadow {
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    border: none;
    border-radius: 8px;
  }

  .Polaris-TextField__Input {
    width: 100%;
    font-size: 12px;
    border-radius: 5px;
    color: black;
    height: 35px;
    padding: 2px 10px;
    border: 1px solid #7a6363;
  }

  .Polaris-Label {
    font-size: 15px;
    font-weight: 600;
    color: #161616;
    font-family: 'Inter', sans-serif;
    text-transform: uppercase;
  }

  .card_heading {
    font-size: 18px;
    font-weight: 600;
    font-family: 'Inter', sans-serif;
    color: #46474b;
  }

  .card_desc p {
    font-size: 12px;
    color: #8b7a7a;
  }

  .card_head:after {
    content: "";
    border: 1px solid #f3f0f091;
    display: block;
    width: 130%;
    margin-left: -20px;
    top: 8px;
    position: relative;
  }

  .card_body {
    margin-top: 20px;
  }

  #saveIntegrationButtn {
    background-color: #EE2E64;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    color: #fff;
    width: 203px;
    text-align: center;
    line-height: 35px;

  }

  #klaviyoListsLabel {
    margin-top: 10px;
  }

  #klaviyoLists {
    width: 100%;
    height: 40px;
  }

  #saveIntegrationButtn:disabled,
  button[disabled] {
    border: none;
    background-color: #ea92ab;
    color: #fff;
  }
</style>
  @endsection
  @include('layout.topbar')
  <div class="integration_wrapper">
    <form id="integration_form">
      <div class="containers">
        <div class="rows">
          
          <!-- Klaviyo Email Integration -->
          <div class="col-md-6">
            <!-- -----------------Email Integration-------------- -->
            <div class="card_wrapper card_shadow">
              <div class="card_head">
                <h2 class="card_heading">
                  Klaviyo Email Integration
                </h2>
                <div class="card_desc">
                  <p>Email Marketing Integration</p>
                </div>
              </div>
              <div class="card_body">
                <div class="Polaris-FormLayout__Item">
                  <div class="">
                    <div class="Polaris-Labelled__LabelWrapper">
                      <div class="Polaris-Label"><label for="PolarisTextField19" class="Polaris-Label__Text">API Key</label></div>
                    </div>
                    <div class="Polaris-Connected">
                      <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                        <div class="Polaris-TextField"><input class="Polaris-TextField__Input" aria-labelledby="PolarisTextField19Label" aria-invalid="false" value="@isset($response['data']['klaviyo_api_key']){{$response['data']['klaviyo_api_key']}}@endisset" id="klaviyo_api_key" name="klaviyo_api_key" placeholder="Enter Api key">
                          <div class="Polaris-TextField__Backdrop"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="Polaris-FormLayout__Item" id="klavioListDiv">
                  <div class="klaviyoList">
                    <div class="Polaris-Labelled__LabelWrapper">
                        <div class="Polaris-Label"><label id="klaviyoListsLabel" for="klaviyoLists" class="Polaris-Label__Text">List</label></div>
                      </div>
                      <div class="Polaris-Select">
                        <select id="klaviyoLists" name="klaviyoLists" class="Polaris-Select__Input" aria-invalid="false">
                        @isset($response['data']['klaviyoLists'])
                          @foreach($response['klaviyoList'] as $list)
                            <option value="{{ $list['list_id'] }}" {{($response['data']['klaviyoLists'] == $list['list_id'])?'selected':''}}>{{ $list['list_name'] }}</option>
                          @endforeach
                        @endisset
                        </select>
                        <div class="Polaris-Select__Backdrop"></div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <!-- -----------------Email Integration--------------- -->
            <div class="save-btn">
              <button id="saveIntegrationButtn" disabled="">Save</button>
            </div>
          </div>
          <div class="col-md-6">
          </div>
        </div>
      </div>
    </form>
  </div>
  @endsection
  @section('scripts')
    @parent
    @include('layout.footer')
    <script>
      $("body").LoadingOverlay("show");
      $(document).ready(function(){
        setTimeout(function() {
          $("body").LoadingOverlay("hide");
        }, 3000);
        $("ul.nav-links li a").removeClass("active_nav");
        $(".integration_nav").addClass("active_nav"); 
        $(document).on('change', '#klaviyoLists', function() {
          $('#saveIntegrationButtn').removeAttr("disabled");
        });
        $(document).on('change', '#klaviyo_api_key', function() {
          var apiKeys = $(this).val();
          if (apiKeys != '') {
            $("body").LoadingOverlay("show");
            shopifyAuthenticatedFetch('get-klaviyo-list', {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body:JSON.stringify({'klaviyoKeyValue': apiKeys})
            })
            .then(async (response) => { 
              var result = await response.json();
              $("body").LoadingOverlay("hide");
              if (result.msg != 'The Key is not valid') {
                $('.klaviyoList').html(result.msg);
                $('#saveIntegrationButtn').removeAttr("disabled");
              } else {
                ShopifyApp.flashNotice("The API Key is not valid.");
                $('.klaviyoList').html('<p style="color:red;">The API Key is not valid.</p>');
                $('#saveIntegrationButtn').attr("disabled", "true");
              }
            });
          }
        });
        // Save Integration Settings
        $('#saveIntegrationButtn').on('click', function(e) {
          e.preventDefault();
          var formData = new FormData(document.getElementById("integration_form"));
          $("body").LoadingOverlay("show");
          shopifyAuthenticatedFetch('add-klaviyo-integration', {
              method: "POST",
              body:formData
          })
          .then(async (response) => { 
            $("body").LoadingOverlay("hide");
            var result = await response.json();
            if (result.status == 200) {
              ShopifyApp.flashNotice(result.message);
            } else {
              ShopifyApp.flashError(result.message);
            }
          });
        });
      });
    </script>
  @endsection