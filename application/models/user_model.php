<?php

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->dbutil(); 
    }
    
    public function get_user($id)
    {
        $this->db->select('id, name, surname');
        $this->db->where('id',$id);
        $query = $this->db->get('user');

        if($query->num_rows() == 1){
            return $query->result();
        }
    }

    function get_all() 
    {
        $query = $this->db->get('user');
                
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
    }
    
    function add_user($name, $surname) 
    {
        $data = array(
            "name" => $name,
            "surname" => $surname
        );
        
        return $this->db->insert("user", $data);
    }
    
    function update_user($id, $data){

        $this->db->where('id',$id);
        return $this->db->update('user',$data);
    }
    
    public function delete_user($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('user');
    } 
}

?>