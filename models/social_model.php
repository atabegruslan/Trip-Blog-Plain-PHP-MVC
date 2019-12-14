<?php

class Social_Model extends Model {

	public function __construct() 
	{
		parent::__construct();
	}

	public function read($email, $type)
    {
		return $this->db->read('SELECT * FROM users WHERE email = :email AND type = :type', array('email' => $email, 'type' => $type));
	} 

    public function create($data)
    {
        $this->db->create('users', $data);
    }

}

?>