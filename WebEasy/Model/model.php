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
	
	public function getArray($getHistoryNumber,$dataExtrasenceOne,$dataExtrasenceTwo){
		$data = array();
		for($i = 0;$i<count($getHistoryNumber);$i++){
			$array = array();
			$array['reliabilityExtrasenceOne'] = $dataExtrasenceOne[$i]['reliabilityExtrasenceOne'];
			$array['reliabilityExtrasenceTwo'] = $dataExtrasenceTwo[$i]['reliabilityExtrasenceTwo'];
			$array['number'] = $getHistoryNumber[$i]['number'];
			$data[$i] = $array;
			
		}
		return $data;
	}
		
	public function getReliability(){
		$count = count($_SESSION['arrayResultNumber']);
		if(isset($_SESSION['countTrueExtrasenceOne']) AND isset($_SESSION['arrayResultNumber'])){
			$_SESSION["historyExtrasenceOne"] =  $_SESSION['countTrueExtrasenceOne'] / $count * 100;
		}
		if(isset($_SESSION['countTrueExtrasenceTwo']) AND isset($_SESSION['arrayResultNumber'])){
			$_SESSION["historyExtrasenceTwo"] = $_SESSION['countTrueExtrasenceTwo'] / $count * 100;
		}
	}
	
	public function  getHistoryNumber($number){
		$arrayResultNumber = array();
		if($_SESSION['arrayResultNumber']){
			$arrayResultNumber = $_SESSION['arrayResultNumber'];
		}
		array_push($arrayResultNumber,array('number' => $number));
		$_SESSION['arrayResultNumber'] = $arrayResultNumber;
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
}


?>