<?php
function is_logged() {
	$CI = &get_instance();
	if($CI->session->userdata('logged') === FALSE) {
		if($CI->input->is_ajax_request()) {
			header("redirectTo: ".base_url());
			exit;
		}
		else {
			redirect('login');
			exit;
		}
	}
}
