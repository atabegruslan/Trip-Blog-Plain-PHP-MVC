<?php

class User_Model extends Model {

	public function __construct() 
	{
		parent::__construct();
	}

    public function create($data)
    {
        $this->db->create('users', array(
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'type' => $data['type']
        ));
    }

	public function read($email, $type)
    {
        $form = new Form();

        $email = $form->sanitize($email);
        if (!$form->validate_email($email)) {
            new Errors('Wrong email format');
            return false;               
        }        

        if (!$form->check_type($type)) {
            new Errors('Login type error');
            return false;               
        }  

		return $this->db->read('SELECT * FROM users WHERE email = :email AND type = :type', array('email' => $email, 'type' => $type));
	}    
}

?>