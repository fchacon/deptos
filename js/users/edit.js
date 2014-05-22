$(function() {
	var user_form = $("#jq-user-form");
	
	addRequiredField(user_form);
	
	setLabels(user_form);
	
	function getUser() {
		var user = {};
		user.firstname = $.trim(user_form.find(".jq-first-name").val());
		
		if($.trim(user_form.find(".jq-second-name").val()) != "")
			user.secondname = $.trim(user_form.find(".jq-second-name").val());
		
		user.lastname = $.trim(user_form.find(".jq-last-name").val());
		
		if($.trim(user_form.find(".jq-last-second-name").val()) != "")
			user.secondlastname = $.trim(user_form.find(".jq-second-last-name").val());
		
		user.rut = $.trim(user_form.find(".jq-rut").val());
		user.email = $.trim(user_form.find(".jq-email").val());
		
		return user;
	}
	
	user_form.off("click", ".jq-save").on("click", ".jq-save", function() {
		if(!validateForm(user_form)) {
			return false;
		}
		
		var button = $(this);
		buttonWait(button);
		
		$.ajax({
			url: "/users/ajax_save",
			data: {user: getUser()},
			type: "POST",
			success: function(resp_arg) {
				var resp = $.parseJSON(resp_arg);
				notify(lang.site_data_saved_successfully, "success");
				recoverButton(button);
			}
		});
	});
	
	hideLabels(user_form);
});
