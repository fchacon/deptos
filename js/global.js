var lang = {};
function getLang() {
	if(!$.isEmptyObject(lang))
		return;
	
	$.ajax({
		url: "/utilities/ajax_get_lang",
		type: "GET",
		async: false,
		success: function(resp) {
			lang = $.parseJSON(resp);
		}
	});
}