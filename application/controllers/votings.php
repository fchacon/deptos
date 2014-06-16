<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Votings extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('votings_mdl');
		is_logged();
	}
	
	public function index($page = 1) {
		$data['VIEW'] = "votings/index";
		$user = $this->session->userdata("user");
		$data['VOTINGS'] = $this->votings_mdl->getByBuilding($user['building']['id'], $page);
		$data['VOTINGS'] = $data['VOTINGS']['data'];
		$this->load->view('includes/template', $data);
	}
	
	public function ajax_load_new() {
		$this->load->view("votings/new");
	}
	
	public function ajax_save() {
		$data = $this->input->post("data");
		$user = $this->session->userdata("user");
		$data['building']['id'] = $user['building']['id'];
		$data['user']['id'] = $user['id'];
		echo $this->votings_mdl->save($data, "json");
	}
	
	public function ajax_load_answer() {
		$id = $this->input->post("id");
		$voting = $this->votings_mdl->getById($id);
		$data['VOTING'] = $voting['data'];
		$this->load->view("votings/answer", $data);
	}
	
	public function ajax_save_answer() {
		$data['options'] = $this->input->post("options");
		$data['voting']['id'] = $this->input->post("votingId");
		$user = $this->session->userdata("user");
		$data['user']['id'] = $user['id'];
		echo $this->votings_mdl->saveAnswer($data, "json");
	}
}
