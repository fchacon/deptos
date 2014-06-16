<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		$this->load->view('login');
	}
	
	function ajax_validate() {
		$data = $this->input->post('data');
		$this->load->model('users_mdl');
		
		$result = $this->users_mdl->validate($data['email'], sha1($data['password']));

		if(isset($result['data']) && is_array($result['data'])) {
			$this->session->set_userdata('logged', true);
			$this->session->set_userdata('user', $result['data']);
		}
		
 		echo json_encode($result);
	}
	
	function logout() {
		$this->session->set_userdata('logged', false);
		redirect('login');
	}
	
	function ajax_forgotten_password() {
		$email = $this->input->post('email');
		$this->load->model('users_mdl');
		echo $this->users_mdl->forgottenPassword($email, 'json');
	}
}
