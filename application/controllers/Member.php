<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("member_m");
		$this->load->helper(array("url","date"));
	}
	
	public function index()
	{
		$this->lists();
	}

	public function lists()
	{
		$search_key = urldecode($this->uri->segment(4));
		$data["search_key"] = $search_key;

		$data["list"] = $this->member_m->getlist($search_key);

		$this->load->view('header');
		$this->load->view('member_list',$data);
		$this->load->view('Footer');
	}

	public function view()
	{
		$mb_no = $this->uri->segment(4);
		$data["row"] = $this->member_m->getrow($mb_no);

		$this->load->view('header');
		$this->load->view('member_view',$data);
		$this->load->view('Footer');
	}

	public function del()
	{
		$mb_no = $this->uri->segment(4);
		$this->member_m->deleterow($mb_no);

		redirect("/index.php/member");
	}

	public function add()
	{

		$this->load->library("form_validation");
		
		$this->form_validation->set_rules("mb_id","아이디","required|min_length[3]|max_length[10]|is_unique[member.mb_id]");
		$this->form_validation->set_rules("mb_name","이름","required|max_length[10]");
		$this->form_validation->set_rules("mb_password","비밀번호","required|max_length[10]");

		if( $this->form_validation->run() == false) //!$_POST
		{
			$this->load->view('header');
			$this->load->view('member_add');
			$this->load->view('Footer');

		}
		else
		{
			if(function_exists("password_hash")){
				$this->load->helper("password");
			}
			$hash = password_hash($this->input->post('mb_password'),PASSWORD_BCRYPT);
			$mb_id 			= $this->input->post('mb_id');
			$mb_name 		= $this->input->post('mb_name');
			$mb_password 	= $hash;
			$YmdHis 		= date('Y-m-d H:i:s');

			$data  = array(
				'mb_id' => $mb_id,
				'mb_name' => $mb_name,
				'mb_password' => $mb_password,
				'reg_date' => $YmdHis	
			);
			$result = $this->member_m->insertrow($data);
			$this->session->set_flashdata('message','가입완료.');
		
			url("/index.php/member");
		}
	}


	public function edit()
	{
		$mb_no = $this->uri->segment(4);

		$this->load->library("form_validation");

		$this->form_validation->set_rules("mb_id","아이디","required|max_length[10]");
		$this->form_validation->set_rules("mb_name","이름","required|max_length[10]");
		$this->form_validation->set_rules("mb_password","비밀번호","required|max_length[10]");
		
		if( $this->form_validation->run() == false ) //!$_POST
		{
		
			$this->load->view('header');
			$data["row"] = $this->member_m->getrow($mb_no);
			$this->load->view('member_edit', $data);
			$this->load->view('Footer');
		}
		else
		{
			$mb_id 			= $this->input->post('mb_id');
			$mb_name 		= $this->input->post('mb_name');
			$mb_password 	= $this->input->post('mb_password');

			$data  = array(
				'mb_id' => $mb_id,
				'mb_name' => $mb_name,
				'mb_password' => $mb_password
			);
			$result = $this->member_m->updaterow($data, $mb_no);
			url("/index.php/member");
		}



	}
}


