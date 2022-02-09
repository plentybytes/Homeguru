<?php
	class fileUpload{
    var $file;
		var $fileName;
		var $fileCategory;
		var $destination;
		var $permissions;
		var $extensions;
		var $tmpFileName;
		var $messageLocation;
		var $tmpPrefix;

    function __construct($file="", $destination="", $permissions="777", $extensions="", $category=""){
		$this->setFile($file);
		$this->setDestination($destination);
		$this->setPermissions($permissions);
		$this->setExtensions($extensions);
		$this->setCategory($category);
		$this->setFileName($file);
     	$this->setOutputMessages("direct");

      if(!isNull($this->file) && !isNull($this->destination)){
        $this->setOutputMessages("session");

        if(($this->fileParse()==true) && ($this->fileSave()==true)){
          return true;
        }else{
          return false;
        }
      }
    }

    function fileParse(){
      global $_FILES, $messageStack;

      $file=array();

      if(isset($_FILES[$this->file])){
        $file=array("name" => $_FILES[$this->file]["name"],
                    "type" => $_FILES[$this->file]["type"],
                    "size" => $_FILES[$this->file]["size"],
                    "tmp_name" => $_FILES[$this->file]["tmp_name"]);
      }elseif(isset($_FILES[$this->file])){
        $file=array("name" => $_FILES[$this->file]["name"],
                    "type" => $_FILES[$this->file]["type"],
                    "size" => $_FILES[$this->file]["size"],
                    "tmp_name" => $_FILES[$this->file]["tmp_name"]);
      }

      if(!isNull($file["tmp_name"]) && ($file["tmp_name"]!="none") && is_uploaded_file($file["tmp_name"])){
        if(sizeof($this->extensions) > 0){
          if(!in_array(strtolower(substr($file["name"], strrpos($file["name"], '.')+1)), $this->extensions)){
            if($this->messageLocation=="direct"){
              $messageStack->addMessage("File upload type not allowed.", "error");
            }else{
              $messageStack->addMessageSession("File upload type not allowed.", "error");
            }

            return false;
          }
        }

        $this->setFile($file);
        $this->setFileName($file["name"]);
        $this->setTmpFileName($file["tmp_name"]);

        return $this->checkDestination();
      }else{
        if($this->messageLocation=="direct"){
          $messageStack->addMessage("No file uploaded.", "warning");
        }else{
          $messageStack->addMessageSession("No file uploaded.", "warning");
        }

        return false;
      }
    }

    function fileSave(){
      global $messageStack;

      if(substr($this->destination, -1) != '/') $this->destination .= '/';

      if(move_uploaded_file($this->file["tmp_name"], $this->destination . $this->fileName)){
        chmod($this->destination . $this->fileName, $this->permissions);

        if($this->messageLocation=="direct"){
          $messageStack->addMessage("File upload saved successfully.", "success");
        }else{
          $messageStack->addMessageSession("File upload saved successfully.", "success");
        }

        return true;
      }else{
        if($this->messageLocation=="direct"){
          $messageStack->addMessage("File upload not saved.", "error");
        }else{
          $messageStack->addMessageSession("File upload not saved.", "error");
        }

        return false;
      }
    }

    function setFile($file){
      $this->file=$file;
    }

    function setDestination($destination){
      $this->destination=$destination;
    }
		
		function setCategory($category){
      $this->fileCategory=$category;
    }

    function setPermissions($permissions){
      $this->permissions=octdec($permissions);
    }

    function setFileName($fileName){
			if($this->fileCategory=="banner"){
				$productionCheckQuery=dbQuery("SELECT COUNT(*) as total FROM banner WHERE banner_image  LIKE '%".$fileName."%'");
  			$productionCheck=dbFetchArray($productionCheckQuery);
				if($productionCheck["total"] > 0){
					$this->fileName=($productionCheck["total"]+1)."_".$fileName;
				}else{
					$this->fileName=$fileName;
				}
			}elseif($this->fileCategory=="property_images"){
				$productionCheckQuery=dbQuery("SELECT COUNT(*) as total FROM property_images WHERE  property_images  LIKE '%".$fileName."%'");
  			$productionCheck=dbFetchArray($productionCheckQuery);
				if($productionCheck["total"] > 0){
					$this->fileName=($productionCheck["total"]+1)."_".$fileName;
				}else{
					$this->fileName=$fileName;
				}
			}elseif($this->fileCategory=="user_image"){
				$categoryCheckQuery=dbQuery("SELECT COUNT(*) as total FROM user WHERE user_image LIKE '%".$fileName."%'");
  			$categoryCheck=dbFetchArray($categoryCheckQuery);
				if($categoryCheck["total"] > 0){
					$this->fileName=($categoryCheck["total"]+1)."_".$fileName;
				}else{
					$this->fileName=$fileName;
				}
			}else{
				if(!isNull($this->tmpPrefix)){
      		$this->fileName=$this->tmpPrefix.$fileName;
				}else{
					$this->fileName=$fileName;
				}
			}
    }

    function setTmpFileName($fileName){
      $this->tmpFileName=$fileName;
    }

    function setExtensions($extensions){
      if(!isNull($extensions)){
        if(is_array($extensions)){
          $this->extensions=$extensions;
        }else{
          $this->extensions=array($extensions);
        }
      }else{
        $this->extensions=array();
      }
    }

    function checkDestination(){
      global $messageStack;

      if(!isWritable($this->destination)){
        if(is_dir($this->destination)){
          if($this->messageLocation=="direct"){
            $messageStack->addMessage(sprintf("Destination not writeable.", $this->destination), "error");
          }else{
            $messageStack->addMessageSession(sprintf("Destination not writeable.", $this->destination), "error");
          }
        }else{
          if($this->messageLocation=="direct"){
            $messageStack->addMessage(sprintf("Destination does not exist.", $this->destination), "error");
          }else{
            $messageStack->addMessageSession(sprintf("Destination does not exist.", $this->destination), "error");
          }
        }

        return false;
      }else{
        return true;
      }
    }

    function setOutputMessages($location){
      switch ($location){
        case "session":
          $this->messageLocation="session";
          break;
        case "direct":
        default:
          $this->messageLocation="direct";
          break;
      }
    }
  }
?>