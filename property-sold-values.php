<?php $seoId=25;include('includes/application.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script><script type="text/javascript" src="js/animatedcollapse.js"></script><script src="js/tabcontent.js" type="text/javascript"></script><script type="text/javascript">animatedcollapse.addDiv('jason', 'fade=1,height=80px')animatedcollapse.addDiv('kelly', 'fade=1,height=100px')animatedcollapse.addDiv('michael', 'fade=1,height=120px')animatedcollapse.addDiv('cat', 'fade=0,speed=400,group=pets')animatedcollapse.addDiv('dog', 'fade=0,speed=400,group=pets,persist=1,hide=1')animatedcollapse.addDiv('rabbit', 'fade=0,speed=400,group=pets,hide=1')animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted	//$: Access to jQuery	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID	//state: "block" or "none", depending on state}animatedcollapse.init()</script><script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script><script type="text/javascript" src="js/ddaccordion.js"></script><script type="text/javascript" src="js/ddaccordion2.js"></script>

<?php //echo $rsultSeo; ?>

<title>Price-Paid</title>
</head><body><!--Header Start--><?php include('includes/header.php');?><!--Header End-->
<!--Middle Start-->

<!--scripting by akash-->
<script src="//cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" type="text/javascript"></script>
<link href="//cdn.datatables.net/1.10.8/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#ak_rent').DataTable( {
        
		//"processing": true,
        //"serverSide": true,
		
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "post_new.php"
		
        
		//"ajax": {
        //    "url": "post.php",
        //    "type": "POST"
        //},
        
		//"columns": [
        //    { "data": "user_first_name" },
        //    { "data": "user_address" },
        //    { "data": "state_id" },
        //    
        //]
    } );
	
	$('div.dataTables_filter input').attr('placeholder', 'e.g. Burket close, UB2, UB2 5NT');
	$('div.dataTables_filter input').css("width", "100%");
	$('div.dataTables_filter').css("width", "25%");
	$('div.dataTables_filter label').css("margin-left", "-50px");
	
	
	
} );
</script>
<style type="text/css">

  .ak_button { background: #6E9B18; background-image: -webkit-linear-gradient(top, #6E9B18, #9cde18); background-image: -moz-linear-gradient(top, #6E9B18, #9cde18); background-image: -ms-linear-gradient(top, #6E9B18, #9cde18); background-image: -o-linear-gradient(top, #6E9B18, #9cde18); background-image: linear-gradient(to bottom, #6E9B18, #9cde18); -webkit-border-radius: 11; -moz-border-radius: 11; border-radius: 11px; font-family: Arial; color: #ffffff;     font-size: 14px; padding: 6px 14px 6px 14px; text-decoration: none; } .ak_button:hover { background: #9cde18; background-image: -webkit-linear-gradient(top, #9cde18, #6E9B18); background-image: -moz-linear-gradient(top, #9cde18, #6E9B18); background-image: -ms-linear-gradient(top, #9cde18, #6E9B18); background-image: -o-linear-gradient(top, #9cde18, #6E9B18); background-image: linear-gradient(to bottom, #9cde18, #6E9B18); text-decoration: none; }

</style>
<!-- script ended by akash-->
<div id="middle">



<?php
/************************************************
/		Code Edited by: Akash singh              /
/		Date:  27/08/2015						 /
/		Company :CvInfotech(www.cvinfotech.com) */ ?>

<h1>Price Paid</h1>
<a href="http://landregistry.data.gov.uk/app/ppd" class="ak_button">Price Paid Data</a><br /> <br />
<table id="ak_rent" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                  <th>Street/Postal code</th>				                
				  <th>Sold Price</th>                
				  <!--<th>Total Price</th>-->
                
            </tr>
        </thead>
 
        <tfoot>
            <tr>
               <th>Street/Postal code</th>			
                <th>Avg. price paid</th>
                <!--<th>Total Price</th>-->
            </tr>
        </tfoot>
</table>
  

<!-- code end by akash -->
<div class="clear"></div>

</div>
<!--Middle End-->
<!--Fotter Start--><?php include('includes/footer.php'); ?><!--Fotter End--></body></html>