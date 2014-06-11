$(function() {
	var login = $("#jq-login");
	
	//Handler boton Ingresar
	function submitLogin() {
		var button = login.find(".jq-submit");
		if(button.hasClass("disabled"))
			return false;
		
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
			success: function(resp_arg) {
				var resp = $.parseJSON(resp_arg);
				if( resp.data != "false" )
					window.location = "/home";
				else {
					login.find(".jq-error").removeClass("hidden-obj");
					login.find(".jq-password").val("");
					button.removeClass("disabled").text(lang.login);
				}
			}
		});
	}
	
	//Click a Ingresar
	login.off("click", ".jq-submit").on("click", ".jq-submit", submitLogin);
	
	//Tecla enter cuando se está en password
	login.off("keyup", ".jq-password").on("keyup", ".jq-password", function(e) {
		var keycode = (e.keyCode ? e.keyCode : e.which);
		if(keycode == '13')
			submitLogin();
	});
	
	//Click a Olvido de contraseña
	login.off("click", ".jq-forgotten-password").on("click", ".jq-forgotten-password", function() {
		forgotten_password_dialog.dialog("open");
	});
	
	//Guardar dialog en memoria
	var forgotten_password_dialog = $("#jq-forgotten-password-dialog");
	
	//Botones del dialog
	var forgotten_password_dialog_buttons = [{
		text: lang.site_accept,
		"className": "btn btn-success btn-sm",
		click: function() {
			if(!validateForm(forgotten_password_dialog))
				return false;
			
			dialogWait(forgotten_password_dialog);
			var email = $.trim(forgotten_password_dialog.find(".jq-email").val());
			$.ajax({
				url: "/login/ajax_forgotten_password",
				type: "POST",
				data: {email: email},
				success: function(resp) {
					resp = $.parseJSON(resp);
					forgotten_password_dialog.find(".jq-form").addClass("hidden-obj");
					forgotten_password_dialog.find(".jq-success-msg").text(resp.data.message).removeClass("hidden-obj");
					var accept_button = [{text: lang.site_accept, "className": "btn btn-sm btn-success", click: function() {
						forgotten_password_dialog.dialog("close");
					}}];
					assignButtons(forgotten_password_dialog, accept_button);
				}
			});
		}
	}, {
		text: lang.site_cancel,
		"className": "btn btn-default btn-sm",
		click: function() {
			forgotten_password_dialog.dialog("close");
		}
	}];
	
	//Definicion del dialog
	forgotten_password_dialog.dialog({
		autoOpen: false, modal: true, position: ["center", 20], closeOnEscape: false, resizable: false, width: 500,
		buttons: forgotten_password_dialog_buttons,
		open: function() {
			assignButtons(forgotten_password_dialog, forgotten_password_dialog_buttons);
		},
		close: function() {
			setTimeout(function() {
				cleanForm(forgotten_password_dialog);
				assignButtons(forgotten_password_dialog, forgotten_password_dialog_buttons);
				forgotten_password_dialog.find(".jq-form").removeClass("hidden-obj");
				forgotten_password_dialog.find(".jq-success-msg").addClass("hidden-obj");
			}, 100);
		}
	});
});