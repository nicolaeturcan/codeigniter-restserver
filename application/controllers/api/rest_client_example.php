<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/Rest.php';


class rest_client_example extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		//$this->load->helper('url');
		//$this->load->view('welcome_message');
	}
    
    function ci_curl($new_name/*, $new_email*/)
    {
        $username = 'admin';
        $password = '1234';

        $this->load->library('Curl');

        $this->curl->create('http://localhost/restserver/index.php/api/user_api/user/id/1');

        // Optional, delete this line if your API is open
        //$this->curl->http_login($username, $password);

        $this->curl->post(array(
            'name' => $new_name
            //'email' => $new_email
        ));

        $result = json_decode($this->curl->execute());

        if(isset($result->status) && $result->status == 'success')
        {
            echo 'User has been updated.';
        }

        else
        {
            echo 'Something has gone wrong';
        }
    }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */