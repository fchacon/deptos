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
