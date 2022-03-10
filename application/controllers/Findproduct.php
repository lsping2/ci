<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Findproduct extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("findproduct_m");
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
			$base_url ="/index.php/findproduct/lists/page";
		}else{
			$base_url = "/index.php/findproduct/lists/search_key/$search_key/page";
		}
		$page_segment = substr_count(substr($base_url,0,strpos($base_url,"page")),"/");
		$config["per_page"]=3;
        $config["total_rows"] = $this->findproduct_m->rowcount($search_key);
     
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
		$data["list"] = $this->findproduct_m->getlist($search_key,$start,$limit);

		$this->load->view('header_nomenu');
		$this->load->view('findproduct_list',$data);
		$this->load->view('Footer');
	}

	


}


