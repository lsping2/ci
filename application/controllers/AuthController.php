<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("authmodel");
		$this->load->helper(array("url","url2","date"));
	}

    public function login(){
        $jwt = new JWT();
        $JwtSecretKey  = "MyLoginSecret";

        $mb_id = $this->input->post('mb_id',TRUE);
		$mb_password = $this->input->post("mb_password",TRUE);
        $mb_password = strtoupper(hash("sha256", $mb_password));
        $result = $this->authmodel->check_login($mb_id,$mb_password);
        
        if($result == false){
            echo "User not found!";
        }else{
            $token = $jwt->encode($result,$JwtSecretKey,"HS256");
            echo json_encode($token);
        }
    }
    

	public function index()
	{
		echo "auth~";
	}

    public function token()
	{
		$jwt = new JWT();
    
        $JwtSecretKey  = "Mysecretwordshere";
        $data =  array(
            "userId" => "145",
            "email" =>"lsping@nate.com",
            "userName" =>"홍길동",
        );
        $token = $jwt->encode($data,$JwtSecretKey,"HS256");
        
        echo $token;
	}

    public function decode_token()
	{   
        $token = $this->uri->segment(3);
		$jwt = new JWT();
    
        $JwtSecretKey  = "Mysecretwordshere";
        
        $decoded_token = $jwt->decode($token,$JwtSecretKey,"HS256");

        echo "<pre>";
        print_r($decoded_token);

        $token1 = $jwt->jsonencode($decoded_token);
        echo $token1;
	}

	
}


