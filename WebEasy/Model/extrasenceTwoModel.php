<?php
require_once "model.php";

class extrasenceTwoModel extends model{
	
	public function getResultExtrasenseTwo($number){
		$arrayResultExtrasenceTwo = array();
		if($_SESSION['arrayResultExtrasenceTwo']){
			$arrayResultExtrasenceTwo = $_SESSION['arrayResultExtrasenceTwo'];
		}
		array_push($arrayResultExtrasenceTwo,array('reliabilityExtrasenceTwo' => $_SESSION["reliabilityExtrasenceTwo"]));
		$_SESSION['arrayResultExtrasenceTwo'] = $arrayResultExtrasenceTwo;
		
		$this->operationSession($number);
		
		$_SESSION["reliabilityExtrasenceTwo"] = $this->getExtrasenceNumberTwo();	
	}
	
	
	public function operationSession($number){
		if($number == $_SESSION["reliabilityExtrasenceTwo"]){
			
			if($_SESSION['resultExtrasenceTwo']){
				unset($_SESSION['resultExtrasenceTwo']);
			}
			$_SESSION['resultExtrasenceTwo'] = 'угадал';
			
			if(!$_SESSION['countTrueExtrasenceTwo']){
				$_SESSION['countTrueExtrasenceTwo'] = 1;
			}else{
				$_SESSION['countTrueExtrasenceTwo']++;
			}
		}else{
			if($_SESSION['resultExtrasenceTwo']){
				unset($_SESSION['resultExtrasenceTwo']);
			}
			$_SESSION['resultExtrasenceTwo'] = 'не угадал';
		}
	}
	
	public function getExtrasenceNumberTwo(){
		return rand(10,99);
	}
	
}
?>