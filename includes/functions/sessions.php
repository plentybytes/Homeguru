<?php
	function sessionStart(){
    global $_GET, $_POST, $_COOKIE;
    $sessionId=true;

    if(isset($_GET[sessionName()])){
      if(preg_match('/^[a-zA-Z0-9]+$/', $_GET[sessionName()])==false){
        unset($_GET[sessionName()]);
        $sessionId=false;
      }
    }elseif(isset($_POST[sessionName()])){
      if (preg_match('/^[a-zA-Z0-9]+$/', $_POST[sessionName()])==false) {
        unset($_POST[sessionName()]);
        $sessionId=false;
      }
    }elseif(isset($_COOKIE[sessionName()])){
      if(preg_match('/^[a-zA-Z0-9]+$/', $_COOKIE[sessionName()])==false){
        $sessionData=session_get_cookie_params();
        setcookie(sessionName(), '', time()-42000, $sessionData['path'], $sessionData['domain']);
        $sessionId=false;
      }
    }
    if($sessionId==false){
      redirect(hrefLink("index.php", "", "NONSSL"));
    }
    return session_start();
  }
	function sessionName($name="") {
    if($name!=""){
      return session_name($name);
    }else{
      return session_name();
    }
  }
	function sessionRegister($variable, $value=""){
		if(isset($value)){
			$_SESSION[$variable]=$value;
		}else{
			$_SESSION[$variable]=NULL;
		}
	}
	function isSessionRegistered($variable){
		if(isset($_SESSION) && array_key_exists($variable, $_SESSION)){
			return true;
		}else{
			return false;
		}
	}
	function sessionUnregister($variable){
		unset($_SESSION[$variable]);
	}
	function sessionDestroy(){
		return session_destroy();
	}
?>