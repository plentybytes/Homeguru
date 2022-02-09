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
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <style type="text/css">.gm-style .gm-style-mtc label,.gm-style .gm-style-mtc div{font-weight:400}</style><style type="text/css">.gm-style .gm-style-cc span,.gm-style .gm-style-cc a,.gm-style .gm-style-mtc div{font-size:10px}</style>
    <link href="css/css.css" rel="stylesheet" type="text/css">

    <style type="text/css">@media print {  .gm-style .gmnoprint, .gmnoprint {    display:none  }}@media screen {  .gm-style .gmnoscreen, .gmnoscreen {    display:none  }}</style><style type="text/css">.gm-style{font-family:Roboto,Arial,sans-serif;font-size:11px;font-weight:400;text-decoration:none}
    </style>


    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="description" content="">
    <meta name="keywords" content=""><title>Property Details</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">

    <script src="js/jquery_003.js" type="text/javascript"></script>
    <script src="js/tabcontent.js" type="text/javascript"></script>
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
    <script src="js/commonmaputilmarkergeometrystreetview.js" charset="UTF-8" type="text/javascript"></script>
    <script src="js/onioncontrols.js" charset="UTF-8" type="text/javascript"></script>
    <script src="js/stats.js" charset="UTF-8" type="text/javascript"></script>

</head>

<body>
<!--Header Start-->
<div id="header">
    <div class="main">
        <div id="logo"><a href="index.php"><img src="images/homesguru.jpg" alt="" border="0"></a></div>

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
                    <div class="input"><input type="email" value="" id="user_name" name="user_name" placeholder="Enter Your Email ID" required="">
                        <input name="_method" id="_method" value="authentication process" type="hidden"></div>
                    <p>Enter Your Password</p>
                    <div class="input"><input required="" placeholder="********" name="login_password" id="login_password" value="" type="password"></div>

                    <input name="login" class="go" value="Login" type="submit">
                    <strong><a href="forgot-password.php">Forgot password?</a></strong>

                </form>
            </div>

            <div class="rigster"><a href="register.php">Register</a></div>
            <div class="login"><a id="loginimg" onclick="showlogin()" href="#">Sign in</a></div>

            <div class="clear"></div>

            <ul id="menu-drop">
                <li><a href="#"><span>For Sale</span></a>
                    <ul>
                        <li><a href="property.php?shortby=sell">UK property for sale</a></li>
                        <li><a href="property.php?shortby=new">UK new homes for sale</a></li>
                        <li><a href="property-agent.php"> UK Letting Agents</a></li>

                    </ul>
                </li>

                <li><a href="#"><span>To Rent</span></a>
                    <ul>
                        <li><a href="property-for-rent.php">UK Property to Rent</a></li>
                        <li><a href="property-agent.php">UK Letting Agents</a></li>


                    </ul>
                </li>

                <li><a href="#"><span>Current Values</span></a>
                    <ul>
                        <li><a href="property-current-valuation.php">UK Property Values</a></li>

                    </ul>
                </li>

                <li><a href="#"><span>Sold Prices</span></a>
                    <ul>
                        <li><a href="property-sold-value.php">UK House Prices</a></li>

                    </ul>
                </li>

                <li><a href="#"><span>New Homes</span></a>
                    <ul>
                        <li><a href="property.php?shortby=new">UK new homes for sale</a></li>

                        <li><a href="newbuyhome.php">New Buy</a></li>
                        <li><a href="firstbuy.php">First buy </a></li>
                    </ul>
                </li>

                <li class="none"><a href="#"><span>Find Agents</span></a>
                    <ul>
                        <li><a href="property-agent.php">UK property for sale</a></li>
                        <li><a href="property.php?shortby=new">UK new homes for sale</a></li>
                        <li><a href="property-agent.php"> UK Letting Agents</a></li>
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
        <div class="well bg_white clearfix">



            <img src="images/<?php echo $imagesInfo["property_images"];?>" alt="req" />
            <h1 style="font-size: 22px;">
                <?php echo $resultProperty["property_bedrooms"];?> bedroom semi-detached house for sale
                </br>
                <?php echo $resultProperty["property_address"];?>
            </h1>
            <h2 style="font-size: 21px;margin-top: -16px;">£ <?php echo $resultProperty["property_total_price"];?></h2>

        </div>

        <div class="well">
            <div class="container-fluid">
                <div class="row clearfix">

                    <form name="reg" id="reg"  method="post" action="saverequest.php" enctype="multipart/form-data" onsubmit="return varify()">
                        <div class="col-md-6">
                            <label>Name:</label>
                            <input type="text" class="form-control" value="" name="name" id="name"/>
                        </div>
                        <div class="col-md-6">
                            <label>Email:</label>
                            <input type="email" class="form-control" value="" name="email" id="email" />
                        </div>
                        <div class="col-md-6">
                            <label>Telephone:</label>
                            <input type="text" class="form-control" value="" name="tel" id="tel" />
                        </div>
                        <div class="col-md-6">
                            <label>Type of enquiry:</label>
                            <span class="redio"><input type="radio" value="" />Arrange Viewing</span>
                            <span class="redio"><input type="radio" value="" />Request details</span>
                        </div>

                        <div class="col-md-12">
                            <label>Message (Optional):</label>
                            <textarea class="form-control" name="message" id="message" placeholder="Please include any useful details, i.e. current status, availability for viewings, etc."></textarea>
                        </div>
                        <div class="col-md-12">
                            <select class="form-control" id="field" name="field">

                                <option value="">Please select:</option>


                                <option value="first_time_buyer">I am a first-time buyer</option>


                                <option selected="selected" value="buyer_not_first_time">I am a buyer (not first-time)</option>


                                <option value="property_to_sell">I have a property to sell</option>


                                <option value="property_to_let">I have a property to let</option>


                                <option value="offer_on_own_property">I have an offer on my property</option>


                                <option value="recently_sold">I have recently sold</option>


                                <option value="looking_to_invest">I am looking to invest</option>


                                <option value="other">None of the above</option>


                            </select>
                        </div>

                        <div class="col-md-12">

                           <!-- <p><input type="checkbox" value="yes" id="" name=""><strong>Get a FREE agent appraisal of my property</strong></p>
                            <p><input type="checkbox" value="yes" id="" name=""><strong>Send a copy to my email address</strong></p>-->
                        </div>
                        <div class="col-md-12">
                            <input type="submit" value="submit now" class="btn btn-danger btn-lg"/>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!--right-panel start 06-02-14-->
    <div id="right-panel">
        <div class="well clearfix">
            <h4 class="wel-heading">4Marketed by</h4>
            <img src="images/agent-logo.jpg" class="img-responsive" />
            <p><a href="#">Evans & Co Property Services (view all property for sale)</a> <br />55 The Broadway, Greenford, UB6 9PN</p>
            <h4>Call 020 7768 0828</h4>

            <hr />

        </div>

        <div class="well">
            <div>
                <h4 class="wel-heading">Share this property</h4>
                <div class="social_share">
                    <a href="#"><img src="images/fb-share.jpg"  alt="fb" /></a>
                    <a href="#"><img src="images/tweet-share.jpg" alt="Tw" /></a>
                    <a href="#"><img src="images/print-share.jpg"  alt="pt" /></a>
                </div>
            </div>
        </div>

    </div>

    <!--right-panel start 06-02-14-->
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
<link rel="stylesheet" href="images/jquery.css" type="text/css">
<script> $113 = jQuery.noConflict();</script>
<script src="images/jquery_002.js"></script>
<script src="images/jquery.js"></script>
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

