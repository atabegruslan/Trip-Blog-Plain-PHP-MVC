<?php 

class Index extends Controller {

	public function __construct() 
	{
		parent::__construct();
	}

	public function index($args) 
	{
		$this->view->msg = 'Welcome!';
		$this->view->render('index/index');
	}

}

?>
