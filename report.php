<?php
include('includes/application.php');
//echo $_GET["proid"];
$strProperty=dbQuery("SELECT  * FROM property where property_id='".base64_decode($_GET["proid"])."'");
$num=dbNumRows($strProperty);
if($num>0){
    $resultProperty=dbFetchArray($strProperty);
// print_r($resultProperty);
}else{
    redirect(hrefLink("show-property.php","source=".$_GET["source"]));
}

$images=dbQuery("select * from  property_images where property_file_type='image' and property_id='".$resultProperty["property_id"]."'");
$count=dbNumRows($images);
$imagesInfo=dbFetchArray($images);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><style type="text/css">.gm-style .gm-style-mtc label,.gm-style .gm-style-mtc div{font-weight:400}</style><style type="text/css">.gm-style .gm-style-cc span,.gm-style .gm-style-cc a,.gm-style .gm-style-mtc div{font-size:10px}</style><link href="css/css.css" rel="stylesheet" type="text/css"><style type="text/css">@media print {  .gm-style .gmnoprint, .gmnoprint {    display:none  }}@media screen {  .gm-style .gmnoscreen, .gmnoscreen {    display:none  }}</style><style type="text/css">.gm-style{font-family:Roboto,Arial,sans-serif;font-size:11px;font-weight:400;text-decoration:none}</style>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="description" content="">
<meta name="keywords" content=""><title>Property Details</title>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<link href="css/css_002.css" rel="stylesheet" type="text/css">
<link href="css/style_002.css" rel="stylesheet" type="text/css">
<link href="css/theme1.css" rel="stylesheet" type="text/css">
<link href="css/common1.css" rel="stylesheet" type="text/css">
<script src="index_files/analytics.js" async=""></script>
<script style="" src="index_files/sdk.js" id="facebook-jssdk"></script>
<script src="index_files/jquery_003.js" type="text/javascript"></script>
<script src="index_files/tabcontent.js" type="text/javascript"></script>
<!--<script src="http://www.dynamicdrive.com/dynamicindex17/tabcontent/tabcontent.js" type="text/javascript"></script>-->


<!--<link href="css/silder.css" rel="stylesheet" type="text/css" />-->

