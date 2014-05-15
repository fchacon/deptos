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
		echo $result?1:0;
	}
	
	function logout() {
		$this->session->set_userdata('logged', false);
		redirect('login');
	}
	
	function ajax_forgotten_password() {
		$email = $this->input->post('email');
		$this->load->model('users');
		echo $this->users->forgottenPassword($email, 'json');
	}
}
