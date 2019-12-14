<?php 

class User extends Controller {

	public function __construct() 
	{
		parent::__construct();

		session_start();
        if ( isset($_SESSION['user_id']) ) {
            header("Location: ".BASE_URL."entry/");
        } 
	}

	public function login() 
	{
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->view->render('user/login');
			return true;
		}

		$user = $this->model->read($_POST['email'], 'normal');

		if (empty($user)) {
			new Errors('User unfound');
			return false;	
		}

		//check password
		$existing_password = $user['password'];
		$hash = new Hash();
		$input_password = $hash->create('sha256', $_POST['password'], HASH_PASSWORD_KEY);
		
		$form = new Form();
        if (!$form->confirm_equality($existing_password, $input_password)) {
            new Errors('Password wrong');
            return false;               
        }

		session_start();
		$_SESSION['user_id'] = $user['id'];

		header('location: ' . BASE_URL . 'entry');
	}
    
	public function logout() 
	{
		session_start();

		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			return false;
		}

		unset($_SESSION);
		session_destroy();

		header('location: ' . BASE_URL . 'user/login');
	}
    
	public function register() 
	{
		$this->view->render('user/register');
		return true;
	}

}

?>