<?php
require_once "./functions.php";
require_once "./Model/extrasenceModel.php";
require_once "./Model/model.php";
require_once "Controller.php";

class PageController extends Controller{
	
	public $data;
	public $extrasenceModel;
	public $user;
	public $historyExtrasenceOne;
	public $historyExtrasenceTwo;
	public $resultExtrasenceOne;
	public $resultExtrasenceTwo;
	public $extrasenceNumberOne;
	public $extrasenceNumberTwo;
	
	public $error = false;
	
	public function __construct($pageName = '') {
		session_start();
		$this->extrasenceModel = new extrasenceModel();
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
			if($this->extrasenceModel->validateNumber($_GET['number'])){
				$this->extrasenceModel->getResultExtrasenses($this->extrasenceModel->secureAcces($_GET['number']));
				$this->extrasenceModel->setHistoryNumber($this->extrasenceModel->secureAcces($_GET['number']));
				unset($_GET['number']);
				redirect('/result');
			}else{
				setError();
				redirect();
			}
		}
		
		$this->extrasenceModel->getReliability();
		$this->extrasenceNumberOne = $this->extrasenceModel->getReliabilityExtrasenceOne();
		$this->extrasenceNumberTwo = $this->extrasenceModel->getReliabilityExtrasenceTwo();
			
		$this->dataExtrasenceOne = $this->extrasenceModel->getArrayResultExtrasenceOne();
		$this->dataExtrasenceTwo = $this->extrasenceModel->getArrayResultExtrasenceTwo();
		$this->user = $this->extrasenceModel->getUser();
		$this->historyNumber = $this->extrasenceModel->getHistoryNumber();
		
		$this->historyExtrasenceOne = $this->extrasenceModel->getHistoryExtrasenceOne();
		$this->historyExtrasenceTwo = $this->extrasenceModel->getHistoryExtrasenceTwo();
		
		
		$this->data = $this->extrasenceModel->getArray($this->historyNumber,$this->dataExtrasenceOne,$this->dataExtrasenceTwo);
	
		//unset($_SESSION['array_result']);	
		$this->showPage();
	}
	
	public function pageResult(){
		$this->title = "Результат";
		$this->resultExtrasenceOne = $this->extrasenceModel->getResultExtrasenceForViewOne();;
		$this->resultExtrasenceTwo = $this->extrasenceModel->getResultExtrasenceForViewTwo();;
		$this->view = "result";
		$this->showPage();
	}
	
	public function pageEnter(){
		$this->title = "Загадай число";
		if(!$this->extrasenceModel->getUser()){
			$this->extrasenceModel->setUser();
		}
		$this->view = "enter";
		$this->showPage();
	}
	
	
}
?>