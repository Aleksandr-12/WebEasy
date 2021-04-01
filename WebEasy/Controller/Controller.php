<?php


 class Controller{
	
	public $header = "./View/header.php";
	public $footer = "./View/footer.php";
	public $DirTmp = "./View/";
	public  $view = "index";
	public $title;
	
	public function showPage() {
		ob_start();
		include ($this->header);
		include ($this->DirTmp.$this->view.'.php');
		include ($this->footer);
	
		echo ob_get_clean();
	}
}

?>