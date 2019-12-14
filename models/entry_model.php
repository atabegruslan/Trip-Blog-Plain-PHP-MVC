<?php

class Entry_Model extends Model {

	public function __construct() 
	{
		parent::__construct();
	}

	public function readAll(){
		return $this->db->readAll('SELECT * FROM entries');
	}

	public function read($searchBy, $searchKey){
		return $this->db->read('SELECT * FROM entries'.' WHERE '.$searchBy.' = :'.$searchBy, array($searchBy => $searchKey));
	}

    public function create($data)
    {
        $this->db->create('entries', array(
            'place' => $data['place'],
            'comments' => $data['comments'],
            'img' => $data['img'],
            'user_id' => $data['user_id']
        ));
    }

    public function update($data)
    {
        $postData = array(
            'place' => $data['place'],
            'comments' => $data['comments'],
            'img' => $data['img'],
            'user_id' => $data['user_id']
        );
        
        $this->db->update('entries', $postData, "`id` = '{$data['id']}'");
    }
    
    public function delete($data)
    {
        $this->db->delete('entries', "`id` = {$data['id']}");
    }    
}

?>