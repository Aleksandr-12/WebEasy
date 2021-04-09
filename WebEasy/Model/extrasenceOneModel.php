<?php
require_once "model.php";

class extrasenceOneModel extends model{
	
	public function getResultExtrasenseOne($number){
		$arrayResultExtrasenceOne = array();
		if($_SESSION['arrayResultExtrasenceOne']){
			$arrayResultExtrasenceOne = $_SESSION['arrayResultExtrasenceOne'];
		}
		array_push($arrayResultExtrasenceOne,array('reliabilityExtrasenceOne' => $_SESSION["reliabilityExtrasenceOne"]));
		$_SESSION['arrayResultExtrasenceOne'] = $arrayResultExtrasenceOne;
		
		$this->operationSession($number);
		
		$_SESSION["reliabilityExtrasenceOne"] = $this->getExtrasenceNumberOne();
	}

	
	public function operationSession($number){
		
		if($number == $_SESSION["reliabilityExtrasenceOne"]){
			if($_SESSION['resultExtrasenceOne']){
				unset($_SESSION['resultExtrasenceOne']);
			}
			$_SESSION['resultExtrasenceOne'] = 'угадал';
			
			if(!$_SESSION['countTrueExtrasenceOne']){
				$_SESSION['countTrueExtrasenceOne'] = 1;
			}else{
				$_SESSION['countTrueExtrasenceOne']++;
			}
		}else{
			if($_SESSION['resultExtrasenceOne']){
				unset($_SESSION['resultExtrasenceOne']);
			}
			$_SESSION['resultExtrasenceOne'] = 'не угадал';
		}
	}
	
	public function getExtrasenceNumberOne(){
		return rand(10,99);
	}
	
}
?>