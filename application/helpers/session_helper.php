<?php
function is_logged() {
	$CI = &get_instance();
	if($CI->session->userdata('logged') === FALSE) {
		redirect('login');
		exit;
	}
}
