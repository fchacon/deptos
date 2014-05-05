$(function() {
	getLang();
	
	$("#jq-login").off("click", ".jq-submit").on("click", ".jq-submit", function() {
		var button = $(this);
		button.addClass("disabled").text(lang.site_wait_a_moment);
		
		if(!validateForm($("#jq-login"))) {
			button.removeClass("disabled").text(lang.login);
			return false;
		}
		
		var data = {};
		data.email = $.trim($("#jq-login .jq-email").val());
		data.password = $.trim($("#jq-login .jq-password").val());
		
		$.ajax({
			url: "/login/ajax_validate",
			type: "POST",
			data: {data: data},
			async: false,
			success: function(resp) {
				if(resp == "1")
					window.location = "/home";
				else {
					$("#jq-login .jq-error").removeClass("hidden-obj");
					$("#jq-login .jq-password").val("");
					button.removeClass("disabled").text(lang.login);
				}
			}
		});
	});
});