<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Votings extends CI_Controller {

	public function __construct() {
		parent::__construct();
		is_logged();
	}
	
	public function index() {
		$data['VIEW'] = "votings/index";
		$this->load->view('includes/template', $data);
	}
}
