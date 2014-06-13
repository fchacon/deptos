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
			//TODO definir que va dentro de esta variable 	
			$this->session->set_userdata('userId', $result['data']['id']);
			if( isset($result['data']['role']) && is_array ($result['data']['role'] ) ) { //TODO definir que va dentro de esta variable, el nombre? el id?
				$this->session->set_userdata('role', $result['data']['role']['name'] ); 
			}
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
