<?php
class Votings_mdl extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function getByBuilding($format = "array") {
		return array(array("id" => 1, "title" => "Votacion 1", "description" => "Descripción votacion 1"), array("id" => 2, "title" => "Votacion 2", "description" => "Descripción votacion 2"));
	}
	
	function create($data, $format = "array") {
		return array("data" => 1);
	}
	
	function getById($id, $format = "array") {
		return array("data" => array("title" => "Votacion 1", 
									"description" => "Descripcion", 
									"options" => array(array("id" => 1, "text" => "Opcion 1"), array("id" => 2, "text" => "Opcion 2")), 
									"multiple" => 1));
	}
}