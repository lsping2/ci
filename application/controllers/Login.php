<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("login_m");
		$this->load->helper(array("url","url2","date"));
	}
	
	public function index()
	{
		$this->check();
	}

	public function check()
	{
		$uid = $this->input->post("mb_id",TRUE);
		$pwd = $this->input->post("mb_password",TRUE);

        $row = $this->login_m->getrow($uid,$pwd);
        if( $row){
            $data  = array(
				"mb_id" => $row->mb_id,
				"rank" => $row->rank
			);
        }

		$this->session->set_userdata($data);
        $this->load->view('header');
		$this->load->view('Footer');
	}


    public function login()
	{
		$this->load->library("form_validation");
        $this->load->helper('alert','url2'); 

		$jwt = new JWT();
        $JwtSecretKey  = "MyloginSecret";
		
		$this->form_validation->set_rules("mb_id","아이디","required|min_length[3]|max_length[10]");
		$this->form_validation->set_rules("mb_password","비밀번호","required|max_length[10]");

		if( $this->form_validation->run() == false) //!$_POST
		{
			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('Footer');

		}
		else
		{

			$mb_id 			= $this->input->post('mb_id');
			$mb_password 	= $this->input->post('mb_password');
			$mb_password = strtoupper(hash("sha256", $mb_password));
		
			$row = $this->login_m->getrow($mb_id,$mb_password);

            if( $row){
                $data  = array(
                    "mb_id" => $row->mb_id,
                    "mb_name" => $row->mb_name
                );

				$token = $jwt->encode($data,$JwtSecretKey,"HS256");	
				//echo json_encode($data );

                $this->session->set_userdata($data);
                $this->load->view('header');
                $this->load->view('Footer');
            }else{
                alert('정보가 일치하지 않습니다.');
                redirect('/index.php/login/login');
            }

            
		}
	}

    public function logout()
	{
        $data = array("mb_id","mb_password");
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();

        $this->load->view('header');
        $this->load->view('Footer');
    }

	
}


