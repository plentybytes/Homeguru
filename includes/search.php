<script type="text/javascript">
$(document).ready(function() {  

	// Icon Click Focus
	$('div.icon').click(function(){
		$('input#searching').focus();
	});

	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#searching').val();
		$('b#search-string').html(query_value);
		$("#off").css("display", "block");
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "search1.php?action=header",
				data: { query: query_value },
				cache: false,
				success: function(html){
					$("ul#results").html(html);
				}
			});
		}return false;

    }

	$("input#searching").live("keyup", function(e) {
		// Set Timeout
		clearTimeout($.data(this, 'timer'));
//document.getElementById("off").style.display="block",
		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#results").fadeOut();
			$('h4#results-text').fadeOut();
		}else{
			$("ul#results").fadeIn();
			$('h4#results-text').fadeIn();
			$(this).data('timer', setTimeout(search, 1));
		};
	});
// Icon Click Focus
	$('div.icon').click(function(){
		$('input#searching1').focus();
	});

	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#searching1').val();
            $('b#search-string1').html(query_value);
		$("#off1").css("display", "block");
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "search.php?action=header1",
				data: { query: query_value },
				cache: false,
				success: function(html){
					$("ul#results1").html(html);
				}
			});
		}return false;

	}
    function search1() {
        var query_value2 = $('input#searching2').val();
       // alert(query_value2);
        $('b#search-string2').html(query_value2);
        $("#off2").css("display", "block");
        if(query_value2 !== ''){
            $.ajax({
                type: "POST",
                url: "search.php?action=header2",
                data: { query: query_value2 },
                cache: false,
                success: function(html){
                    $("ul#results2").html(html);
                }
            });
        }return false;
    }
	$("input#searching1").live("keyup", function(e) {
       // alert('test');
       // exit;
		// Set Timeout
		clearTimeout($.data(this, 'timer'));
//document.getElementById("off").style.display="block",
		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#results1").fadeOut();
			$('h4#results-text1').fadeOut();
		}else{
			$("ul#results1").fadeIn();
			$('h4#results-text1').fadeIn();
			$(this).data('timer', setTimeout(search, 1));
		};
	});

    $("input#searching2").live("keyup", function(e) {
        // alert('test');
        // exit;
      //  var query_value2 = $('input#searching2').val();
       // alert(query_value2);
       // exit;
        // Set Timeout
        clearTimeout($.data(this, 'timer'));
//document.getElementById("off").style.display="block",
        // Set Search String
        var search_string2 = $(this).val();
        //alert(search_string2);
       // exit;
        // Do Search
        if (search_string2 == '') {
            $("ul#results2").fadeOut();
            $('h4#results-text2').fadeOut();
        }else{
            $("ul#results2").fadeIn();
            $('h4#results-text2').fadeIn();
            $(this).data('timer', setTimeout(search1, 1));
        };
    });

});
</script>
<div id="search">

  <div class="start">
    <div id="flowertabs" class="modernbricksmenu">
      <p>Search</p>
      <ul>
        <li><a id="left" class="selected" href="#" rel="tcontent1">For Sale</a></li>
        <li><a id="right" class="" href="#" rel="tcontent2">To Rent</a></li>
      </ul>
      <div class="clear"></div>
    </div>
	<!---------------------For Sale Search------------------->
    <div id="tcontent1" class="search-from" style="display:none;">
      <form method="post" action="search-property.php?type=sale">
        <input type="text" class="input" name="location" id="searching1" autocomplete="off"> <input type="hidden" class="input" name="locationId" id="searchid1" autocomplete="off">
        <div class="clear"></div>
		<div id="off1">
		<p>*Please use appropriate space for postal code input</p><br />
        <h4 id="results-text1">Showing results for: <b id="search-string1"></b></h4>
        <ul id="results1"> 
        </ul>
		</div>
        <div class="minprice"> Min Price
          <select name="minimum_price">
            <option>No Min</option>
            <?php 
		$i=10000;
		while($num<250000){
		 $num=$num+$i; ?>
            <option value="<?php echo $num?>"><?php echo "&pound; ".number_format($num)?></option>
            <?php } 
		$num1=275000;
		while($num1<=500000){
	
		?>
            <option value="<?php echo $num1?>"><?php echo "&pound; ".number_format($num1)?></option>
            <?php 	$num1=$num1+25000;  } 
		$num2=550000;
		while($num2<=1000000){
		
		?>
            <option value="<?php echo $num2?>"><?php echo "&pound; ".number_format($num2)?></option>
            <?php $num2=$num2+50000;} 
		  $num3=1000000;
		while($num3<=2500000){
		
		?>
            <option value="<?php echo $num3?>"><?php echo "&pound; ".number_format($num3)?></option>
            <?php $num3=$num3+100000;}
		   $num4=2750000;
		while($num4<=5000000){
		
		?>
            <option value="<?php echo $num4?>"><?php echo "&pound; ".number_format($num4)?></option>
            <?php $num4=$num4+25000;} 
		  $num5=5500000;
		while($num5<=10000000){
		
		?>
            <option value="<?php echo $num5?>"><?php echo "&pound; ".number_format($num5)?></option>
            <?php $num5=$num5+500000;} ?>
            <option value="12500000"><?php echo "&pound; 12,500,000"?></option>
            <option value="15000000"><?php echo "&pound; 15,000,000"?>
            <option>
          </select>
        </div>
        <div class="minprice"> Max Price
          <select name="maximum_price">
            <option>No Max</option>
            <?php 
		$i=10000;
		/*Line of code added By Akash $num=0 to again initialise it with 0*/
		$num=0;
		while($num<250000){
		 $num=$num+$i; ?>
            <option value="<?php echo $num?>"><?php echo "&pound; ".number_format($num)?></option>
            <?php } 
		$num1=275000;
		while($num1<=500000){
	
		?>
            <option value="<?php echo $num1?>"><?php echo "&pound; ".number_format($num1)?></option>
            <?php 	$num1=$num1+25000;  } 
		$num2=550000;
		while($num2<=1000000){
		
		?>
            <option value="<?php echo $num2?>"><?php echo "&pound; ".number_format($num2)?></option>
            <?php $num2=$num2+50000;} 
		  $num3=1000000;
		while($num3<=2500000){
		
		?>
            <option value="<?php echo $num3?>"><?php echo "&pound; ".number_format($num3)?></option>
            <?php $num3=$num3+100000;}
		   $num4=2750000;
		while($num4<=5000000){
		
		?>
            <option value="<?php echo $num4?>"><?php echo "&pound; ".number_format($num4)?></option>
            <?php $num4=$num4+25000;} 
		  $num5=5500000;
		while($num5<=10000000){
		
		?>
            <option value="<?php echo $num5?>"><?php echo "&pound; ".number_format($num5)?></option>
            <?php $num5=$num5+500000;} ?>
            <option value="12500000"><?php echo "&pound; 12,500,000"?></option>
            <option value="15000000"><?php echo "&pound; 15,000,000"?></option>
          </select>
        </div>
        <div class="minprice"> Type
          <select class="select" name="property_type"  >
            <?php

