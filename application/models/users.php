<?php
class Users extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function validate($email, $password) {
		return true;
	}
}