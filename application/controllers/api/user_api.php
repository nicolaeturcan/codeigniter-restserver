<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 * @editedby    Turcan Nicolae
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class User_api extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        
        $this->load->model("User_model");

        
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }
    
    // Get one user by id.
    function user_get()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

        $user = $this->User_model->get_user( $this->get('id') );
    	
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
    // Create a new user.
    function new_user_post()
    {        
        if($this->post("name") || $this->post("surname")){
            
            $result = $this->User_model->add_user($this->post("name"),$this->post("surname"));
            
            if($result === FALSE)
            {
                $this->response(array('status' => 'failed'));
            }

            else
            {
                $this->response(array('status' => 'success'));
            }
        }
    }
    
    // Update an user by id.
    public function user_put()
    {
        $id = $this->put('id');
        $data = array(
            'name'=>$this->put('name'),
            'surname'=>$this->put('surname')
        );
            
        $result = $this->User_model->update_user($id,$data);
         
        if($result === false){
            $this->response(array("status" => "failed"));
        }else{
            $this->response(array("status" => "success"));
        }
    } 
    
    // Delete an user by id.
    function user_delete()
    {
    	$result = $this->User_model->delete_user( $this->get('id') );
        
        if($result === false){
            $this->response(array("status" => "failed"));
        }else{
            $this->response(array("status" => "success"));
        }    }
    
    // Gets all users from the table
    function users_get()
    {
        $users = $this->User_model->get_all();
        
        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
    
        
    public function send_post()
	{
		var_dump($this->request->body);
	}


	public function send_put()
	{
		var_dump($this->put('foo'));
	}
}