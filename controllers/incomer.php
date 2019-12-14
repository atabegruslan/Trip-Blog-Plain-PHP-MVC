<?php 

class Incomer extends Controller {

	private $userModel;

	public function __construct() 
	{
		parent::__construct();
		$this->userModel = new User_Model();
	}
    
	public function register() 
	{
        session_start(); 

		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			return false;
		}

		$form = new Form();

        $name = $form->sanitize($_POST['name']);
        if (!$form->check_length($name, 2)) {
            new Errors('User name not long enough');
            return false;               
        }
        $name = $form->capitalize_first($name);

        $email = $form->sanitize($_POST['email']);
        if (!$form->validate_email($email)) {
            new Errors('Wrong email format');
            return false;               
        }

        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        if (!$form->confirm_equality($password, $confirm_password)) {
            new Errors('Password mismatch');
            return false;               
        }
        if (!$form->check_length($password, 6)) {
            new Errors('Password must by at least 6 letters long');
            return false;               
        }        
        $password = $_POST['password'];
    	$hash = new Hash();
    	$password = $hash->create('sha256', $password, HASH_PASSWORD_KEY);

        $duplicate_users = $this->userModel->read($email, 'normal');
        if (!empty($duplicate_users)) {
            new Errors('Email (username) already taken');
            return false;    
        }

        $duplicate_incomers = $this->model->read('email', $email);
        if (!empty($duplicate_incomers)) {
            new Errors('Email (username) already taken');
            return false;    
        }

        $captchaIn = $_POST['captcha'];
        $captcha = $_SESSION['captcha'];
        if (!$form->confirm_equality($captchaIn, $captcha)) {
            new Errors('Captcha mismatch');
            return false;               
        } 

        $code = md5(uniqid(rand()));

        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'code' => $code
        );

        $this->model->create($data);

        $mail = new Email();
        $mail->sendmail($email, $code);
		
	}
    
	public function confirm($args) 
	{
		$code = $args[0];

		$incomer = $this->model->read('code', $code);

        $user = array(
            'name' => $incomer['name'],
            'email' => $incomer['email'],
            'password' => $incomer['password'],
            'type' => 'normal'	
        );

		$this->userModel->create($user);

		header("Location: ".BASE_URL."user/login/");
	}

}

?>