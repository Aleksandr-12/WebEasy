<?php
require_once "./functions.php";
require_once "./Model/extrasenceOneModel.php";
require_once "./Model/extrasenceTwoModel.php";
require_once "./Model/model.php";
require_once "Controller.php";

class PageController extends Controller{
	
	public $data;
	public $extrasenceOneModel;
	public $extrasenceTwoModel;
	public $user;
	public $historyExtrasenceOne;
	public $historyExtrasenceTwo;
	public $resultExtrasenceOne;
	public $resultExtrasenceTwo;
	public $extrasenceNumberOne;
	public $extrasenceNumberTwo;
	
	public function __construct($pageName = '') {
		session_start();
		$this->extrasenceOneModel = new extrasenceOneModel();
		$this->extrasenceTwoModel = new extrasenceTwoModel();
		$this->createPage($pageName);
	}

	public function createPage($pageName=''){
		
		switch($pageName){
			case 'rand':
				$this->pageRand();
				break;
			case 'result':
				$this->pageResult();
				break;
			default:
				$this->pageEnter();
				break;
		}
	}
	
	public function pageRand(){
		$this->data = array();
		$this->title = 'Главная';
		if($_GET['number']){
			if($this->extrasenceOneModel->validateNumber($_GET['number'])){
				$this->extrasenceOneModel->getResultExtrasenseOne($this->extrasenceOneModel->secureAcces($_GET['number']));
				$this->extrasenceTwoModel->getResultExtrasenseTwo($this->extrasenceOneModel->secureAcces($_GET['number']));
				$this->extrasenceOneModel->getHistoryNumber($this->extrasenceOneModel->secureAcces($_GET['number']));
				unset($_GET['number']);
				redirect('/result');
			}else{
				setError();
				redirect();
			}
		}
		
		$this->extrasenceOneModel->getReliability();
		
		if(!$_SESSION['reliabilityExtrasenceOne'] OR !$_SESSION['reliabilityExtrasenceTwo']){
			$_SESSION['reliabilityExtrasenceOne'] = $this->extrasenceOneModel->getExtrasenceNumberOne();
			$_SESSION['reliabilityExtrasenceTwo'] = $this->extrasenceTwoModel->getExtrasenceNumberTwo();
		}
		
		$this->extrasenceNumberOne = $_SESSION['reliabilityExtrasenceOne'];
		$this->extrasenceNumberTwo = $_SESSION['reliabilityExtrasenceTwo'];
		
		
		$this->dataExtrasenceOne = $_SESSION['arrayResultExtrasenceOne'];
		$this->dataExtrasenceTwo = $_SESSION['arrayResultExtrasenceTwo'];
		$this->user = $_SESSION['user'];
		$this->getHistoryNumber = $_SESSION['arrayResultNumber'];
		if(isset($_SESSION["historyExtrasenceOne"])){
			$this->historyExtrasenceOne = $_SESSION["historyExtrasenceOne"];
		}
		if(isset($_SESSION["historyExtrasenceTwo"])){
			$this->historyExtrasenceTwo = $_SESSION["historyExtrasenceTwo"];
		}
		
		$this->data = $this->extrasenceOneModel->getArray($this->getHistoryNumber,$this->dataExtrasenceOne,$this->dataExtrasenceTwo);
	
		//unset($_SESSION['array_result']);	
		$this->showPage();
	}
	
	public function pageResult(){
		$this->title = "Результат";
		$this->resultExtrasenceOne = $_SESSION['resultExtrasenceOne'];
		$this->resultExtrasenceTwo = $_SESSION['resultExtrasenceTwo'];
		$this->view = "result";
		$this->showPage();
	}
	
	public function pageEnter(){
		$this->title = "Загадай число";
		if(!$_SESSION['user']){
			$_SESSION['user'] = $this->extrasenceOneModel->getUserRand();
		}
		$this->view = "enter";
		$this->showPage();
	}
	
	
}
?>