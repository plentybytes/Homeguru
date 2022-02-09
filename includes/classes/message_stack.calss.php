<?php
	class messageStack{
		var $messageArray=array();
    var $size=0;
		
    function __construct(){
      if(isSessionRegistered("message_to_stack")){
				$messageToStack=$_SESSION["message_to_stack"];
        for($i=0, $n=sizeof($messageToStack); $i < $n; $i++){
          $this->addMessage($messageToStack[$i]["text"], $messageToStack[$i]["type"]);
        }
        sessionUnregister("message_to_stack");
      }
    }
		
    function addMessage($message, $type="error"){
      if($type=="error"){
        $this->messageArray[]="<div class=\"error_box\"> ".$message." </div>";
      }elseif($type=="warning"){
        $this->messageArray[]="<div class=\"warning_box\"> ".$message." </div>";
      }elseif($type=="success"){
        $this->messageArray[]="<div class=\"valid_box\"> ".$message." </div>";
      }else {
        $this->messageArray[]="<div class=\"error_box\"> ".$message." </div>";
      }

      $this->size++;
    }
		
    function addMessageSession($message, $type="error"){
      if(!isSessionRegistered("message_to_stack")){
				$messageToStack[]=array("text" => $message, "type" => $type);
				sessionRegister("message_to_stack", $messageToStack);
      }
    }
		
    function resetMessage(){
      $this->messageArray=array();
      $this->size=0;
    }
		
    function outputMessage(){
			$outputMessage="";
			if($this->size > 0){
				foreach($this->messageArray as $key => $value){
					$outputMessage.=$value."\n";
				}
			}
      return $outputMessage;
    }
  }
?>