<script>
$(document).ready(function() { 
$('.bxslider').bxSlider({
  mode: 'fade',
  captions: true,auto: true,
  autoControls: true
});
});
document.cookie = 'flowertabs=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
</script>
<script type="text/javascript" src="index_files/gsrs"></script><style type="text/css"> #fi #fic {margin-right:100px !important}  #fi #rh {margin-left:-115px !important;width:95px !important}  #fi .rh {display:none !important}  body:not(.xE) div[role='main'] .Bu:not(:first-child) {display: none !important} </style><style type="text/css">.fb_hidden{position:absolute;top:-10000px;z-index:10001}.fb_invisible{display:none}.fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:"lucida grande", tahoma, verdana, arial, sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}.fb_reset>div{overflow:hidden}.fb_link img{border:none}
.fb_dialog{background:rgba(82, 82, 82, .7);position:absolute;top:-10000px;z-index:10001}.fb_reset .fb_dialog_legacy{overflow:visible}.fb_dialog_advanced{padding:10px;-moz-border-radius:8px;-webkit-border-radius:8px;border-radius:8px}.fb_dialog_content{background:#fff;color:#333}.fb_dialog_close_icon{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 0 transparent;_background-image:url(http://static.ak.fbcdn.net/rsrc.php/v2/yL/r/s816eWC-2sl.gif);cursor:pointer;display:block;height:15px;position:absolute;right:18px;top:17px;width:15px}.fb_dialog_mobile .fb_dialog_close_icon{top:5px;left:5px;right:auto}.fb_dialog_padding{background-color:transparent;position:absolute;width:1px;z-index:-1}.fb_dialog_close_icon:hover{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -15px transparent;_background-image:url(http://static.ak.fbcdn.net/rsrc.php/v2/yL/r/s816eWC-2sl.gif)}.fb_dialog_close_icon:active{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -30px transparent;_background-image:url(http://static.ak.fbcdn.net/rsrc.php/v2/yL/r/s816eWC-2sl.gif)}.fb_dialog_loader{background-color:#f2f2f2;border:1px solid #606060;font-size:24px;padding:20px}.fb_dialog_top_left,.fb_dialog_top_right,.fb_dialog_bottom_left,.fb_dialog_bottom_right{height:10px;width:10px;overflow:hidden;position:absolute}.fb_dialog_top_left{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ye/r/8YeTNIlTZjm.png) no-repeat 0 0;left:-10px;top:-10px}.fb_dialog_top_right{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ye/r/8YeTNIlTZjm.png) no-repeat 0 -10px;right:-10px;top:-10px}.fb_dialog_bottom_left{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ye/r/8YeTNIlTZjm.png) no-repeat 0 -20px;bottom:-10px;left:-10px}.fb_dialog_bottom_right{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ye/r/8YeTNIlTZjm.png) no-repeat 0 -30px;right:-10px;bottom:-10px}.fb_dialog_vert_left,.fb_dialog_vert_right,.fb_dialog_horiz_top,.fb_dialog_horiz_bottom{position:absolute;background:#525252;filter:alpha(opacity=70);opacity:.7}.fb_dialog_vert_left,.fb_dialog_vert_right{width:10px;height:100%}.fb_dialog_vert_left{margin-left:-10px}.fb_dialog_vert_right{right:0;margin-right:-10px}.fb_dialog_horiz_top,.fb_dialog_horiz_bottom{width:100%;height:10px}.fb_dialog_horiz_top{margin-top:-10px}.fb_dialog_horiz_bottom{bottom:0;margin-bottom:-10px}.fb_dialog_iframe{line-height:0}.fb_dialog_content .dialog_title{background:#6d84b4;border:1px solid #3b5998;color:#fff;font-size:14px;font-weight:bold;margin:0}.fb_dialog_content .dialog_title>span{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/yd/r/Cou7n-nqK52.gif) no-repeat 5px 50%;float:left;padding:5px 0 7px 26px}body.fb_hidden{-webkit-transform:none;height:100%;margin:0;overflow:visible;position:absolute;top:-10000px;left:0;width:100%}.fb_dialog.fb_dialog_mobile.loading{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ya/r/3rhSv5V8j3o.gif) white no-repeat 50% 50%;min-height:100%;min-width:100%;overflow:hidden;position:absolute;top:0;z-index:10001}.fb_dialog.fb_dialog_mobile.loading.centered{max-height:590px;min-height:590px;max-width:500px;min-width:500px}#fb-root #fb_dialog_ipad_overlay{background:rgba(0, 0, 0, .45);position:absolute;left:0;top:0;width:100%;min-height:100%;z-index:10000}#fb-root #fb_dialog_ipad_overlay.hidden{display:none}.fb_dialog.fb_dialog_mobile.loading iframe{visibility:hidden}.fb_dialog_content .dialog_header{-webkit-box-shadow:white 0 1px 1px -1px inset;background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#738ABA), to(#2C4987));border-bottom:1px solid;border-color:#1d4088;color:#fff;font:14px Helvetica, sans-serif;font-weight:bold;text-overflow:ellipsis;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0;vertical-align:middle;white-space:nowrap}.fb_dialog_content .dialog_header table{-webkit-font-smoothing:subpixel-antialiased;height:43px;width:100%}.fb_dialog_content .dialog_header td.header_left{font-size:12px;padding-left:5px;vertical-align:middle;width:60px}.fb_dialog_content .dialog_header td.header_right{font-size:12px;padding-right:5px;vertical-align:middle;width:60px}.fb_dialog_content .touchable_button{background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#4966A6), color-stop(.5, #355492), to(#2A4887));border:1px solid #29447e;-webkit-background-clip:padding-box;-webkit-border-radius:3px;-webkit-box-shadow:rgba(0, 0, 0, .117188) 0 1px 1px inset, rgba(255, 255, 255, .167969) 0 1px 0;display:inline-block;margin-top:3px;max-width:85px;line-height:18px;padding:4px 12px;position:relative}.fb_dialog_content .dialog_header .touchable_button input{border:none;background:none;color:#fff;font:12px Helvetica, sans-serif;font-weight:bold;margin:2px -12px;padding:2px 6px 3px 6px;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}.fb_dialog_content .dialog_header .header_center{color:#fff;font-size:16px;font-weight:bold;line-height:18px;text-align:center;vertical-align:middle}.fb_dialog_content .dialog_content{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/y9/r/jKEcVPZFk-2.gif) no-repeat 50% 50%;border:1px solid #555;border-bottom:0;border-top:0;height:150px}.fb_dialog_content .dialog_footer{background:#f2f2f2;border:1px solid #555;border-top-color:#ccc;height:40px}#fb_dialog_loader_close{float:left}.fb_dialog.fb_dialog_mobile .fb_dialog_close_button{text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}.fb_dialog.fb_dialog_mobile .fb_dialog_close_icon{visibility:hidden}
.fb_iframe_widget{display:inline-block;position:relative}.fb_iframe_widget span{display:inline-block;position:relative;text-align:justify}.fb_iframe_widget iframe{position:absolute}.fb_iframe_widget_lift{z-index:1}.fb_hide_iframes iframe{position:relative;left:-10000px}.fb_iframe_widget_loader{position:relative;display:inline-block}.fb_iframe_widget_fluid{display:inline}.fb_iframe_widget_fluid span{width:100%}.fb_iframe_widget_loader iframe{min-height:32px;z-index:2;zoom:1}.fb_iframe_widget_loader .FB_Loader{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/y9/r/jKEcVPZFk-2.gif) no-repeat;height:32px;width:32px;margin-left:-16px;position:absolute;left:50%;z-index:4}
.fb_connect_bar_container div,.fb_connect_bar_container span,.fb_connect_bar_container a,.fb_connect_bar_container img,.fb_connect_bar_container strong{background:none;border-spacing:0;border:0;direction:ltr;font-style:normal;font-variant:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal;vertical-align:baseline}.fb_connect_bar_container{position:fixed;left:0 !important;right:0 !important;height:42px !important;padding:0 25px !important;margin:0 !important;vertical-align:middle !important;border-bottom:1px solid #333 !important;background:#3b5998 !important;z-index:99999999 !important;overflow:hidden !important}.fb_connect_bar_container_ie6{position:absolute;top:expression(document.compatMode=="CSS1Compat"? document.documentElement.scrollTop+"px":body.scrollTop+"px")}.fb_connect_bar{position:relative;margin:auto;height:100%;width:100%;padding:6px 0 0 0 !important;background:none;color:#fff !important;font-family:"lucida grande", tahoma, verdana, arial, sans-serif !important;font-size:13px !important;font-style:normal !important;font-variant:normal !important;font-weight:normal !important;letter-spacing:normal !important;line-height:1 !important;text-decoration:none !important;text-indent:0 !important;text-shadow:none !important;text-transform:none !important;white-space:normal !important;word-spacing:normal !important}.fb_connect_bar a:hover{color:#fff}.fb_connect_bar .fb_profile img{height:30px;width:30px;vertical-align:middle;margin:0 6px 5px 0}.fb_connect_bar div a,.fb_connect_bar span,.fb_connect_bar span a{color:#bac6da;font-size:11px;text-decoration:none}.fb_connect_bar .fb_buttons{float:right;margin-top:7px}
.fbpluginrecommendationsbarleft,.fbpluginrecommendationsbarright{position:fixed !important;bottom:0;z-index:999}.fbpluginrecommendationsbarleft{left:10px}.fbpluginrecommendationsbarright{right:10px}</style><script src="index_files/commonutilinfowindow.js" charset="UTF-8" type="text/javascript"></script><script src="index_files/blm.js"></script><script src="index_files/site-classification.js"></script><script src="index_files/lang.js"></script><script src="index_files/wl.js"></script><script src="index_files/site-classification.js"></script><script src="index_files/fo.js"></script><style>.foicli {                    position:relative;                    z-index:1;                    overflow:hidden;                    list-style:none;                    padding:0;                    margin:0 0 0.25em;                }                .foicli span:link,                    .foicli span:visited {                    display:block;                    border:0;                    padding-left:28px;                    color:#aaa;                }                .foicli span:hover,                    .foicli span:focus,                    .foicli span:active {                    color:#730800;                    background:transparent;                }                .foicli:before,                    .foicli:after,                    .foicli span:before,                    .foicli span:after {                    content:'';                    position:absolute;                    top:50%;                    left:0;                }                .foicli span:before,                    .foicli span:after {                    margin:-8px 0 0;                    background:#aaa;                }                .foicli span:hover:before,                    .foicli span:focus:before,                    .foicli span:active:before {                    background:#730800;                }                .tools{                    height:20px;                    cursor: pointer;                }                .tools:after {                    left:13px;                    width:3px;                    height:5px;                    margin-top:-8px;                    background:#fff;                    /* css3 */                    -webkit-transform:rotate(45deg);                    -moz-transform:rotate(45deg);                    -ms-transform:rotate(45deg);                    -o-transform:rotate(45deg);                    transform:rotate(45deg);                }                .tools span:before {                    left:6px;                    width:4px;                    height:15px;                    margin-top:-7px;                    background:#aaa;                    /* css3 */                    -webkit-transform:rotate(45deg);                    -moz-transform:rotate(45deg);                    -ms-transform:rotate(45deg);                    -o-transform:rotate(45deg);                    transform:rotate(45deg);                }                .tools span:after {                    left:8px;                    width:9px;                    height:9px;                    background:#aaa;                    -webkit-border-radius:8px;                    -moz-border-radius:8px;                    border-radius:8px;                }                .tools span:hover:after,.tools span:focus:after,.tools span:active:after{                    background:#730800;                }                .power{                    height:16px;                    cursor: pointer;                }                .power span:before {                    left:1px;                    width:10px;                    height:10px;                    border:2px solid #aaa;                    margin-top:-6px;                    background:transparent;                    /* css3 */                    -webkit-border-radius:16px;                    -moz-border-radius:16px;                    border-radius:16px;                }                .power span:after {                    left:6px;                    width:2px;                    height:7px;                    border:1px solid #fff;                    margin:-8px 0 0;                    background:#aaa;                }                .power span:hover:before,                .power span:focus:before,                .power span:active:before {                    border-color:#730800;                    background:transparent;                }                .power span:hover:after,                .power span:focus:after,                .power span:active:after {                    background:#730800;                }</style><link rel="stylesheet" href="css/font-awesome.css"><style>.fostpcontainer {                    box-sizing: content-box;                    display: none;                    min-width: 165px;                    min-height: 100px;                    width: auto;                    height: auto;                    text-align: center;                    padding: .5em;                    white-space: nowrap;                    position: relative;                    background: dimgrey;                    -moz-border-radius:3px;                    -webkit-border-radius:3px;                    border-radius:3px;                    color: #fff;                    font-size: 14px;                    opacity: 0.95;                    line-height: 18px;                    z-index:6458093;                    top: -10.75em;                    left: -3.5em;                }                .fostpul{                    color: #fff;                    text-decoration: none;                    margin: 0px;                    float: left;                    text-algin: left;                    padding: 0px;                }                .fostpul li {                    list-style: none;                }                .fostpinnerdiv{                    height: 20px;                    width:70px;                    font-size: 12px;                }                .fostpbtndiv{                    width: 52px;                    position: absolute;                    bottom: 10px;                    right: 10px;                }                .fostpbtnok{                    height: 20px;                    cursor: pointer;                    content: attr(title);                    float:left;                }                .fostpbtnclose{                    height: 20px;                    cursor: pointer;                    content: attr(title);                }                .fo-close-button{                    -moz-box-shadow:inset 0px 1px 0px 0px #F0C07E;                    -webkit-box-shadow:inset 0px 1px 0px 0px #F0C07E;                    box-shadow:inset 0px 1px 0px 0px #F0C07E;                    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #F67024), color-stop(1, #D03800) );                    background:-moz-linear-gradient( center top, #F67024 5%, #D03800 100% );                    //filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#F67024', endColorstr='#D03800');                    background-color:#F67024;                    -webkit-border-top-left-radius:3px;                    -moz-border-radius-topleft:3px;                    border-top-left-radius:3px;                    -webkit-border-top-right-radius:3px;                    -moz-border-radius-topright:3px;                    border-top-right-radius:3px;                    -webkit-border-bottom-right-radius:3px;                    -moz-border-radius-bottomright:3px;                    border-bottom-right-radius:3px;                    -webkit-border-bottom-left-radius:3px;                    -moz-border-radius-bottomleft:3px;                    border-bottom-left-radius:3px;                    text-indent:0;                    border:1px solid #D03800;                    display:inline-block;                    color:#ffffff;                    font-family:Arial;                    font-size:14px;                    font-weight:bold;                    font-style:normal;                    text-decoration:none;                    text-align:center;                    text-shadow:1px 1px 0px #D03800;                    padding: 0px 5px 2px 5px;                    position: relative;                    left: 0px;                }                .fo-close-button:hover{                    box-shadow: rgb(100, 153, 55) 0px 1px 0px 0px inset;                    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #D03800), color-stop(1, #F67024) );                    background:-moz-linear-gradient( center top, #D03800 5%, #F67024 100% );                    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#D03800', endColorstr='#F67024');                    background-color:#D03800;                }                .fo-v-button{                    -moz-box-shadow:inset 0px 1px 0px 0px #c1ed9c;                    -webkit-box-shadow:inset 0px 1px 0px 0px #c1ed9c;                    box-shadow:inset 0px 1px 0px 0px #c1ed9c;                    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #9dce2c), color-stop(1, #8cb82b) );                    background:-moz-linear-gradient( center top, #9dce2c 5%, #8cb82b 100% );                    //filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#9dce2c', endColorstr='#8cb82b');                    background-color:#9dce2c;                    -webkit-border-top-left-radius:3px;                    -moz-border-radius-topleft:3px;                    border-top-left-radius:3px;                    -webkit-border-top-right-radius:3px;                    -moz-border-radius-topright:3px;                    border-top-right-radius:3px;                    -webkit-border-bottom-right-radius:3px;                    -moz-border-radius-bottomright:3px;                    border-bottom-right-radius:3px;                    -webkit-border-bottom-left-radius:3px;                    -moz-border-radius-bottomleft:3px;                    border-bottom-left-radius:3px;                    text-indent:0;                    border:1px solid #8cb82b;                    display:inline-block;                    color:#ffffff;                    font-family:Arial;                    font-size:14px;                    font-weight:bold;                    font-style:normal;                    text-decoration:none;                    text-align:center;                    text-shadow:1px 1px 0px #8cb82b;                    padding: 0px 5px 2px 5px;                    position: relative;                    left: 0px;                }                .foforever{                    display: none;                }                .fo-v-button:hover{                    box-shadow: rgb(100, 153, 55) 0px 1px 0px 0px inset;                    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8cb82b), color-stop(1, #9dce2c) );                    background:-moz-linear-gradient( center top, #8cb82b 5%, #9dce2c 100% );                    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8cb82b', endColorstr='#9dce2c');                    background-color:#8cb82b;                }</style><style>.fos {                    line-height: initial!important;                    -webkit-transition: all 0.4s ease-in-out;                    -moz-transition: all 0.4s ease-in-out;                    -o-transition: all 0.4s ease-in-out;                    -ms-transition: all 0.4s ease-in-out;                    transition: all 0.4s ease-in-out;                    border-width: 1px 0px 1px 1px;                    border-color: rgb(170, 170, 170);                    border-style: solid;                    border-radius: 3px 0px 0px 3px;                    text-align: center;                    padding: 10px 5px 0px 0px;                    width: 270px;                    float: right;                    position: fixed;                    right: 0px;                    top: 13%;                    z-index: 325604;                    background-color: white;                    box-sizing: content-box;                    font-family:'Helvetica neue',Helvetica,Arial,serif,sans-serif;                }                .fol {                    font-weight: bold;                    font-size:23px;                    color: #0579A1;                    padding: 5px;                }                .foci{                   	-webkit-transform: scale(1,2);                    -moz-transform: scale(1,2);                    -ms-transform: scale(1,2);                    -o-transform: scale(1,2);                    text-align: center;                    line-height: 1em;                    color: #057ab0;                    font-size: 13px;                    text-shadow:0px 0px 0 rgb(2,119,173),1px 0px 0 rgb(-2,115,169), 2px 0px 0 rgb(-5,112,166),3px 0px 2px rgba(0,0,0,0.35),3px 0px 1px rgba(0,0,0,0.5),0px 0px 2px rgba(0,0,0,.2);                    margin-top: 17px;                    left: 0px;                }                .foa {                   	position: relative;                    display: inline-block;                    left: -26px;                    top: 0px;                    float: left;                    border-width: 1px 0px 1px 1px;                    border-style: solid;                    border-color: rgb(170, 170, 170);                    width: 25px;                    height: 50px;                    border-radius: 6px 0px 0px 6px;                    cursor: pointer;                    -webkit-transition: all 0.4s ease-in-out;                    -moz-transition: all 0.4s ease-in-out;                    -o-transition: all 0.4s ease-in-out;                    -ms-transition: all 0.4s ease-in-out;                    transition: all 0.4s ease-in-out;                    background-color: gainsboro;                    opacity: 0.75                }                .foa:fodus{                    outline: -webkit-focus-ring-color auto 0px;                }                .fod {                   	text-align: center;                    border: 1px solid #aaa;                    width: 260px;                    height: 121px;                    color: #5E696B;                    cursor : pointer;                    margin-bottom: 8px;                    background:#FFF;                }                .fod:hover{                    cursor : pointer;                    color: #076B08;                    -webkit-box-shadow: 0 5px 10px #777;                    -moz-box-shadow: 0 5px 10px #777;                    box-shadow: 0 5px 10px #777;                }                .fod:hover .foii{                    border-color: #076B08;                }                .fodp{                    font-size: 20px;                    font-weight: 700;                    width: 136px;                    float: right;                    color: #6C8A25;                    padding-top: 1px;                    text-align: center;                    padding-right: 3px;                }                .fod:hover .fodp{                    color: #076B08;                }                .fods:before , .fods:after{                    	z-index: -1;                        position: absolute;                        content: '';                        bottom: 15px;                        left: 10px;                        width: 50%;                        top: 80%;                        max-width:300px;                        background: #777;                        -webkit-box-shadow: 0 15px 10px #777;                        -moz-box-shadow: 0 15px 10px #777;                        box-shadow: 0 15px 10px #777;                        -webkit-transform: rotate(-3deg);                        -moz-transform: rotate(-3deg);                        -o-transform: rotate(-3deg);                        -ms-transform: rotate(-3deg);                        transform: rotate(-3deg);                }                .fods:after{                    -webkit-transform: rotate(3deg);                    -moz-transform: rotate(3deg);                    -o-transform: rotate(3deg);                    -ms-transform: rotate(3deg);                    transform: rotate(3deg);                    right: 10px;                    left: auto;                }                .fods{                    position: relative                }                .foc {                    box-shadow: none;                    right: -274px!important;                }                .fodi {                   	width: 120px;                    //height: 130px;                    float: left;                }                .fodii{                    border-width: 1px 1px 1px 1px;                    border-color: rgb(170, 170, 170);                    border-style: solid;                    border-radius: 5px 5px 5px 5px;                    width: 100px;                    height: 100px;                    background-repeat: no-repeat;                    background-size: 100px 100px;                    position: relative;                    top: 10px;                    left: 10px;                }                .fodm {                    width: 110px;                    height: 30px;                    margin-top: 3px;                    font-size: 15px;                    width: 110px;                    text-align: center;                    font-weight: bold;                    text-overflow: ellipsis;                    overflow: hidden;                    white-space: nowrap;                }                .fodmi{                    max-height: 28px;                }                .fodt {                    font-size: 13px;                    font-weight: normal;                    padding-right: 3px;                    width: 136px;                    height: 35px;                    float: right;                    overflow: hidden;                    text-align: center;                    margin-top: 15px;                }                .fodb:hover {                    /*background: -webkit-gradient(linear, 0% 100%, 0% 0%, color-stop(0.05, rgb(157, 206, 44)), to(rgb(108, 138, 37)));                    background: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(0.05, rgb(140, 184, 38)), to(rgb(148, 179, 76)));*/                    box-shadow: rgb(100, 153, 55) 0px 1px 0px 0px inset;                    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8cb82b), color-stop(1, #9dce2c) );                    background:-moz-linear-gradient( center top, #8cb82b 5%, #9dce2c 100% );                    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8cb82b', endColorstr='#9dce2c');                    background-color:#8cb82b;                }                .fodb {                    -moz-box-shadow:inset 0px 1px 0px 0px #c1ed9c;                    -webkit-box-shadow:inset 0px 1px 0px 0px #c1ed9c;                    box-shadow:inset 0px 1px 0px 0px #c1ed9c;                    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #9dce2c), color-stop(1, #8cb82b) );                    background:-moz-linear-gradient( center top, #9dce2c 5%, #8cb82b 100% );                    background-color:#9dce2c;                    -webkit-border-top-left-radius:4px;                    -moz-border-radius-topleft:4px;                    border-top-left-radius:4px;                    -webkit-border-top-right-radius:4px;                    -moz-border-radius-topright:4px;                    border-top-right-radius:4px;                    -webkit-border-bottom-right-radius:4px;                    -moz-border-radius-bottomright:4px;                    border-bottom-right-radius:4px;                    -webkit-border-bottom-left-radius:4px;                    -moz-border-radius-bottomleft:4px;                    border-bottom-left-radius:4px;                    text-indent:0;                    border:1px solid #83c41a;                    display:inline-block;                    color:#ffffff;                    font-size:14px;                    font-weight:bold;                    font-style:normal;                    text-decoration:none;                    text-align:center;                    text-shadow:1px 1px 0px #689324;                }                .fodc{                	width: 260px;                    height: auto;                    float: right;                    position:relative;                    top:-22px                }                .foleft{                    float: left;                    width: 120px;                }                .foright{                    float: right;                    width: 134px;                    text-align:left;                }                .fofooright{                    width: 160px;                    float: right;                }                .fos a:hover{                    color:#aaa;                    cursor: pointer;                }                .fofooleft{                    width: 90px;                    float: left;                }                .foby{                    font-size: 11px!important;                    color: #aaa!important;                    text-decoration: none!important;                    padding-top:5px;                    text-align: right;                }                .fodli{                    list-style: none;                    line-height: initial!important;                    background-image: none;                }                .fodul{                   	color: #000;                    text-decoration: none;                    margin: 0px;                   	float: right;                    list-style: none;                    width: auto;                    padding-top:5px;                }                .foclear{                	clear: both;                }                .foro{                    width:125px;                    height:148px;                    overflow:hidden;                    position:absolute;                    top: 0px;                    left: 0px;                }                .fori{                    font-size: 15px;                    background: rgb(255,175,75); /* Old browsers */                    background: -moz-linear-gradient(top, rgba(255,175,75,1) 0%, rgba(255,146,10,1) 100%); /* FF3.6+ */                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,175,75,1)), color-stop(100%,rgba(255,146,10,1))); /* Chrome,Safari4+ */                    background: -webkit-linear-gradient(top, rgba(255,175,75,1) 0%,rgba(255,146,10,1) 100%); /* Chrome10+,Safari5.1+ */                    background: -o-linear-gradient(top, rgba(255,175,75,1) 0%,rgba(255,146,10,1) 100%); /* Opera 11.10+ */                    background: -ms-linear-gradient(top, rgba(255,175,75,1) 0%,rgba(255,146,10,1) 100%); /* IE10+ */                    background: linear-gradient(to bottom, rgba(255,175,75,1) 0%,rgba(255,146,10,1) 100%); /* W3C */                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffaf4b', endColorstr='#ff920a',GradientType=0 ); /* IE6-9 */                    text-align:center;                    color:#FFFFFF;                    top:20px;                    left:-55px;                    width:170px;                    padding:2px;                    position:relative;                    -webkit-transform: rotate(-45deg);                    -moz-transform: rotate(-45deg);                    -o-transform: rotate(-45deg);                    -ms-transform: rotate(-45deg);                }                .fori:before, .fori:after{                    	content: '';                        border-top:   3px solid #CC7A29;                        border-left:  3px solid transparent;                        border-right: 3px solid transparent;                        position:absolute;                        bottom: 3px;                }                .fori:before {                    left: 0;                }                .fori:after {                    right: 0;                }                .fobtn-default {                    color:#807E7E!important;                    padding: 0px 0px 0px 3px!important;                    background-color: initial!important;                    font-size: 14px!important;                    opacity: 0.6!important;                    cursor: pointer!important;                    width: 20px!important;                }                .for{                    unicode-bidi: bidi-override;                    direction: ltr;                    color: gold;                    float: center;                    height: 15px;                    width:136px;                    font-size: 14px;                    text-align: center;                    padding: 0px;                }                .fosb{                    float: left;                    padding-top: 5px;					width:19px;                    font-size: 13px;                }                .fofoo{					text-align: center;                    width: 260px;                    height: 23px;                    margin-top: 3px;                    background:#FFF;				}                .foc .foa {                                    box-shadow: rgba(0, 0, 0, 0.0784314) -2px 2px 33px;                }                .fodbtn{         			float: left;					padding-top: 5px;					width: 19px                }</style><style media="screen" type="text/css">#easyInlineSwf {visibility:hidden}</style><style type="text/css"></style><script src="index_files/mixpanel-2.js" async="" type="text/javascript"></script><script src="index_files/stats.js" charset="UTF-8" type="text/javascript"></script><style type="text/css"></style><style type="text/css">#reviewsDisp , #reviewsDisp * { position:relative; color:inherit; font-family:Arial; font-weight:inherit; font-size:inherit; margin:0; padding:0; box-sizing:content-box; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; text-align:center; line-height:1; border:none; -webkit-border-radius:0; -moz-border-radius:0; border-radius:0; text-shadow:none;-moz-box-shadow: none; -webkit-box-shadow: none;box-shadow: none;overflow:hidden; }#reviewsDisp { display:block; position:relative; margin:9px; width:143px; height:70px; color:#BABABA; background:#FFF; border:1px solid #BABABA; -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; overflow:hidden; }#reviewsDisp.reviewRed { color:#C66; }#reviewsDisp.reviewYellow { color:#C90; }#reviewsDisp.reviewGreen { color:#6B9E0C; }#reviewsDisp .reviewContent { display:block; float:left; width:119px;  }#reviewsDisp .reviewTitle { height:23px; font-size:14px; color:#69C; font-weight:bold; background: #ffffff; background: -moz-linear-gradient(top,  #ffffff 0%, #eeeeee 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#eeeeee));background: -webkit-linear-gradient(top,  #ffffff 0%,#eeeeee 100%);  background: -o-linear-gradient(top,  #ffffff 0%,#eeeeee 100%);  background: -ms-linear-gradient(top,  #ffffff 0%,#eeeeee 100%);  background: linear-gradient(to bottom,  #ffffff 0%,#eeeeee 100%);  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#eeeeee',GradientType=0 );  }#reviewsDisp.trust.reviewRed .reviewTitle, #reviewsDisp.trust.reviewYellow .reviewTitle, #reviewsDisp.trust.reviewGreen .reviewTitle { color:inherit; }#reviewsDisp .reviewTitle > div { line-height:23px; }#reviewsDisp .reviewSection { height:28px; margin:5px 0 0; font-size:12px; font-weight:bold; }#reviewsDisp .reviewSection .percent.rated { font-size:26px }#reviewsDisp .reviewSection .percent span { font-size:18px; position:relative; top:-7px; }#reviewsDisp .reviewSection .reviewStars { color:#BABABA;font-size:12px;margin-left:4px; }#reviewsDisp .reviewSection .reviewStar { float:left; margin-top:3px; width:22px; height:22px; background:url(//hdapp1008-a.akamaihd.net/app/review_sprite.png) transparent; background }#reviewsDisp .reviewSection .reviewStar.reviewStarFull { background-position:-5px -88px }#reviewsDisp .reviewSection .reviewStar.reviewStarHalf { background-position:-27px -88px }#reviewsDisp .reviewSection .reviewStar.reviewStarNone { background-position:-49px -88px }#reviewsDisp .reviewFooter { font-size:10px; line-height:12px;color:#BABABA; }#reviewsDisp.trust .reviewFooter { color:inherit; margin:0 5px; overflow:hidden; }.trust .rate { display:none }.rate .trust { display:none }#reviewsDisp .reviewNav { width:24px; display:block; float:right; }#reviewsDisp .reviewNav .reviewBtn { display:block; height:23px; background:url(//hdapp1008-a.akamaihd.net/app/review_sprite.png) transparent; background-color:#E3E3E3; border-bottom:1px solid #FFF;cursor:pointer; }#reviewsDisp .reviewNav .reviewBtn:last-child { border-bottom:none; }#reviewsDisp .reviewNav .reviewBtn.hover { background-color:#D1D1D1; }#reviewsDisp .reviewNav .reviewBtn.reviewSelected { background-color:#BABABA; cursor:auto; }#reviewsDisp .reviewNav .reviewBtn.reviewCheck { background-position: -3px -6px }#reviewsDisp .reviewNav .reviewBtn.reviewSelected.reviewCheck { background-position: -33px -6px }#reviewsDisp .reviewNav .reviewBtn.reviewThumb { background-position: -3px -59px }#reviewsDisp .reviewNav .reviewBtn.reviewSelected.reviewThumb { background-position: -33px -59px }#reviewsDisp .reviewNav .reviewBtn.reviewInfo { background-position: -3px -32px }</style><script src="index_files/mapmarkergeometrystreetview.js" charset="UTF-8" type="text/javascript"></script><script src="index_files/onioncontrols.js" charset="UTF-8" type="text/javascript"></script><script id="FPCfg" type="text/javascript" src="index_files/pubjs.js"></script><link media="screen" href="css/style.css" rel="stylesheet" type="text/css"><script id="FACommonScript" type="text/javascript" src="index_files/facommon3.js"></script></head>

<body style="">
<!--Header Start-->
<div id="header">
<div class="main">
<div id="logo"><a href="http://homesguru.co.uk/index.php"><img src="images/homesguru.jpg" alt="" border="0"></a></div>

<div id="right">
<script type="text/javascript">
function showlogin()
{	jQuery.noConflict();
	jQuery('#login-box').toggle('slow');
}
function is_valid_email(email)
{
var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
return email.match(reg);
}

</script>

<div id="login-box" class="window">


 <form id="login" name="login" action="files/application_file.php?action=login" method="post" onsubmit="return submitForm()">
 <p>Enter Your Email</p>
<div class="input"><input required="" placeholder="Enter Your Email ID" name="user_name" id="user_name" type="email">
<input name="_method" id="_method" value="authentication process" type="hidden"></div>
<p>Enter Your Password</p>
<div class="input"><input required="" placeholder="********" name="login_password" id="login_password" value="" type="password"></div>
  
 <input name="login" class="go" value="Login" type="submit">
<strong><a href="http://homesguru.co.uk/forgot-password.php">Forgot password?</a></strong>

 </form>
</div>

<div class="rigster"><a href="http://homesguru.co.uk/register.php">Register</a></div>
<div class="login"><a id="loginimg" onclick="showlogin()" href="#">Sign in</a></div>
 
<div class="clear"></div>

<ul id="menu-drop">
<li><a href="#"><span>For Sale</span></a>
<ul>
<li><a href="http://homesguru.co.uk/property.php?shortby=sell">UK property for sale</a></li>
<li><a href="http://homesguru.co.uk/property.php?shortby=new">UK new homes for sale</a></li>
<li><a href="http://homesguru.co.uk/property-agent.php"> UK Letting Agents</a></li>

</ul>
</li>

<li><a href="#"><span>To Rent</span></a>
<ul>
<li><a href="http://homesguru.co.uk/property-for-rent.php">UK Property to Rent</a></li>
<li><a href="http://homesguru.co.uk/property-agent.php">UK Letting Agents</a></li>


</ul>
</li>

<li><a href="#"><span>Current Values</span></a>
<ul>
<li><a href="http://homesguru.co.uk/property-current-valuation.php">UK Property Values</a></li>

</ul>
</li>

<li><a href="#"><span>Sold Prices</span></a>
<ul>
<li><a href="http://homesguru.co.uk/property-sold-value.php">UK House Prices</a></li>

</ul>
</li>

<li><a href="#"><span>New Homes</span></a>
<ul>
<li><a href="http://homesguru.co.uk/property.php?shortby=new">UK new homes for sale</a></li>

<li><a href="http://homesguru.co.uk/newbuyhome.php">New Buy</a></li>
<li><a href="http://homesguru.co.uk/firstbuy.php">First buy </a></li>
</ul>
</li>

<li class="none"><a href="#"><span>Find Agents</span></a>
<ul>
<li><a href="http://homesguru.co.uk/property-agent.php">UK property for sale</a></li>
<li><a href="http://homesguru.co.uk/property.php?shortby=new">UK new homes for sale</a></li>
<li><a href="http://homesguru.co.uk/property-agent.php"> UK Letting Agents</a></li>
</ul>
</li>

</ul>

</div>

</div>
</div>
<!--Header End-->

<!--Middle Start-->
<div id="middle">


  <div id="left-panel">
  <div style="float:left; height: auto; width:auto;">
   <div class="inner_2"><h1>Report listing for <?php echo $resultProperty["property_bedrooms"];?> bedroom semi-detached house for sale at <?php echo $resultProperty["property_address"];?> </h1>
   	<p>These property details have been advertised by Leonard Leese Ltd. If you have identified any content which is inaccurate or of poor quality or if the property is no longer available, please let us know so that we may take this up with the advertiser</p><br />
   </div>
     <div class="inner">
     <form action="contactreportmail.php" method="post" enctype="multipart/form-data">
        <div class="inner_form">
        	<span>Contact name</span>
            <input type="text" name="txtname" value="" class="fromsection" />
        </div>
        <div class="inner_form">
        	<span>Email address</span>
            <input type="text" name="txtmail" value="" class="fromsection" />
        </div>
        <div class="inner_form">
        	<span>Relationship to property</span>
            <select class="fromsection">
            	<option>Select...</option>
                <option></option>
                <option></option>
            </select>
        </div>
        <div class="inner_form">
        	<span>Nature of report</span>
            <select class="fromsection">
            	<option>Select...</option>
                <option></option>
                <option></option>
            </select>
        </div>
        
        <div class="inner_form">
        	<span>Description of content issue</span>
            <textarea class="massage" name="txtcontent">Thank you for reporting the listing error for <?php echo $resultProperty["property_bedrooms"];?> bedroom semi-detached house for sale at <?php echo $resultProperty["property_address"];?>. We will investigate this matter further and take the appropriate action as soon as possible. </textarea>
            <div class=" clear"></div>
            <p style="float:left; color:#999;">Characters remaining: 500</p>
        </div>
        <!--<div class="inner_form">
        	<p> <input name="" type="checkbox" value="" />I confirm that the information above is accurate and I accept the Zoopla <div class="tell" style="float:none;"><a href="#">Terms of Use.</a></div></p>
        </div>-->
        <div class="inner_form">
        	<div class="sendemail"><input type="submit" name="submit" value="Report Error"></div>
        </div>
     </form>
     </div>
    
  </div>
                <div class="clear"></div>
    




	

<div id="tcontent2" class="silder-start" style="display:none;">
<div id="tab-details">
<p>Perform a local search on the map below:</p>
<ul>
<li><input name="details" id="rail" value="1" type="radio"> Transport</li>
<li><input name="details" id="school" value="1" type="radio"> Schools</li>
<li><input name="details" id="health" value="1" type="radio"> Healthcare</li>
<li><input name="details" id="food" value="1" type="radio"> Food shops</li>
<li><input name="details" id="restaurant" value="1" type="radio"> Restaurants, pubs and bars</li>
<li><input name="details" id="worship" value="1" type="radio"> Places of worship</li>

</ul>
<div class="clear"></div>
</div>

<div style="position: relative; background-color: rgb(229, 227, 223); overflow: hidden;" id="map"><div class="gm-style" style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; width: 100%; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default;"><div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; position: absolute; left: -255px; top: -208px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -255px; top: 48px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 1px; top: -208px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 1px; top: 48px;"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: -1;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -255px; top: -208px;"><canvas width="256" height="256" style="-moz-user-select: none; position: absolute; left: 0px; top: 0px; height: 256px; width: 256px;" draggable="false"></canvas></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -255px; top: 48px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 1px; top: -208px;"><canvas width="256" height="256" style="-moz-user-select: none; position: absolute; left: 0px; top: 0px; height: 256px; width: 256px;" draggable="false"></canvas></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 1px; top: 48px;"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div><div style="position: absolute; z-index: 0; left: 0px; top: 0px;"><div style="overflow: hidden;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; position: absolute; left: -255px; top: -208px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="index_files/vt_003.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -255px; top: 48px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="index_files/vt_004.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 1px; top: -208px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="index_files/vt_002.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 1px; top: 48px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="index_files/vt.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div></div></div></div><div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;"><a title="Click to see this area on Google Maps" href="http://maps.google.com/maps?ll=51.485441,-0.368061&amp;z=16&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3" target="_blank" style="position: static; overflow: visible; float: none; display: inline;"><div style="width: 62px; height: 26px; cursor: pointer;"><img draggable="false" src="index_files/google_white2.png" style="position: absolute; left: 0px; top: 0px; width: 62px; height: 26px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></a></div><div style="z-index: 1000001; position: absolute; right: 0px; bottom: 0px; width: 12px;" class="gmnoprint"><div class="gm-style-cc" style="-moz-user-select: none;" draggable="false"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer; display: none;">Map Data</a><span style="display: none;"></span></div></div></div><div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto,Arial,sans-serif; color: rgb(34, 34, 34); box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.2); z-index: 10000002; display: none; width: 0px; height: 0px; position: absolute; left: 5px; top: 5px;"><div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div><div style="font-size: 13px;"></div><div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img draggable="false" src="index_files/mapcnt3.png" style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div style="position: absolute; right: 0px; bottom: 0px;" class="gmnoscreen"><div style="font-family: Roboto,Arial,sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);"></div></div><div draggable="false" style="z-index: 1000001; position: absolute; -moz-user-select: none; right: 0px; bottom: 0px;" class="gmnoprint gm-style-cc"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a target="_blank" href="http://www.google.com/intl/en-US_US/help/terms_maps.html" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Terms of Use</a></div></div><div class="gm-style-cc" style="-moz-user-select: none; position: absolute; right: 0px; bottom: 0px;" draggable="false"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; display: none;"><a href="http://maps.google.com/maps?ll=51.485441,-0.368061&amp;z=16&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3&amp;skstate=action:mps_dialog$apiref:1&amp;output=classic" style="font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;" title="Report errors in the road map or imagery to Google" target="_new">Report a map error</a></div></div><div controlheight="84" controlwidth="32" draggable="false" style="margin: 5px; -moz-user-select: none; position: absolute; left: 0px; top: 0px;" class="gmnoprint"><div controlheight="40" controlwidth="32" style="cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; position: absolute; left: 0px; top: 0px;"><div style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px;"><img draggable="false" src="index_files/cb_scout2.png" style="position: absolute; left: -9px; top: -102px; width: 1028px; height: 214px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;"><img draggable="false" src="index_files/cb_scout2.png" style="position: absolute; left: -107px; top: -102px; width: 1028px; height: 214px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;"><img draggable="false" src="index_files/cb_scout2.png" style="position: absolute; left: -58px; top: -102px; width: 1028px; height: 214px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;"><img draggable="false" src="index_files/cb_scout2.png" style="position: absolute; left: -205px; top: -102px; width: 1028px; height: 214px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div controlheight="0" controlwidth="0" style="opacity: 0.6; display: none; position: absolute;" class="gmnoprint"><div title="Rotate map 90 degrees" style="width: 22px; height: 22px; overflow: hidden; position: absolute; cursor: pointer;"><img draggable="false" src="index_files/mapcnt3.png" style="position: absolute; left: -38px; top: -360px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div style="position: absolute; left: 6px; top: 45px;" controlheight="39" controlwidth="20" class="gmnoprint"><div style="width: 20px; height: 39px; overflow: hidden; position: absolute;"><img draggable="false" src="index_files/mapcnt3.png" style="position: absolute; left: -39px; top: -401px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div title="Zoom in" style="position: absolute; left: 0px; top: 2px; width: 20px; height: 17px; cursor: pointer;"></div><div title="Zoom out" style="position: absolute; left: 0px; top: 19px; width: 20px; height: 17px; cursor: pointer;"></div></div></div><div style="margin: 5px; z-index: 0; position: absolute; cursor: pointer; text-align: left; width: 85px; right: 0px; top: 0px;" class="gmnoprint gm-style-mtc"><div title="Change map style" draggable="false" style="direction: ltr; overflow: hidden; text-align: left; position: relative; color: rgb(0, 0, 0); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 1px 6px; border-radius: 2px; background-clip: padding-box; border: 1px solid rgba(0, 0, 0, 0.15); box-shadow: 0px 1px 4px -1px rgba(0, 0, 0, 0.3); font-weight: 500;">Map<img style="-moz-user-select: none; border: 0px none; padding: 0px; margin: -2px 0px 0px; position: absolute; right: 6px; top: 50%; width: 7px; height: 4px;" draggable="false" src="index_files/arrow-down.png"></div><div style="background-color: white; z-index: -1; padding-top: 2px; background-clip: padding-box; border-width: 0px 1px 1px; border-style: none solid solid; border-color: -moz-use-text-color rgba(0, 0, 0, 0.15) rgba(0, 0, 0, 0.15); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; box-shadow: 0px 1px 4px -1px rgba(0, 0, 0, 0.3); position: relative; text-align: left; display: none;"><div title="Show street map" draggable="false" style="color: black; font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px; font-weight: 500;">Map</div><div title="Show satellite imagery" draggable="false" style="color: black; font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px;">Satellite</div><div style="margin: 1px 0px; border-top: 1px solid rgb(235, 235, 235);"></div><div title="Zoom out to show street map with terrain" draggable="false" style="color: rgb(184, 184, 184); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap;"><span style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(241, 241, 241); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;" role="checkbox"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img draggable="false" src="index_files/imgs8.png" style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">Terrain</label></div><div style="margin: 1px 0px; border-top: 1px solid rgb(235, 235, 235); display: none;"></div><div title="Zoom in to show 45 degree view" draggable="false" style="color: rgb(184, 184, 184); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap; display: none;"><span style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(241, 241, 241); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;" role="checkbox"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img draggable="false" src="index_files/imgs8.png" style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">45°</label></div><div title="Show imagery with street names" draggable="false" style="color: rgb(0, 0, 0); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap; display: none;"><span style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;" role="checkbox"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden;"><img draggable="false" src="index_files/imgs8.png" style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">Labels</label></div></div></div></div></div>
<div class="client-details">
<img src="index_files/agent-logo.jpg" alt="">   <p>For more information about this property, please call
<strong>01373 316021</strong> (local rate) or email agent. </p>
<div class="clear"></div>
</div>
</div>

<div id="tcontent3" class="silder-start" style="display:none;">


<div style="position: relative; background-color: rgb(229, 227, 223); overflow: hidden;" id="smap"><div class="gm-style" style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; width: 100%; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default;"><div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; position: absolute; left: -255px; top: -208px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -255px; top: 48px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 1px; top: -208px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 1px; top: 48px;"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: -1;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -255px; top: -208px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -255px; top: 48px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 1px; top: -208px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 1px; top: 48px;"></div></div></div><div style="width: 49px; height: 52px; overflow: hidden; position: absolute; left: -27px; top: -43px; z-index: 1000000;"><img draggable="false" src="index_files/cb_scout2.png" style="position: absolute; left: -588px; top: 0px; width: 1028px; height: 214px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"><div title="" class="gmnoprint" style="width: 49px; height: 52px; overflow: hidden; position: absolute; opacity: 0.01; cursor: pointer; left: -27px; top: -43px; z-index: 1000000;"><img draggable="false" src="index_files/cb_scout2.png" style="position: absolute; left: -588px; top: 0px; width: 1028px; height: 214px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div><div style="position: absolute; z-index: 0; left: 0px; top: 0px;"><div style="overflow: hidden;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; position: absolute; left: -255px; top: -208px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="index_files/vt_003.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -255px; top: 48px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="index_files/vt_004.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 1px; top: -208px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="index_files/vt_002.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 1px; top: 48px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="index_files/vt.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div></div></div></div><div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;"><a title="Click to see this area on Google Maps" href="http://maps.google.com/maps?ll=51.485441,-0.368061&amp;z=16&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3" target="_blank" style="position: static; overflow: visible; float: none; display: inline;"><div style="width: 62px; height: 26px; cursor: pointer;"><img draggable="false" src="index_files/google_white2.png" style="position: absolute; left: 0px; top: 0px; width: 62px; height: 26px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></a></div><div style="z-index: 1000001; position: absolute; right: 0px; bottom: 0px; width: 12px;" class="gmnoprint"><div class="gm-style-cc" style="-moz-user-select: none;" draggable="false"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer; display: none;">Map Data</a><span style="display: none;"></span></div></div></div><div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto,Arial,sans-serif; color: rgb(34, 34, 34); box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.2); z-index: 10000002; display: none; width: 0px; height: 0px; position: absolute; left: 5px; top: 5px;"><div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div><div style="font-size: 13px;"></div><div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img draggable="false" src="index_files/mapcnt3.png" style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div style="position: absolute; right: 0px; bottom: 0px;" class="gmnoscreen"><div style="font-family: Roboto,Arial,sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);"></div></div><div draggable="false" style="z-index: 1000001; position: absolute; -moz-user-select: none; right: 0px; bottom: 0px;" class="gmnoprint gm-style-cc"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a target="_blank" href="http://www.google.com/intl/en-US_US/help/terms_maps.html" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Terms of Use</a></div></div><div class="gm-style-cc" style="-moz-user-select: none; position: absolute; right: 0px; bottom: 0px;" draggable="false"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; display: none;"><a href="http://maps.google.com/maps?ll=51.485441,-0.368061&amp;z=16&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3&amp;skstate=action:mps_dialog$apiref:1&amp;output=classic" style="font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;" title="Report errors in the road map or imagery to Google" target="_new">Report a map error</a></div></div><div controlheight="84" controlwidth="32" draggable="false" style="margin: 5px; -moz-user-select: none; position: absolute; left: 0px; top: 0px;" class="gmnoprint"><div controlheight="40" controlwidth="32" style="cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; position: absolute; left: 0px; top: 0px;"><div style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;"><img draggable="false" src="index_files/cb_scout2.png" style="position: absolute; left: -9px; top: -102px; width: 1028px; height: 214px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;"><img draggable="false" src="index_files/cb_scout2.png" style="position: absolute; left: -107px; top: -102px; width: 1028px; height: 214px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px;"><img draggable="false" src="index_files/cb_scout2.png" style="position: absolute; left: -58px; top: -102px; width: 1028px; height: 214px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;"><img draggable="false" src="index_files/cb_scout2.png" style="position: absolute; left: -205px; top: -102px; width: 1028px; height: 214px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div controlheight="0" controlwidth="0" style="opacity: 0.6; display: none; position: absolute;" class="gmnoprint"><div title="Rotate map 90 degrees" style="width: 22px; height: 22px; overflow: hidden; position: absolute; cursor: pointer;"><img draggable="false" src="index_files/mapcnt3.png" style="position: absolute; left: -38px; top: -360px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div style="position: absolute; left: 6px; top: 45px;" controlheight="39" controlwidth="20" class="gmnoprint"><div style="width: 20px; height: 39px; overflow: hidden; position: absolute;"><img draggable="false" src="index_files/mapcnt3.png" style="position: absolute; left: -39px; top: -401px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div title="Zoom in" style="position: absolute; left: 0px; top: 2px; width: 20px; height: 17px; cursor: pointer;"></div><div title="Zoom out" style="position: absolute; left: 0px; top: 19px; width: 20px; height: 17px; cursor: pointer;"></div></div></div><div style="margin: 5px; z-index: 0; position: absolute; cursor: pointer; text-align: left; width: 85px; right: 0px; top: 0px;" class="gmnoprint gm-style-mtc"><div title="Change map style" draggable="false" style="direction: ltr; overflow: hidden; text-align: left; position: relative; color: rgb(0, 0, 0); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 1px 6px; border-radius: 2px; background-clip: padding-box; border: 1px solid rgba(0, 0, 0, 0.15); box-shadow: 0px 1px 4px -1px rgba(0, 0, 0, 0.3); font-weight: 500;">Map<img style="-moz-user-select: none; border: 0px none; padding: 0px; margin: -2px 0px 0px; position: absolute; right: 6px; top: 50%; width: 7px; height: 4px;" draggable="false" src="index_files/arrow-down.png"></div><div style="background-color: white; z-index: -1; padding-top: 2px; background-clip: padding-box; border-width: 0px 1px 1px; border-style: none solid solid; border-color: -moz-use-text-color rgba(0, 0, 0, 0.15) rgba(0, 0, 0, 0.15); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; box-shadow: 0px 1px 4px -1px rgba(0, 0, 0, 0.3); position: relative; text-align: left; display: none;"><div title="Show street map" draggable="false" style="color: black; font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px; font-weight: 500;">Map</div><div title="Show satellite imagery" draggable="false" style="color: black; font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px;">Satellite</div><div style="margin: 1px 0px; border-top: 1px solid rgb(235, 235, 235);"></div><div title="Zoom out to show street map with terrain" draggable="false" style="color: rgb(184, 184, 184); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap;"><span style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(241, 241, 241); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;" role="checkbox"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img draggable="false" src="index_files/imgs8.png" style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">Terrain</label></div><div style="margin: 1px 0px; border-top: 1px solid rgb(235, 235, 235); display: none;"></div><div title="Zoom in to show 45 degree view" draggable="false" style="color: rgb(184, 184, 184); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap; display: none;"><span style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(241, 241, 241); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;" role="checkbox"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img draggable="false" src="index_files/imgs8.png" style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">45°</label></div><div title="Show imagery with street names" draggable="false" style="color: rgb(0, 0, 0); font-family: Roboto,Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap; display: none;"><span style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;" role="checkbox"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden;"><img draggable="false" src="index_files/imgs8.png" style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">Labels</label></div></div></div></div><div class="gm-style" style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 1;"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0; background-color: rgb(229, 227, 223);"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; width: 100%; height: 100%; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default;"><div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div><div class="gmnoprint" style="position: absolute; left: 0px; top: 0px; z-index: 2; width: 0px; height: 0px; font-family: Roboto,Arial,sans-serif;"><svg viewBox="0 0 0 0" height="0px" width="0px" overflow="hidden" version="1.1" style="position: absolute; left: 0px; top: 0px;"><ellipse visibility="hidden" fill-rule="evenodd" fill="white"></ellipse><path visibility="hidden" fill-rule="evenodd" fill="white"></path><path transform="translate(0 0) scale(1 0.31698729810778065) rotate(-201) " d="M 0 -100 L 40 -60 L 30 -50 L 0 -82 L -30 -50 L -40 -60" stroke="none" fill-opacity="0.5" fill-rule="evenodd" fill="black"></path><path transform="translate(0 -3) scale(1 0.31698729810778065) rotate(-201) " d="M 0 -100 L 40 -60 L 30 -50 L 0 -82 L -30 -50 L -40 -60" stroke="none" fill-opacity="1" fill-rule="evenodd" fill="white"></path><path transform="translate(0 -3) scale(1 0.31698729810778065) rotate(-201) " cursor="pointer" pano="HNdHcNQElbyRoYgfuo3LKw" d="M 0 -120 L 60 -60 L 40 -30 L -40 -30 L -60 -60 L 0 -120" stroke="none" fill-opacity="0" fill-rule="evenodd" fill="white"></path><text transform="translate(0 -89) rotate(-201) rotate(201 0 -140)" cursor="pointer" pano="HNdHcNQElbyRoYgfuo3LKw" text-anchor="middle" font-size="20px" y="-140" x="0" stroke="none" fill-rule="evenodd" fill="white">Wheatlands</text><path transform="translate(0 0) scale(1 0.31698729810778065) rotate(-1) " d="M 0 -100 L 40 -60 L 30 -50 L 0 -82 L -30 -50 L -40 -60" stroke="none" fill-opacity="0.5" fill-rule="evenodd" fill="black"></path><path transform="translate(0 -3) scale(1 0.31698729810778065) rotate(-1) " d="M 0 -100 L 40 -60 L 30 -50 L 0 -82 L -30 -50 L -40 -60" stroke="none" fill-opacity="1" fill-rule="evenodd" fill="white"></path><path transform="translate(0 -3) scale(1 0.31698729810778065) rotate(-1) " cursor="pointer" pano="lMFxPe9kNrwgSU_zLKRu4w" d="M 0 -120 L 60 -60 L 40 -30 L -40 -30 L -60 -60 L 0 -120" stroke="none" fill-opacity="0" fill-rule="evenodd" fill="white"></path><text transform="translate(0 96) rotate(-1) rotate(1 0 -140)" cursor="pointer" pano="lMFxPe9kNrwgSU_zLKRu4w" text-anchor="middle" font-size="20px" y="-140" x="0" stroke="none" fill-rule="evenodd" fill="white">Wheatlands</text></svg></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"></div></div></div></div><div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;"><a title="Click to see this area on Google Maps" href="http://maps.google.com/maps?z=17&amp;layer=c&amp;cbll=51.485578,-0.3681&amp;panoid=l87yDf2-qVLrp4prFUUjyg&amp;cbp=12,265,,-2,0&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3" target="_blank" style="position: static; overflow: visible; float: none; display: inline;"><div style="width: 62px; height: 26px; cursor: pointer;"><img draggable="false" src="index_files/google_white2.png" style="position: absolute; left: 0px; top: 0px; width: 62px; height: 26px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></a></div><div style="z-index: 1000001; position: absolute; right: 0px; bottom: 0px; width: 12px;" class="gmnoprint"><div class="gm-style-cc" style="-moz-user-select: none;" draggable="false"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer;">Map Data</a><span style="display: none;">© 2014 Google</span></div></div></div><div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto,Arial,sans-serif; color: rgb(34, 34, 34); box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.2); z-index: 10000002; display: none; width: 0px; height: 0px; position: absolute; left: 5px; top: 5px;"><div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div><div style="font-size: 13px;">© 2014 Google</div><div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img draggable="false" src="index_files/mapcnt3.png" style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div style="position: absolute; right: 0px; bottom: 0px;" class="gmnoscreen"><div style="font-family: Roboto,Arial,sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">© 2014 Google</div></div><div draggable="false" style="z-index: 1000001; position: absolute; -moz-user-select: none; right: 0px; bottom: 0px;" class="gmnoprint gm-style-cc"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a target="_blank" href="http://www.google.com/intl/en-US_US/help/terms_maps.html" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Terms of Use</a></div></div><div controlheight="124" controlwidth="78" draggable="false" style="margin: 5px; -moz-user-select: none; position: absolute; left: 0px; top: 0px;" class="gmnoprint"><div style="cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; width: 78px; height: 78px; position: absolute; left: 0px; top: 0px;" controlheight="80" controlwidth="78" class="gmnoprint"><div style="width: 78px; height: 78px; position: absolute; left: 0px; top: 0px;" controlheight="80" controlwidth="78" class="gmnoprint"><div style=""><svg viewBox="0 0 78 78" height="78px" width="78px" overflow="hidden" version="1.1" style="position: absolute; left: 0px; top: 0px;"><circle stroke="#f2f4f6" fill="#f2f4f6" fill-opacity="0.2" stroke-width="3" r="35" cy="39" cx="39"></circle><g transform="rotate(-265 39 39)"><rect fill="#f2f4f6" stroke-width="1" stroke="#a6a6a6" height="11" width="12" ry="4" rx="4" y="0" x="33"></rect><polyline stroke="#000" fill="#f2f4f6" stroke-width="1.5" stroke-linejoin="bevel" points="36.5,8.5 36.5,2.5 41.5,8.5 41.5,2.5"></polyline></g></svg></div></div><div style="position: absolute; left: 10px; top: 11px;" controlheight="59" controlwidth="59" class="gmnoprint"><div style="width: 59px; height: 59px; overflow: hidden; position: relative;"><img draggable="false" src="index_files/mapcnt3.png" style="position: absolute; left: 0px; top: 0px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"><div title="Pan left" style="position: absolute; left: 0px; top: 20px; width: 19.6667px; height: 19.6667px; cursor: pointer;"></div><div title="Pan right" style="position: absolute; left: 39px; top: 20px; width: 19.6667px; height: 19.6667px; cursor: pointer;"></div><div title="Pan up" style="position: absolute; left: 20px; top: 0px; width: 19.6667px; height: 19.6667px; cursor: pointer;"></div><div title="Pan down" style="position: absolute; left: 20px; top: 39px; width: 19.6667px; height: 19.6667px; cursor: pointer;"></div></div></div></div><div style="position: absolute; left: 29px; top: 85px;" controlheight="39" controlwidth="20" class="gmnoprint"><div style="width: 20px; height: 39px; overflow: hidden; position: absolute;"><img draggable="false" src="index_files/mapcnt3.png" style="position: absolute; left: -39px; top: -401px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div title="Zoom in" style="position: absolute; left: 0px; top: 2px; width: 20px; height: 17px; cursor: pointer;"></div><div title="Zoom out" style="position: absolute; left: 0px; top: 19px; width: 20px; height: 17px; cursor: pointer;"></div></div><div controlwidth="18px" style="-moz-user-select: none; font-family: Roboto,Arial,sans-serif; font-size: 11px; width: 18px; text-align: center; cursor: pointer; display: none; position: absolute;" draggable="false"></div></div><div style="z-index: 1; margin: 10px; position: absolute; left: 88px; top: 0px;"><div style="padding: 5px; background-color: rgba(255, 255, 255, 0.75); font-family: Roboto,Arial,sans-serif; font-size: 11px; color: rgb(34, 34, 34);">110 Wheatlands, Hounslow, England<div style="font-size: 10px; color: rgb(102, 102, 102);">Address is approximate</div></div></div><div style="z-index: 1; margin: 3px; position: absolute; right: 0px; top: 0px;" class="gmnoprint"><div style="position: absolute; left: 0px; top: 0px; z-index: 2;" title="Exit Street View"><div style="width: 16px; height: 16px; overflow: hidden; position: absolute; left: 0px; top: 0px;"><img draggable="false" src="index_files/cb_scout2.png" style="position: absolute; left: -490px; top: -102px; width: 1028px; height: 214px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 16px; height: 16px; overflow: hidden; position: absolute; left: 0px; top: 0px; display: none;"><img draggable="false" src="index_files/cb_scout2.png" style="position: absolute; left: -539px; top: -102px; width: 1028px; height: 214px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div style="z-index: 1; font-size: 1px; background-color: rgb(187, 187, 187); width: 16px; height: 16px;"></div></div><div draggable="false" style="color: white; font-family: Roboto,Arial,sans-serif; background-color: black; padding: 4px; border: 2px solid white; -moz-user-select: none; display: none; position: absolute; left: 0px; top: 0px;">This image is no longer available</div><div class="gm-style-cc" style="-moz-user-select: none; position: absolute; right: 0px; bottom: 0px;" draggable="false"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto,Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a href="https://cbks0.googleapis.com/cbk?output=report&amp;cb_client=apiv3&amp;v=4&amp;panoid=l87yDf2-qVLrp4prFUUjyg&amp;cbp=1,265,,0,0&amp;hl=en-US" title="Report problems with Street View imagery to Google" target="_new" style="text-decoration: none; color: rgb(68, 68, 68);">Report a problem</a></div></div></div></div>
<div class="client-details">
<img src="index_files/agent-logo.jpg" alt="">   <p>For more information about this property, please call
<strong>01373 316021</strong> (local rate) or email agent. </p>
<div class="clear"></div>
</div>

