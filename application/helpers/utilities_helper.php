<?php
function get_js($file, $plugin = "") {
	return get_css_js($file, $plugin, "js");
}

function get_css($file, $plugin = "") {
	return get_css_js($file, $plugin, "css");
}

function get_css_js($file, $plugin, $ext) {
	$url = base_url();
	if($plugin != "")
		$url .= "plugins/".$plugin."/";
	
	$url .= $ext."/".$file.".".$ext;
	return $url;
}

function get_image($img) {
	return base_url()."images/".$img;
}

function get_pagination_config() {
	$CI = &get_instance();
	$new_config = $CI->config->item("PAGINATION");
	$new_config['first_link'] = lang($new_config['first_link']);
	$new_config['last_link'] = lang($new_config['last_link']);
	$new_config['next_link'] = lang($new_config['next_link']);
	$new_config['prev_link'] = lang($new_config['prev_link']);
	return $new_config;
}