<script type="text/javascript">

    $(document).ready(function() {

        var pyrmont = new google.maps.LatLng(51.4955543,-0.3801607000000331);


        var myOptions = {
            zoom: 15,
            center: pyrmont,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("map"), myOptions);

        var marker = new google.maps.Marker({
            map: map,
            position: pyrmont
        });
    });
    //  stephin nadar

</script>
<script type="text/javascript">

    $(document).ready(function() {
        var pyrmont = new google.maps.LatLng(51.4955543,-0.3801607000000331);
        var panoramaOptions = {
            position: pyrmont,
            pov: {
                heading: 165,
                pitch: 0
            },
            zoom: 1
        };
        var myPano = new google.maps.StreetViewPanorama(
            document.getElementById('smap'),
            panoramaOptions);
        myPano.setVisible(true);
    });
    //  stephin nadar

</script>

<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>-->
<script type="text/javascript" src="js/js"></script><script src="js/main.js" type="text/javascript"></script>

<script>


    var type ={'food':['food'],'health':['health','hospital'],'rail':['train_station','taxi_stand'],'restaurant':['bar','restaurant'],'school':['school'],'worship':['place_of_worship']};
    var hmm=type[this.value];
    var iconn = this.value;
    function initialize() {
        var pyrmont = new google.maps.LatLng(51.4955543,-0.3801607000000331);

        map = new google.maps.Map(document.getElementById('map'), {
            center: pyrmont,

            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: 15
        });

        var request = {
            location: pyrmont,
            radius: 500,
            types: hmm
        };
        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);

        service.nearbySearch(request, callback);
    }

    function callback(results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
            for (var i = 0; i < results.length; i++) {
                createMarker(results[i]);
            }
        }
    }

    function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
            map: map,
            icon: 'http://homesguru.co.uk/js/images/pin-'+iconn+'.png',
            position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(place.name);
            infowindow.open(map, this);
        });

    }


    $(window).load(function() {

        $("input[name='details']").change(function(){

            //  google.maps.event.addDomListener(window, 'load', initialize);
            initialize();
        });

    });
