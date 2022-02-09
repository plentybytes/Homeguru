<?php
	function setCookies($name, $value, $expire=0, $secure=false, $httponly=false){
	$path=COOKIE_PATH;
	$domain=COOKIE_DOMAIN;
	if($expire==0) $expire=time()+60*60*24;
		setcookie($name, $value, (int)$expire, $path, $domain, $secure, $httponly);
	}
	function deleteCookies($name){
		$path=COOKIE_PATH;
		$domain=COOKIE_DOMAIN;
		$expire=time()-60*60*24;
		setcookie($name, '', $expire, $path, $domain);
	}
?>