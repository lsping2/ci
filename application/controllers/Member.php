<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("member_m");
		$this->load->helper(array("url2","date"));
		$this->load->library("upload");
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
		$data["row"] = $this->member_m->getrow($mb_no);
		if($data["row"]->file_name){
			$this->del_upload($data["row"]->file_path.$data["row"]->file_name);
		}
	
		$this->member_m->deleterow($mb_no);

		url2("/index.php/member");
	}

	public function add()
	{

		$this->load->library("form_validation");
		$this->load->library("upload");
		
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
			/*
			if(function_exists("password_hash")){
				$this->load->helper("password");
			}
			$hash = password_hash($this->input->post('mb_password'),PASSWORD_BCRYPT);
			*/

			$hash= strtoupper(hash("sha256", $this->input->post('mb_password')));
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

			$file_info = $this->call_upload();

			$file_name =  $file_info['upload_data']["file_name"];
			$file_path =  $file_info['upload_data']["file_path"];
		
			if($file_name) $data["file_name"] = $file_name;
			if($file_path) $data["file_path"] = $file_path;

			$result = $this->member_m->insertrow($data);
			$this->session->set_flashdata('message','가입완료.');
		
			url2("/index.php/member");
		}
	}


	public function edit()
	{
		$mb_no = $this->uri->segment(4);
		$this->load->library("form_validation");
		$this->form_validation->set_rules("mb_id","아이디","required|max_length[10]");
		$this->form_validation->set_rules("mb_name","이름","required|max_length[10]");
		//$this->form_validation->set_rules("mb_password","비밀번호","required|max_length[10]");
		
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
			/*
			if(function_exists("password_hash")){
				$this->load->helper("password");
			}
			$hash = password_hash($mb_password,PASSWORD_BCRYPT);
			*/
			$hash= strtoupper(hash("sha256", $mb_password));
			$data  = array(
				'mb_id' => $mb_id,
				'mb_name' => $mb_name,
				'mb_password' => $hash
			);
	
			$file_info = $this->call_upload();

			$file_name =  $file_info['upload_data']["file_name"];
			$file_path =  $file_info['upload_data']["file_path"];
		
			if($file_name) $data["file_name"] = $file_name;
			if($file_path) $data["file_path"] = $file_path;

			$result = $this->member_m->updaterow($data, $mb_no);
			url2("/index.php/member");
		}

	}

	public function call_upload(){
		$config['upload_path']    = './file/';
		$config['allowed_types']   = 'gif|jpg|png';
		$config['overwrite'] = TRUE;
	
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
				//$error = array('error' => $this->upload->display_errors());
				//$this->load->view('upload_form', $error);
		}
		else
		{
			
				$mb_no = $this->uri->segment(4);
				if($mb_no){
					
					$data["row"] = $this->member_m->getrow($mb_no);
					if($data["row"]->file_name){
						
						//기존파일 삭제
						if(is_file($data["row"]->file_path.$data["row"]->file_name)){
							unlink($data["row"]->file_path.$data["row"]->file_name);
						}
					}
				}
				$upload_data = array('upload_data' => $this->upload->data());
				//$this->load->view('upload_success', $data);
				return $upload_data;
		}
		
		
		//return $this->upload->data('file_name');
		
	}


	public function del_upload($file){
		
		if($file){
			//기존파일 삭제
			unlink($file);
		}
	
	}
	
		


}


