<?php

		function isNull($value){
		if(($value != "") && (strtolower($value) != "null") && (strlen(trim($value)) > 0)){
			return false;
		}else{
			return true;
		}
	}
	function inArray($array, $value){
		if(in_array($value, $array)){
			return true;
		}else{
			return false;
		}
	}
	function isEmail($email){
		$email=trim($email);
		$validEmail=false;
		if(strlen($email) > 255){
			$validEmail=false;
		}else{
			if(substr_count( $email, "@" ) > 1 ){
				$validEmail=false;
			}
			if(preg_match("/[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i", $email)){
				$validEmail=true;
			}else{
				$validEmail=false;
			}
		}
		return $validEmail;
	}
	function parseInputFieldData($data, $parse){
    return strtr(trim($data), $parse);
  }
	function outputString($string, $protected=false){
		if($protected==true){
			return htmlspecialchars($string);
		}else{
			return parseInputFieldData($string, array('"' => '&quot;'));
		}
	}
	
	function sanitizeString($string){
    $patterns=array ('/ +/','/[<>]/');
    $replace=array (' ', '_');
    return preg_replace($patterns, $replace, trim($string));
  }
	function hrefLink($page="", $parameters="", $connection="NONSSL"){
		if(isNull($page)){
			die("<div><font color=\"#ff0000\"><b>Error!</b></font><br><br><b>Unable to determine the page link!<div>");
		}
		
		if($connection=="NONSSL"){
			$link=HTTP_SERVER.APP_DIR;
		}elseif($connection=="SSL"){
			if(ENABLE_SSL==true){
				$link=HTTPS_SERVER.APP_DIR;
			}else{
				$link=HTTP_SERVER.APP_DIR;
			}
		}else{
			die("<div><font color=\"#ff0000\"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL</b></div>");
		}
		
		if(!isNull($parameters)){
			$link.=$page . '?' . outputString($parameters);
			$separator='&';
		}else{
			$link.=$page;
			$separator='?';
		}
		while((substr($link, -1)=="&") || (substr($link, -1)=="?")) $link=substr($link, 0, -1);
		return $link;
	}
	function redirect($url){
		if((strstr($url, "\n")!=false) || (strstr($url, "\r")!=false)){ 
			redirect(hrefLink("index.php", "", "NONSSL", false));
		}
		if((ENABLE_SSL==true) && (getenv('HTTPS')=="on")){
			if(substr($url, 0, strlen(HTTP_SERVER))==HTTP_SERVER){
				$url=HTTPS_SERVER . substr($url, strlen(HTTP_SERVER));
			}
		}
		header("location: ".$url);
		exit();
	}
	function getPagingLink($sql, $itemPerPage=10, $strGet="", $pageHolder="page", $adminDir=true){
		global $_GET, $_POST;
		$result=dbQuery($sql);
		$pagingLink="";
		$totalResults=dbNumRows($result);
		$totalPages=ceil($totalResults / $itemPerPage);
		
		$numLinks=15;
	
		if(isset($_GET[$pageHolder])){
			$pageNumber=$_GET[$pageHolder];
		}elseif(isset($_POST[$pageHolder])){
			$pageNumber=$_POST[$pageHolder];
		}else{
			$pageNumber="";
		}
	
		if(empty($pageNumber) || !is_numeric($pageNumber)) $pageNumber=1;
			
		if($totalPages > 0){
			$currentPage=basename($_SERVER['PHP_SELF']);
			if($adminDir) $currentPage=APP_ADMIN_DIR.$currentPage;
		
			if(!isNull($strGet) && (substr($strGet, -1)!="&") ) $strGet.="&";
			
			if($pageNumber > 1){
				$page=$pageNumber - 1;
				if($page > 1){
					$prev="<a href='".hrefLink($currentPage, $strGet.$pageHolder."=".$page)."'>&lt; Prev</a>";
				}else{
					$prev="<a href='".hrefLink($currentPage, $strGet.$pageHolder."=1")."'>&lt; Prev</a>";
				}	
				$first="<a href='".hrefLink($currentPage, $strGet.$pageHolder."=1")."'>&lt;&lt; First</a>";
			}else{
				$prev="<span class='disabled'>&lt; Prev</span>";
				$first="<span class='disabled'>&lt;&lt; First</span>";
			}
		
			if($pageNumber < $totalPages){
				$page=$pageNumber + 1;
				$next="<a href='".hrefLink($currentPage, $strGet.$pageHolder."=".$page)."'>Next &gt;</a>";
				$last="<a href='".hrefLink($currentPage, $strGet.$pageHolder."=".$totalPages)."'>Last &gt;&gt;</a>";
			}else{
				$next="<span class='disabled'>Next &gt;</span>";
				$last="<span class='disabled'>Last &gt;&gt;</span>";
			}
	
			$start=$pageNumber - ($pageNumber % $numLinks) + 1;
			$end=$start + $numLinks - 1;		
			
			$end=min($totalPages, $end);
			
			$pagingLink=array();
			for($page=$start; $page<=$end; $page++){
				if($page==$pageNumber){
					$pagingLink[]="<span class=\"current\">". $page."</span>";
				}else{
					if($pag==1){
						$pagingLink[]="<a href='".hrefLink($currentPage, $strGet.$pageHolder."=1")."'>".$page."</a>";
					}else{	
						$pagingLink[]="<a href='".hrefLink($currentPage, $strGet.$pageHolder."=".$page)."'>".$page."</a>";
					}	
				}
		
			}
			
			$pagingLink=implode(" ", $pagingLink);
			$pagingLink=$first.$prev.$pagingLink.$next.$last;
		}
		return $pagingLink;
	}
	function getPagingQuery($sql, $itemPerPage=10, $pageHolder="page"){
		global $_GET;
		if(isset($_GET[$pageHolder])){
			$page=(int)$_GET[$pageHolder];
		}else{
			$page=1;
		}
		
		$offset=($page - 1) * $itemPerPage;
		return $sql." LIMIT ".$offset.", ".$itemPerPage;
	}
	function getAllGetParams($excludeArray=''){
		global $_GET;
		if(!is_array($excludeArray)) $excludeArray=array();
		$getUrl="";
		if(is_array($_GET) && (sizeof($_GET) > 0)){
			reset($_GET);
			while(list($key, $value)=each($_GET)){
				if(is_string($value) && (strlen($value) > 0) && ($key != 'error') && (!in_array($key, $excludeArray)) && ($key != 'x') && ($key != 'y')){
					$getUrl.=$key . '=' . rawurlencode(stripslashes($value)) . '&';
				}
			}
		}
		return $getUrl;
	}
  function isWritable($file){
    if(strtolower(substr(PHP_OS, 0, 3))==="win"){
      if(file_exists($file)){
        $file=realpath($file);
        if(is_dir($file)){
          $result=@tempnam($file, "cmg");
          if(is_string($result) && file_exists($result)){
            unlink($result);
            return (strpos($result, $file) === 0) ? true : false;
          }
        }else{
          $handle=@fopen($file, "r+");
          if(is_resource($handle)){
            fclose($handle);
            return true;
          }
        }
      }else{
        $dir=dirname($file);
        if(file_exists($dir) && is_dir($dir) && isWritable($dir)){
          return true;
        }
      }
      return false;
    }else{
      return is_writable($file);
    }
  }
	function createRandomValue($length, $type="mixed"){
    if(($type!="mixed") && ($type!="chars") && ($type!="digits")) return false;

    $randomValue="";
    while(strlen($randomValue) < $length){
      if($type=="digits"){
        $char=randomValue(0,9);
      }else{
        $char=chr(randomValue(0,255));
      }
      if($type=="mixed"){
        if(preg_match("/^[a-z0-9]$/i", $char)) $randomValue.=$char;
      }elseif($type=="chars"){
        if(preg_match("/^[a-z]$/i", $char)) $randomValue.=$char;
      }elseif($type=="digits"){
        if(preg_match("/^[0-9]$/i", $char)) $randomValue.=$char;
      }
    }

    return $randomValue;
  }
	
	function randomValue($min=NULL, $max=NULL){
    static $seeded;

    if(!isset($seeded)){
      mt_srand((double)microtime()*1000000);
      $seeded=true;
    }

    if(isset($min) && isset($max)){
      if($min>=$max){
        return $min;
      }else{
        return mt_rand($min, $max);
      }
    }else{
      return mt_rand();
    }
  }
	//cookie (en/de)crypt
	function persistentCookieEncryptDecrypt($cString, $cAction, $cType=""){
		//(en/de)crypt key
		if(!empty($cType) && ($cType=="password"))
			$endeKey="PWD^CMG@PC#ED*PWD";
		else
			$endeKey="ID*CMG@P#CED^ID";
		//(en/de)crypt
		if(!empty($cString)){
			if($cAction=="encrypt"){
				return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($endeKey), $cString, MCRYPT_MODE_CBC, md5(md5($endeKey))));
			}elseif($cAction=="decrypt"){
				return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($endeKey), base64_decode($cString), MCRYPT_MODE_CBC, md5(md5($endeKey))), "\0");
			}
		}
	}
  function convertLinefeeds($from, $to, $string){
    if((PHP_VERSION < "4.0.5") && is_array($from)){
      return preg_replace('/(' . implode('|', $from) . ')/', $to, $string);
    }else{
      return str_replace($from, $to, $string);
    }
  }
  function sendMail($toName, $toEmailAddress, $emailSubject, $emailText, $fromEmailName, $fromEmailAddress){
    $message=new email(array("X-Mailer: SlickCasting"));

    $text=strip_tags($emailText);
    if(EMAIL_USE_HTML == "true"){
      $message->addHtml($emailText, $text);
    }else{
      $message->addText($text);
    }

    $message->buildMessage();
    $message->send($toName, $toEmailAddress, $fromEmailName, $fromEmailAddress, $emailSubject);
  }
	

  function parseSearchString($searchStr="", &$objects){
    $searchStr=trim(strtolower($searchStr));

    $pieces=preg_split('/[[:space:]]+/', $searchStr);
    $objects=array();
    $tmpstring='';
    $flag='';

    for($k=0; $k<count($pieces); $k++){
      while(substr($pieces[$k], 0, 1) == '('){
        $objects[]='(';
        if(strlen($pieces[$k]) > 1){
          $pieces[$k]=substr($pieces[$k], 1);
        }else{
          $pieces[$k]='';
        }
      }

      $postObjects=array();

      while(substr($pieces[$k], -1) == ')'){
        $postObjects[]=')';
        if(strlen($pieces[$k]) > 1){
          $pieces[$k]=substr($pieces[$k], 0, -1);
        }else{
          $pieces[$k]='';
        }
      }

      if((substr($pieces[$k], -1) != '"') && (substr($pieces[$k], 0, 1) != '"')){
        $objects[]=trim($pieces[$k]);

        for($j=0; $j<count($postObjects); $j++){
          $objects[]=$postObjects[$j];
        }
      }else{
        $tmpstring=trim(preg_replace('/"/', ' ', $pieces[$k]));

        if(substr($pieces[$k], -1 ) == '"'){
          $flag='off';
          $objects[]=trim(preg_replace('/"/', ' ', $pieces[$k]));

          for($j=0; $j<count($postObjects); $j++){
            $objects[]=$postObjects[$j];
          }
          unset($tmpstring);
          continue;
        }

        $flag='on';
        $k++;

        while(($flag == 'on') && ($k < count($pieces))){
          while(substr($pieces[$k], -1) == ')'){
            $postObjects[]=')';
            if(strlen($pieces[$k]) > 1){
              $pieces[$k]=substr($pieces[$k], 0, -1);
            }else{
              $pieces[$k]='';
            }
          }

          if(substr($pieces[$k], -1) != '"'){
            $tmpstring.=' ' . $pieces[$k];
            $k++;
            continue;
          }else{
            $tmpstring.=' ' . trim(preg_replace('/"/', ' ', $pieces[$k]));
            $objects[]=trim($tmpstring);

            for($j=0; $j<count($postObjects); $j++){
              $objects[]=$postObjects[$j];
            }

            unset($tmpstring);
            $flag='off';
          }
        }
      }
    }

    $temp=array();
    for($i=0; $i<(count($objects)-1); $i++){
      $temp[]=$objects[$i];
      if(($objects[$i] != 'and') &&
           ($objects[$i] != 'or') &&
           ($objects[$i] != '(') &&
           ($objects[$i+1] != 'and') &&
           ($objects[$i+1] != 'or') &&
           ($objects[$i+1] != ')') ){
        $temp[]='and';
      }
    }
    $temp[]=$objects[$i];
    $objects=$temp;

    $keywordCount=0;
    $operatorCount=0;
    $balance=0;
    for($i=0; $i<count($objects); $i++){
      if($objects[$i] == '(') $balance--;
      if($objects[$i] == ')') $balance++;
      if(($objects[$i] == 'and') || ($objects[$i] == 'or')){
        $operatorCount ++;
      }elseif(($objects[$i]) && ($objects[$i] != '(') && ($objects[$i] != ')')){
        $keywordCount++;
      }
    }

    if(($operatorCount < $keywordCount) && ($balance == 0)){
      return true;
    }else{
      return false;
    }
  }
	function getVisitorIp(){
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $theIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else $theIp=$_SERVER['REMOTE_ADDR'];
		return trim($theIp);
	}
	
	function checkDuplicateEMail($email){
		$subscriberCheck=dbQuery("SELECT user_email FROM user WHERE user_email='".$email."'");
		
		if(dbNumRows($subscriberCheck) == 0){
			return true;
		}else{
			return false;
		}
	}
	function checkDuplicateUserName($userName){
		$subscriberCheck=dbQuery("SELECT user_name FROM user WHERE user_name='".$userName."'");
		
		if(dbNumRows($subscriberCheck) == 0){
			return true;
		}else{
			return false;
		}
	}
	
