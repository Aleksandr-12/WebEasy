<?php
require_once "model.php";

class extrasenceModel extends model{
	
	public $countExtrasences = 7;
	
	public $superArray = array();
	
	public $nameArrayExtrasences = 'nameArrayExtrasences';
	public $nameArrayNameExtrasences = 'nameArrayNameExtrasences';
	public $nameResultExtrasences = 'nameResultExtrasence';
	public $nameCountTrueExtrasences = 'nameCountTrueExtrasence';
	public $nameAnswerCountExtrasences = 'nameAnswerCountExtrasences';
	
	public $generalArrayExtrasences = array();
	public $generalArrayNameExtrasences = array();
	public $generalResultExtrasences = array();
	public $generalCountTrueExtrasences = array();
	
	public $generalAnswerCountExtrasences = array();
	
	public $generalHistoryExtrasences = array();
	
	
	public $historyNumber = array();
			
	
	public function __construct() {
		$this->superArray = $_SESSION;
		$count = count($this->superArray['allArray']);
		if(empty($_SESSION['allArray']) or ($count <> $this->countExtrasences)){
			unset($_SESSION['allArray']);
			unset($_SESSION['arrayResultNumber']);
			unset($_SESSION[$this->nameArrayExtrasences]);
			unset($_SESSION[$this->nameArrayNameExtrasences]);
			unset($_SESSION[$this->nameResultExtrasences]);
			unset($_SESSION[$this->nameCountTrueExtrasences]);
			unset($_SESSION[$this->nameAnswerCountExtrasences]);
								
			$this->allGenerate();
		}
		$this->generalArrayExtrasences = $_SESSION[$this->nameArrayExtrasences];
		$this->generalArrayNameExtrasences = $_SESSION[$this->nameArrayNameExtrasences];
		$this->generalResultExtrasences = $_SESSION[$this->nameResultExtrasences];
		$this->generalCountTrueExtrasences = $_SESSION[$this->nameCountTrueExtrasences];
		$this->generalAnswerCountExtrasences = $_SESSION[$this->nameAnswerCountExtrasences];
		
				
		//	var_dump($count);	
		$this->historyNumber = $this->superArray['arrayResultNumber'];
	}
	
	public function allGenerate(){
		$array = array();
		for($i = 0;$i < $this->countExtrasences; $i++){
			$nameExtrasence = $this->generateString('name');
			$_SESSION['allArray'][$i] = $this->generateString('array');
			$_SESSION['allName'][$i] = $nameExtrasence;
			$_SESSION['allResult'][$i] = $this->generateString('result');
			$_SESSION['allCount'][$i] = $this->generateString('count');
			$_SESSION[$nameExtrasence] = $this->getRandomExtrasence();
			$array[$i] = $_SESSION[$nameExtrasence];
		}
		$_SESSION[$this->nameAnswerCountExtrasences] = $array;
		$this->generalAnswerCountExtrasences = $_SESSION[$this->nameAnswerCountExtrasences];
	}
	