$strParentProperty=dbQuery("select * from property_category where property_category_parent_id=0") ;
while($rsPro=dbFetchArray($strParentProperty)){
?>
            <optgroup label="<?php echo $rsPro["property_category_name"]?>" style="background-color:#ccff6a;"></optgroup>
            <?php

$strProperty=dbQuery("select * from property_category where property_category_parent_id='".$rsPro['property_category_id']."'") ;
while($rsProperty=dbFetchArray($strProperty)){
?>
            <option <?php if($row["property_category_id"]==$rsProperty["property_category_id"]){ ?> selected="selected" <?php } ?> value="<?php echo $rsProperty["property_category_id"]?>"><?php echo $rsProperty["property_category_name"]?></option>
            <?php } } ?>
          </select>
        </div>
        <div class="minprice"> Bedrooms
          <select name="bedroom">
            <option value="" selected="selected">No min</option>
            <option value="0">Studio+</option>
            <option value="1">1+</option>
            <option value="2">2+</option>
            <option value="3">3+</option>
            <option value="4">4+</option>
            <option value="5">5+</option>
            <option value="6">6+</option>
            <option value="7">7+</option>
            <option value="8">8+</option>
            <option value="9">9+</option>
            <option value="10">10+</option>
          </select>
    
        </div>
        <div class="minprice"> Bathrooms
          <select name="bathroom">
            <option value="" selected="selected">No min</option>
            <option value="0">Studio+</option>
            <option value="1">1+</option>
            <option value="2">2+</option>
            <option value="3">3+</option>
            <option value="4">4+</option>
            <option value="5">5+</option>
            <option value="6">6+</option>
            <option value="7">7+</option>
            <option value="8">8+</option>
            <option value="9">9+</option>
            <option value="10">10+</option>
         
          </select>
        </div>
        <div class="more"><a href="#" rel="toggle[dog]" data-openimage="fewer.png" data-closedimage="more.png"><img src="more.png" border="0" /></a> </div>
        <div id="dog" class="rest-form">  <span>Distance from location</span>
          <select class="select" name="radius">
            <option>This area only</option>
            <option value="">This area only</option>
            <option value="0.25">Within 0.25 mile</option>
            <option value="0.5">Within 0.5 mile</option>
            <option value="1">Within 1 mile</option>
            <option value="3">Within 3 miles</option>
            <option value="5">Within 5 miles</option>
            <option value="10">Within 10 miles</option>
            <option value="15">Within 15 miles</option>
            <option value="20">Within 20 miles</option>
            <option value="30">Within 30 miles</option>
            <option value="40">Within 40 miles</option>
          </select>
          <div class="height"></div>
          <span>Added</span>
          <select class="select2" name="posting">
            <option value="">Anytime</option>
            <option value="1">Last 24 hours</option>
            <option value="3">Last 3 days</option>
            <option value="7">Last 7 days</option>
            <option value="14">Last 14 days</option>
            <option value="30">Last 30 days</option>
          </select>
          <span> Sort by</span>
          <select class="select2" name="shorting" style="margin:0px;">
            <option value="highest_price">Highest price</option>
            <option value="lowest_price">Lowest price</option>
            <option value="newest_listings" selected="&quot;selected&quot;">Most recent</option>
            
          </select>
          <div class="height"></div>
          <span>Keywords</span>
          <input type="text" name="keywords" placeholder="e.g. 'garden' or 'wood floors'"class="input2" />
          <div class="height"></div>
         
        </div>
        <input type="submit" name="" class="search-botton" value="" />
        <div class="clear"></div>
      </form>
    </div>
	<!------------------------For Rent Search---------------------->
    <div id="tcontent2" class="search-from" style="display:none;">
      <form method="get" action="search-property.php?type=sale">
        <input type="text" class="input" name="location" id="searching2" autocomplete="off"> <input type="hidden" class="input" name="locationId" id="searchid2" autocomplete="off">
        <div class="clear"></div>
   <div id="off2">
   <p>*Please use appropriate space for postal code input</p><br />
        <h4 id="results-text2">Showing results for: <b id="search-string2"></b></h4>
        <ul id="results2">
        </ul>
		</div>
        <div class="minprice"> Min Price
          <select name="minimum_price">
            <option>No Min</option>
            <?php 
		$i=10000;
		$num=0;
		while($num<250000){
		 $num=$num+$i; ?>
            <option value="<?php echo $num?>"><?php echo "&pound; ".number_format($num)?></option>
            <?php } 
		$num1=275000;
		while($num1<=500000){
	
		?>
            <option value="<?php echo $num1?>"><?php echo "&pound; ".number_format($num1)?></option>
            <?php 	$num1=$num1+25000;  } 
		$num2=550000;
		while($num2<=1000000){
		
		?>
            <option value="<?php echo $num2?>"><?php echo "&pound; ".number_format($num2)?></option>
            <?php $num2=$num2+50000;} 
		  $num3=1000000;
		while($num3<=2500000){
		
		?>
            <option value="<?php echo $num3?>"><?php echo "&pound; ".number_format($num3)?></option>
            <?php $num3=$num3+100000;}
		   $num4=2750000;
		while($num4<=5000000){
		
		?>
            <option value="<?php echo $num4?>"><?php echo "&pound; ".number_format($num4)?></option>
            <?php $num4=$num4+25000;} 
		  $num5=5500000;
		while($num5<=10000000){
		
		?>
            <option value="<?php echo $num5?>"><?php echo "&pound; ".number_format($num5)?></option>
            <?php $num5=$num5+500000;} ?>
            <option value="12500000"><?php echo "&pound; 12,500,000"?></option>
            <option value="15000000"><?php echo "&pound; 15,000,000"?>
            <option>
          </select>
        </div>
        <div class="minprice"> Max Price
          <select name="maximum_price">
            <option>No Max</option>
            <?php 
		$i=10000;
		$num=0;
		while($num<250000){
		 $num=$num+$i; ?>
            <option value="<?php echo $num?>"><?php echo "&pound; ".number_format($num)?></option>
            <?php } 
		$num1=275000;
		while($num1<=500000){
	
		?>
            <option value="<?php echo $num1?>"><?php echo "&pound; ".number_format($num1)?></option>
            <?php 	$num1=$num1+25000;  } 
		$num2=550000;
		while($num2<=1000000){
		
		?>
            <option value="<?php echo $num2?>"><?php echo "&pound; ".number_format($num2)?></option>
            <?php $num2=$num2+50000;} 
		  $num3=1000000;
		while($num3<=2500000){
		
		?>
            <option value="<?php echo $num3?>"><?php echo "&pound; ".number_format($num3)?></option>
            <?php $num3=$num3+100000;}
		   $num4=2750000;
		while($num4<=5000000){
		
		?>
            <option value="<?php echo $num4?>"><?php echo "&pound; ".number_format($num4)?></option>
            <?php $num4=$num4+25000;} 
		  $num5=5500000;
		while($num5<=10000000){
		
		?>
            <option value="<?php echo $num5?>"><?php echo "&pound; ".number_format($num5)?></option>
            <?php $num5=$num5+500000;} ?>
            <option value="12500000"><?php echo "&pound; 12,500,000"?></option>
            <option value="15000000"><?php echo "&pound; 15,000,000"?></option>
          </select>
        </div>
        <div class="minprice"> Type
          <select class="select" name="property_type"  >
            <?php

