<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Community extends CI_Controller {

	public function __construct() {
		parent::__construct();
		is_logged();
	}
	
	public function index() {
		$data['VIEW'] = "community/index";
		$this->load->view('includes/template', $data);
	}
}
