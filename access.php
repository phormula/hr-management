<?php
$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === 
FALSE ? 'http' : 'https';            // Get protocol HTTP/HTTPS
$host     = $_SERVER['HTTP_HOST'];   // Get  www.domain.com
$script   = $_SERVER['SCRIPT_NAME']; // Get folder/file.php
$params   = $_SERVER['QUERY_STRING'];// Get Parameters occupation=odesk&name=ashik

$currentUrl = $protocol . '://' . $host  ; // Adding all


if(!checkManager() && !checkAdmin() && !checkHR()) {
header("Location: ".$currentUrl."/login/login.php?noaccess=1");
exit();
}

?>