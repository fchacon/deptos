<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ws {
	var $CI;
	var $WS;
	
	public function __construct() {
        $this->CI = & get_instance();
        $this->WS = $this->CI->config->item('WS_URL');
    }
	
	/*HTTP DELETE*/
	function delete($url, $data = array()){
		$full_url = $this->WS.$url;
		$curl_execution = $this->execute_curl('DELETE', $full_url, json_encode($data));
		
		$result = $curl_execution['result'];
		
		if($this->look_status($curl_execution) ==  FALSE) {
			return;
		}
		
		log_message('debug',"El resultado fue: ".print_r($result,true));
	
		return $result;
	}

	/*HTTP POST*/
	function post($url, $data = array(), $page_number = -1){
		$req_page_str = "";
		if($page_number != -1)
			$req_page_str = "?requestedpage=".$page_number;
		$full_url = $this->WS.$url.$req_page_str;
		$curl_execution = $this->execute_curl('POST', $full_url, json_encode($data));

		$result = $curl_execution['result'];
		
		if($this->look_status($curl_execution) ==  FALSE) {
			return;
		}

		log_message('debug',"El resultado fue: ".print_r($result,true));
		
		return $result;
	}
	
	/*HTTP POST FILE*/
	function post_file($url, $data = array()) {
		$full_url = $this->WS.$url;

		if(isset($data['attachedfile']))
			$data['attachedfile'] = "@".$data['attachedfile'];

		$curl_execution = $this->execute_curl('POST_FILE', $full_url, $data);

		
		$result = $curl_execution['result'];
	   
		if($this->look_status($curl_execution) ==  FALSE) {
			return;
		}
		
	    log_message('debug', 'UPLOAD RESPONSE: '.print_r($result, true));
	    log_message('debug', 'UPLOAD DATA: '.print_r($data, true));
		
		return $result;
	}

	/*HTTP GET*/
	function get($url, $page_number = -1, $per_page = -1){
		$full_url = $this->WS.$url;
		if( $page_number > 0 ){
			if( stripos($full_url,'?' ) !== false  )
				$full_url .= "&requestedpage=".$page_number;
			else
				$full_url .= "?requestedpage=".$page_number;
		}
		
		$curl_execution = $this->execute_curl('GET', $full_url);

		$result = $curl_execution['result'];
		
		//log_message('debug',"El resultado fue: ".print_r($result,true));
		
		if($this->look_status($curl_execution) ==  FALSE) {
			return;
		}
		
		return $result;
	}
	
	function regular_get($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	
	/*VER SI HAY HTTP STATUS CODE 401*/
	function look_status($curl_execution) {
		/*401: Unauthorized*/
		if($curl_execution['http_status'] == 401) {

			$this->CI->session->unset_userdata('logged');
			$this->CI->session->unset_userdata('post_login_url');
			$curl_execution['result'] = json_decode($curl_execution['result'], true);
			$code_error = $curl_execution['result']['error']['codError'];
			if( $code_error == 1 )
				$this->CI->session->set_userdata('id', $curl_execution['result']['data']);
			
			if($this->CI->input->is_ajax_request()) {
				$this->CI->output->set_status_header('401');
				return true;
			}
			else {
				$this->CI->session->set_flashdata('ERROR', $curl_execution['result']['error']['message']);
				$this->CI->session->set_flashdata('CODE_ERROR', $code_error);
				redirect();
			}
			return false;
		}
		/*400: Bad request*/
		else if($curl_execution['http_status'] == 400) {
			$curl_execution['result'] = json_decode($curl_execution['result'], true);
			$code_error = $curl_execution['result']['error']['codError'];

			if($this->CI->input->is_ajax_request()) {
				$this->CI->output->set_status_header('400');
			}
			else {
				//$this->CI->session->set_flashdata('ERROR', $curl_execution['result']['error']['message']);
				//$this->CI->session->set_flashdata('CODE_ERROR', $code_error);
			}
		}
		else if($curl_execution['http_status'] == 0) {
			//redirect('error_page');
			return false;
		}
		
		return true;
	}
	
	/*EJECUTAR CURL*/
	function execute_curl($action, $full_url, $data_string = "") {
		$ch = curl_init($full_url);
		
		$action = strtoupper($action);
		if($action == 'DELETE' || $action == 'POST') {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $action);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_string)
			));
		}
		else if($action == 'POST_FILE') {
			curl_setopt($ch, CURLOPT_HEADER, 0);
	   		curl_setopt($ch, CURLOPT_VERBOSE, 0);
	    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
	    	curl_setopt($ch, CURLOPT_POST, true);
	    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		}
		else if($action == 'GET') {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		}
		
		curl_setopt($ch, CURLOPT_PROXY, null);
		
		$return['result'] = curl_exec($ch);
		$return['http_status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		log_message('debug', $action.": se enviará: ".print_r($data_string,true));
		log_message('debug', $action.": a : ".print_r($full_url,true));
		
		return $return;
	}
}