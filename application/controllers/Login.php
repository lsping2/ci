<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("login_m");
		$this->load->helper(array("url","date"));
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
        $this->load->helper('alert','url'); 
		
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
		
			$row = $this->login_m->getrow($mb_id,$mb_password);
            if( $row){
                $data  = array(
                    "mb_id" => $row->mb_id,
                    "mb_name" => $row->mb_name
                );
                $this->session->set_userdata($data);
                $this->load->view('header');
                $this->load->view('Footer');
            }else{
                alert('정보가 일치하지 않습니다.');
                url('/index.php/login/login');
            }

            
		}
	}

    public function logout()
	{
        $data = array("mb_id","mb_password");
        $this->session->unset_userdata($data);

        $this->load->view('header');
        $this->load->view('Footer');
    }

	
}