function getCountries($selected=""){
		$listCountries="";
		$countries = dbQuery("select countries_name, countries_id,countries_image from countries order by countries_name");  
		while ($countries_values = dbFetchArray($countries)) {
		
		$listCountries.="<option value=\"".$countries_values['countries_id']."\"".((strtolower($selected) == strtolower($countries_values['countries_id'])) ? " selected=\"selected\"" : "").">".$countries_values['countries_name']."</option>";
		}
	
		return $listCountries;
		}
/*Root Pagination*/
function getPaging($sql, $itemPerPage=10, $strGet="", $pageHolder="page", $rootDir=true){
		global $_GET, $_POST;
		$result=dbQuery($sql);
		$pagingLink1="";
		$totalResults=dbNumRows($result);
		$totalPages=ceil($totalResults / $itemPerPage);
		
		$numLinks=15;
	
		if(isset($_GET[$pageHolder])){
			$pageNumber=$_GET[$pageHolder];
		}elseif(isset($_POST[$pageHolder])){
			$pageNumber=$_POST[$pageHolder];
		}else{
			$pageNumber="";
		}
	
		if(empty($pageNumber) || !is_numeric($pageNumber)) $pageNumber=1;
			
		if($totalPages > 0){
			$currentPage=basename($_SERVER['PHP_SELF']);
			if($rootDir) $currentPage=$currentPage;
		
			if(!isNull($strGet) && (substr($strGet, -1)!="&") ) $strGet.="&";
			
			if($pageNumber > 1){
				$page=$pageNumber - 1;
				if($page > 1){
					$prev="<pre><a href='".hrefLink($currentPage, $strGet.$pageHolder."=".$page)."'>&laquo; previous </a></pre>";
				}else{
					$prev="<pre><a href='".hrefLink($currentPage, $strGet.$pageHolder."=1")."'>&laquo; previous  </a></pre>";
				}	
				//$first="<a href='".hrefLink($currentPage, $strGet.$pageHolder."=1")."'>&lt;&lt; First</a>";
			}else{
				$prev="<span class='disabled'>&laquo; previous</span>";


				//$first="<span class='disabled'>&lt;&lt; First</span>";
			}
		
			if($pageNumber < $totalPages){
				$page=$pageNumber + 1;
				$next="<pre><a href='".hrefLink($currentPage, $strGet.$pageHolder."=".$page)."'>Next &raquo;</a></pre>";
				//$last="<a href='".hrefLink($currentPage, $strGet.$pageHolder."=".$totalPages)."'>Last &gt;&gt;</a>";
			}else{
				$next="<span class='disabled'>Next &raquo;</span>";
				//$last="<span class='disabled'>Last &gt;&gt;</span>";
			}
	
			$start=$pageNumber - ($pageNumber % $numLinks) + 1;
			$end=$start + $numLinks - 1;		
			
			$end=min($totalPages, $end);
			
			$pagingLink1=array();
			for($page=$start; $page<=$end; $page++){
				if($page==$pageNumber){
					$pagingLink1[]="<span class=\"current\">". $page."</span>";
				}else{
					if($pag==1){
						$pagingLink1[]="<pre><a href='".hrefLink($currentPage, $strGet.$pageHolder."=1")."'>".$page."</a></pre>";
					}else{	
						$pagingLink1[]="<pre><a href='".hrefLink($currentPage, $strGet.$pageHolder."=".$page)."'>".$page."</a></pre>";
					}	
				}
		
			}
			
			$pagingLink1=implode(" ", $pagingLink1);
			$pagingLink1=$first.$prev.$pagingLink1.$next.$last;
		}
		return $pagingLink1;
	}
	
	function getPagingQueries($sql, $itemPerPage=10, $pageHolder="page"){
		global $_GET;
		if(isset($_GET[$pageHolder])){
			$page=(int)$_GET[$pageHolder];
		}else{
			$page=1;
		}
		
		$offset=($page - 1) * $itemPerPage;
		return $sql." LIMIT ".$offset.", ".$itemPerPage;
	}

