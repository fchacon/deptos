<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		//$ch = curl_init("http://localhost:8080/deptobook/rest/users/logIn");
		$ch = curl_init("http://www.php.net");
		echo $ch."<br/>";
		$data_string = json_encode(array("email" => "felipe.chacon@gmail.com", "password" => "pass"));
		echo "1<br/>";
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		echo "2<br/>";
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		echo "3<br/>";
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
		echo "4<br/>";
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		//'Content-Type: application/json',
		//'Content-Length: ' . strlen($data_string)
		//));
		echo "5<br/>";
		
		$return = curl_exec($ch);
		echo "6<br/>";return;
		echo print_r($return, true);
		echo "7<br/>"; return;
		$this->load->view('login');
	}
	
	function ajax_validate() {
		$data = $this->input->post('data');
		$this->load->model('users_mdl');
		
		$result = $this->users_mdl->validate($data['email'], sha1($data['password']));
// 		if($result['data']) {
// 			$this->session->set_userdata('logged', true);
// 		}
		
// 		echo json_encode(array('data' => $result['data'] ));
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
