<?php
class Votings_mdl extends CI_Model {
	var $ws_class = "votings";
	
	function __construct() {
		parent::__construct();
	}
	
	function getByBuilding($format = "array") {
		return $this->ws->get($this->ws_class."/getByBuilding", $format);
	}
	
	function save($data, $format = "array") {
		return $this->ws->post($this->ws_class."/save", $format, $data);
	}
	
	function getById($id, $format = "array") {
		return array("data" => array("title" => "Votacion 1", 
									"description" => "Descripcion", 
									"options" => array(array("id" => 1, "text" => "Opcion 1"), array("id" => 2, "text" => "Opcion 2")), 
									"multiple" => 0));
	}
}