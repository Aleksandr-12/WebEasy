<?php
require_once "./functions.php";
require_once "./Model/model_class.php";
require_once "Controller.php";

class PageController extends Controller{
	
	public $model = '';
	public $ExtrasensNumberOne = '';
	public $ExtrasensNumberTwo = '';
	
	public function __construct($pageName = '') {
		session_start();
		$this->model = new model_class();
		$this->createPage($pageName);
	}

	public function createPage($pageName=''){
		
		switch($pageName){
			case 'rand':
				$this->PageRand();
				break;
			case 'res_notif':
				$this->ResNotif();
				break;
			default:
				$this->PageEnter();
				break;
		}
	}
	
	public function PageRand(){
		$this->title = 'Главная';
		if($_GET['number']){
			if($this->model->validateNumber($_GET['number'])){
				$this->model->getResultExtrasense($this->model->secureAcces($_GET['number']), $_SESSION["dogat_extra_1"], $_SESSION["dogat_extra_2"]);
				unset($_GET['number']);
				redirect('/res_notif');
			}else{
				setError();
				redirect();
			}
			
		}
		
		$this->model->getDostovernost();
		
		$this->ExtrasensNumberOne = $this->model->getExtrasensNumberOne();
		$this->ExtrasensNumberTwo = $this->model->getExtrasensNumberTwo();
		$_SESSION["dogat_extra_1"] = $this->ExtrasensNumberOne;
		$_SESSION["dogat_extra_2"] = $this->ExtrasensNumberTwo;
		//unset($_SESSION['array_result']);	
		$this->showPage();
	}
	
	public function ResNotif(){
		$this->title = "Результат";
		
		$this->view = "res_notif";
		$this->showPage();
	}
	
	public function PageEnter(){
		$this->title = "Загадай число";
		if(!$_SESSION['user']){
			$_SESSION['user'] = $this->model->getUserRand();
		}
		$this->view = "enter";
		$this->showPage();
	}
	
	
}
?>