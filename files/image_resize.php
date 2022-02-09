<?php
require("../includes/application.php");
if(isset($_GET["image"]) && isset($_GET["file"]) && isset($_GET["width"]) && isset($_GET["height"])){
	$image = new Image($_GET["image"]."/".$_GET["file"]);
	$image->resize((int)$_GET["width"],(int)$_GET["height"]);
	header("Content-Type: image/jpeg");
	$image->output();
}
?>