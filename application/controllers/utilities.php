<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilities extends CI_Controller {

	public function ajax_get_lang() {
		$this->config->load("languages");
		
		$langs = $this->config->item("LANGUAGES_ITEMS");
		$response = array();
		for($i = 0; $i < count($langs); $i++) {
			$response[$langs[$i]] = lang($langs[$i]);
		}
		
		echo json_encode(array('data' => $response));
	}
	
	public function ajax_get_url() {
		$urls['base'] = base_url();
		$urls['loading_small'] = get_image("loading_small.gif");
		$urls['loading_large'] = get_image("loading_large.gif");
		
		echo json_encode(array('data' => $urls));
	}
}
