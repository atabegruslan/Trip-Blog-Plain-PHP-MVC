<?php 

class Errors extends Controller {

	public function __construct($err) 
	{
		parent::__construct();

		$this->view->msg = $err;
		$this->view->render('error/index');
	}
}

?>