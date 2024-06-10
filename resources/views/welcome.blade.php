@extends('shopify-app::layouts.default')
@section('content')
  @section('styles')
    @include('layout.header')
    <style>
      body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
  }

  .dashboard {
    background-color: #eff1f9;
    margin: 0;
    padding: 0;
  }

  .dashboard .container {
    width: 95%;
    margin: 0 auto;
    padding-bottom: 40px;
  }

  .dashboard .container header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 145px;
  }

  .dashboard .container header .heading h3 {
    font-size: 28px;
    line-height: 1.5;
    font-weight: 500;
    margin: 0;
  }

  .dashboard .container header .search_bar .search_box {
    border-radius: 100px;
    padding: 9px 30px;
    background-color: #f5f7fb;
    width: 440px;
    box-sizing: border-box;
  }

  .dashboard .container header .search_bar .search_box .search_feild {
    background-color: transparent;
    border: none;
    border-right: 1px solid black;
    line-height: 37px;
    width: 85%;
    font-size: 22px;
  }

  .dashboard .container header .search_bar .search_box .search_feild:focus-visible {
    outline: none;
  }

  .dashboard .container header .search_bar .search_box button {
    border: none;
    background-color: transparent;
    font-size: 22px;
    width: 10%;
    text-align: center;
  }

  .dashboard .container .card_container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top:20px;
  }

  .dashboard .container .card_container .card {
    background-color: white;
    border-radius: 8px;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-direction: row;
    padding: 20px;
    gap: 20px;
  }

  .dashboard .container .card_container .card .card_info {
    flex: 1;
  }

  .dashboard .container .card_container .card .card_info h4 {
    color: #4c4c4c;
    font-size: 22px;
    font-weight: 400;
    margin: 0;
    margin-bottom: 35px;
  }

  .dashboard .container .card_container .card .card_info h3 {
    font-size: 23px;
    font-weight: 400;
    color: #484c6b;
    margin: 0;
  }

  .bar_heading {
    font-size: 20px;
    color: #202127;
    font-weight: 400;
    text-align: center;
  }

  .circle-wrap {
    width: 130px;
    height: 130px;
    background: #c7c9d3;
    border-radius: 50%;
    border: 1px solid #c7c9d3;
  }

  .profit-color {
    color: #70cf80;
  }

  .loss-color {
    color: #e01c54;
  }

  .decress {
    width: 20px;
    margin-left: 5px;
  }

  .incress {
    width: 20px;
    margin-left: 5px;
  }

  /* .card_container .card:nth-child(2) .incress {
    display: none;
  }

  .card_container .card:nth-child(2) .decress {
    display: inline;
  } */

  .card_bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .persent {
    font-weight: 600;
  }

  .card_icon {
    width: 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    height: 100%;
  }

  .profit_loss {
    display: flex;
  }

  .card_icon img {
    width: 100%;
  }

  .circle-wrap .circle .mask,
  .circle-wrap .circle .fill {
    width: 130px;
    height: 130px;
    position: absolute;
    border-radius: 50%;
  }

  .card .circle-wrap .circle .mask {
    clip: rect(0px, 130px, 130px, 75px);
  }

  .card:nth-child(2) .circle-wrap .circle .mask {
    clip: rect(0px, 130px, 130px, 68px);
  }

  .card:nth-child(3) .circle-wrap .circle .mask {
    clip: rect(0px, 130px, 130px, 50px);
  }

  .circle-wrap .inside-circle {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    background: #fff;
    line-height: 110px;
    text-align: center;
    margin-top: 10px;
    margin-left: 10px;
    color: #000;
    position: absolute;
    z-index: 100;
    font-weight: 700;
    font-size: 2em;
  }

  /* color animation */

  /* 3rd progress bar */
  .mask .fill {
    clip: rect(0px, 75px, 150px, 0px);
    background-color: #ef2f65;
  }

  .card .mask.full,
  .card .circle .fill {
    animation: fill ease-in-out 3s;
    transform: rotate(135deg);
  }

  .card:nth-child(3) .mask.full,
  .card:nth-child(3) .circle .fill {
    animation: fillss ease-in-out 3s;
    transform: rotate(90deg);
  }

  .card:nth-child(2) .mask.full,
  .card:nth-child(2) .circle .fill {
    animation: fills ease-in-out 3s;
    transform: rotate(120deg);
  }

  /* Social Providers */
  .social_providers {
    display: none;
    justify-content: space-between;
    align-items: center;
    line-height: 50px;
  }

  .social_providers div:nth-child(1) {
    width: 50%;
    display: flex;
    align-items: center;
    gap: 10px;
    justify-content: flex-start;
  }

  .social_providers div:nth-child(1) .icon_img_box {
    width: auto;
  }

  .social_providers div:nth-child(1) span {
    font-size: 16px;
    color: #202127;
    font-weight: 400;
  }

  .social_providers span:nth-child(3) {
    color: #202127;
    font-weight: 400;
    font-size: 16px;
  }

  @keyframes fill {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(135deg);
    }
  }

  @keyframes fills {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(120deg);
    }
  }

  @keyframes fillss {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(90deg);
    }
  }

  .bar_graph {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 20px;
    padding: 40px 0;
    box-sizing: border-box;
  }

  .bar_cart_box {
    width: 100%;
    height: auto;
    box-sizing: border-box;
    box-sizing: border-box;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
  }

  .bar_cart_box canvas {
    width: 100%;
    height: 400px;
  }

  .acuaisitions {
    width: calc(33.33% - 15px);
    background-color: white;
    border-radius: 8px;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    box-sizing: border-box;

  }

  .acuaisitions_list {
    padding: 20px;
  }

  .acuaisitions .acuaisitions_header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid rgba(128, 128, 128, 0.233);
  }

  .acuaisitions .acuaisitions_header .acuaisitions_heading h2 {
    margin: 0;
    font-size: 20px;
    font-weight: 400;
    color: #46474b;
  }

  .select-dropdown {
    position: relative;
    display: inline-block;
    max-width: 100%;
  }

  .select-dropdown__button {

    background-color: transparent;
    color: #202127b4;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 18px;
    text-align: left;
  }

  .select-dropdown__button::focus {
    outline: none;
  }

  .select-dropdown__button .zmdi-chevron-down {
    position: absolute;
    right: 10px;
    top: 12px;
  }

  .select-dropdown__list {
    position: absolute;
    display: block;
    left: 0;
    right: 0;
    max-height: 300px;
    overflow: auto;
    margin: 0;
    padding: 0;
    list-style-type: none;
    opacity: 0;
    pointer-events: none;
    transform-origin: top left;
    transform: scale(1, 0);
    transition: all ease-in-out 0.3s;
    z-index: 2;
  }

  .select-dropdown__list.active {
    opacity: 1;
    pointer-events: auto;
    transform: scale(1, 1);
  }

  .select-dropdown__list-item {
    display: block;
    list-style-type: none;
    padding: 10px 15px;
    background: #fff;
    border-top: 1px solid #e6e6e6;
    font-size: 14px;
    line-height: 1.4;
    cursor: pointer;
    color: #616161;
    transition: all ease-in-out 0.3s;
  }

  .acuaisitions_progress {
    background: rgb(221, 221, 221);
    justify-content: flex-start;
    border-radius: 100px;
    align-items: center;
    position: relative;
    display: flex;
    height: 8px;
    width: 100px;
  }

  .progress-value {
    border-radius: 100px;
    background: #ef2f65;
    height: 6px;
    width: 0;
  }

  .bottom_container {
    display: flex;
    gap: 25px;
  }

  @keyframes load {
    0% {
      width: 0;
    }

    100% {
      width: 68%;
    }
  }

  .acuaisitions_content {
    display: Flex;
    justify-content: space-between;
    align-items: center;
    line-height: 50px;
  }

  .acuaisitions_content div:nth-child(1) {
    width: 50%;
    display: flex;
    align-items: center;
    gap: 10px;
    justify-content: flex-start;
  }

  .acuaisitions_content div:nth-child(1) .icon_img_box {
    width: auto;
  }

  .acuaisitions_content div:nth-child(1) span {
    font-size: 16px;
    color: #202127;
    font-weight: 400;
  }

  .acuaisitions_content span:nth-child(3) {
    color: #202127;
    font-weight: 400;
    font-size: 16px;
  }

  .socil_icon {
    padding: 40px 0;

  }

  .socil_icon ul {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 40px;
    padding: 0;
  }

  .socil_icon ul li {
    width: 100px;
    height: 100px;
    list-style-type: none;
  }

  .socil_icon ul li img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .icon_img_box .circle_icon {
    width: 40px;
    height: 40px;
    border-radius: 50px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .icon_img_box .circle_icon img {
    width: 60%;
    height: 60%;
    object-fit: cover;
  }

  .acuaisitions.mobile_resp {
    display: none;
  }

  @media screen and (max-width: 1200px) {
    .dashboard .container .card_container .card .card_info h4 {
      font-size: 16px;
      margin-bottom: 25px;
    }

    .card_icon {
      width: 30px;
    }

    .dashboard .container .card_container .card .card_info h3 {
      font-size: 15px;
    }

    .acuaisitions .acuaisitions_header .acuaisitions_heading h2 {
      font-size: 16px;
    }

    .acuaisitions_content div:nth-child(1) span {
      font-size: 12px;
    }

    .acuaisitions_content div:nth-child(1) {
      gap: 0;
    }

    .acuaisitions_progress {

      height: 6px;
      width: 80px;
    }

    .progress-value {
      height: 5px;
    }

    .acuaisitions_content span:nth-child(3) {
      font-size: 12px;
    }
  }

  @media screen and (max-width: 768px) {
    .acuaisitions.mobile_resp {
      display: inline;
    }

    .acuaisitions.destop_resp {
      display: none;
    }

    .dashboard .container .card_container {

      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
    }

    .bar_cart_box {
      width: 100%;
      border-radius: 8px;
    }

    .bottom_container {
      flex-wrap: wrap;
    }

    .acuaisitions {
      width: calc(50% - 15px);
      border-radius: 8px;
    }

    .dashboard .container .card_container .card {
      border-radius: 10px;
    }

    .bar_graph {
      padding: 25px 0;
    }
  }

  @media screen and (max-width: 480px) {
    .dashboard .container .card_container {
      grid-template-columns: repeat(1, 1fr);
      gap: 20px;
    }

    .dashboard .container .card_container .card .card_info h4 {
      font-size: 24px;
      margin-bottom: 25px;
    }

    .card_icon {
      width: 50px;
    }

    .dashboard .container .card_container .card .card_info h3 {
      font-size: 28px;
    }

    .acuaisitions {
      width: 100%;
    }

    .bar_graph {
      overflow-x: scroll;
    }

    .bar_cart_box {
      width: 250%;
      border-radius: 8px;
      height: auto;
    }

  }
</style>
</head>

<body>
  @endsection
  @include('layout.topbar')
  <div class="dashboard">
    <div class="container">
      <div class="card_container">
        <div class="card">
          <div class="card_info">
            <h4 class="card_title">Login session</h4>
            <div class="card_bottom">
              <h3 class="card_val" id="loginSession">0</h3>

            </div>
          </div>
          <div class="card_icon">
            <img src="https://logingenie.sketchappslab.com/assets/images/login.png" alt="">
            <div class="profit_loss">
              <span class="persent loss-color" id="loginSessionProg">0%</span>
              <!-- <span class="incress"><img src="https://logingenie.sketchappslab.com/assets/images/Icon_Green.png" alt=""></span>
                <span class="decress"><img src="https://logingenie.sketchappslab.com/assets/images/Icon_red.png" alt=""></span> -->
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card_info">
            <h4 class="card_title">New User</h4>
            <div class="card_bottom">
              <h3 class="card_val" id="newUser"></h3>

            </div>
          </div>
          <div class="card_icon">
            <img src="https://logingenie.sketchappslab.com/assets/images/New_Users.png" alt="">
            <div class="profit_loss">
              <span class="persent loss-color" id="newUserProgress">0%</span>
            </div>
          </div>
        </div>
        <!-- <div class="card">
          <div class="card_info">
            <h4 class="card_title">PopUp Logins</h4>
            <div class="card_bottom">
              <h3 class="card_val">24</h3>
              <div class="profit_loss">
                <span class="persent profit-color">35%</span>
                <span class="incress"><img src="https://logingenie.sketchappslab.com/assets/images/Icon_Green.png" alt=""></span>
                <span class="decress"><img src="https://logingenie.sketchappslab.com/assets/images/Icon_red.png" alt=""></span>
              </div>
            </div>
          </div>
          <div class="card_icon">
            <img src="https://logingenie.sketchappslab.com/assets/images/Popup_Logins.png" alt="">
          </div>
        </div>
        <div class="card">
          <div class="card_info">
            <h4 class="card_title">Widget Logins</h4>
            <div class="card_bottom">
              <h3 class="card_val">1940</h3>
              <div class="profit_loss">
                <span class="persent profit-color">75%</span>
                <span class="incress"><img src="https://logingenie.sketchappslab.com/assets/images/Icon_Green.png" alt=""></span>
                <span class="decress"><img src="https://logingenie.sketchappslab.com/assets/images/Icon_red.png" alt=""></span>
              </div>

            </div>
          </div>
          <div class="card_icon">
            <img src="https://logingenie.sketchappslab.com/assets/images/Widget_Logins.png" alt="">
          </div>
        </div> -->

      </div>
      <div class="bar_graph">
        <div class="bar_cart_box">
          <div>
            <!-- <h2 class="bar_heading">chart.js Bar chart - Stacked</h2> -->
            <canvas id="analyticsChart"></canvas>
          </div>
        </div>

        <div class="acuaisitions destop_resp">
          <div class="acuaisitions_header">
            <div class="acuaisitions_heading">
              <h2>Most use Social Providers</h2>
            </div>

          </div>
          <div class="acuaisitions_list">
            <div class="social_providers" id="magicLinkDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/magicLink.png" alt="">
                  </span>
                </div>
                <span>MagicLink</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="magicLink_progress" style="width: 0%;"></div>
              </div>
              <span id="magicLink_span">0%</span>
            </div>
            <div class="social_providers default_provider" id="facebookDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/fb_img.png" alt="">
                  </span>
                </div>
                <span>Facebook</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="facebook_progress" style="width: 0%;"></div>
              </div>
              <span id="facebook_span">0%</span>
            </div>
            <div class="social_providers default_provider" id="amazonDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Amazon.png" alt="">
                  </span>
                </div>
                <span>Amazon</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="amazon_progress" style="width: 0%;"></div>
              </div>
              <span id="amazon_span">0%</span>
            </div>
            <div class="social_providers" id="yahooDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/yahoo.png" alt="">
                  </span>
                </div>
                <span>Yahoo</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="yahoo_progress" style="width: 0%;"></div>
              </div>
              <span id="yahoo_span">0%</span>
            </div>
            <div class="social_providers" id="vkontakteDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Vkontakte.png" alt="">
                  </span>
                </div>
                <span>Vkontakte</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="vkontakte_progress" style="width: 0%;"></div>
              </div>
              <span id="vkontakte_span">0%</span>
            </div>
            <div class="social_providers" id="spotifyDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/spotif.png" alt="">
                  </span>
                </div>
                <span>Spotify</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="spotify_progress" style="width: 0%;"></div>
              </div>
              <span id="spotify_span">0%</span>
            </div>
            <div class="social_providers" id="paypalDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/paypal.png" alt="">
                  </span>
                </div>
                <span>Paypal</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="paypal_progress" style="width: 0%;"></div>
              </div>
              <span id="paypal_span">0%</span>
            </div>
            <div class="social_providers" id="microsoftGraphDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/MicrosoftGraph.png" alt="">
                  </span>
                </div>
                <span>MicrosoftGraph</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="microsoftGraph" style="width: 0%;"></div>
              </div>
              <span id="microsoftGraph_span">0%</span>
            </div>
            <div class="social_providers" id="DiscordDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Discord.png" alt="">
                  </span>
                </div>
                <span>Discord</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="Discord_progress" style="width: 0%;"></div>
              </div>
              <span id="Discord_span">0%</span>
            </div>
            <div class="social_providers" id="DisqusDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Disqus.png" alt="">
                  </span>
                </div>
                <span>Disqus</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="Disqus_progress" style="width: 0%;"></div>
              </div>
              <span id="Disqus_span">0%</span>
            </div>
            <div class="social_providers" id="FoursquareDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/F.png" alt="">
                  </span>
                </div>
                <span>Foursquare</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="Foursquare_progress" style="width: 0%;"></div>
              </div>
              <span id="Foursquare_span">0%</span>
            </div>
            <div class="social_providers" id="WordPressDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Wordpress.png" alt="">
                  </span>
                </div>
                <span>WordPress</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="WordPress_progress" style="width: 0%;"></div>
              </div>
              <span id="WordPress_span">0%</span>
            </div>
            <div class="social_providers" id="TwitchTVDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/TwitchTV.png" alt="">
                  </span>
                </div>
                <span>TwitchTV</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="TwitchTV_progress" style="width: 0%;"></div>
              </div>
              <span id="TwitchTV_span">0%</span>
            </div>
            <div class="social_providers" id="YandexDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Yandex.png" alt="">
                  </span>
                </div>
                <span>Yandex</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="Yandex_progress" style="width: 0%;"></div>
              </div>
              <span id="Yandex_span">0%</span>
            </div>
            <div class="social_providers" id="AppleDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Apple.png" alt="">
                  </span>
                </div>
                <span>Apple</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="AppleDiv_progress" style="width: 0%;"></div>
              </div>
              <span id="Apple_span">0%</span>
            </div>
            <div class="social_providers" id="KakaoDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Kakao.png" alt="">
                  </span>
                </div>
                <span>Kakao</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="Kakao_progress" style="width: 0%;"></div>
              </div>
              <span id="Kakao_span">0%</span>
            </div>

            <div class="social_providers default_provider" id="linkedInDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/linkdin.png" alt="">
                  </span>
                </div>
                <span>LinkedIn</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="linkedIn_progress" style="width: 0%;"></div>
              </div>
              <span id="linkedIn_span">0%</span>
            </div>
            <div class="social_providers" id="GitHubDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/GitHub.png" alt="">
                  </span>
                </div>
                <span>GitHub</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="GitHub_progress" style="width: 0%;"></div>
              </div>
              <span id="GitHub_span">0%</span>
            </div>
            <div class="social_providers default_provider" id="twitterDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/twwit.png" alt="">
                  </span>
                </div>
                <span>Twitter</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="twitter_progress" style="width: 0%;"></div>
              </div>
              <span id="twitter_span">0%</span>
            </div>
            <div class="social_providers default_provider" id="googleDiv">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/google_img.png" alt="">
                  </span>
                </div>
                <span>Google</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="google_progress" style="width: 0%;"></div>
              </div>
              <span id="google_span">0%</span>
            </div>

          </div>
        </div>
      </div>
      <div class="bottom_container">

        <div class="acuaisitions">
          <div class="acuaisitions_header">
            <div class="acuaisitions_heading">
              <h2>Most Login By Country</h2>
            </div>

          </div>
          <div class="acuaisitions_list">
            <div class="acuaisitions_content">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/usa.png" alt="">
                  </span>
                </div>
                <span>United States</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" style="width: 0%;"></div>
              </div>
              <span>0</span>
            </div>
            <div class="acuaisitions_content">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/india.png" alt="">
                  </span>
                </div>
                <span>INDIA</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="india_progress" style="width: 0%;"></div>
              </div>
              <span id="india_span">0</span>
            </div>
            <div class="acuaisitions_content">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/rusia.png" alt="">
                  </span>
                </div>
                <span>Russia</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="russia_progress" style="width: 0%;"></div>
              </div>
              <span id="russia_span">0</span>
            </div>
            <div class="acuaisitions_content">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Australia.png" alt="">
                  </span>
                </div>
                <span>Australia</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="australia_progress" style="width: 0%;"></div>
              </div>
              <span id="australia_span">0

              </span>
            </div>

          </div>
        </div>

        <div class="acuaisitions">
          <div class="acuaisitions_header">
            <div class="acuaisitions_heading">
              <h2>Most use OS</h2>
            </div>

          </div>
          <div class="acuaisitions_list">
            <div class="acuaisitions_content">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Windows.png" alt="">
                  </span>
                </div>
                <span>Windows</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="Windows_progress" style="width: 0%;"></div>
              </div>
              <span id="Windows">0</span>
            </div>
            <div class="acuaisitions_content">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Ubuntu.png" alt="">
                  </span>
                </div>
                <span>Ubuntu</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="Linux_progress" style="width: 0%;"></div>
              </div>
              <span id="Linux">0</span>
            </div>

            <div class="acuaisitions_content">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/mac.png" alt="">
                  </span>
                </div>
                <span>Mac</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="Mac_progress" style="width: 0%;"></div>
              </div>
              <span id="Mac">0</span>
            </div>


          </div>
        </div>
        <div class="acuaisitions">
          <div class="acuaisitions_header">
            <div class="acuaisitions_heading">
              <h2>Most Login Device use</h2>
            </div>
          </div>
          <div class="acuaisitions_list">
            <div class="acuaisitions_content">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Mobile.png" alt="">
                  </span>
                </div>
                <span>Mobile</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="mobile_progress" style="width: 0%;"></div>
              </div>
              <span id="mobile">0</span>
            </div>
            <div class="acuaisitions_content">
              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Laptop.png" alt="">
                  </span>
                </div>
                <span>Desktop</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="desktop_progress" style="width: 0%;"></div>
              </div>
              <span id="desktop">0</span>
            </div>
            <div class="acuaisitions_content">

              <div>
                <div class="icon_img_box">
                  <span class="circle_icon">
                    <img src="https://logingenie.sketchappslab.com/assets/images/Tablet.png" alt="">
                  </span>
                </div>
                <span>Tablet</span>
              </div>
              <div class="acuaisitions_progress">
                <div class="progress-value" id="tablet_progress" style="width: 0%;"></div>
              </div>
              <span id="tablet">0</span>
            </div>


          </div>
        </div>
      </div>

    </div>
  </div>
  @endsection
  @section('scripts')
    @parent
    @include('layout.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>
    <script>
      function generateChart(chartData, providerData) {
        var thisWeek = chartData;
        console.log(providerData);
        var dataPack4 = [44, 22, 33, 11, 45.10];
        var dataPack5 = [49, 22, 36, 21, 35, 22];
        var chart = document.getElementById('analyticsChart');
        new Chart(chart, {
          type: 'bar',
          data: {
            labels: thisWeek,
            datasets: [{
                label: 'Google',
                data: providerData.googleArr,
                backgroundColor: "#DB4437",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white',
              },
              {
                label: 'Magic Link',
                data: providerData.magicLinkArr,
                backgroundColor: "#ff5253",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'Twitter',
                data: providerData.TwitterArr,
                backgroundColor: "#1da1f2",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'paypal',
                data: providerData.paypalArr,
                backgroundColor: "#4cc0c0",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'Amazon',
                data: providerData.amazonArr,
                backgroundColor: "#ff9900",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'Facebook',
                data: providerData.facebookArr,
                backgroundColor: "#1877f2",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'Linkdin',
                data: providerData.linkedInArr,
                backgroundColor: "#0a66c2",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'Yahoo',
                data: providerData.yahooArr,
                backgroundColor: "#6001d2",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'Vkontakte',
                data: providerData.vkontakteArr,
                backgroundColor: "#4a76a8",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'Spotify',
                data: providerData.spotifyArr,
                backgroundColor: "#1ed760",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'MicrosoftGraph',
                data: providerData.microsoftGraphArr,
                backgroundColor: "#f35022",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'Discord',
                data: providerData.discordArr,
                backgroundColor: "#5865f2",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'Disqus',
                data: providerData.disqusArr,
                backgroundColor: "#800000",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'Foursquare',
                data: providerData.foursquareArr,
                backgroundColor: "#f94877",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'WordPress',
                data: providerData.wordPressArr,
                backgroundColor: "#123456",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'TwitchTV',
                data: providerData.TwitchTVArr,
                backgroundColor: "#9146ff",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'Yandex',
                data: providerData.YandexArr,
                backgroundColor: "#FFA500",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'GitHub',
                data: providerData.GitHubArr,
                backgroundColor: "#181818",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'Apple',
                data: providerData.AppleArr,
                backgroundColor: "#a6b1b7",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
              {
                label: 'Kakao',
                data: providerData.KakaoArr,
                backgroundColor: "#6e6def",

                hoverBorderWidth: 2,
                hoverBorderColor: 'white'
              },
            ]
          },
          options: {
            responsive: true,
            title: {
              display: true,
              text: 'Current Week Logins'
            },
            animation: {
              duration: 10,
            },
              tooltips: {
                displayColors: true,
                callbacks:{
                  mode: 'x',
                },
              },
            scales: {
              xAxes: [{
                stacked: true,
                gridLines: {
                  display: false
                },
              }],
              yAxes: [{
                stacked: true,
                ticks: {
                  beginAtZero: true,
                  callback: function(value) {
                    if (value % 1 === 0) {
                      return value;
                    }
                  }
                },
              }],
            }, // scales
            legend: {
              display: false
            }
          }
        });
      }
      $("body").LoadingOverlay("show");
      $(document).ready(function(){
        $('.progress-value').css('width',"0%");
        setTimeout(function() {
          $("body").LoadingOverlay("hide");
          // window.dispatchEvent(new Event('resize'));
        }, 3000);
        $("ul.nav-links li a").removeClass("active_nav");
        $(".dashboard_nav").addClass("active_nav"); 
       /*
        ==================================
        Chart Data
        ==================================
        */
        setTimeout(function() {
          shopifyAuthenticatedFetch('get-chart-data', {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body:JSON.stringify({'shop': "{{ Auth::user()->name }}"})
          }).then(async (response) => {
            var result = await response.json();
            generateChart(result.DatesArr, result.providerData);
          });
        }, 2000);
        setTimeout(function() {
          shopifyAuthenticatedFetch('all-analytics', {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body:JSON.stringify({'shop': "{{ Auth::user()->name }}"})
          }).then(async (response) => {
            var result = await response.json();
            console.log("result",result);
            if (result.status == 200) {
              var totalBrowserLoginCount = result.osArr.Windows + result.osArr.Linux + result.osArr.Mac;
              var totalDeviceLoginCount = result.deviceArr.mobile + result.deviceArr.desktop + result.deviceArr.tablet;
              // show progress bar for browser
              $('#Windows_progress').css('width', percentCal(result.osArr.Windows, totalBrowserLoginCount));
              $('#Linux_progress').css('width', percentCal(result.osArr.Linux, totalBrowserLoginCount));
              $('#Mac_progress').css('width', percentCal(result.osArr.Mac, totalBrowserLoginCount));
              $('#Windows').text(result.osArr.Windows);
              $('#Linux').text(result.osArr.Linux);
              $('#Mac').text(result.osArr.Mac);
              // show progressbar for device login
              $('#mobile_progress').css('width', percentCal(result.deviceArr.mobile, totalDeviceLoginCount));
              $('#desktop_progress').css('width', percentCal(result.deviceArr.desktop, totalDeviceLoginCount));
              $('#tablet_progress').css('width', percentCal(result.deviceArr.tablet, totalDeviceLoginCount));
              $('#mobile').text(result.deviceArr.mobile);
              $('#desktop').text(result.deviceArr.desktop);
              $('#tablet').text(result.deviceArr.tablet);
              $('#loginSession').text(result.loginSession);
              $('#newUser').text(result.newUser);
              
              // Show country Login
              $('#india_span').text(result.totalCountryLogin.India);
              $('#india_progress').css('width',percentCal(result.totalCountryLogin.India,totalBrowserLoginCount));
              $('#russia_span').text(result.totalCountryLogin.Russia);
              $('#russia_progress').css('width',percentCal(result.totalCountryLogin.Russia,totalBrowserLoginCount));
              $('#australia_span').text(result.totalCountryLogin.Australia);
              $('#australia_progress').css('width',percentCal(result.totalCountryLogin.Australia,totalBrowserLoginCount));
              // Show Login Session Progress comparision of last week
              if (result.loginSession > result.lastLoginSession) {
                console.log("loginSession",result.loginSession,'lastLoginSession',result.lastLoginSession);
                var progressPer = (((result.loginSession - result.lastLoginSession) * 100) / result.lastLoginSession).toFixed(1);
                console.log("progressPer",progressPer);
                if (!isNaN(progressPer) && isFinite(progressPer)) {
                  $('#loginSessionProg').removeClass("loss-color").addClass("profit-color");
                  $('#loginSessionProg').text(progressPer.replace("-", "") + "%");
                  $('#loginSessionProg').after(`<span class="incress"><img src="https://logingenie.sketchappslab.com/assets/images/Icon_Green.png" alt=""></span>`);
                }
              } else {
                var progressPer = (((result.loginSession - result.lastLoginSession) * 100) / result.lastLoginSession).toFixed(1);
                // console.log("progressPer",progressPer);
                if (!isNaN(progressPer) && isFinite(progressPer)) {
                  $('#loginSessionProg').addClass("loss-color");
                  $('#loginSessionProg').text(progressPer.replace("-", "") + "%");
                  $('#loginSessionProg').after(`<span class="decress"><img src="https://logingenie.sketchappslab.com/assets/images/Icon_red.png" alt=""></span>`);
                }
              }
              // show Comparision Of New User Login 
              if (result.newUser > result.lastWeekNewUser) {
                var newLoginPer = (((result.newUser - result.lastWeekNewUser) * 100) / result.lastWeekNewUser).toFixed(1);
                if (!isNaN(newLoginPer) && isFinite(progressPer)) {
                  $('#newUserProgress').removeClass("loss-color").addClass("profit-color");
                  $('#newUserProgress').text(newLoginPer.replace("-", "") + "%");
                  $('#newUserProgress').after(`<span class="incress"><img src="https://logingenie.sketchappslab.com/assets/images/Icon_Green.png" alt=""></span>`);
                }
              } else {
                var newLoginPer = (((result.newUser - result.lastWeekNewUser) * 100) / result.lastWeekNewUser).toFixed(1);
                if (!isNaN(newLoginPer) && isFinite(progressPer)) {
                  $('#newUserProgress').addClass("loss-color");
                  $('#newUserProgress').text(newLoginPer.replace("-", "") + "%");
                  $('#newUserProgress').after(`<span class="decress"><img src="https://logingenie.sketchappslab.com/assets/images/Icon_red.png" alt=""></span>`);
                }
              }
              // Most use Social Provider Functionality
              // show Default Social Provider if Count is 0
              if (result.totalLoginProviderCount == 0) {
                $('.default_provider').css('display', 'flex');
              }
              var providerCount = 0;
              Object.entries(result.providerArr).forEach(([key, value]) => {
                providerProgress = "";
                if (providerCount < 5) {
                  if (key == "Google") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#googleDiv').css('display', 'flex');
                    $('#google_span').text(providerProgress);
                    $('#google_progress').css('width', providerProgress);
                  } else if (key == "MagicLink") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#magicLinkDiv').css('display', 'flex');
                    $('#magicLink_span').text(providerProgress);
                    $('#magicLink_progress').css('width', providerProgress);
                  } else if (key == "Facebook") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#facebookDiv').css('display', 'flex');
                    $('#facebook_span').text(providerProgress);
                    $('#facebook_progress').css('width', providerProgress);
                  } else if (key == "LinkedIn") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#linkedInDiv').css('display', 'flex');
                    $('#linkedIn_span').text(providerProgress);
                    $('#linkedIn_progress').css('width', providerProgress);
                  } else if (key == "Twitter") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#twitterDiv').css('display', 'flex');
                    $('#twitter_span').text(providerProgress);
                    $('#twitter_progress').css('width', providerProgress);
                  } else if (key == "Amazon") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#amazonDiv').css('display', 'flex');
                    $('#amazon_span').text(providerProgress);
                    $('#amazon_progress').css('width', providerProgress);
                  } else if (key == "Yahoo") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#yahooDiv').css('display', 'flex');
                    $('#yahoo_span').text(providerProgress);
                    $('#yahoo_progress').css('width', providerProgress);
                  } else if (key == "Vkontakte") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#vkontakteDiv').css('display', 'flex');
                    $('#vkontakte_span').text(providerProgress);
                    $('#vkontakte_progress').css('width', providerProgress);
                  } else if (key == "Spotify") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#spotifyDiv').css('display', 'flex');
                    $('#spotify_span').text(providerProgress);
                    $('#spotify_progress').css('width', providerProgress);
                  } else if (key == "Paypal") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#paypalDiv').css('display', 'flex');
                    $('#paypal_span').text(providerProgress);
                    $('#paypal_progress').css('width', providerProgress);
                  } else if (key == "MicrosoftGraph") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#microsoftGraphDiv').css('display', 'flex');
                    $('#microsoftGraph_span').text(providerProgress);
                    $('#microsoftGraph_progress').css('width', providerProgress);
                  } else if (key == "Discord") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#DiscordDiv').css('display', 'flex');
                    $('#Discord_span').text(providerProgress);
                    $('#Discord_progress').css('width', providerProgress);
                  } else if (key == "Disqus") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#DisqusDiv').css('display', 'flex');
                    $('#Disqus_span').text(providerProgress);
                    $('#Disqus_progress').css('width', providerProgress);
                  } else if (key == "Foursquare") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#FoursquareDiv').css('display', 'flex');
                    $('#Foursquare_span').text(providerProgress);
                    $('#Foursquare_progress').css('width', providerProgress);
                  } else if (key == "WordPress") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#WordPressDiv').css('display', 'flex');
                    $('#WordPress_span').text(providerProgress);
                    $('#WordPress_progress').css('width', providerProgress);
                  } else if (key == "TwitchTV") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#TwitchTVDiv').css('display', 'flex');
                    $('#TwitchTV_span').text(providerProgress);
                    $('#TwitchTV_progress').css('width', providerProgress);
                  } else if (key == "Yandex") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#YandexDiv').css('display', 'flex');
                    $('#Yandex_span').text(providerProgress);
                    $('#Yandex_progress').css('width', providerProgress);
                  } else if (key == "GitHub") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#GitHubDiv').css('display', 'flex');
                    $('#GitHub_span').text(providerProgress);
                    $('#GitHub_progress').css('width', providerProgress);
                  } else if (key == "Apple") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#AppleDiv').css('display', 'flex');
                    $('#Apple_span').text(providerProgress);
                    $('#AppleDiv_progress').css('width', providerProgress);
                  } else if (key == "Kakao") {
                    providerProgress = percentCal(value, result.totalLoginProviderCount);
                    $('#KakaoDiv').css('display', 'flex');
                    $('#Kakao_span').text(providerProgress);
                    $('#Kakao_progress').css('width', providerProgress);
                  }
                }
                providerCount++;
              });
              // end Most use Social Provider Functionality
              //calculate most user Provider Percent
              function percentCal(value, total_value) {
                var percent = ((value * 100) / total_value).toFixed(2) + "%";
                return percent;
              }
            }
          });
        }, 2000);
      });
      /*
      ========================================
      Get All Analytics Data of current Week
      ========================================
      */
    </script>
  @endsection