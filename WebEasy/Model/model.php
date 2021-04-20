<?php 
class model{
		
	public function secureAcces($var){
		$var = htmlspecialchars($var,ENT_QUOTES);
		$var = trim($var);
		$var = addslashes($var); 
		return $var;
	}
	
	public function getUserRand(){
		return rand();
	}
	
	public function validateNumber($n){
		if(!is_numeric($n)){
			return false;
		}
		if($n >= 10 && $n <= 99){
			return true;
		}else{
			return false;
		}
	}
	public function setUser(){
		if(!$_SESSION['user']){
			$_SESSION['user'] = $this->getUserRand();
		}
	}
	
	public function getUser(){
		return $_SESSION['user'];
	}
	
	public function getRandomExtrasence(){
		return rand(10,99);
	}
	
}


?>