	public function getResultExtrasenses($number){
		$arrayExtrasences = array();
		$arrayNameExtrasences = array();
		$resultExtrasence = array();
		$countTrueExtrasence = array();
		$answerExtrasence = array();
		for($i = 0;$i < $this->countExtrasences; $i++){
			$arrayExtrasences[$i] = $_SESSION['allArray'][$i];
			
			$arrayNameExtrasences[$i] = $_SESSION['allName'][$i];
	
			$resultExtrasence[$i] = $_SESSION['allResult'][$i];
			
			$countTrueExtrasence[$i] = $_SESSION['allCount'][$i];
			 
			$this->getExtrasences($arrayExtrasences[$i],$arrayNameExtrasences[$i],$number);
			$this->operationSessionExtrasences($number,$resultExtrasence[$i],$countTrueExtrasence[$i],$arrayNameExtrasences[$i]);
			
			$answerExtrasence[$arrayNameExtrasences[$i]] = $this->getRandomExtrasence();
			$_SESSION[$arrayNameExtrasences[$i]] = $answerExtrasence[$arrayNameExtrasences[$i]];
		}
		$_SESSION[$this->nameArrayExtrasences] = $arrayExtrasences;
		$_SESSION[$this->nameArrayNameExtrasences] = $arrayNameExtrasences;
		$_SESSION[$this->nameResultExtrasences] = $resultExtrasence;
		$_SESSION[$this->nameCountTrueExtrasences] = $countTrueExtrasence;
		
		$_SESSION[$this->nameAnswerCountExtrasences] = $answerExtrasence;
		
		$this->generalArrayExtrasences = $_SESSION[$this->nameArrayExtrasences];
		$this->generalArrayNameExtrasences = $_SESSION[$this->nameArrayNameExtrasences];
		$this->generalResultExtrasences = $_SESSION[$this->nameResultExtrasences];
		$this->generalCountTrueExtrasences = $_SESSION[$this->nameCountTrueExtrasences];
				
		$this->generalAnswerCountExtrasences = $_SESSION[$this->nameAnswerCountExtrasences];
	
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
		
		
	}
	
	public function getReliability(){
		$count = count($_SESSION['arrayResultNumber']);
	
		if(count($this->generalCountTrueExtrasences) AND isset($_SESSION['arrayResultNumber'])){
			for($i = 0; $i < count($this->generalCountTrueExtrasences);$i++){
				$countTrue = (int)$_SESSION[$this->generalCountTrueExtrasences[$i]];
				$this->generalHistoryExtrasences[$i] = $countTrue / $count * 100;
			}
		}else{
			for($i = 0; $i < $this->countExtrasences;$i++){
				$this->generalHistoryExtrasences[$i] = 0;
			}
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
	
	public function getExtrasenceHtml(){
		   $str.= "<div>";
			  for($i = 0;$i < count($this->generalAnswerCountExtrasences);$i++){
				$str.= "<div>";
				$n = $i+1;
					$str.= "<h3 class='headerBorder'> Экстрасенс ".$n."</h3>";
				$str.= "</div>";
				$str.= "<div class='flexBox'>";
				if(count($_SESSION[$this->generalArrayExtrasences[$i]]) > 0){
						for($j = 0;$j < count($this->superArray[$this->generalArrayExtrasences[$i]]);$j++){
						$s = $j+1;
						$str.= "<div><span>".$s."</span>".$this->superArray[$this->generalArrayExtrasences[$i]][$j][$this->generalArrayNameExtrasences[$i]]."</div>";
					}
				}
				
				$str.= "</div>";
			  }
			$str.= "</div>";
		return $str;
	}	

	public function generateString($char) {
		$strength = 10;
		$input = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$inputLength = strlen($input);
		$randomString = '';
		for($i = 0; $i < $strength; $i++) {
			$randomCharacter = $input[mt_rand(0, $inputLength - 1)];
			$randomString .= $randomCharacter;
		}
	 
		return $char.$randomString;
	}
	
	public function getGeneralHistoryExtrasences(){
		return $this->generalHistoryExtrasences;
	}
		
	public function getGeneralArrayExtrasences(){
		return $this->generalArrayExtrasences;
	}
	
	public function getGeneralanswerCountExtrasences(){
		return $this->generalAnswerCountExtrasences;
	}
	
	public function getGeneralArrayNameExtrasences(){
		return $this->generalArrayNameExtrasences;
	}
	
	
	public function getGeneralResultExtrasence(){
		$array = array();
		for($i = 0; $i < count($this->generalResultExtrasences);$i++){
			$array[$i] = $_SESSION[$this->generalResultExtrasences[$i]];
		}
		return $array;
		
	}
	
	public function getGeneralCountTrueExtrasences(){
		return $this->generalCountTrueExtrasences;
	}
	
	public function getHistoryNumber(){
		return $this->historyNumber;
	}
}
?>