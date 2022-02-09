<?php
define('PAGE_PARSE_START_TIME', microtime());
error_reporting(E_ALL & ~E_NOTICE);

include("config.php");

$PHP_SELF = (((strlen(ini_get('cgi.fix_pathinfo')) > 0) && ((bool)ini_get('cgi.fix_pathinfo') == false)) || !isset($_SERVER['SCRIPT_NAME'])) ? basename($_SERVER['PHP_SELF']) : basename($_SERVER['SCRIPT_NAME']);

require("functions/database.php");
dbConnect() or die("Unable to connect to database server!");


$configurationQuery = dbQuery("SELECT configuration_key as cfgKey, configuration_value as cfgValue FROM configuration");
while ($configuration = dbFetchArray($configurationQuery)) {
    define($configuration["cfgKey"], $configuration["cfgValue"]);
}

require("functions/general.php");
require("functions/sessions.php");
require("functions/cookies.php");
sessionName("Biding");
sessionStart();

require("classes/message_stack.calss.php");
$messageStack = new messageStack();
require("classes/file_upload.class.php");
require("classes/image.class.php");
require("classes/mime.class.php");
require("classes/email.class.php");
$rsultSe = dbFetchArray(dbQuery("SELECT * from seo where seo_id='" . $seoId . "' and seo_status='Yes'"));
$rsultSeo = "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' /><meta name='description' content='" . $rsultSe["seo_description"] . "'>
<meta name='keywords' content='" . $rsultSe["seo_meta_keywords"] . "' />";
$seoTitle = "<title>" . $rsultSe["seo_title"] . "</title>";

?>
