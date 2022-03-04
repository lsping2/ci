<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gubun extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("gubun_m");
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
		$uri_array = $this->uri->uri_to_assoc(3);
		$search_key = array_key_exists("search_key",$uri_array) ? urldecode($uri_array["search_key"]) : ""; //search_key값이 있을경우
		//paging start
		if($search_key ==""){
			$base_url ="/index.php/gubun/lists/page";
		}else{
			$base_url = "/index.php/gubun/lists/search_key/$search_key/page";
		}
		$page_segment = substr_count(substr($base_url,0,strpos($base_url,"page")),"/");
		$config["per_page"]=3;
		$config["total_rows"] = $this->gubun_m->rowcount($search_key);
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
		$data["list"] = $this->gubun_m->getlist($search_key,$start,$limit);

		$this->load->view('header');
		$this->load->view('gubun_list',$data);
		$this->load->view('Footer');
	}

	public function view()
	{
		$no = $this->uri->segment(4);
		$data["row"] = $this->gubun_m->getrow($no);

		$this->load->view('header');
		$this->load->view('gubun_view',$data);
		$this->load->view('Footer');
	}

	public function del()
	{
		$no = $this->uri->segment(4);
		$this->gubun_m->deleterow($no);

		redirect("/index.php/gubun");
	}

	public function add()
	{

		$this->load->library("form_validation");
		$this->load->library("upload");
		
		$this->form_validation->set_rules("name","이름","required|max_length[10]|is_unique[gubun.name]");

		if( $this->form_validation->run() == false) //!$_POST
		{
			$this->load->view('header');
			$this->load->view('gubun_add');
			$this->load->view('Footer');

		}
		else
		{

			$name 		= $this->input->post('name');
			$YmdHis 		= date('Y-m-d H:i:s');

			$data  = array(
				'name' => $name,
				'reg_date' => $YmdHis	
			);

			$result = $this->gubun_m->insertrow($data);
			redirect("/index.php/gubun");
		}
	}


	public function edit()
	{
		$no = $this->uri->segment(4);
		$this->load->library("form_validation");
		$this->form_validation->set_rules("name","이름","required|max_length[10]");
		
		if( $this->form_validation->run() == false ) //!$_POST
		{
		
			$this->load->view('header');
			$data["row"] = $this->gubun_m->getrow($no);
			$this->load->view('gubun_edit', $data);
			$this->load->view('Footer');
		}
		else
		{
			$name 		= $this->input->post('name');
			$data  = array(
				'name' => $name,
			);
	
			$result = $this->gubun_m->updaterow($data, $no);
			redirect("/index.php/gubun");
		}

	}

	

}


