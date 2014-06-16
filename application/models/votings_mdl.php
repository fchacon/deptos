<?php
class Votings_mdl extends CI_Model {
	var $ws_class = "votings";
	
	function __construct() {
		parent::__construct();
	}
	
	function getByBuilding($buildingId, $page, $format = "array") {
		return $this->ws->get($this->ws_class."/getByBuilding?buildingId=".$buildingId."&page=".$page, $format);
	}
	
	function save($data, $format = "array") {
		return $this->ws->post($this->ws_class."/save", $format, $data);
	}
	
	function getById($id, $format = "array") {
		return $this->ws->get($this->ws_class."/getById?votingId=".$id, $format);
	}
}