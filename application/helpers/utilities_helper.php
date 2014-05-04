<?php
function getJs($file, $plugin = "") {
	return getCssJs($file, $plugin, "js");
}

function getCss($file, $plugin = "") {
	return getCssJs($file, $plugin, "css");
}

function getCssJs($file, $plugin, $ext) {
	$url = base_url();
	if($plugin != "")
		$url .= "plugins/".$plugin."/";
	
	$url .= $ext."/".$file.".".$ext;
	return $url;
}
