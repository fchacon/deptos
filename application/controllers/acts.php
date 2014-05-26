<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acts extends CI_Controller {

	public function __construct() {
		parent::__construct();
		is_logged();
	}
	
	public function index() {
		$data['VIEW'] = "acts/index";
		$this->load->view('includes/template', $data);
	}
}