</div>

<div id="tcontent4" class="area-stats" style="display:none;">

</div>

<div id="tcontent5" style="display:;">



</div>

<script type="text/javascript">

var myflowers=new ddtabcontent("flowertabs")
myflowers.setpersist(true)
myflowers.setselectedClassTarget("link") //"link" or "linkparent"
myflowers.init()
</script>
  </div>
    

  <div class="clear"></div>
</div><!--Middle End-->

<!--Fotter Start-->
<div id="fotter">
<div class="main">
<div class="around">
<h3>Around the site</h3>
<p></p><p>
	Search for UK Letting Agents Search for property for sale House prices 
near you Search for property to rent Get removal quotes. Search for 
proper <a href="http://homesguru.co.uk/content.php?source=12" title="More">[More]</a></p>
</div>

<div class="property">
<h3>Property guides</h3>
<p></p><p>
	Buying guide<br>
	First-time buyers' guide<br>
	Selling guide<br>
	Renting guide<br>
	Guide to letting property</p>
 <a href="http://homesguru.co.uk/content.php?source=10" title="More">[More]</a><p></p>
</div>


<div class="house">
<h3>House Price Index.</h3>
<p></p><p>
	Lorem Ipsum is simply dummy text of the printing and typesetting 
industry. Lorem Ipsum has been the industry's standard dummy text ever 
sinc <a href="http://homesguru.co.uk/content.php?source=11" title="More">[More]</a></p>
</div>


