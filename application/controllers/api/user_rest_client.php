
<?php defined('BASEPATH') OR exit('No direct script access allowed');


class User_Rest_Client extends CI_Controller{


	function __construct()
    {
        parent::__construct();
        $this->load->library('Rest');
        $this->load->library('Curl');
        $this->load->config('rest_client');
        $config = array('server' =>'http://localhost/restserver/index.php/',
                        'api_key' => $this->config->item('api_key'),
                        'api_name' => 'X-API-KEY'
                       );
        
        $this->rest->initialize($config);
    }

    public function index(){
        $user = $this->rest->get('api/user_api/users/');
        echo json_encode($user);
        
    }
    
     function get_user($id = null){   
       $get_user_url = 'api/user_api/user/id/';

     	if($id != null){
     		$user = $this->rest->get($get_user_url, array('id' => $id));
        }
         
        echo json_encode($user);
    }

    function update_user(){
        $update_user_url = 'api/user_api/user';

        $id = 200;
        $column = 'name';
        $name = 'Update_name';
        $data = array(
            'id'=>$id,
            $column=>$name);
             
        $response = $this->rest->post($update_user_url,$data);
        echo json_encode($response);
    }

    function delete_user($id = null){
        $delete_user_url = 'api/user_api/user';

        if($id){
            $response = $this->rest->delete($delete_user_url.'/id/'.$id);
            echo json_encode($response);
            
        }else{
           $message = $this->rest->delete($delete_user_url.'/id/');
           echo json_encode($message);
        }
    }

    function add_user(){

        $user = array(            
            'name'=>'add',
            'surname'=>'succesfully'
            );

        $user_add_url = 'api/user_api/user';
        $response = $this->rest->put($user_add_url,$user);
        
        echo json_encode($response); 
    }
 }
 ?>
        
        
        
