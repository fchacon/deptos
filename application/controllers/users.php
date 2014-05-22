<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function edit() {
		$data['VIEW'] = "users/edit";
		$this->load->view('includes/template', $data);
	}
	
	public function ajax_save() {
		$this->load->model("users_mdl");
		$user = $this->input->post("user");
		echo $this->users_mdl->save($user, "json");
	}
}