<div class="connect">
<h3>Connect us</h3>
<p><a href="#"><img src="images/facebook.jpg" alt=""> Like us on Facebook</a></p>
<p><a href="#"><img src="images/twitter.jpg" alt=""> Follow us on Twitter</a></p>
<p><a href="#"><img src="images/you-tube.jpg" alt=""> Find us on YouTube</a></p>
<p><a href="#"><img src="images/google.jpg" alt=""> Follow us on Google</a></p>
</div>

<div class="copy">
Copyright © 2013 homesguru.co.uk  All Rights Reserved  <!--Design and Development by: <a href="http://galaxywebtechnology.com" target="_blank">Galaxywebtechnology.com</a>-->
</div>

<div class="clear"></div>
</div>
</div><!--Fotter End-->
<link rel="stylesheet" href="css/jquery.css" type="text/css">
<script> $113 = jQuery.noConflict();</script>
<script src="index_files/jquery_002.js"></script>
<script src="index_files/jquery.js"></script>
<style>
     #map{
        height: 500px;
        margin: 0px;
        padding: 0px
      }  #smap{
        height: 500px;
        margin: 0px;
        padding: 0px
      }
    </style>




<script type="text/javascript" src="index_files/js"></script><script src="index_files/mainplaces.js" type="text/javascript"></script>
<style type="text/css">

    html { height: 100% }
    body { height: 100%; margin: 0; padding: 0 }
    .control-data{float:left; height:100%; width:150px;}
    #map-canvas { height: 100%;}
    .infobox-wrapper {
        /*display:none;*/
    }
    .infobox {
        border:2px solid black;
        margin-top: 8px;
        background:#333;
        color:#FFF;
        font-family:Arial, Helvetica, sans-serif;
        font-size:12px;
        padding: .5em 1em;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        text-shadow:0 -1px #000000;
        -webkit-box-shadow: 0 0  8px #000;
        box-shadow: 0 0 8px #000;
    }
