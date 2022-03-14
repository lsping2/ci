<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("member_m");
		$this->load->helper(array("url","url2","date"));
		$this->load->library("upload");
		$this->load->library("pagination");
		$this->load->library("PHPExcel");
	}
	
	public function index()
	{
		$this->lists();
	}

	public function lists()
	{
		//$search_key = urldecode($this->uri->segment(4));
		//$data["search_key"] = $search_key;
		$uri_array = $this->uri->uri_to_assoc(3);
		$search_key = array_key_exists("search_key",$uri_array) ? urldecode($uri_array["search_key"]) : ""; //search_key값이 있을경우
	
		//paging start
		if($search_key ==""){
			$base_url ="/member/lists/page";
		}else{
			$base_url = "/member/lists/search_key/$search_key/page";
		}
		$page_segment = substr_count(substr($base_url,0,strpos($base_url,"page")),"/")+1;
		$config["per_page"]=3;
		$config["total_rows"] = $this->member_m->rowcount($search_key);
		$config["uri_segment"] = $page_segment;
		$config["base_url"] = $base_url;
		$this->pagination->initialize($config);
		$data["total_rows"] = $config["total_rows"];
		$data["per_page"] = $config["per_page"];
		$data["page"] = $this->uri->segment($page_segment,0);
		$data["pagination"] = $this->pagination->create_links();
		
		$start = $data["page"];
		$limit = $config["per_page"];
		//paging end
		
		$data["search_key"] = $search_key;
		$data["list"] = $this->member_m->getlist($search_key,$start,$limit);

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

		https://view.shoppinglive.naver.com/lives/443760view
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

			$file_info = $this->call_upload($mb_id);

			$file_name =  $file_info['upload_data']["file_name"];
			$file_path =  $file_info['upload_data']["file_path"];
			$file_name_real =  $file_info['upload_data']["client_name"];
		
			if($file_name) $data["file_name"] = $file_name;
			if($file_path) $data["file_path"] = $file_path;
			if($file_name_real) $data["file_name_real"] = $file_name_real;

			$result = $this->member_m->insertrow($data);
			$this->session->set_flashdata('message','가입완료.');
		
			redirect("/index.php/member");
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
	
			$file_info = $this->call_upload($mb_id);

			$file_name =  $file_info['upload_data']["file_name"];
			$file_path =  $file_info['upload_data']["file_path"];
			$file_name_real =  $file_info['upload_data']["client_name"];
		
			if($file_name) $data["file_name"] = $file_name;
			if($file_path) $data["file_path"] = $file_path;
			if($file_name_real) $data["file_name_real"] = $file_name_real;

			$result = $this->member_m->updaterow($data, $mb_no);
			redirect("/index.php/member");
		}

	}

	public function call_upload($mb_id){
		$config['upload_path']  = './file/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|heic';
        $config['max_size'] = '8000';

		$config['overwrite'] = TRUE;
		$config['file_name']    = $mb_id."_".time();
	
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


	public function excel()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$search_key = array_key_exists("search_key",$uri_array) ? urldecode($uri_array["search_key"]) : ""; //search_key값이 있을경우
		
		$count = $this->member_m->rowcount($search_key);
		$data["list"]  = $this->member_m->getlist_all($search_key);
		
		$this->load->view('member_excel',$data);
		/*
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '아이디')
            ->setCellValue('B2', '이름')
            ->setCellValue('C1', '등록일');

		foreach($list as $row){
			//echo $row->mb_name;
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', $row->mb_id)
            ->setCellValue('A5', $row->mb_name)
			->setCellValue('A5', $row->reg_date);
		}

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="01simple.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		*/
		
	}

}


