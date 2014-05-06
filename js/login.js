$(function() {
	getLang();
	var login = $("#jq-login");
	
	//Click a Ingresar
	login.off("click", ".jq-submit").on("click", ".jq-submit", function() {
		if($(this).hasClass("disabled"))
			return false;
		
		var button = $(this);
		button.addClass("disabled").text(lang.site_wait_a_moment);
		
		//Validar formulario
		if(!validateForm(login)) {
			button.removeClass("disabled").text(lang.login);
			return false;
		}
		
		var data = {};
		data.email = $.trim(login.find(".jq-email").val());
		data.password = $.trim(login.find(".jq-password").val());
		
		//Enviar datos
		$.ajax({
			url: "/login/ajax_validate",
			type: "POST",
			data: {data: data},
			success: function(resp) {
				if(resp == "1")
					window.location = "/home";
				else {
					login.find(".jq-error").removeClass("hidden-obj");
					login.find(".jq-password").val("");
					button.removeClass("disabled").text(lang.login);
				}
			}
		});
	});
});