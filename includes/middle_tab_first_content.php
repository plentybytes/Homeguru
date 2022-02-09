<?php
		//echo'<iframe height="500" width="500" src="http://www.propertywire.com/news/"></iframe>';
		
	
		
		$url = 'http://www.propertywire.com/news/';
		$content = file_get_contents($url);
		$first_step = explode( '<ul class="latestnews">' , $content );
		$second_step = explode("</ul>" , $first_step[1] );
		
		
		$third_step = explode('<li class="latestnews">' , $second_step[0] );
		
		//echo $second_step[0];
		//print_r ($third_step);
		echo '<li class="latestnews">';
		echo $third_step[1];
		echo("<br>");
		echo '<li class="latestnews">';
		echo $third_step[2];
		echo("<br>");
		echo '<li class="latestnews">';
		echo $third_step[3];
		
		

	?>