</script>
<script language="javascript">
    function varify(){
        //alert('Hello');
        var ext = $('#image2').val().split('.').pop().toLowerCase();
        var ext1 = $('#cv').val().split('.').pop().toLowerCase();
        if(!$('#fn').val()){
            alert('First Name can not be blank');
            //$('#fn').scrollTo();
            $('html, body').animate({ scrollTop: 0 }, 'fast');
            $('#fn').focus();
            return false;
        }
        if(!$('#ln').val()){
            alert('Last Name can not be blank');
            //$('#fn').scrollTo();
            $('html, body').animate({ scrollTop: 0 }, 'fast');
            $('#ln').focus();
            return false;
        }
        if(!$('#image2').val()){
            alert('Profile Image must be Uploaded');
            //$('#fn').scrollTo();
            $('html, body').animate({ scrollTop: 0 }, 'fast');
            $('#image2').focus();
            return false;
        }

        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            alert("invalid extension!Please Upload 'gif','png','jpg' or 'jpeg' format images");
            $('html, body').animate({ scrollTop: 0 }, 'fast');
            $('#image2').focus();
            return false;
        }
        if(!$('#specialization').val()){
            alert('Specialization  can not be blank');
            //$('#fn').scrollTo();
            $('html, body').animate({ scrollTop: 0 }, 'fast');
            $('#specialization').focus();
            return false;
        }
        if(!$('#field').val()){
            alert('field  can not be blank');
            //$('#fn').scrollTo();
            $('html, body').animate({ scrollTop: 0 }, 'fast');
            $('#field').focus();
            return false;
        }
        if(!$('#gen').val()){
            alert('Gender can not be blank');
            //$('#fn').scrollTo();
            $('html, body').animate({ scrollTop: 0 }, 'fast');
            $('#gen').focus();
            return false;
        }
        if(!$('#email').val()){
            alert('Email can not be blank');
            //$('#fn').scrollTo();
            //$('html, body').animate({ scrollTop: 0 }, 'fast');
            $('#email').focus();
            return false;
        }
        if(!$('#pass').val()){
            var pos = $('#pass').offset().top;

            alert('Password can not be blank');
            //alert(pos);
            //$('#fn').scrollTo();
            $('html, body').animate({ scrollTop: 400 }, 'fast');
            //$("html, body").animate({scrollTop: $("#pass").offset().top}, 1000);
            $('#pass').focus();
            return false;
        }
        if(!$('#repass').val()){
            alert('Retype Password can not be blank');
            //$('#fn').scrollTo();
            //$('html, body').animate({ scrollTop: 0 }, 'fast');
            $('html, body').animate({ scrollTop: 400 }, 'fast');
            $('#repass').focus();
            return false;
        }
        if($('#pass').val()!=$('#repass').val())
        {
            alert('Password Mismatch.Please retype your password.');
            $('html, body').animate({ scrollTop: 400 }, 'fast');
            $('#repass').focus();
            return false;
        }
        if(!$('#nationality').val()){
            alert('Nationality can not be blank');
            //$('#fn').scrollTo();
            //$('html, body').animate({ scrollTop: 0 }, 'fast');
            $('html, body').animate({ scrollTop: 500 }, 'fast');
            $('#nationality').focus();
            return false;
        }
        if(!$('#state').val()){
            alert('State Of Origin can not be blank');
            //$('#fn').scrollTo();
            //$('html, body').animate({ scrollTop: 0 }, 'fast');
            $('html, body').animate({ scrollTop: 500 }, 'fast');
            $('#state').focus();
            return false;
        }
        if(!$('#res').val()){
            alert('State Of Residence can not be blank');
            //$('#fn').scrollTo();
            //$('html, body').animate({ scrollTop: 0 }, 'fast');
            $('html, body').animate({ scrollTop: 500 }, 'fast');
            $('#res').focus();
            return false;
        }
        if(!$('#cv').val()){
            alert('CV must be uploaded');
            //$('#fn').scrollTo();
            //$('html, body').animate({ scrollTop: 0 }, 'fast');
            //$('html, body').animate({ scrollTop: 200 }, 'fast');
            $('#cv').focus();
            return false;
        }
        if($.inArray(ext1, ['doc','docx','pdf']) == -1) {
            alert("invalid extension!Please Upload 'doc','docx' or 'pdf' format Resume");
            $('html, body').animate({ scrollTop: 0 }, 'fast');
            $('#cv').focus();
            return false;
        }

    }

</script>

</body></html>
