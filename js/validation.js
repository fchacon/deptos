function validateRequired(field) {
	var response = true;
	if($.trim(field.val()) == "") {
		field.addClass("field-error");
		var span = $("<span></span>");
		span.addClass("jq-form-error form-error").text(lang.validation_required_field);
		span.insertAfter(field);
		response = false;
	}
	
	return response;
}

function validateEmail(field) {
	var email_re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var valid_email = ($.trim(field.val()) == "" || email_re.test($.trim(field.val())));
	
	if(!valid_email) {
		field.addClass("field-error");
		var span = $("<span></span>");
		span.addClass("jq-form-error form-error").text(lang.validation_invalid_email);
		span.insertAfter(field);
	}
	
	return valid_email;
}

function validateRut() {
	return true;
}

function validateForm(container) {
	container.find(".jq-form-error").remove();
	container.find(".field-error").removeClass("field-error");
	var response = true;
	container.find(":text, :password, textarea, select").each(function() {
		if($(this).data("validation") == undefined || $.trim($(this).data("validation").toString()) == "")
			return true;
		
		var validations = $(this).data("validation").toString().split("|");
		for(var i = 0; i < validations.length; i++) {
			if(validations[i] == "required")
				response = validateRequired($(this)) && response;
			else if(validations[i] == "email")
				response = validateEmail($(this)) && response;
		}
	});
	
	return response;
}