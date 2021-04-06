<?php
	function redirect($http = ''){
		if($http){
			$redirect = $http;
		}else{
			$redirect = $_SERVER['HTTP_REFERER'];
		}
		header("Location: $redirect");
		exit;
	}
	
	function requestUrl($url){
		$params = explode('&', $url, 2);
		return $params[0];
	}
	
	function setError(){
		$_SESSION["error"] = "error";
	}
	
	function getError(){
		if($_SESSION["error"]){
			unset($_SESSION["error"]);
			return true;
		}
	}
	
	
?>