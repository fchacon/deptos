<?php
class Users_mdl extends CI_Model {

    var $ws_class = "user";

	function __construct() {
		parent::__construct();
		$this->load->library('ws');
	}
	
	function validate($email, $password, $format = 'array') {
		//return true;
	    $data = array ( 'email' => $email , 'password' => $password  );
		$result = $this->ws->post($this->ws_class."/logIn",$data);
		if($format == 'array'){
			return json_decode($result, true);
		}else
			return $result;
	}
	
	function forgottenPassword($email, $format = 'array') {
		return json_encode(array('data' => array('message' => 'Un email ha sido enviado a su cuenta')));
	}
	
	function save($user, $format = "array") {
		return json_encode(array('data' => true));
	}
}