<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("product_m");
		$this->load->helper(array("url","url2","date"));
		$this->load->library("upload");
		$this->load->library("pagination");
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
			$base_url ="/index.php/product/lists/page";
		}else{
			$base_url = "/index.php/product/lists/search_key/$search_key/page";
		}
		$page_segment = substr_count(substr($base_url,0,strpos($base_url,"page")),"/");
		$config["per_page"]=3;
        $config["total_rows"] = $this->product_m->rowcount($search_key);
     
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
		$data["list"] = $this->product_m->getlist($search_key,$start,$limit);

		$this->load->view('header');
		$this->load->view('product_list',$data);
		$this->load->view('Footer');
	}

	public function view()
	{
		$no = $this->uri->segment(4);
		$data["row"] = $this->product_m->getrow($no);

		$this->load->view('header');
		$this->load->view('product_view',$data);
		$this->load->view('Footer');
	}

	public function del()
	{
		$no = $this->uri->segment(4);
		$data["row"] = $this->product_m->getrow($no);
		if($data["row"]->file_name){
			$this->del_upload($data["row"]->file_path.$data["row"]->file_name);
		}
	
		$this->product_m->deleterow($no);

		redirect("/index.php/product");
	}

	public function add()
	{

		$this->load->library("form_validation");
		$this->load->library("upload");

		$this->form_validation->set_rules("name","상품명","required|max_length[10]");
        $this->form_validation->set_rules("price","가격정보","required|max_length[10]");

		if( $this->form_validation->run() == false) //!$_POST
		{
            //분류 목록
            $data["list"] = $this->product_m->getlist_gubun();

			$this->load->view('header');
			$this->load->view('product_add',$data);
			$this->load->view('Footer');

		}
		else
		{
            $gubun_no   = $this->input->post('gubun_no');
			$pdate 		= $this->input->post('pdate');
			$name 		= $this->input->post('name');
			$price 		= $this->input->post('price');
			$YmdHis 		= date('Y-m-d H:i:s');

			$data  = array(
				'gubun_no' => $gubun_no,
				'pdate' => $pdate,
				'name' => $name,
				'price' => $price,
				'reg_date' => $YmdHis	
			);

			$file_info = $this->call_upload();

			$file_name =  $file_info['upload_data']["file_name"];
			$file_path =  $file_info['upload_data']["file_path"];
            $file_name_real =  $file_info['upload_data']["client_name"];
		
			if($file_name) $data["file_name"] = $file_name;
			if($file_path) $data["file_path"] = $file_path;
            if($file_name_real) $data["file_name_real"] = $file_name_real;
            

			$result = $this->product_m->insertrow($data);
			$this->session->set_flashdata('message','등록완료.');
		
			redirect("/index.php/product");
		}
	}


	public function edit()
	{
		$no = $this->uri->segment(4);
		$this->load->library("form_validation");
		$this->form_validation->set_rules("name","상품명","required|max_length[10]");
        $this->form_validation->set_rules("price","가격정보","required|max_length[10]");
		
		if( $this->form_validation->run() == false ) //!$_POST
		{
		
            //분류 목록
            $data["list"] = $this->product_m->getlist_gubun();
            
			$this->load->view('header');
			$data["row"] = $this->product_m->getrow($no);
			$this->load->view('product_edit', $data);
			$this->load->view('Footer');
		}
		else
		{

			$gubun_no   = $this->input->post('gubun_no');
			$pdate 		= $this->input->post('pdate');
			$name 		= $this->input->post('name');
			$price  	= $this->input->post('price');

			$data  = array(
				'gubun_no' => $gubun_no,
				'pdate' => $pdate,
				'name' => $name,
				'price' => $price
			);
	
			$file_info = $this->call_upload();

			$file_name =  $file_info['upload_data']["file_name"];
			$file_path =  $file_info['upload_data']["file_path"];
			$file_name_real =  $file_info['upload_data']["client_name"];
		
			if($file_name) $data["file_name"] = $file_name;
			if($file_path) $data["file_path"] = $file_path;
			if($file_name_real) $data["file_name_real"] = $file_name_real;

			$result = $this->product_m->updaterow($data, $no);
			redirect("/index.php/product");
		}

	}

	public function call_upload(){
		$config['upload_path']  = './file_product/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|heic';
        $config['max_size'] = '5000';

		$config['overwrite'] = TRUE;
		$config['file_name'] = "p_".time();
	
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
				//$error = array('error' => $this->upload->display_errors());
				//$this->load->view('upload_form', $error);
		}
		else
		{
			
				$no = $this->uri->segment(4);
				if($no){
					
					$data["row"] = $this->product_m->getrow($no);
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


