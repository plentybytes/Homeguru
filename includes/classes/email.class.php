<?php
  class email{
    var $html;
    var $text;
    var $output;
    var $htmlText;
    var $htmlImages;
    var $imageTypes;
    var $buildParams;
    var $attachments;
    var $headers;

    function __construct($headers=""){
      if($headers == "") $headers=array();

      $this->htmlImages=array();
      $this->headers=array();

      if(EMAIL_LINEFEED == 'CRLF'){
        $this->lf="\r\n";
      }else{
        $this->lf="\n";
      }

      $this->imageTypes=array('gif' => 'image/gif',
															 'jpg' => 'image/jpeg',
															 'jpeg' => 'image/jpeg',
															 'jpe' => 'image/jpeg',
															 'bmp' => 'image/bmp',
															 'png' => 'image/png',
															 'tif' => 'image/tiff',
															 'tiff' => 'image/tiff',
															 'swf' => 'application/x-shockwave-flash');

      $this->buildParams['html_encoding']='quoted-printable';
      $this->buildParams['text_encoding']='7bit';
      $this->buildParams['html_charset']='utf-8';
      $this->buildParams['text_charset']='utf-8';
      $this->buildParams['text_wrap']=998;

      $this->headers[]='MIME-Version: 1.0';

      reset($headers);
      while(list(,$value)=each($headers)){
        if(!isNull($value)){
          $this->headers[]=$value;
        }
      }
    }

    function getFile($filename){
      $return='';

      if($fp=fopen($filename, 'rb')){
        while(!feof($fp)){
          $return .= fread($fp, 1024);
        }
        fclose($fp);

        return $return;
      }else{
        return false;
      }
    }

    function findHtmlImages($imagesDir){
      while(list($key, )=each($this->imageTypes)){
        $extensions[]=$key;
      }

      preg_match_all('/"([^"]+\.(' . implode('|', $extensions).'))"/Ui', $this->html, $images);

      for($i=0; $i<count($images[1]); $i++){
        if(file_exists($imagesDir . $images[1][$i])){
          $htmlImages[]=$images[1][$i];
          $this->html=str_replace($images[1][$i], basename($images[1][$i]), $this->html);
        }
      }

      if(!isNull($htmlImages)){
        $htmlImages=array_unique($htmlImages);
        sort($htmlImages);

        for($i=0; $i<count($htmlImages); $i++){
          if($image=$this->getFile($imagesDir . $htmlImages[$i])){
            $contentType=$this->imageTypes[substr($htmlImages[$i], strrpos($htmlImages[$i], '.') + 1)];
            $this->addHtmlImage($image, basename($htmlImages[$i]), $contentType);
          }
        }
      }
    }

    function addText($text=''){
      $this->text=convertLinefeeds(array("\r\n", "\n", "\r"), $this->lf, $text);
    }

    function addHtml($html, $text=NULL, $imagesDir=NULL){
      $this->html=convertLinefeeds(array("\r\n", "\n", "\r"), '<br />', $html);
      $this->htmlText=convertLinefeeds(array("\r\n", "\n", "\r"), $this->lf, $text);

      if(isset($imagesDir)) $this->findHtmlImages($imagesDir);
    }

    function addHtmlImage($file, $name='', $cType='application/octet-stream'){
      $this->htmlImages[]=array('body' => $file,
															  'name' => $name,
															  'c_type' => $cType,
															  'cid' => md5(uniqid(time())));
    }

    function addAttachment($file, $name='', $cType='application/octet-stream', $encoding='base64'){
      $this->attachments[]=array('body' => $file,
																 'name' => $name,
																 'c_type' => $cType,
																 'encoding' => $encoding);
    }

    function addTextPart(&$obj, $text){
      $params['content_type']='text/plain';
      $params['encoding']=$this->buildParams['text_encoding'];
      $params['charset']=$this->buildParams['text_charset'];

      if(is_object($obj)){
        return $obj->addSubpart($text, $params);
      }else{
        return new mime($text, $params);
      }
    }

    function addHtmlPart(&$obj){
      $params['content_type']='text/html';
      $params['encoding']=$this->buildParams['html_encoding'];
      $params['charset']=$this->buildParams['html_charset'];

      if(is_object($obj)){
        return $obj->addSubpart($this->html, $params);
      }else{
        return new mime($this->html, $params);
      }
    }

    function addMixedPart(){
      $params['content_type']='multipart/mixed';

      return new mime('', $params);
    }

    function addAlternativePart(&$obj){
      $params['content_type']='multipart/alternative';

      if(is_object($obj)){
        return $obj->addSubpart('', $params);
      }else{
        return new mime('', $params);
      }
    }

    function addRelatedPart(&$obj){
      $params['content_type']='multipart/related';

      if(is_object($obj)){
        return $obj->addSubpart('', $params);
      }else{
        return new mime('', $params);
      }
    }

    function addHtmlImagePart(&$obj, $value){
      $params['content_type']=$value['c_type'];
      $params['encoding']='base64';
      $params['disposition']='inline';
      $params['dfilename']=$value['name'];
      $params['cid']=$value['cid'];

      $obj->addSubpart($value['body'], $params);
    }

    function addAttachmentPart(&$obj, $value){
      $params['content_type']=$value['c_type'];
      $params['encoding']=$value['encoding'];
      $params['disposition']='attachment';
      $params['dfilename']=$value['name'];

      $obj->addSubpart($value['body'], $params);
    }

    function buildMessage($params=''){
      if($params == '') $params=array();

      if(count($params) > 0){
        reset($params);
        while(list($key, $value)=each($params)){
          $this->buildParams[$key]=$value;
        }
      }

      if(!isNull($this->htmlImages)){
        reset($this->htmlImages);
        while(list(,$value)=each($this->htmlImages)){
          $this->html=str_replace($value['name'], 'cid:' . $value['cid'], $this->html);
        }
      }

      $null=NULL;
      $attachments=((!isNull($this->attachments)) ? true : false);
      $htmlImages=((!isNull($this->htmlImages)) ? true : false);
      $html=((!isNull($this->html)) ? true : false);
      $text=((!isNull($this->text)) ? true : false);

      switch (true){
        case (($text == true) && ($attachments == false)):
          $message=$this->addTextPart($null, $this->text);
          break;
        case (($text == false) && ($attachments == true) && ($html == false)):
          $message=$this->addMixedPart();

          for($i=0; $i<count($this->attachments); $i++){
            $this->addAttachmentPart($message, $this->attachments[$i]);
          }
          break;
        case (($text == true) && ($attachments == true)):
          $message=$this->addMixedPart();
          $this->addTextPart($message, $this->text);

          for($i=0; $i<count($this->attachments); $i++){
            $this->addAttachmentPart($message, $this->attachments[$i]);
          }
          break;
        case (($html == true) && ($attachments == false) && ($htmlImages == false)):
          if(!isNull($this->htmlText)){
            $message=$this->addAlternativePart($null);
            $this->addTextPart($message, $this->htmlText);
            $this->addHtmlPart($message);
          }else{
            $message=$this->addHtmlPart($null);
          }
          break;
        case (($html == true) && ($attachments == false) && ($htmlImages == true)):
          if(!isNull($this->htmlText)){
            $message=$this->addAlternativePart($null);
            $this->addTextPart($message, $this->htmlText);
            $related=$this->addRelatedPart($message);
          }else{
            $message=$this->addRelatedPart($null);
            $related=$message;
          }
          $this->addHtmlPart($related);

          for($i=0; $i<count($this->htmlImages); $i++){
            $this->addHtmlImagePart($related, $this->htmlImages[$i]);
          }
          break;
        case (($html == true) && ($attachments == true) && ($htmlImages == false)):
          $message=$this->addMixedPart();
          if(!isNull($this->htmlText)){
            $alt=$this->addAlternativePart($message);
            $this->addTextPart($alt, $this->htmlText);
            $this->addHtmlPart($alt);
          }else{
            $this->addHtmlPart($message);
          }

          for($i=0; $i<count($this->attachments); $i++){
            $this->addAttachmentPart($message, $this->attachments[$i]);
          }
          break;
        case (($html == true) && ($attachments == true) && ($htmlImages == true)):
          $message=$this->addMixedPart();

          if(!isNull($this->htmlText)){
            $alt=$this->addAlternativePart($message);
            $this->addTextPart($alt, $this->htmlText);
            $rel=$this->addRelatedPart($alt);
          }else{
            $rel=$this->addRelatedPart($message);
          }
          $this->addHtmlPart($rel);

          for($i=0; $i<count($this->htmlImages); $i++){
            $this->addHtmlImagePart($rel, $this->htmlImages[$i]);
          }

          for($i=0; $i<count($this->attachments); $i++){
            $this->addAttachmentPart($message, $this->attachments[$i]);
          }
          break;
      }

      if((isset($message)) && (is_object($message))){
        $output=$message->encode();
        $this->output=$output['body'];

        reset($output['headers']);
        while(list($key, $value)=each($output['headers'])){
          $headers[]=$key . ': ' . $value;
        }

        $this->headers=array_merge($this->headers, $headers);

        return true;
      }else{
        return false;
      }
    }

    function send($toName, $toAddr, $fromName, $fromAddr, $subject='', $headers=''){
      if((strstr($toName, "\n") != false) || (strstr($toName, "\r") != false)){
        return false;
      }

      if((strstr($toAddr, "\n") != false) || (strstr($toAddr, "\r") != false)){
        return false;
      }

      if((strstr($subject, "\n") != false) || (strstr($subject, "\r") != false)){
        return false;
      }

      if((strstr($fromName, "\n") != false) || (strstr($fromName, "\r") != false)){
        return false;
      }

      if((strstr($fromAddr, "\n") != false) || (strstr($fromAddr, "\r") != false)){
        return false;
      }

      $to=(($toName != '') ? '"' . $toName . '" <' . $toAddr . '>' : $toAddr);
      $from=(($fromName != '') ? '"' . $fromName . '" <' . $fromAddr . '>' : $fromAddr);

      if(is_string($headers)){
        $headers=explode($this->lf, trim($headers));
      }

      for($i=0; $i<count($headers); $i++){
        if(is_array($headers[$i])){
          for($j=0; $j<count($headers[$i]); $j++){
            if($headers[$i][$j] != ''){
              $xtraHeaders[]=$headers[$i][$j];
            }
          }
        }

        if($headers[$i] != ''){
          $xtraHeaders[]=$headers[$i];
        }
      }

      if(!isset($xtraHeaders)){
        $xtraHeaders=array();
      }

      return mail($to, $subject, $this->output, 'From: '.$from.$this->lf.implode($this->lf, $this->headers).$this->lf.implode($this->lf, $xtraHeaders));
    }
	}
?>