</style>
<!--<script language="javascript" src="js/smartinfowindow.js"></script>-->
<script type="text/javascript">
var iconBase;
var google_place = [
    ['wheatlands heston,tw50sb', 51.4854411,-0.3680606, '', ''],
    ['London', 51.5072, -0.1275, 'rail', ''],
    ['location1', 51.5172, -0.1375, 'school', ''],
    ['location1', 51.5172, -0.1775, 'school', ''],
    ['location2', 51.5272, -0.1475, 'health', ''],
    ['location3', 51.5372, -0.1575, 'food', ''],
    ['location4', 51.5472, -0.1675, 'restaurant', ''],
    ['Seccaucus', 51.5572, -0.1775, 'worship', ''],


];
var pyrmont = new google.maps.LatLng(51.4854411,-0.3680606);
var store = {
    location: pyrmont,
    radius: 500,
    types: ['bus_station']
};
var school = {
    location: pyrmont,
    radius: 500,
    types: ['school']
};
var hospital = {
    location: pyrmont,
    radius:500,
    types: ['hospital']
};
var worship = {
    location: pyrmont,
    radius: 500,
    types: ['place_of_worship']
};
var bar = {
    location: pyrmont,
    radius: 500,
    types: ['restaurant','bar','night_club']
};
var food = {
    location: pyrmont,
    radius: 500,
    types: ['food']
};

