<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		$this->load->view('login');
	}
	
	function ajax_validate() {
		$data = $this->input->post('data');
		$this->load->model('users');
		$result = $this->users->validate($data['email'], sha1($data['password']));
		if($result) {
			$this->session->set_userdata('logged', true);
		}
		echo ($result)?1:0;
	}
}
