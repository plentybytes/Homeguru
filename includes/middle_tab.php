  <div class="tab">
      <h4>Home buying news</h4>
    <ul id="middlenews">
	  <?php /*$buyNews=dbQuery("select * from  buy_news where buy_news_status='Yes' order by buy_news_id DESC limit 0,5");
  		while($resultBuyNews=dbFetchArray($buyNews)){*/
  ?>
   
   
   
   <?php
		//echo'<iframe height="500" width="500" src="http://www.propertywire.com/news/"></iframe>';
		
	
		
		$url = 'https://www.estateagenttoday.co.uk/';
		$content = file_get_contents($url);
		$first_step = explode( '<ul class="list-group col-sm-6">' , $content );
		$second_step = explode("</ul>" , $first_step[1] );
		
		
		$third_step = explode('<li data-slide-to="0" class="list-group-item" style="height: 76px;">' , $second_step[0] );
		
		$html='';
		$correct_text= str_replace('<h2>', '<p>',$third_step[0] );
		$correct_text= str_replace('</h2>', '</p>',$correct_text );
		$correct_text= preg_replace('/<h5>(.*?)<\/h5>/s', $html, $correct_text);
		$correct_text= preg_replace('/<li(.*?)>/s', '<li>', $correct_text);
		$final_step = explode('<li>' , $correct_text );
		//echo $final_step;
		//print_r ($third_step);
		echo "<li>";
		echo $final_step[1];
		
		echo "<li>";
		echo $final_step[2];
		
		echo "<li>";
		echo $final_step[3];
		
		

	?>
   
   
   
   
   
 <!--<li><a href="news-details.php?source=<?php //echo $resultBuyNews["buy_news_id"]?> "><?php //echo substr($resultBuyNews["buy_news_title"],0,100)?></a> <span>Posted: <?php //echo date('M j , Y', strtotime($resultBuyNews["buy_news_created"]));?></span> </li>-->
    <?php// } ?>
     <!-- Coded by Akash to display the news on home page from another site(http://www.propertywire.com/news/)-->
	
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       
            $.ajax({
                type: 'GET',
                url: 'includes/middle_tab_first_content.php',
                data: 'Loading...',
                success: function(e){
                    $('ul#middlenews').html(e);
                }
            });
        
    });
</script>-->
   
	</ul>
    </div>
    
<div class="tab" style="overflow: hidden;">
  <h4>Home buying</h4>
 
    <!--<p><a href="#">How can I find council tax bands? </a><br />
      <strong>Asked on Mar 21 2013,</strong> <span><a href="#">General in Dunstable</a></span></p>
    <p><a href="#">How can I find council tax bands? </a><br />
      <strong>Asked on Mar 21 2013,</strong> <span><a href="#">General in Dunstable</a></span></p>
    
	<p><a href="#">How can I find council tax bands? </a><br />
      <strong>Asked on Mar 21 2013,</strong> <span><a href="#">General in Dunstable</a></span></p>-->
	  <div style="overflow:hidden; height: 160px;"><a class="twitter-timeline" href="https://twitter.com/epromotional" data-widget-id="324786565907877888">Tweets by @epromotional</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>
</div>
    

    </div>
    
<div class="tab2">
  <h4>Newly listed properties for sale</h4>
  
  <?php $proForSale=dbQuery("select * from  property where property_transaction_type='sell' and property_type='New' order by property_id DESC limit 0,3");
  		while($resultProperty=dbFetchArray($proForSale)){
  
  		$proImage=dbFetchArray(dbQuery("select * from property_images where property_id='".$resultProperty["property_id"]."' and property_file_type='image'  order by property_image_id DESC limit 0,1"));
	?>
    
<p><?php if($proImage["property_images"]!=''){?>
<img src="images/property_images/<?php echo $proImage["property_images"];?>" alt="" width="50" height="38" /><?php } else{ ?><img src="images/img1.jpg" alt="" width="50" height="38" />
<?php } ?> <strong>&pound; <?php echo $resultProperty["property_total_price"]?> </strong> - <?php echo $resultProperty["property_bedrooms"]?> bedroom flat &nbsp; &nbsp; <span class="blink_me" style="color:red;">NEW</span><br />
  <a href="#"><?php echo showLocality($resultProperty["city_id"])?>,<?php echo showCounty($resultProperty["state_id"])?></a></p>
      <?php } ?>

    </div>
    <div class="clear"></div>