$strParentProperty=dbQuery("select * from property_category where property_category_parent_id=0") ;
while($rsPro=dbFetchArray($strParentProperty)){
?>
            <optgroup label="<?php echo $rsPro["property_category_name"]?>" style="background-color:#ccff6a;"></optgroup>
            <?php

$strProperty=dbQuery("select * from property_category where property_category_parent_id='".$rsPro['property_category_id']."'") ;
while($rsProperty=dbFetchArray($strProperty)){
?>
            <option <?php if($row["property_category_id"]==$rsProperty["property_category_id"]){ ?> selected="selected" <?php } ?> value="<?php echo $rsProperty["property_category_id"]?>"><?php echo $rsProperty["property_category_name"]?></option>
            <?php } } ?>
          </select>
        </div>
        <div class="minprice"> Bedrooms
          <select name="bedroom">
            <option value="" selected="selected">No min</option>
            <option value="0">Studio+</option>
            <option value="1">1+</option>
            <option value="2">2+</option>
            <option value="3">3+</option>
            <option value="4">4+</option>
            <option value="5">5+</option>
            <option value="6">6+</option>
            <option value="7">7+</option>
            <option value="8">8+</option>
            <option value="9">9+</option>
            <option value="10">10+</option>
          </select>
          </select>
        </div>
        <div class="minprice"> Bathrooms
          <select name="bathroom">
            <option value="" selected="selected">No min</option>
            <option value="0">Studio+</option>
            <option value="1">1+</option>
            <option value="2">2+</option>
            <option value="3">3+</option>
            <option value="4">4+</option>
            <option value="5">5+</option>
            <option value="6">6+</option>
            <option value="7">7+</option>
            <option value="8">8+</option>
            <option value="9">9+</option>
            <option value="10">10+</option>
          </select>
          </select>
        </div>
        <div class="more"><a href="#" rel="toggle[cat]" data-openimage="fewer.png" data-closedimage="more.png"><img src="more.png" border="0" /></a> </div>
        <div id="cat" class="rest-form">  <span>Distance from location</span>
          <select class="select" name="radius">
            <option>This area only</option>
            <option value="">This area only</option>
            <option value="0.25">Within 0.25 mile</option>
            <option value="0.5">Within 0.5 mile</option>
            <option value="1">Within 1 mile</option>
            <option value="3">Within 3 miles</option>
            <option value="5">Within 5 miles</option>
            <option value="10">Within 10 miles</option>
            <option value="15">Within 15 miles</option>
            <option value="20">Within 20 miles</option>
            <option value="30">Within 30 miles</option>
            <option value="40">Within 40 miles</option>
          </select>
          <div class="height"></div>
          <span>Added</span>
          <select class="select2" name="posting">
            <option value="">Anytime</option>
            <option value="1">Last 24 hours</option>
            <option value="3">Last 3 days</option>
            <option value="7">Last 7 days</option>
            <option value="14">Last 14 days</option>
            <option value="30">Last 30 days</option>
          </select>
          <span> Sort by</span>
          <select class="select2" name="shorting" style="margin:0px;">
            <option value="highest_price">Highest price</option>
            <option value="lowest_price">Lowest price</option>
            <option value="newest_listings" selected="&quot;selected&quot;">Most recent</option>
            
          </select>
          <div class="height"></div>
          <span>Keywords</span>
          <input type="text" name="keywords" placeholder="e.g. 'garden' or 'wood floors'"class="input2" />
          <div class="height"></div>
          <h2>Include</h2>
          <div class="include">
            <p>
              <input type="checkbox" name="" />
              New homes </p>
            <p>
              <input type="checkbox" name="" />
              Retirement homes</p>
          </div>
          <div class="include">
            <p>
              <input type="checkbox" name="" />
              Shared ownership homes </p>
            <p>
              <input type="checkbox" name="" />
              Under offer or sold STC </p>
          </div>
        </div>
        <input type="submit" name="" class="search-botton" value="" />
        <div class="clear"></div>
      </form>
    </div>
    <script type="text/javascript">

var myflowers=new ddtabcontent("flowertabs")
myflowers.setpersist(true)
myflowers.setselectedClassTarget("link") //"link" or "linkparent"
myflowers.init()
</script>
    <div class="clear"></div>
  </div>
</div>
