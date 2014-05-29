<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Votings extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('votings_mdl');
		is_logged();
	}
	
	public function index() {
		$data['VIEW'] = "votings/index";
		$data['VOTINGS'] = $this->votings_mdl->getByBuilding();
		$this->load->view('includes/template', $data);
	}
}