function  showHearAboutUs($value=""){

$aboutUs = array("1" => "Friend" ,"TV ad","Online ad","Magazine ad","Radio ad","Football sponsorship","Taxi ad","Press article","Search engine","Another website","Estate agent","Other");
		if($value!=''){
		$checkAboutUs=$aboutUs[$value];
		}else{
		$checkAboutUs=$aboutUs;
		}
		
		return $checkAboutUs;
	}
	function  showAmenties($value=""){

$amenties = array("Power Backup" ,"Lift","Rain Water Harvesting","Club","Swimming Pool","Security","Reserved Parking","Gym","Servant Quarters","Park","Vaastu Compliant");
		if($value!=''){
		$checkAmenties=$amenties[$value];
		}else{
		$checkAmenties=$amenties;
		}
		
		return $checkAmenties;
	}
	function  showCategory($value=""){

$rsProperty=dbFetchArray(dbQuery("select * from property_category where property_category_id=".$value)) ;

	
		return $rsProperty["property_category_name"];
	}
	
	function  showLocality($value=""){

$rsCities=dbFetchArray(dbQuery("select * from uk_town where town_id=".$value)) ;

	    if($rsCities["town"]!=='')
		{  
		return $rsCities["town"];
		}
		else{
		return "[".$rsCities["postcode"]."]";
		}
	}
	function  showCounty($value=""){

$rsStates=dbFetchArray(dbQuery("select * from uk_region where region_id=".$value)) ;

	
		return $rsStates["region_name"];
	}
	function  showDirectionalFacing($value=""){

$Facing = array("1"=>"East" ,"North East","North","North West","West","South West","South","South East");
		if($value!=''){
		$checkFacing=$Facing[$value];
		}else{
		$checkFacing=$Facing;
		}
		
		return $checkFacing;
	}
	function  showBodyAboutMe($value=""){

$Facing = array("1"=>"I am a first-time buyer" ,"I have a property to sell/let","I have an offer on my property","I have recently sold","I am looking to invest","None of the above");
		if($value!=''){
		$checkFacing=$Facing[$value];
		}else{
		$checkFacing=$Facing;
		}
		
		return $checkFacing;
	}
	function  showOwnership($value=""){

$Owner = array("1"=>"Freehold" ,"Leasehold","Power of Attorney","Co-Operative Society");
		if($value!=''){
		$checkOwner=$Owner[$value];
		}else{
		$checkOwner=$Owner;
		}
		
		return $checkOwner;
	}
