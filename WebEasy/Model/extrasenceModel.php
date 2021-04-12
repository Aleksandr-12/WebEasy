<?php
require_once "model.php";

class extrasenceModel extends model{
	
	public $nameExtrasenceOne = 'reliabilityExtrasenceOne';
	public $nameExtrasenceTwo = 'reliabilityExtrasenceTwo';
	
	public $nameExtrasenceArrayOne = 'arrayResultExtrasenceOne';
	public $nameExtrasenceArrayTwo = 'arrayResultExtrasenceTwo';
	
	public $reliabilityExtrasenceOne;
	public $reliabilityExtrasenceTwo;
	
	public $resultExtrasenceOne = 'resultExtrasenceOne';
	public $resultExtrasenceTwo = 'resultExtrasenceTwo';
	
	public $countTrueExtrasenceOne = 'countTrueExtrasenceOne';
	public $countTrueExtrasenceTwo = 'countTrueExtrasenceTwo';
	
	public $arrayResultExtrasenceOne = array();
	public $arrayResultExtrasenceTwo = array();
	
	public $historyExtrasenceOne;
	public $historyExtrasenceTwo;
	
	public $historyNumber;
			
	
	public function __construct() {
		if(!$_SESSION['reliabilityExtrasenceOne']){
			$_SESSION['reliabilityExtrasenceOne'] = $this->getRandomExtrasence();
		}
		$this->reliabilityExtrasenceOne = $_SESSION[$this->nameExtrasenceOne];
		if(!$_SESSION['reliabilityExtrasenceTwo']){
			$_SESSION['reliabilityExtrasenceTwo'] = $this->getRandomExtrasence();
		}
		$this->reliabilityExtrasenceTwo = $_SESSION[$this->nameExtrasenceTwo];
				
		$this->arrayResultExtrasenceOne = $_SESSION[$this->nameExtrasenceArrayOne];
		$this->arrayResultExtrasenceTwo = $_SESSION[$this->nameExtrasenceArrayTwo];
		
		if(isset($_SESSION["historyExtrasenceOne"])){
			$this->historyExtrasenceOne = $_SESSION["historyExtrasenceOne"];
		}
		if(isset($_SESSION["historyExtrasenceTwo"])){
			$this->historyExtrasenceTwo = $_SESSION["historyExtrasenceTwo"];
		}
		
		$this->historyNumber = $_SESSION['arrayResultNumber'];
				
	}
	
	public function getResultExtrasenses($number){
		$this->getExtrasences($this->nameExtrasenceArrayOne,$this->nameExtrasenceOne,$number);
		$this->operationSessionExtrasences($number,$this->resultExtrasenceOne,$this->countTrueExtrasenceOne,$this->nameExtrasenceOne);
		
		$this->getExtrasences($this->nameExtrasenceArrayTwo,$this->nameExtrasenceTwo,$number);
		$this->operationSessionExtrasences($number,$this->resultExtrasenceTwo,$this->countTrueExtrasenceTwo,$this->nameExtrasenceTwo);
	}
	
		
	public function getExtrasences($extrasenceErray,$extrasence,$number){
		$arrayResultExtrasence = array();
		if($_SESSION[$extrasenceErray]){
			$arrayResultExtrasence = $_SESSION[$extrasenceErray];
		}
		array_push($arrayResultExtrasence,array($extrasence => $_SESSION[$extrasence]));
		$_SESSION[$extrasenceErray] = $arrayResultExtrasence;
	}
	
	public function operationSessionExtrasences($number,$resultExtrasence,$countTrueExtransence,$extrasence){
		
		$number = (int)$number;
		
		if($number == $_SESSION[$extrasence]){
			
			if($_SESSION[$resultExtrasence]){
				unset($_SESSION[$resultExtrasence]);
			}
			$_SESSION[$resultExtrasence] = 'угадал';
			
			if(!$_SESSION[$countTrueExtransence]){
				$_SESSION[$countTrueExtransence] = 1;
			}else{
				$_SESSION[$countTrueExtransence]++;
			}
		}else{
			if($_SESSION[$resultExtrasence]){
				unset($_SESSION[$resultExtrasence]);
			}
			$_SESSION[$resultExtrasence] = 'не угадал';
		}
		
		$_SESSION[$extrasence] = $this->getRandomExtrasence();
	}
	
	public function getReliability(){
		$count = count($_SESSION['arrayResultNumber']);
		if(isset($_SESSION['countTrueExtrasenceOne']) AND isset($_SESSION['arrayResultNumber'])){
			$this->historyExtrasenceOne =  $_SESSION['countTrueExtrasenceOne'] / $count * 100;
		}
		if(isset($_SESSION['countTrueExtrasenceTwo']) AND isset($_SESSION['arrayResultNumber'])){
			$this->historyExtrasenceTwo = $_SESSION['countTrueExtrasenceTwo'] / $count * 100;
		}
	}
	
	public function  setHistoryNumber($number){
		$arrayResultNumber = array();
		if($_SESSION['arrayResultNumber']){
			$arrayResultNumber = $_SESSION['arrayResultNumber'];
		}
		array_push($arrayResultNumber,array('number' => $number));
		$_SESSION['arrayResultNumber'] = $arrayResultNumber;
	}
	
	public function getResultExtrasenceForViewOne(){
		return $_SESSION['resultExtrasenceOne'];
	}
	
	public function getResultExtrasenceForViewTwo(){
		return  $_SESSION['resultExtrasenceTwo'];
	}	
	
	public function getReliabilityExtrasenceOne(){
		return $this->reliabilityExtrasenceOne;
	}
	
	public function getReliabilityExtrasenceTwo(){
		return $this->reliabilityExtrasenceTwo;
	}
	
	
	public function getArrayResultExtrasenceOne(){
		return $this->arrayResultExtrasenceOne;
	}
	
	public function getArrayResultExtrasenceTwo(){
		return $this->arrayResultExtrasenceTwo;
	}
	
	public function getHistoryExtrasenceOne(){
		return $this->historyExtrasenceOne;
	}
	
	public function getHistoryExtrasenceTwo(){
		return $this->historyExtrasenceTwo;
	}
	
	public function getHistoryNumber(){
		return $this->historyNumber;
	}
}
?>