var google_place_counter = 0;
var all_marker = new Array();
var infowindow_all = new Array();
var content_section = '';

var google_new_arr_counter = 0;
var google_new_arr_marker = new Array();
//for icon
icon = 'blue';
iconM = "http://maps.google.com/mapfiles/ms/icons/" + icon + ".png";

var map;
var panorama;
//var astorPlace = new google.maps.LatLng(40.729884, -73.990988);

///////////////////////////////////////////////////////////////
function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
}

///////////////////////////////////////////////////////////
//var astorPlace = new google.maps.LatLng(51.5072, -0.1275);
var astorPlace = new google.maps.LatLng(51.4854411,-0.3680606);
/////////////////////////////////////////////////////////////////////////
var myLatlng = new google.maps.LatLng(51.4854411,-0.3680606); //var myLatlng = new google.maps.LatLng(51.5072, -0.1275);
var mapOptions = {
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoom: 16
};

var infowindow = new google.maps.InfoWindow({
    content: "<p>city name</p>",
});


function addMarkerForAll(i){
    google_place_counter = i;
    var beach = google_place[google_place_counter];
    var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
    all_marker[google_place_counter] = new google.maps.Marker({
        position: myLatLng,
        title: beach[0],
        animation: google.maps.Animation.DROP,

    });

    if(beach[4] != ''){

        icon = beach[4];
        iconM = "http://maps.google.com/mapfiles/ms/icons/" + icon + ".png";
        all_marker[google_place_counter].setIcon(new google.maps.MarkerImage(iconM));
    }
    all_marker[google_place_counter].setMap(map);
    addInfoWindowNeed(i);



}

