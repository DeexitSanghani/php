<?php
if(!strstr($_SERVER['REQUEST_URI'],"admin"))
{
    //session_cache_limiter('private_no_expire'); // must go before session start
}
session_start();
error_reporting(0);
error_reporting(E_ALL ^ E_NOTICE);
//ini_set('display_errors',1);
ob_start();
define("SITE_URL","http://192.168.192.51/lsa/");
define("ADMIN_URL","http://192.168.192.51/lsa/admin/");

define("SITE_PATH",$_SERVER['DOCUMENT_ROOT']."lsa/",true);
define("ADMIN_PATH",$_SERVER['DOCUMENT_ROOT']."lsa/admin/",true);
 

define("SITE_NAME","London Serviced Apartments");

define("APARTMENT_MEDIA_URL",SITE_URL."apartment_media/");
define("APARTMENT_MEDIA_PATH",SITE_PATH."apartment_media/",true);

define("APARTMENT_MEDIA_THUMB_URL",SITE_URL."apartment_media/thumb/");
define("APARTMENT_MEDIA_THUMB_PATH",SITE_PATH."apartment_media/thumb/",true);

define("APARTMENT_MEDIA_DOC_URL",SITE_URL."apartment_media/document/");
define("APARTMENT_MEDIA_DOC_PATH",SITE_PATH."apartment_media/document/",true);

$dbHost = "localhost"; 

$dbName = "lsa_core";

$dbUser = "root";

$dbPass = "";


require_once(ADMIN_PATH."include/db.class.php");
require_once(ADMIN_PATH."include/functions.php");
require_once(SITE_PATH."include/functions.php");

$db = new Database();



?>
