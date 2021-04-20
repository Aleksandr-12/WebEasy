<?php
require_once "./functions.php";
require_once "./Model/extrasenceModel.php";
require_once "./Model/model.php";
require_once "Controller.php";

class PageController extends Controller{
	
	public $data;
	public $extrasenceModel;
	public $user;
	public $resultExtrasence = array();
	public $historyArrayExtrasence = array();
	public $answerExtrasenceArray = array();
	public $dataExtrasence = array();
	public $getGeneralArrayExtrasences = array();
	
	public $dataArray = array();
	public $dataNumberArray = array();
	
	public $htmlExtrasence;	
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
		$this->answerExtrasenceArray = $this->extrasenceModel->getGeneralanswerCountExtrasences();
			
		$this->user = $this->extrasenceModel->getUser();
		$this->historyNumber = $this->extrasenceModel->getHistoryNumber();
		
		$this->historyArrayExtrasence = $this->extrasenceModel->getGeneralHistoryExtrasences();
		
		$this->htmlExtrasence = $this->extrasenceModel->getExtrasenceHtml();
		//unset($_SESSION);	
		$this->showPage();
	}
	
	public function pageResult(){
		$this->title = "Результат";
		$this->resultExtrasence = $this->extrasenceModel->getGeneralResultExtrasence();
		$this->view = "result";
		$this->showPage();
	}
	
	public function pageEnter(){
		$this->title = "Загадай число";
		//unset($_SESSION);
		if(!$this->extrasenceModel->getUser()){
			$this->extrasenceModel->setUser();
		}
		$this->view = "enter";
		$this->showPage();
	}
	
	
}
?>