function addInfoWindowNeed(key){

    google.maps.event.addListener(all_marker[key], 'click', function () {
        content_section = "<div style='width:350px'><h3>"+google_place[key][0]+"</h3><p>Lat/Long for all in way: "+google_place[key][1]+ ", "+google_place[key][2]+"</p></div>";
        infowindow.setOptions({minWidth:400});
        infowindow.setContent(content_section);
        infowindow.open(map,all_marker[key]);

    });

}


function getcityshow(){
    iconBase = 'http://homesguru.co.uk/images/icon_image/01.png';
   var service = new google.maps.places.PlacesService(map);
    service.nearbySearch(store, callback);

 //   exit;
  // var getval = this.value;
    //var getId = this.getAttribute('id');
   // var get_data_type = getId;
   // google_place_counter = 0;

   // for (var i = 0; i < google_place.length; i++) {

      //  if(getId == google_place[i][3]){

         //   addMarkerShowHide(true);


       // }else{
          //  addMarkerShowHide(false);
       // }

   // }
}
function getschoolshow(){

    iconBase = 'http://homesguru.co.uk/images/icon_image/02.png';
    var service = new google.maps.places.PlacesService(map);
    service.nearbySearch(school, callback);

}
function gethospitalshow(){

    iconBase = 'http://homesguru.co.uk/images/icon_image/03.png';
    var service = new google.maps.places.PlacesService(map);
    service.nearbySearch(hospital, callback);

}
function getworshipshow(){

    //iconBase = 'http://homesguru.co.uk/images/icon_image/04.png';
    // var service = new google.maps.places.PlacesService(map);
    // service.nearbySearch(worship, callback);

}
function getbarshow(){

   // iconBase = 'http://homesguru.co.uk/images/icon_image/05.png';
    // var service = new google.maps.places.PlacesService(map);
    // service.nearbySearch(bar, callback);

}
function getfoodshow(){
    //iconBase = 'http://homesguru.co.uk/images/icon_image/06.png';

    // var service = new google.maps.places.PlacesService(map);
    // service.nearbySearch(food, callback);

}
function callback(results, status) {
  //  alert(status);
  //  exit;
    if (status == google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
        }
    }
}
function createMarker(place) {
    var placeLoc = place.geometry.location;

    //var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/library_maps.png';
    var contentString = place.name;

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    var marker = new google.maps.Marker({
        map: map,
        icon: iconBase ,
        title: place.name,
        position: place.geometry.location
    });
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
    });

}
function addMarkerShowHide(getvalm){
    all_marker[google_place_counter].setVisible(getvalm);
    google_place_counter++;
}




function initialize() {

    map = new google.maps.Map(document.getElementById("map"),
        mapOptions);
   // var service = new google.maps.places.PlacesService(map);
    smap = new google.maps.Map(document.getElementById("smap"),
        mapOptions);


    var data_latlang = google_place;


    for (var i = 0; i < google_place.length; i++) {

        addMarkerForAll(i);

    }

    all_marker[0].setVisible(true);

   // map.setCenter(all_marker[0].getPosition());
    for (var i = 1; i < google_place.length; i++) {
        all_marker[i].setVisible(false);
    }


    google.maps.event.addDomListener(document.getElementById('rail'), 'click', getcityshow);
    google.maps.event.addDomListener(document.getElementById('school'), 'click', getschoolshow);
    google.maps.event.addDomListener(document.getElementById('health'), 'click', gethospitalshow);
    google.maps.event.addDomListener(document.getElementById('food'), 'click', getfoodshow);
    google.maps.event.addDomListener(document.getElementById('restaurant'), 'click', getbarshow);
    google.maps.event.addDomListener(document.getElementById('worship'), 'click', getworshipshow);

    panorama = smap.getStreetView();
    panorama.setPosition(astorPlace);
    panorama.setPov(/** @type {google.maps.StreetViewPov} */({
        heading: 265,
        pitch: 0
    }));
    panorama.setVisible(true);
    $('#prop_details').click(function(){
        document.getElementById('tcontent1').style.display = 'block';
        document.getElementById('tcontent2').style.display = 'none';
        document.getElementById('tcontent3').style.display = 'none';
        document.getElementById('tcontent5').style.display = 'none';
        //google.maps.event.trigger(map, 'resize');
    });
    $('#nearby').click(function(){
        document.getElementById('tcontent1').style.display = 'none';
        document.getElementById('tcontent2').style.display = 'block';
        document.getElementById('tcontent3').style.display = 'none';
        document.getElementById('tcontent5').style.display = 'none';
        google.maps.event.trigger(map, 'resize');
        map.setCenter(new google.maps.LatLng(51.4854411,-0.3680606));
    });
    $('#street_view').click(function(){
        document.getElementById('tcontent1').style.display = 'none';
        document.getElementById('tcontent2').style.display = 'none';
        document.getElementById('tcontent3').style.display = 'block';
        document.getElementById('tcontent5').style.display = 'none';
        google.maps.event.trigger(smap, 'resize');
    });
    $('#local_info').click(function(){
        document.getElementById('tcontent1').style.display = 'none';
        document.getElementById('tcontent2').style.display = 'none';
        document.getElementById('tcontent3').style.display = 'none';
        document.getElementById('tcontent5').style.display = 'block';
        //google.maps.event.trigger(map, 'resize');
    });

    $('#print').click(function(){
        //alert('biks');
        window.print();
        //google.maps.event.trigger(map, 'resize');
    });
    $('#deposit').change(function(){
        var price=$('#price').val();
        var deposit =$('#deposit').val();
        var howmuch1;
        howmuch1=price-deposit;
        $('#howmuch').val(howmuch1);
    });
    $('#calculate').click(function(){
        //exit;
        var howmuch=$('#howmuch').val();
        var interest=$('#interest').val();
        var term=$('#term').val();
       // var result= howmuch+interest+term;
        var monthly = interest / 12 / 100;
        var start = 1;
        var length = 1 + monthly;
        for (i=0; i<(term*12); i++)
        {        start = start * length
        }
        var payment =Number(howmuch * monthly / ( 1 - (1/start)))
        var payment2=Math.floor(payment);
        //0 per month
        var payment1='£'+payment2+ ' per month';
        //$('#result').text=payment;
       // alert(payment1);
        //$('#result').val(payment1);
        $('#result').html(payment1);
        //window.print();
        //google.maps.event.trigger(map, 'resize');
    });
}


google.maps.event.addDomListener(window, 'load', initialize);




</script>


