//Funcion para cargar traducciones y poder utilizarlas en
//ambientes js. Ej: lang.site_accept ==> "Aceptar"
var lang = {};
function getLang() {
	if(!$.isEmptyObject(lang))
		return;
	
	$.ajax({
		url: "/utilities/ajax_get_lang",
		type: "GET",
		async: false,
		success: function(resp_arg) {
			var resp = $.parseJSON(resp_arg);
			lang = resp.data;
		}
	});
}

//Cargar traducciones
getLang();

//Funcion para cargar algunas urls
var globalUrl = {};
function getGlobalUrl() {
	if(!$.isEmptyObject(globalUrl))
		return;
	
	$.ajax({
		url: "/utilities/ajax_get_url",
		type: "GET",
		async: false,
		success: function(resp_arg) {
			var resp = $.parseJSON(resp_arg);
			globalUrl = resp.data;
		}
	});
}

//Cargar urls
getGlobalUrl();

//Funcion para validar una variable
function checkVar(x) {
	if(x == null || x == undefined || (typeof x != "object" && $.trim(x) === "") || $.trim(x) === "null" || x === false)
		return false;
		
	return true;
}

//Limpia formularios
function cleanForm(container) {
	container.find(":text, textarea, select, :password").val("");
	container.find(":radio, :checkbox").prop("indeterminate", false).prop("checked", false);
	container.find(".jq-form-error").remove();
	container.find(".field-error").removeClass("field-error");
}

//Asigna botones a un dialog
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

//Reemplaza botones de un dialog por un boton que dice: "Espere un momento"
function dialogWait(dialog) {
	var button_wait = [{
		text: lang.site_wait_a_moment,
		"className": "btn btn-success",
		disabled: true
	}];
	assignButtons(dialog, button_wait);
}

//Reemplaza un boton por uno que dice: "Espere un momento"
function buttonWait(button) {
	button.addClass("hidden-obj");
	var wait_button = $("<button></button>");
	wait_button.addClass("btn btn-success jq-wait-button").prop("disabled", true).text(lang.site_wait_a_moment);
	wait_button.insertAfter(button);
}

//Elimina el boton de "Espere un momento"
function recoverButton(button) {
	button.next(".jq-wait-button").remove();
	button.removeClass("hidden-obj");
}

//Parametros ajax globales
function globalAjax() {
	$(document).ajaxSuccess(function(event, xhr, settings) {
		if(checkVar(xhr.getResponseHeader('redirectTo')) && xhr.getResponseHeader('redirectTo') != "") {
			window.location = xhr.getResponseHeader('redirectTo');
			return false;
		}
		
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
						alert(resp.error.message);
					}
				}
			}
			catch(err) {
				//Error
				return false;
			}
		}
		else {
			alert("Error ajax");
		}
	});
}

//Inicializa ajax global
globalAjax();

//Retorna un string random. Sirve para poder generar passwords o id's.
function rdmStr(length) {
	var str = "";
	var randomNumber;
	
	for(var i = 0; i < length; i++) {
		randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
		if((randomNumber >=33) && (randomNumber <=47))
			continue;
		if((randomNumber >=58) && (randomNumber <=64))
			continue;
		if((randomNumber >=91) && (randomNumber <=96))
			continue;
		if((randomNumber >=123) && (randomNumber <=126))
			continue;
		
		str += String.fromCharCode(randomNumber);
	}
	
	return str;
}

//Entrega un id unico para un elemento html
function uuid() {
	var str = "id_"+rdmStr(6);
	while($("#"+str).length > 0)
		str = "id_"+rdmStr(6);
	
	return str;
}

//Setea el atributo for de los labels que esten dentro de container
function setLabels(container) {
	container.find("label").each(function() {
		var field;
		if($(this).prev().is(":checkbox") || $(this).prev().is(":radio"))
			field = $(this).prev();
		else {
			field = $(this).next(":text, textarea, select").first();
			if(field.length == 0)
				field = $(this).next().find(":text, textarea, select").first();
		}
		
		var id = uuid();
		field.attr("id", id);
		$(this).attr("for", id);
	});
}

//Sirve para agregar una notificacion
function notify(message, type) {
	var title = "";
	if(type == "success")
		title = lang.site_success;
	else if(type == "info")
		title = lang.site_info;
	else if(type == "error")
		title = lang.site_error;
	
	new PNotify({title: title, text: message, type: type});
}

//Agrega un asterisco a los campos obligatorios
function addRequiredField(container) {
	container.find(":text, select, textarea").each(function() {
		if($(this).data("validation") == undefined || $.trim($(this).data("validation").toString()) == "")
			return true;
		
		var validations = $(this).data("validation").toString().split("|");
		var element = $(this);
		$.each(validations, function(index, validation) {
			if(validation == "required") {
				var label = element.prev("label");
				var html_required = $("<span></span>");
				html_required.addClass("red-asterisk").text("*").data({toggle: "tooltip", placement: "top", title: "Campo obligatorio"});
				html_required.appendTo(label);
				html_required.tooltip();
				return false;
			}
		});
	});
}

//Esconde los labels arriba de los campo de texto y construye atributos placeholder
function hideLabels(container) {
	if($.support.placeholder) {
		container.find(":text").each(function() {
			var label = $(this).prev("label");
			var placeholder = label.text();
			$(this).attr("placeholder", placeholder);
			label.remove();
		});
	}
}

//Sirve para determinar si el navegador soporta el atributo placeholder
jQuery.support.placeholder = (function(){
    var i = document.createElement('input');
    return 'placeholder' in i;
})();

function printLoading(element, height) {
	element.addClass("hidden-obj");
	var attributes = {src: globalUrl["loading_"+height], title: lang.loading};
	var div_loading = $("<div></div>").addClass("text-center jq-loading");
	var loading = $("<img />").attr(attributes);
	loading.appendTo(div_loading);
	div_loading.insertAfter(element);
}

function removeLoading(element) {
	element.next(".jq-loading").remove();
	element.removeClass("hidden-obj");
}
