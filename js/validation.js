function validateRequired(container) {
	var response = true;
	container.find(":text, :password, textarea, select").each(function() {
		if($(this).data("validation") == undefined || $.trim($(this).data("validation")) == "")
			return true;
		
		var validations = $(this).data("validation").toString().split("|");
		var validate = false;
		for(var i = 0; i <= validations.length; i++) {
			if(validations[i] == "required") {
				$(this).removeClass("required-field");
				$(this).next(".jq-form-error").remove();
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

function validateForm(container) {
	var response = true;
	response = response && validateRequired(container);
	
	return response;
}