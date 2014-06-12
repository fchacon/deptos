<?php
class Users_mdl extends CI_Model {

    var $ws_class = "users";

	function __construct() {
		parent::__construct();
	}
	
	function validate($email, $password, $format = 'array') {
	    $data = array ( 'email' => $email , 'password' => $password  );
		return $this->ws->post($this->ws_class."/logIn", $format, $data);
	}
	
	function forgottenPassword($email, $format = 'array') {
		return json_encode(array('data' => array('message' => 'Un email ha sido enviado a su cuenta')));
	}
	
	function save($user, $format = "array") {
		return json_encode(array('data' => true));
	}
}