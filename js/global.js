var lang = {};
function getLang() {
	if(!$.isEmptyObject(lang))
		return;
	
	$.ajax({
		url: "/utilities/ajax_get_lang",
		type: "GET",
		async: false,
		success: function(resp) {
			resp = $.parseJSON(resp);
			lang = resp.data;
		}
	});
}

function checkVar(x) {
	if(x == null || x == undefined || (typeof x != "object" && $.trim(x) === "") || $.trim(x) === "null" || x === false)
		return false;
		
	return true;
}

function cleanForm(container) {
	container.find(":text, textarea, select, :password").val("");
	container.find(":radio, :checkbox").prop("indeterminate", false).prop("checked", false);
	container.find(".jq-form-error").remove();
	container.find(".field-error").removeClass("field-error");
}

function assignButtons(dialog, buttons) {
	dialog.next(".ui-dialog-buttonpane").find(".ui-dialog-buttonset").html("");
	$.each(buttons, function(index, button) {
		var buttonItem = $("<button></button>");
		if(checkVar(button.disabled) && button.disabled == true)
			buttonItem.prop("disabled", true);
		buttonItem.addClass(button.className).text(button.text);
		if(checkVar(button.click))
			buttonItem.click(button.click);
		buttonItem.appendTo(dialog.next(".ui-dialog-buttonpane").find(".ui-dialog-buttonset"));
	});
}

function dialogWait(dialog) {
	var button_wait = [{
		text: lang.site_wait_a_moment,
		"className": "btn btn-success",
		disabled: true
	}];
	assignButtons(dialog, button_wait);
}

function globalAjax() {
	$(document).ajaxSuccess(function(event, xhr, settings) {
		if(xhr.status != 200) {
			//Error
			alert("Error");
			return false;
		}
		
		if(checkVar(xhr.responseText)) {
			var resp = xhr.responseText;
			try {
				resp = $.parseJSON(resp);
				if(checkVar(resp.data)) {
					return true;
				}
				else {
					if(checkVar(resp.error) && checkVar(resp.error.message)) {
						//Error
						alert("Error");
					}
					else {
						//Otro error
						alert("Error");
					}
				}
			}
			catch(err) {
				//Error
				return false;
			}
		}
	});
}

globalAjax();
