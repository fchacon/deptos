<?php
class Users_mdl extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function validate($email, $password, $format = 'array') {
		return true;
	}
	
	function forgottenPassword($email, $format = 'array') {
		return json_encode(array('data' => array('message' => 'Un email ha sido enviado a su cuenta')));
	}
	
	function save($user, $format = "array") {
		return json_encode(array('data' => true));
	}
}