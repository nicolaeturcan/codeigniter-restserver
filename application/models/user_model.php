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