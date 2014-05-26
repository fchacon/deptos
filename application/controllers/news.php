<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('news_mdl');
		is_logged();
	}
	
	public function index() {
		$data['VIEW'] = "news/index";
		$data['NEWS'] = $this->news_mdl->getByBuilding();
		$this->load->view('includes/template', $data);
	}
}
