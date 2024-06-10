<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Jost:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<style>
    /*
 Loading Overlay CSS
 */
#sketch_load_bottom,#sketch_load_top{width:53px;height:20px;transform:skew(-15deg,-10deg)}
    #sketch_load_global{width:70px;margin:50px auto auto;position:relative;cursor:pointer;height:60px}
    .sketch_load_mask{position:absolute;border-radius:2px;overflow:hidden;perspective:1000;backface-visibility:hidden}
    .sketch_load_plane{background:#da4366;width:400%;height:100%;position:absolute;transform:translate3d(0,0,0);z-index:100;perspective:1000;-webkit-backface-visibility:hidden;backface-visibility:hidden}
    #sketch_load_top .sketch_load_plane{z-index:2000;animation:1.3s ease-in infinite backwards trans1}
    #sketch_load_middle .sketch_load_plane{transform:translate3d(0,0,0);background:#f8e4ed;-webkit-animation:1.3s linear .3s infinite backwards trans2;animation:1.3s linear .3s infinite backwards trans2}
    #sketch_load_bottom .sketch_load_plane{z-index:2000;animation:1.3s ease-out .7s infinite backwards trans3}
    #sketch_load_top{left:20px;z-index:100}
    #sketch_load_middle{width:33px;height:20px;left:20px;top:18px;transform:skew(-15deg,40deg)}
    #sketch_load_bottom{top:36px}.sketch_load_text{color:#f49bb6;position:absolute;left:-3px;top:100%;font-family:Arial;text-align:center;font-size:10px}@keyframes trans1{from{transform:translate3d(53px,0,0)}to{transform:translate3d(-250px,0,0)}}
    @keyframes trans2{from{transform:translate3d(-160px,0,0)}to{transform:translate3d(53px,0,0)}}
    @keyframes trans3{from{transform:translate3d(53px,0,0)}to{transform:translate3d(-220px,0,0)}}
    @keyframes animColor{from{background:red}25%{background:#ff0}50%{background:green}75%{background:brown}to{background:#00f}}
 </style>