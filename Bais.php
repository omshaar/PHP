<?php session_start();
$currentPath = $_SERVER['PHP_SELF']; 
$pathInfo = pathinfo($currentPath); 
$hostName = $_SERVER['HTTP_HOST']; 
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
//echo $protocol.'://'.$hostName.$pathInfo['dirname']."/";
$_SESSION["bais"] = $protocol.'://'.$hostName.$pathInfo['dirname']."/";?>