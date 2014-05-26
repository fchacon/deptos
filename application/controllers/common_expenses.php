<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_expenses extends CI_Controller {

	public function __construct() {
		parent::__construct();
		is_logged();
	}
	
	public function index() {
		$data['VIEW'] = "common_expenses/index";
		$this->load->view('includes/template', $data);
	}
}
