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
		$data['VOTINGS'] = $data['VOTINGS']['data'];
		$this->load->view('includes/template', $data);
	}
	
	public function ajax_load_new() {
		$this->load->view("votings/new");
	}
	
	public function ajax_save() {
		$data = $this->input->post("data");
		$data['building']['id'] = 1;
		$data['user']['id'] = 1;
		echo $this->votings_mdl->save($data, "json");
	}
	
	public function ajax_load_answer() {
		$id = $this->input->post("id");
		$voting = $this->votings_mdl->getById($id);
		$data['VOTING'] = $voting['data'];
		$this->load->view("votings/answer", $data);
	}
}
