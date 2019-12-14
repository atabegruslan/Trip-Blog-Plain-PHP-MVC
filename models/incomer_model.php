<?php

class Incomer_Model extends Model {

	public function __construct() 
	{
		parent::__construct();
	}

    public function create($data)
    {
        $this->db->create('incomers', array(
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'code' => $data['code']
        ));
    }

	public function read($searchBy, $searchKey)
    {
		return $this->db->read('SELECT * FROM incomers WHERE '.$searchBy.' = :'.$searchBy, array($searchBy => $searchKey));
	}  
}

?>