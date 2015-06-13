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
        //log_message('debug', var_export($query));

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
    
    function add_user($user)
    {
        if ($user)
        {
            $this->db->insert('user',$user);
            $row = $this->db->affected_rows();
            $id = $this->db->insert_id();
            $result=array();
            $result['id'] = $id;
            
            if($row == 1){
              $response = true;
               $result['response'] = $response;
              }else{
                $response = false;
                $result['response'] = $response;
              }
            
            return $result;
        }else{
            return false;
        }
    }

       /*
    
        public function get($id)
    {
        this->db->select('id, name', 'surname');
        $query = $this->db->get_where("user", array("id" => $id));
        if($query->num_rows() == 1){
            return $query->row();
        }
    }
    
    
    public function get_all()
    {
        $this->db->select('id','name','surname');
        $this->db->from('user');

        $query = $this->db->get();
        
        echo $this->db->last_query(). "<br/>";
        log_message('debug', var_export($query));
        
        if($query->num_rows() > 0){
            return $query->result();
        }
    }
*/
   
    
}

?>