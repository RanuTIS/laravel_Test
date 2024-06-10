<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
        nav{

            background-color: #fff;
            width:100%;
            z-index: 10;
            -webkit-box-shadow: 0px 0px 4px 1px rgba(219,219,219,1);
            -moz-box-shadow: 0px 0px 4px 1px rgba(219,219,219,1);
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        }
        nav{
            display: flex;
            align-items:center;
            justify-content:space-between;
            padding:0 20px;
        }
        /*Styling logo*/
        .logo{
            padding:1vh 1vw;
            text-align: center;
        }
        .logo img {
            height: auto;
            width: 50px;
        }

        /*Styling Links*/
        .nav-links{
            display: flex;
            list-style: none; 
            gap:10px;
            padding: 0 0.7vw;
            justify-content: space-evenly;
            align-items: center;
            text-transform: uppercase;
            margin-bottom:0;
        }
        .nav-links li a{
            text-decoration: none;
            margin: 0 0.7vw;
            color:#6D7175;
            font-family: 'Poppins', sans-serif;
            padding:0 12px;
            line-height: 2rem;
            font-weight: 400;
            font-size: 13px;
            text-transform: capitalize !important;
        }
        .nav-links li a:hover {
            color: #EE2E64;
        }
        .active_nav{
            color: #EE2E64 !important;
        }
        .active_nav::before {
            content: "";
            display: block;
            height: 3px;
            width: 80% !important;
            background-color: #EE2E64;
            position: absolute;
            transition: all ease-in-out 250ms;
            margin: 0 0 0 10%;
            bottom:-3px;
        }
      
        .nav-links li {
            position: relative;
            padding:0;
        }
        .nav-links li a::before {
            content: "";
            display: block;
            height: 3px;
            width: 0%;
            background-color: #EE2E64;
            position: absolute;
            transition: all ease-in-out 250ms;
            margin: 0 0 0 10%;
            bottom:-3px;
        }
        .nav-links li a:hover::before{
            width: 80%;
        }

        /*Styling Buttons*/
        .login-button{
            background-color: transparent;
            border: 1.5px solid #f2f5f7;
            border-radius: 2em;
            padding: 0.6rem 0.8rem;
            margin-left: 2vw;
            font-size: 1rem;
            cursor: pointer;

        }
        .login-button:hover {
            color: #131418;
            background-color: #f2f5f7;
            border:1.5px solid #f2f5f7;
            transition: all ease-in-out 350ms;
        }
        .join-button{
            color: #131418;
            background-color: #61DAFB;
            border: 1.5px solid #61DAFB;
            border-radius: 2em;
            padding: 0.6rem 0.8rem;
            font-size: 1rem;
            cursor: pointer;
        }
        .join-button:hover {
            color: #f2f5f7;
            background-color: transparent;
            border:1.5px solid #f2f5f7;
            transition: all ease-in-out 350ms;
        }

        /*Styling Hamburger Icon*/
        .hamburger div{
            width: 30px;
            height:3px;
            background: #f2f5f7;
            margin: 5px;
            transition: all 0.3s ease;
        }
        .hamburger{
            display: none;
        }

        /*Stying for small screens*/
        @media screen and (max-width: 800px){
            nav{
                position: fixed;
                z-index: 3;
            }
            .hamburger{
                display:block;
                position: absolute;
                cursor: pointer;
                right: 5%;
                top: 50%;
                transform: translate(-5%, -50%);
                z-index: 2;
                transition: all 0.7s ease;
            }
            .nav-links{
                position: fixed;
                background: #131418;
                height: 100vh;
                width: 100%;
                flex-direction: column;
                clip-path: circle(50px at 90% -20%);
                -webkit-clip-path: circle(50px at 90% -10%);
                transition: all 1s ease-out;
                pointer-events: none;
            }
            .nav-links.open{
                clip-path: circle(1000px at 90% -10%);
                -webkit-clip-path: circle(1000px at 90% -10%);
                pointer-events: all;
            }
            .nav-links li{
                opacity: 0;
            }
            .nav-links li:nth-child(1){
                transition: all 0.5s ease 0.2s;
            }
            .nav-links li:nth-child(2){
                transition: all 0.5s ease 0.4s;
            }
            .nav-links li:nth-child(3){
                transition: all 0.5s ease 0.6s;
            }
            .nav-links li:nth-child(4){
                transition: all 0.5s ease 0.7s;
            }
            .nav-links li:nth-child(5){
                transition: all 0.5s ease 0.8s;
            }
            .nav-links li:nth-child(6){
                transition: all 0.5s ease 0.9s;
                margin: 0;
            }
            .nav-links li:nth-child(7){
                transition: all 0.5s ease 1s;
                margin: 0;
            }
            li.fade{
                opacity: 1;
            }
        }
        /*Animating Hamburger Icon on Click*/
        .toggle .line1{
            transform: rotate(-45deg) translate(-5px,6px);
        }
        .toggle .line2{
            transition: all 0.7s ease;
            width:0;
        }
        .toggle .line3{
            transform: rotate(45deg) translate(-5px,-6px);
        }

        .progress {
            background: #EDEEF0;
            justify-content: flex-start;
            border-radius: 100px;
            align-items: center;
            position: relative;
            display: flex;
            height: 6px;
            width: 100px;
            margin:0 10px;
        }

        .progress-value {
        animation: load 3s normal forwards;
        border-radius: 100px;
        background: #EE2E64;
        height: 6px;
        width: 0;
        }
        @keyframes load {
        0% { width: 0; }
        100% { width: 68%; }
        }
        li:hover .mydropdown {
        visibility: visible;
        opacity: 1;
        transform: translateY(0px);
        }

        .mydropdown {
        visibility: hidden;
        opacity: 0;
        position: absolute;
        padding: 10px 0;
        top: 100%;
        transform: translateY(50px);
        left: 0;
        width:200px;
        background-color: #fff;
        box-shadow: 0px 10px 10px 3px rgba(0, 0, 0, 0.3);
        border-bottom-left-radius: 3px;
        border-bottom-right-radius: 3px;
        z-index: 111;
        transition: 0.4s all;
        }
        .mydropdown a {
        padding-top: 10px;
        padding-bottom: 10px;
        font-weight: 400;
        display:block;
        }
        .mydropdown a::before{
            display:none !important;
        }
        .dd-button:after {
        content: '';
        position: absolute;
        top: 50%;
        right: -5px;
        transform: translateY(-50%);
        width: 0; 
        height: 0; 
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid #ADADAF;
        }
        .plans.ds-button{
            display: flex;
            align-items: center;
            position: relative;
            padding: 0 12px;
            cursor: pointer;
        }
        .plans.ds-button:hover{
            background-color:#F1F2F4;
            border-radius:5px;
        }
        .plans.ds-button p{
            margin-bottom:0;
            margin-right:5px;
            color:#6D7175;
            font-family: 'Poppins', sans-serif;
                    line-height: 2rem;
                    font-weight: 400;
                    font-size: 16px;
                    text-transform: capitalize !important;
        }
        .plans.ds-button p span{
            color:black;
        }
        .ds-button:after {
        content: '';
        position: absolute;
        top: 50%;
        right: 5px;
        transform: translateY(-50%);
        width: 0; 
        height: 0; 
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid #000;
        }
        /* .plans.ds-button:hover .plans_box{
        display:flex;
        } */
        .hMenuStatPop {
            width: 360px;
            height: auto;
            margin-top: -260px;
            position: relative;
            top: 255px;
            background-color: #fff;
            box-shadow: 0 0 0 1px rgb(63 63 68 / 5%), 0 1px 3px 0 rgb(63 63 68 / 15%);
            border-radius: 8px;
            z-index: 11111;
        
        }
        .hMenuStatPopIn {
            display: flex;
            flex-direction: column;
            margin: 10px 0;
            width: 90%;
            position: relative;
            left: 5%;
        }
        .hMenuStatBlk {
            display: flex;
            flex-direction: column;
            margin-top: 10px;
        }
        .hMenuStatBlk div {
            width: 100%;
            text-align: left;
            font-size: 14px;
            color: #202223;
            margin-bottom: 10px;
        }
        .hMenuStatBlk div.hMenuStatBlkBar {
            display: flex;
            justify-content: flex-start;
            height: 11px;
            border-radius: 8px;
            background-color: #EDEEEF;
        }
        .hMenuStatBlk div.hMenuStatBlkDesc {
            font-size: 12px;
            color: #6D7175;
            text-align: right;
            margin-bottom:10px;
        }
        .hMenuStatBlk div.hMenuStatBlkBar span {
            width: 50%;
            height: 100%;
            border-radius: 8px;
            background-color: #92E6B5;
        }
        .plans_box{
            /* z-index: 9; */
            position: absolute;
            top: 100%;
            right: 0px;
            display:none;
        }
        .hMenuStatBlk div {
            width: 100%;
            text-align: left;
            font-size: 14px;
            color: #202223;
            margin-bottom: 10px;
        }
        .hMenuStatBlkBtn button {
            float: right;
            margin-left: 8px;
            margin-right: 0;
        }
        .plans_box button{
            padding:8px 12px;
            border:none;
            color:white;
            background:#EE2E64;
            border-radius:5px;
        }
        .containers {
  width: 90%;
  margin: 20px auto;
}

        .card_shadow {
  box-shadow: 0px 7px 17px #e5e2ff80;
}
.box_wrapper {
  padding: 20px 30px;
  overflow: hidden;
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
  background-color:white;
  border-radius:8px;
  margin-bottom:25px;
}
.txt_container {
  margin-top: 5px;
}
.box_input_wrapper:last-child {
  margin-bottom: 0;
}
.txt_container::after {
  content: "";
  width: 137%;
  border-bottom: 1px solid #f3f0f0;
  display: block;
  margin-left: -48px;
}
.api_wrapper .heading {
  font-size: 22px;
  font-weight: 600;
  font-family: 'Inter', sans-serif;
  color:#46474b;

}
.sub_heading p {
  font-size: 12px;
  font-weight: 100;
  font-family: 'Inter', sans-serif;
  color: #868788;
  margin: 10px 0px;
}
.box_content {
  margin-top: 23px;
}
.box_content label {
  font-size: 16px;
  font-weight: 600;
  font-family: 'Inter', sans-serif;
  color: #202127;
}
.input_wrapper input {
  width: 100%;
  border: none;
  height: 35px;
  background-color: #fff;
  border-radius: 5px;
  color: #7b7b80;
  font-size: 11px;
  padding: 0px 9px;
  border: 1px solid #b9b9b9;
}
.box_input_wrapper {
  margin-bottom: 11px;
}
.api_wrapper small {
  margin-top: 8px;
  font-size:11px;
}
.myform-content{
  height: 80vh;
  overflow-y: scroll;
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
.myform-content::-webkit-scrollbar {
  display: none;
}
.save-btn button {
    background-color: #EE2E64;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    color: #fff;
    width: 200px;
    text-align: center;
    line-height: 35px;
}
.save-btn {
    text-align: center;
    margin-top: 15px;
}
body{
    background-color:#f0f2f9;
  }
</style>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

    nav {

        background-color: #fff;
        width: 100%;
        z-index: 10;
        -webkit-box-shadow: 0px 0px 4px 1px rgba(219, 219, 219, 1);
        -moz-box-shadow: 0px 0px 4px 1px rgba(219, 219, 219, 1);
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    }

    nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        box-sizing: border-box;
    }

    /*Styling logo*/
    .logo {
        padding: 1vh 1vw;
        text-align: center;
    }

    .logo img {
        height: auto;
        width: 50px;
    }

    /*Styling Links*/
    .nav-links {
        display: flex;
        list-style: none;
        gap: 10px;
        padding: 0 0.7vw;
        justify-content: space-evenly;
        align-items: center;
        text-transform: uppercase;
        margin-bottom: 0;
        margin-top:0px;
    }

    .nav-links li a {
        text-decoration: none;
        margin: 0 0.7vw;
        color: #6D7175;
        font-family: 'Poppins', sans-serif;
        padding: 0 12px;
        line-height: 2rem;
        font-weight: 400;
        font-size: 18px;
        text-transform: capitalize !important;
    }

    .nav-links li a:hover {
        color: #EE2E64;
    }

    .active_nav {
        color: #EE2E64 !important;
    }

    .active_nav::before {
        content: "";
        display: block;
        height: 3px;
        width: 80% !important;
        background-color: #EE2E64;
        position: absolute;
        transition: all ease-in-out 250ms;
        margin: 0 0 0 10%;
        bottom: -3px;
    }

    .nav-links li {
        position: relative;
    }

    .nav-links li a::before {
        content: "";
        display: block;
        height: 3px;
        width: 0%;
        background-color: #EE2E64;
        position: absolute;
        transition: all ease-in-out 250ms;
        margin: 0 0 0 10%;
        bottom: -3px;
    }

    .nav-links li a:hover::before {
        width: 80%;
    }

    /*Styling Buttons*/
    .login-button {
        background-color: transparent;
        border: 1.5px solid #f2f5f7;
        border-radius: 2em;
        padding: 0.6rem 0.8rem;
        margin-left: 2vw;
        font-size: 1rem;
        cursor: pointer;

    }

    .login-button:hover {
        color: #131418;
        background-color: #f2f5f7;
        border: 1.5px solid #f2f5f7;
        transition: all ease-in-out 350ms;
    }

    .join-button {
        color: #131418;
        background-color: #61DAFB;
        border: 1.5px solid #61DAFB;
        border-radius: 2em;
        padding: 0.6rem 0.8rem;
        font-size: 1rem;
        cursor: pointer;
    }

    .join-button:hover {
        color: #f2f5f7;
        background-color: transparent;
        border: 1.5px solid #f2f5f7;
        transition: all ease-in-out 350ms;
    }

    /*Styling Hamburger Icon*/
    .hamburger div {
        width: 30px;
        height: 3px;
        background: #f2f5f7;
        margin: 5px;
        transition: all 0.3s ease;
    }

    .hamburger {
        display: none;
    }

    /*Stying for small screens*/
    @media screen and (max-width: 800px) {
        nav {
            position: fixed;
            z-index: 3;
        }

        .hamburger {
            display: block;
            position: absolute;
            cursor: pointer;
            right: 5%;
            top: 50%;
            transform: translate(-5%, -50%);
            z-index: 2;
            transition: all 0.7s ease;
        }

        .nav-links {
            position: fixed;
            background: #131418;
            height: 100vh;
            width: 100%;
            flex-direction: column;
            clip-path: circle(50px at 90% -20%);
            -webkit-clip-path: circle(50px at 90% -10%);
            transition: all 1s ease-out;
            pointer-events: none;
        }

        .nav-links.open {
            clip-path: circle(1000px at 90% -10%);
            -webkit-clip-path: circle(1000px at 90% -10%);
            pointer-events: all;
        }

        .nav-links li {
            opacity: 0;
        }

        .nav-links li:nth-child(1) {
            transition: all 0.5s ease 0.2s;
        }

        .nav-links li:nth-child(2) {
            transition: all 0.5s ease 0.4s;
        }

        .nav-links li:nth-child(3) {
            transition: all 0.5s ease 0.6s;
        }

        .nav-links li:nth-child(4) {
            transition: all 0.5s ease 0.7s;
        }

        .nav-links li:nth-child(5) {
            transition: all 0.5s ease 0.8s;
        }

        .nav-links li:nth-child(6) {
            transition: all 0.5s ease 0.9s;
            margin: 0;
        }

        .nav-links li:nth-child(7) {
            transition: all 0.5s ease 1s;
            margin: 0;
        }

        li.fade {
            opacity: 1;
        }
    }

    /*Animating Hamburger Icon on Click*/
    .toggle .line1 {
        transform: rotate(-45deg) translate(-5px, 6px);
    }

    .toggle .line2 {
        transition: all 0.7s ease;
        width: 0;
    }

    .toggle .line3 {
        transform: rotate(45deg) translate(-5px, -6px);
    }

    .progress {
        background: #EDEEF0;
        justify-content: flex-start;
        border-radius: 100px;
        align-items: center;
        position: relative;
        display: flex;
        height: 6px;
        width: 100px;
        margin: 0 10px;
    }

    .progress-value {
        border-radius: 100px;
        background: rgb(146, 230, 181);
        height: 6px;
        width: 0;
    }


    li:hover .mydropdown {
        visibility: visible;
        opacity: 1;
        transform: translateY(0px);
    }

    .mydropdown {
        visibility: hidden;
        opacity: 0;
        position: absolute;
        padding: 10px 0;
        top: 100%;
        transform: translateY(50px);
        left: 0;
        width: 200px;
        background-color: #fff;
        box-shadow: 0px 10px 10px 3px rgba(0, 0, 0, 0.3);
        border-bottom-left-radius: 3px;
        border-bottom-right-radius: 3px;
        z-index: 111;
        transition: 0.4s all;
    }

    .mydropdown a {
        padding-top: 10px;
        padding-bottom: 10px;
        font-weight: 400;
        display: block;
    }

    .mydropdown a::before {
        display: none !important;
    }

    .dd-button:after {
        content: '';
        position: absolute;
        top: 50%;
        right: -5px;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid #ADADAF;
    }

    .plans.ds-button {
        display: flex;
        align-items: center;
        position: relative;
        padding: 0 12px;
        cursor: pointer;
    }

    .plans.ds-button:hover {
        background-color: #F1F2F4;
        border-radius: 5px;
    }

    .plans.ds-button p {
        margin-bottom: 0;
        margin-right: 5px;
        color: #6D7175;
        font-family: 'Poppins', sans-serif;
        line-height: 2rem;
        font-weight: 400;
        font-size: 16px;
        text-transform: capitalize !important;
        margin: 0;
    }

    .plans.ds-button p span {
        color: black;
    }

    .ds-button:after {
        content: '';
        position: absolute;
        top: 50%;
        right: 5px;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid #000;
    }

    /* .plans.ds-button:hover .plans_box{
        display:flex;
        } */
    .hMenuStatPop {

        width: 360px;
        height: auto;
        margin-top: -260px;
        position: relative;
        top: 255px;
        background-color: #fff;
        box-shadow: 0 0 0 1px rgb(63 63 68 / 5%), 0 1px 3px 0 rgb(63 63 68 / 15%);
        border-radius: 8px;

    }

    .hMenuStatPopIn {
        display: flex;
        flex-direction: column;
        margin: 10px 0;
        width: 90%;
        position: relative;
        left: 5%;
    }

    .hMenuStatBlk {
        display: flex;
        flex-direction: column;
        margin-top: 10px;
    }

    .hMenuStatBlk div {
        width: 100%;
        text-align: left;
        font-size: 14px;
        color: #202223;
        margin-bottom: 10px;
    }

    .hMenuStatBlk div.hMenuStatBlkBar {
        display: flex;
        justify-content: flex-start;
        height: 11px;
        border-radius: 8px;
        background-color: #EDEEEF;
    }

    .hMenuStatBlk div.hMenuStatBlkDesc {
        font-size: 12px;
        color: #6D7175;
        text-align: right;
        margin-bottom: 10px;
    }

    .hMenuStatBlk div.hMenuStatBlkBar span {
        width: 50%;
        height: 100%;
        border-radius: 8px;
        background-color: #EE2E64;
    }

    .plans_box {
        z-index: 9;
        position: absolute;
        top: 100%;
        right: 0px;
        display: none;
    }

    .hMenuStatBlk div {
        width: 100%;
        text-align: left;
        font-size: 14px;
        color: #202223;
        margin-bottom: 10px;
    }

    .hMenuStatBlkBtn button {
        float: right;
        margin-left: 8px;
        margin-right: 0;
    }

    .plans_box a {
        padding: 8px 12px;
        border: none;
        color: white;
        background: #EE2E64;
        float: right;
    }
    .plan_progress {
        background: #EDEEF0;
        justify-content: flex-start;
        border-radius: 100px;
        align-items: center;
        position: relative;
        display: flex;
        height: 6px;
        width: 100px;
        margin: 0 10px;
        padding: .5px 0;
        overflow: hidden;
    }
    #loginProgress{
        height: 5px;
        background-color: #EE2E64;
    }
    @media only screen and (max-width: 1350px) {
        .nav-links li a {
            text-decoration: none;

            color: #6D7175;
            font-family: 'Poppins', sans-serif;
            padding: 0 12px;
            line-height: 2rem;
            font-weight: 400;
            font-size: 13px;
            text-transform: capitalize !important;
        }
        .plans.ds-button p{
            font-size: 13px;
        }
        ul li {
            padding: 0;
        }
    }
  </style>
   
    <nav>
      
            <div class="logo">
                <img src="https://cdn.shopify.com/s/files/1/0597/6496/5550/files/CPOgyOTFpv4CEAE.png?v=1685010508" alt="Logo Image">
            </div>
            <div class="hamburger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="nav-links">
                <li><a href="#" onclick="redirectNavigation('');" class='dashboard_nav active_nav'>Dashboard</a></li>
                <li><a href="#" onclick="redirectNavigation('settings');" class="settings_nav">Settings</a></li>
                <li><a href="#" onclick="redirectNavigation('customers');" class="customer_nav">Customers</a></li>
                <li><a href="#" onclick="redirectNavigation('integrations');" class="integration_nav">Integrations</a></li>
                <li><a href="#" onclick="redirectNavigation('api-key-settings');" class="apikey_nav">API Key Setting</a></li>
                <li><a href="#" class='dd-button'>More</a> <div class="mydropdown">
                    <a href="#" onclick="redirectNavigation('plans');" class="plans_nav">Plans & Pricing</a> 
                    <a href="#" onclick="redirectNavigation('instruction');" class="instruction_nav">Instruction</a>
                    <a href="https://sketchapps.tawk.help/category/logingenie-social-login-app" target="_blank">Help</a>
            </div></li>
            
            </ul>
            <div class="plans ds-button">
                <p>Your Plan: <b>{{ $userPlan }}</b></p>
                <div class="progress">
                <div class="progress-value"></div>
                </div>
                <div class="plans_box">
                    <div class="hMenuStatPop" style="right: 68px;">
                        <div class="hMenuStatPopIn">
                        <div class="hMenuStatBlk">
                        <div class="hMenuStatBlkTit"><strong>Registration/Login </strong></div>
                        <div class="hMenuStatBlkBar"><span class="totalLoginProgress"></span></div>
                        <div class="hMenuStatBlkDesc"></div>
                        <div class="hMenuStatBlkBtn">
                            @if($userPlan == "free")
                                <a href="#" onclick="redirectNavigation('plans');" class="secondary plan-upgrade-btn">Upgrade plan</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
