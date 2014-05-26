<?php
class News_mdl extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function getByBuilding($format = "array") {
		return array(array("id" => 1, "title" => "Novedad 1", "description" => "Descripción novedad 1"), array("id" => 2, "title" => "Novedad 2", "description" => "Descripción novedad 2"));
	}
}