function ChangeStatus($tb,$fild,$data,$where1,$whereid)

{
$sqlDataArray=array($fild => $data);

dbPerform($tb, $sqlDataArray, "update", $where1."=".(int)$whereid);

//return tipsstatus;

}
function getPropertyList($id,$data)

{
$rowa=dbNumRows(dbQuery("select * from property where user_id='".$id."' and property_status='".$data."'"));
return $rowa;

}


  function getAverage($whereClouse,$whereClouseEquel,$table,$averageFelied){
    
    
	   $query=dbFetchArray(dbQuery("SELECT AVG($averageFelied) as OrderAverage  FROM $table WHERE $whereClouse=".$whereClouseEquel)); 
  		return $query["OrderAverage"];
	  }
 function getCountWhere($table,$whereClouse,$whereClouseEquel,$countFelied){
    
 
	   $query=dbFetchArray(dbQuery("SELECT  count($countFelied) as nos  FROM $table WHERE $whereClouse=".$whereClouseEquel)); 
  		return $query["nos"];
	  }
	   function getCount($table,$countFelied){
    
     	
	   $query=dbFetchArray(dbQuery("SELECT  count($countFelied) as nos  FROM $table WHERE $whereClouse=".$whereClouseEquel)); 
  		return $query["nos"];
	  }
	     function waiting(){
    
    
	   $query=dbFetchArray(dbQuery("SELECT  count(user_status) as nos  FROM user WHERE user_status='Wait'")); 
  		return $query["nos"];
	  }
/**************************************
/	 Code by: Neeraj Krishna Maurya   /
/       Date: 29/05/2013              /
/      For Getting property_id        /
/*************************************/
function getPropertyID($queryString)
{
  $data=dbQuery($queryString);
   while($result=dbFetchArray($data))
    {
	   $row[]=$result['property_id'];
	} 
  if(is_array($row))
    {	  
     foreach($row as $col)
	 {
	   $orgArr[]=$col.",";
     }	
   } 
   if(is_array($orgArr))
   {
	 $orgStr=rtrim(implode("",$orgArr),",");	
   } 
	return $orgStr; 
	 	
}




?>
