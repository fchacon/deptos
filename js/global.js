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

function cleanForm(container) {
	container.find(":text, textarea, select, :password").val("");
	container.find(":radio, :checkbox").prop("indeterminate", false).prop("checked", false);
}
