<?php 
require_once 'Controller/PageController.php';
require_once 'functions.php';
	
	
	$url = trim($_SERVER['QUERY_STRING'], '/');
	$pageName = requestUrl($url);
	New PageController($pageName);
?>


