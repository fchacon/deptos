function validateRequired(container) {
	var response = true;
	container.find(":text, :password, textarea, select").each(function() {
		if($(this).data("validation") == undefined || $.trim($(this).data("validation")) == "")
			return true;
		
		var validations = $(this).data("validation").toString().split("|");
		var validate = false;
		for(var i = 0; i <= validations.length; i++) {
			if(validations[i] == "required") {
				validate = true;
				break;
			}
		}
		if(validate && $.trim($(this).val()) == "") {
			$(this).addClass("required-field");
			var span = $("<span></span>");
			span.addClass("jq-form-error form-error").text(lang.validation_required_field);
			span.insertAfter($(this));
			response = false;
		}
	});
	
	return response;
}

function validateEmail(container) {
	var response = true;
	container.find(":text").each(function() {
		if($(this).data("validation") == undefined || $.trim($(this).data("validation")) == "")
			return true;
		
		var validations = $(this).data("validation").toString().split("|");
		var validate = false;
		for(var i = 0; i <= validations.length; i++) {
			if(validations[i] == "email") {
				validate = true;
				break;
			}
		}
		
		var email_re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var valid_email = ($.trim($(this).val()) == "" || email_re.test($.trim($(this).val())));
		 
		if(validate && !valid_email) {
			$(this).addClass("field-error");
			var span = $("<span></span>");
			span.addClass("jq-form-error form-error").text(lang.validation_invalid_email);
			span.insertAfter($(this));
			response = false;
		}
	});
	
	return response;
}

function validateForm(container) {
	container.find(".jq-form-error").remove();
	container.find(".field-error").removeClass(".field-error");
	var response = true;
	response = response && validateRequired(container);
	response = response && validateEmail(container);
	
	return response;
}