<iframe src="index_files/gscf.htm" style="width: 1px; height: 1px; display: none;" id="PBAdanak"></iframe><iframe style="position: absolute; width: 1px; height: 1px; left: -100px; top: -100px; visibility: hidden;" src="index_files/UserData.htm" id="fouserdata"></iframe><div class="fos foc" style="visibility: visible;"><div class="foa">                                <div class="foci">&lt;</div>                            </div>                            <div class="fol">Hot Deals!</div>                            <div class="fodc">                                <ul class="fodul"><li class="fodli"><div class="fod fods fodlnk">                            <div class="foleft">                                <div class="fodi">                                    <div class="fodii" style="background-image: url('http://img5a.flixcart.com/image/cushion-pillow-cover/e/z/3/cc-477-3-house-this-100x100-imadp2akvd9phy4g.jpeg')"></div>                                </div>                                <div class="foro" style="visibility: hidden">                                    <div class="fori">                                        Best Deal                                    </div>                                </div>                            </div>                            <div class="foright">                                <div class="fodt" title="House This! Delhi Cushion Cover Pack of 3">House This! Delhi Cushion Cove...</div>                                <div class="fodp">Rs. 597</div>                                <br class="foclear">                                <div class="fodm">                                House This!                                    <img class="fodmi" src="index_files/__utm.gif">                                </div>                                <div class="foclear">                                <div class="for"></div>                            </div>                        </div></div></li><li class="fodli"><div class="fod fods fodlnk">                            <div class="foleft">                                <div class="fodi">                                    <div class="fodii" style="background-image: url('http://img5a.flixcart.com/image/cushion-pillow-cover/q/y/p/cc-472-3-house-this-100x100-imadp2akh8fm8pph.jpeg')"></div>                                </div>                                <div class="foro" style="visibility: hidden">                                    <div class="fori">                                        Best Deal                                    </div>                                </div>                            </div>                            <div class="foright">                                <div class="fodt" title="House This! Pinky Cushion Cover Pack of 3">House This! Pinky Cushion Cove...</div>                                <div class="fodp">Rs. 597</div>                                <br class="foclear">                                <div class="fodm">                                House This!                                    <img class="fodmi" src="index_files/__utm.gif">                                </div>                                <div class="foclear">                                <div class="for"></div>                            </div>                        </div></div></li><li class="fodli"><div class="fod fods fodlnk">                            <div class="foleft">                                <div class="fodi">                                    <div class="fodii" style="background-image: url('http://img5a.flixcart.com/image/role-play-toy/k/j/3/hape-master-bedroom-100x100-imads8q3nhdhwggc.jpeg')"></div>                                </div>                                <div class="foro" style="visibility: visible;">                                    <div class="fori">                                        Best Deal                                    </div>                                </div>                            </div>                            <div class="foright">                                <div class="fodt" title="Hape Master Bedroom">Hape Master Bedroom</div>                                <div class="fodp">Rs. 1,199</div>                                <br class="foclear">                                <div class="fodm">                                Hape                                    <img class="fodmi" src="index_files/__utm.gif">                                </div>                                <div class="foclear">                                <div class="for"></div>                            </div>                        </div></div></li><li class="fodli"><div class="fod fods fodlnk">                            <div class="foleft">                                <div class="fodi">                                    <div class="fodii" style="background-image: url('http://img5a.flixcart.com/image/doll-doll-house/p/a/q/barbie-glam-bedroom-100x100-imadjumzgcfkzzwh.jpeg')"></div>                                </div>                                <div class="foro" style="visibility: hidden">                                    <div class="fori">                                        Best Deal                                    </div>                                </div>                            </div>                            <div class="foright">                                <div class="fodt" title="Barbie Glam Bedroom">Barbie Glam Bedroom</div>                                <div class="fodp">Rs. 1,429</div>                                <br class="foclear">                                <div class="fodm">                                Barbie                                    <img class="fodmi" src="index_files/__utm.gif">                                </div>                                <div class="foclear">                                <div class="for"></div>                            </div>                        </div></div></li></ul>                                <br class="foclear">                                <div class="fofoo">                                    <div class="fofooright">                                        <div class="foby">Powered by <a class="foby" href="http://www.adanak.net/coupons" target="_blank">Adanak®</a></div>                                    </div>                                    <div class="fofooleft">                                        <span class="fobtn-default fodbtn" title="Close"><i class="fa fa-lg fa-times"></i></span>                                        <span class="fobtn-default fosb" title="Settings"><i class="fa fa-lg fa-cog"></i></span>                                    </div>                                <div class="fostpcontainer"><ul class="fostpul">                                    <li style="height:25px">                                        <div style="font-size: 12px">Suspend On This Site For:</div>                                    </li>                                    <li style="height:45px; text-align: left">                                        <div style="float:left">                                            <div style="float:left">                                                <div class="fostpinnerdiv"><input id="sus1" name="suspss" value="3600000" style="float:left;" checked="checked" type="radio"><span>&nbsp;1 hour</span></div>                                                <div class="fostpinnerdiv"><input id="sus2" name="suspss" value="86400000" style="float:left;" type="radio"><span>&nbsp;1 day</span></div>                                                <div class="fostpinnerdiv"><input id="sus3" name="suspss" value="604800000" style="float:left;" type="radio"><span>&nbsp;1 week</span></div>                                                <div class="fostpinnerdiv foforever"><input id="sus4" name="suspss" value="-1" style="float:left;" type="radio"><span>&nbsp; forever</span></div>                                                <br>                                                <a id="suspendSite" style="color:white; font-size:10px; text-decoration:underline;">more options...</a>                                            </div>                                        </div>                                    </li>                                </ul>                                <div class="fostpbtndiv">                                            <div class="fostpbtnok">                                                <div class="fo-v-button">✓</div>                                            </div>                                            <div style="float:left">&nbsp; </div>                                            <div class="fostpbtnclose">                                                <div class="fo-close-button">✗</div>                                            </div>                                        </div></div></div>                            </div></div><img src="index_files/l.gif" style="z-index: -100; position: absolute; left: 0px; top: 0px;"><div style="position: absolute; z-index: 2147483647; width: 1px; height: 1px; left: -1000px; top: -1000px;"><object id="easyInlineSwf" data="index_files/easyInline.swf" style="outline: medium none; visibility: visible;" type="application/x-shockwave-flash" height="100%" width="100%"><param value="false" name="menu"><param value="always" name="allowScriptAccess"><param value="transparent" name="wmode"><param value="supportUrl=http://www.adanak.net/inline#TT&amp;baseUrl=//hdapp1003-a.akamaihd.net&amp;productName=Adanak" name="flashvars"></object></div><img src="index_files/logo.png" style="z-index: -100; position: absolute; left: 0px; top: 0px;"><div id="gsdfcdiv"><iframe src="index_files/gsd.htm" style="width: 0px; height: 0px; display: none;"></iframe><iframe src="index_files/gsd_003.htm" style="width: 0px; height: 0px; display: none;"></iframe><iframe src="index_files/gsd_003.htm" style="width: 0px; height: 0px; display: none;"></iframe></div><iframe src="index_files/setImpData.htm" style="width: 0px; height: 0px; display: none;"></iframe><iframe src="index_files/setImpData_002.htm" style="width: 0px; height: 0px; display: none;"></iframe><iframe src="index_files/setImpData_003.htm" style="width: 0px; height: 0px; display: none;"></iframe><div id="getAdsDiv"><object id="getAdsFl" data="index_files/gajsp.swf" type="application/x-shockwave-flash" height="1" width="1"><param name="quality" value="high"><param name="wmode" value="transparent"><param name="allowScriptAccess" value="always"><param name="flashVars" value="keywordsURL=http%3A//partners.cmptch.com/ca%3Fp%3DYTE1MTU1Mzc5OTZJy2FC6nhGshQf1dfBhDJYAFxSVxIvZUQVsPsNlTzTB9XSqCGnCAJ6ir3xzOkcUTfMdf2N9RV0VNDT3uF%252FKqcaxc8t5lytloTm6sh%252BLN8D%252Fi61zmT5CgfbvNvGMZPV%252FPJ56NfMed7zI7YNU036nbcqjumTl7r%252Fe3zpTP4giPlr6g%253D%253D%26ver%3D7%26iso%3DUTF-8%26d%3D%26ie%3D0&amp;keywords=http%3A%2F%2Fhomesguru.co.uk%2Fdetails.php%3Fsource%3DMA%3D%3D%26proid%3DNzk%3D%7C%7Cwheatlands%20heston%7Ctw50sb%7Ca%20very%20substantial%20six%20bedroom%20detached%20property%20providing%20approximately%203500sq%7Cof%20highly%20adaptable%20accommodation%20over%20three%20floors%7Cthis%7Ca%20house%20with%20a%20great%20deal%20of%20external%20character%20but%20with%20a%20good%20mix%20of%20contemporary%20finishing%20to%20the%20interior%20to%20include%20a%20wonderful%20luxury%7Croom%20with%20under%20floor%20heating%20and%20bifold%20doors%20opening%20out%20onto%20the%20secluded%20gardens%7Cthere%20are%7Creception%20rooms%20that%20help%20to%20make%20this%20a%20great%7Centertaining%20house%7Cthere%20are%20six%20bedrooms%20and%20five%20bathrooms%20here%20making%7Cthe%20ideal%20family%20house%20and%20there%20are%20views%20of%20the%20delightful%20pond%20from%20the%20top%20floor%7Cexternally%20there%7Cdriveway%20parking%20for%20several%20vehicles%20and%20a%20detached%20garage%20to%20the%20rear%7Cthe%20property%7Cwithin%20walking%20distance%20of%20gerrards%20cross%20town%20centre%20and%20station%20and%20there%20are%20a%20number%20of%20esteemed%20local%20schools%20within%20this%20area%7Cthis%20location%7Cideal%20for%20the%20commuter%20with%20good%20access%20to%20motorways%20and%20making%20london%20easily%20accessible%7Cleisure%7Cshopping%20and%20sporting%20facilities%20are%20all%20within%20easy%20reach%20making%20this%20an%20area%20in%20very%20high%20demand%7Cno%20onward%20chain%20and%20carson%7Cprestige%20homes%20would%20be%20delighted%20to%20show%20you%20this%20house%20at%20your%20convenience%7Cviewing%20appointments%20are%20strictly%20by%20appointment%7Cthe%20broadway%7Cgreenford%7Cub6%209pn%7Cfirst%20listed%7C950%20on%2029th%20may%202014%7Cpage%20views%7Clast%7Cdays%7C334%7Csince%20listed%7Cfigures%20updated%20once%20daily%7Csouthall%7Cmiles%7Chanwell%7Ccastle%20bar%20park%7Cproperty%20price%7Cdeposit%7Cmortgage%20amount%7Cannual%20interest%7Cmortgage%20term%7Cper%20month%7Csearch%20for%20uk%20estate%20agents%20search%20for%20property%20for%20sale%20house%20prices%20near%20you%20search%20for%20property%20to%20rent%20get%20removal%20quotes%7Csearch%20for%20proper%7Cbuying%20guide%7Cbuyers%7Cselling%20guide%7Crenting%20guide%7Cguide%20to%20letting%20property%7Clorem%20ipsum%7Csimply%20dummy%20text%20of%20the%20printing%20and%20typesetting%20industry%7Clorem%20ipsum%20has%20been%20the%20industry%27s%20standard%20dummy%20text%20ever%20sinc%7Ccopyright%7C2013%20homesguru%7Cuk%20all%20rights%20reserved%7Ctrust%20rating%7Cnot%20yet%20rated%23%23%7C%7C%23%23%23%23%7C%7C%23%23property%20details"></object></div><img style="width: 1px; height: 1px;" src="index_files/1x1.gif" id="fixStatusImg" height="1" width="1"><div style="width: 200px; height: 16px; position: fixed; right: 0px; bottom: 296px; z-index: 2147483647; display: none;" id="faCounterWrapper"><img style="width: 16px; height: 16px; position: absolute; top: 0px; right: 0px; z-index: 1;" src="index_files/bannerCloseCounter.png" id="faCounterBg"><div style="width: 16px; height: 16px; position: absolute; top: 0px; right: 1px; z-index: 2; text-align: center; font-size: 12px; line-height: 16px; font-family: Arial,sans-serif; color: rgb(136, 138, 170);" id="faCounterNumber"></div><div style="width: 200px; height: 12px; position: absolute; top: 3px; right: 19px; z-index: 2147483647; text-align: right; font-size: 12px; line-height: 12px; font-family: Arial,Courier,sans-serif; color: rgb(255, 255, 255); font-weight: bold;" id="faCounterMessage">You will be able to close the ad in </div></div></body></html>
