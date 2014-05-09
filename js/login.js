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
	
	//Click a Olvido de contraseña
	login.off("click", ".jq-forgotten-password").on("click", ".jq-forgotten-password", function() {
		forgotten_password_dialog.dialog("open");
	});
	
	var forgotten_password_dialog = $("#jq-forgotten-password-dialog");
	forgotten_password_dialog.dialog({
		autoOpen: false, modal: true, position: ["center", 20], closeOnEscape: false, resizable: false, width: 500,
		buttons: [{
			text: "OK",
			"class": "btn btn-success",
			click: function() {
				
			}
		}, {
			text: "Cancel",
			"class": "btn",
			click: function() {
				
			}
		}],
		close: function() {
			setTimeout(function() {
				cleanForm(forgotten_password_dialog);
			}, 100);
		}
	});
});