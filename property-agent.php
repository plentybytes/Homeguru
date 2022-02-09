<?php $seoId=25;
include('includes/application.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>
<link href="css/style.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/animatedcollapse.js"></script>
<script src="js/tabcontent.js" type="text/javascript"></script>

<script type="text/javascript">

animatedcollapse.addDiv('jason', 'fade=1,height=80px')
animatedcollapse.addDiv('kelly', 'fade=1,height=100px')
animatedcollapse.addDiv('michael', 'fade=1,height=120px')

animatedcollapse.addDiv('cat', 'fade=0,speed=400,group=pets')
animatedcollapse.addDiv('dog', 'fade=0,speed=400,group=pets,persist=1,hide=1')
animatedcollapse.addDiv('rabbit', 'fade=0,speed=400,group=pets,hide=1')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}

animatedcollapse.init()


</script>


<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>
<script type="text/javascript" src="js/ddaccordion2.js"></script>
<!--scripting by akash-->
<script src="//cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" type="text/javascript"></script>
<link href="//cdn.datatables.net/1.10.8/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#ak_rent_agent').DataTable( {
        
		//"processing": true,
        //"serverSide": true,
		
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "post.php"
        
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
} );
</script><!-- script ended by akash-->
</head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<div class="main">



<div class="clear">&nbsp;</div>

<div id="left-panel">
  <?php include('includes/about.php');?>

<?php
/************************************************
/		Code Edited by: Akash singh              /
/		Date:  20/08/2015						 /
/		Company :CvInfotech(www.cvinfotech.com) */ ?>

<h2>A-Z Letting Agents directory</h2>
<!--<div class="pre-next">
<pre ><a href="show-agent.php?show=view&key=a">A</a></pre>
<pre ><a href="show-agent.php?show=view&key=b">B</a></pre>
<pre ><a href="show-agent.php?show=view&key=c">C</a></pre>
<pre ><a href="show-agent.php?show=view&key=d">D</a></pre>
<pre ><a href="show-agent.php?show=view&key=e">E</a></pre>
<pre ><a href="show-agent.php?show=view&key=f">F</a></pre>
<pre ><a href="show-agent.php?show=view&key=g">G</a></pre>
<pre ><a href="show-agent.php?show=view&key=h">H</a></pre>
<pre ><a href="show-agent.php?show=view&key=i">I</a></pre>
<pre ><a href="show-agent.php?show=view&key=j">J</a></pre>
<pre ><a href="show-agent.php?show=view&key=k">K</a></pre>
<pre ><a href="show-agent.php?show=view&key=l">L</a></pre>
<pre ><a href="show-agent.php?show=view&key=m">M</a></pre>
<pre ><a href="show-agent.php?show=view&key=n">N</a></pre>
<pre ><a href="show-agent.php?show=view&key=o">O</a></pre>
<pre ><a href="show-agent.php?show=view&key=p">P</a></pre>
<pre ><a href="show-agent.php?show=view&key=q">Q</a></pre>
<pre ><a href="show-agent.php?show=view&key=r">R</a></pre>
<pre ><a href="show-agent.php?show=view&key=s">S</a></pre>
<pre ><a href="show-agent.php?show=view&key=t">T</a></pre>
<pre ><a href="show-agent.php?show=view&key=u">U</a></pre>
<pre ><a href="show-agent.php?show=view&key=v">V</a></pre>
<pre ><a href="show-agent.php?show=view&key=w">W</a></pre>
<pre ><a href="show-agent.php?show=view&key=x">X</a></pre>
<pre ><a href="show-agent.php?show=view&key=y">Y</a></pre>
<pre ><a href="show-agent.php?show=view&key=z">Z</a></pre>
</div>-->
<table id="ak_rent_agent" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Agent name</th>
                <th>City</th>
                <th>Postcode</th>
                
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Agent name</th>
                <th>City</th>
                <th>Postcode</th>
            </tr>
        </tfoot>
    </table>
  

<!-- code end by akash -->
<br />
<div class="clearfix"></div>
<?php include('includes/popup.html');?>	
<div class="clearfix"></div>
</div>



<div id="right-panel">
<div  class="banner">
 <?php include('includes/right-banner.php');?>

</div>

</div>



<div class="clear">&nbsp;</div>
 <div id="tab">
  <?php include('includes/middle_tab.php');?>
  
  </div>

<div class="clear"></div>
</div>
</div>
<!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
