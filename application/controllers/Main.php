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

		//$this->member_m->rowcount($search_key);
		//$CI =& get_instance();
		//$CI->db->get('member');
		$this->load->view('Footer');
	}
}
