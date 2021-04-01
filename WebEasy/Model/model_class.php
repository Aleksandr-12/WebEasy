<?php 
class model_class{
		
	public function secureAcces($var){
		$var = htmlspecialchars($var,ENT_QUOTES);
		$var = trim($var);
		$var = addslashes($var); 
		return $var;
	}
	
	public function getUserRand(){
		return rand();
	}
	
	public function getExtrasensNumberOne(){
		return rand(1,100);
	}
	
	public function getExtrasensNumberTwo(){
		return rand(1,100);
	}
	
	public function getDostovernost(){
		$count = count($_SESSION['array_result']);
		$_SESSION["history_extra_1"] =  $_SESSION['count_true_extra_1'] / $count * 100;
		$_SESSION["history_extra_2"] = $_SESSION['count_true_extra_2'] / $count * 100;
		
	}
	
	public function getResultExtrasense($number, $dogatka_extra_1, $dogatka_extra_2){
		$array_result = array();
		
		if($_SESSION['array_result']){
			$array_result = $_SESSION['array_result'];
		}
		if($number == $dogatka_extra_1){
			if(!$_SESSION['count_true_extra_1']){
				$_SESSION['count_true_extra_1'] = 1;
			}else{
				$_SESSION['count_true_extra_1'] = $_SESSION['count_true_extra_1'] + 1;
			}
			array_push($array_result,array('dogatka_extra_1' => 'угадал','dogatka_extra_2' => 'не угадал','number' => $number));
		}elseif($number == $dogatka_extra_2){
			if(!$_SESSION['count_true_extra_2']){
				$_SESSION['count_true_extra_2'] = 1;
			}else{
				$_SESSION['count_true_extra_2']= $_SESSION['count_true_extra_2'] + 1;
			}
			array_push($array_result,array('dogatka_extra_1' => 'не угадал','dogatka_extra_2' => 'угадал','number' => $number));
		}else{
			array_push($array_result,array('dogatka_extra_1' => 'не угадал','dogatka_extra_2' => 'не угадал','number' => $number));
		}
		$_SESSION['array_result'] = $array_result;
	}
}


?>