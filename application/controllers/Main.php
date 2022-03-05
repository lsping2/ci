<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("member_m");
	}
	
	public function index()
	{
		$this->load->view('header');
		$data["list"] = $this->member_m->getstat_member();
		$this->load->view('main',$data);
		$this->load->view('Footer');
	}
}
