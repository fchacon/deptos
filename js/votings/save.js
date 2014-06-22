$(function() {
	var create_voting_dialog = $("#jq-create-voting-dialog");
	
	//Botones para crear nueva votacion
	buttons_for_new_voting = [{
		text: lang.site_create,
		"className": "btn btn-sm btn-success",
		click: function() {
			dialogWait(create_voting_dialog);
			if(!validateVoting())
				return false;

			var data = getVoting(create_voting_dialog);
			$.ajax({
				url: "/votings/ajax_save",
				type: "POST",
				data: {data: data},
				success: function(resp_arg) {
					create_voting_dialog.dialog("close");
					notify(lang.voting_created_successfully, "success");
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				},
				error: function() {
					assignButtons(create_voting_dialog, buttons_for_new_voting);
				}
			});
		}
	}, {
		text: lang.site_cancel,
		"className": "btn btn-sm btn-default",
		click: function() {
			create_voting_dialog.dialog("close");
		}
	}];
	
	//Definicion del dialog de crear nueva votacion
	create_voting_dialog.dialog({
		autoOpen: false, modal: true, position: ["center", 20], closeOnEscape: false, resizable: false, width: 500,
		buttons: buttons_for_new_voting,
		open: function() {
			assignButtons(create_voting_dialog, buttons_for_new_voting);
			if($.trim(create_voting_dialog.find(".jq-content").html()) == "") {
				printLoading(create_voting_dialog.find(".jq-content"), "large");
				create_voting_dialog.find(".jq-content").load("/votings/ajax_load_new", function() {
					create_voting_dialog.find(".jq-new-option:first").click();
					setLabels(create_voting_dialog);
					addRequiredField(create_voting_dialog);
					removeLoading(create_voting_dialog.find(".jq-content"));
				});
			}
		},
		close: function() {
			setTimeout(function() {
				//Limpiar :text, selects y textarea
				create_voting_dialog.find(":text, select, textarea").val("");
				
				//Descheckear opcion de opciones multiples
				create_voting_dialog.find(".jq-multiple").prop("checked", false);
				checkMultipleAnswers();
				
				//Eliminar opciones, excepto la primera
				create_voting_dialog.find(".jq-option-group:not(:first)").remove();
				
				//Clonarla primera opcion para obtener el minimo de opciones (2)
				create_voting_dialog.find(".jq-new-option:first").click();
				
				//Eliminar elementos de error
				create_voting_dialog.find(".jq-form-error").remove();
				create_voting_dialog.find(".field-error").removeClass("field-error");
				
				//Enumerarlas
				enumerateOptions();
			}, 50);
		}
	});
	
	//Click a crear nueva votacion
	$("#jq-create-voting").click(function() {
		create_voting_dialog.dialog("open");
	});
	
	//Click a agregar opcion
	create_voting_dialog.off("click", ".jq-new-option").on("click", ".jq-new-option", function() {
		var option_group = create_voting_dialog.find(".jq-option-group:last");
		var clone = option_group.clone();
		clone.find(":text").removeClass("field-error");
		clone.find(".jq-form-error").remove();
		setLabels(clone);
		clone.find(".jq-option").val("");
		clone.insertAfter(option_group);
		enumerateOptions();
		create_voting_dialog.scrollTo($(this));
	});
	
	//Click a quitar opcion
	create_voting_dialog.off("click", ".jq-remove-option").on("click", ".jq-remove-option", function() {
		//Debe haber un minimo de 2 opciones
		var options = create_voting_dialog.find(".jq-option-group");
		var option_group = $(this).parentsUntil(".jq-option-group").parent(".jq-option-group");
		
		if(options.length > 2) {
			option_group.remove();
			enumerateOptions();
		}
		else
			option_group.find(".jq-option").val("");
	});
	
	//Enumerar opciones
	function enumerateOptions() {
		create_voting_dialog.find(".jq-option-number").each(function(index) {
			$(this).text(index+1);
		});
	}
	
	//Obtener json de una votacion
	function getVoting(container) {
		var data = {};
		data.title = $.trim(container.find(".jq-title").val());
		data.description = $.trim(container.find(".jq-description").val());
		data.options = [];
		container.find(".jq-option").each(function() {
			if($.trim($(this).val()) == "")
				return true;
			
			var option = {text: $.trim($(this).val())};
			data.options.push(option);
		});
		
		if(container.find(".jq-multiple").is(":checked")) {
			data.possibleAnswers = data.options.length;
			var op = create_voting_dialog.find(".jq-value-operation").val();
			var value1 = create_voting_dialog.find(".jq-value-1").val();
			var value2 = create_voting_dialog.find(".jq-value-2").val();
			if(op == "equal_to")
				data.possibleAnswers = value1+":"+value1;
			else if(op == "minimum")
				data.possibleAnswers = value1+":-1";
			else if(op == "maximum")
				data.possibleAnswers = "0:"+value1;
			else
				data.possibleAnswers = value1+":"+value2;
		}
		else
			data.possibleAnswers = "1:1";
		
		return data;
	}
	
	//Click a multiples respuestas
	function checkMultipleAnswers() {
		var checkbox = create_voting_dialog.find(".jq-multiple");
		var checked = checkbox.is(":checked");
		if(checked) {
			create_voting_dialog.find(".jq-answers-subcontainer").removeClass("hidden-obj");
			create_voting_dialog.find(".jq-answers-container").addClass("answers-container");
			create_voting_dialog.scrollTo(create_voting_dialog.find(".jq-value-operation"));
		}
		else {
			create_voting_dialog.find(".jq-answers-subcontainer").addClass("hidden-obj");
			create_voting_dialog.find(".jq-answers-container").removeClass("answers-container");
		}
	}
	
	create_voting_dialog.off("click", ".jq-multiple").on("click", ".jq-multiple", function() {
		checkMultipleAnswers($(this));
	});
	
	//Change en la operacion
	create_voting_dialog.off("change", ".jq-value-operation").on("change", ".jq-value-operation", function() {
		var op = $(this).val();
		if($.inArray(op, ["equal_to", "minimum", "maximum"]) >= 0)
			create_voting_dialog.find(".jq-value-and, .jq-value-2").addClass("hidden-obj");
		else
			create_voting_dialog.find(".jq-value-and, .jq-value-2").removeClass("hidden-obj");
	});
	
	function validateVoting() {
		//Validacion global
		if(!validateForm(create_voting_dialog))
			return false;
		
		//Validacion especifica
		
		//Si se aceptan respuestas multiples, verificar valores
		if(create_voting_dialog.find(".jq-multiple").is(":checked")) {
			create_voting_dialog.find(".jq-answers-subcontainer .field-error").removeClass("field-error");
			var v1 = create_voting_dialog.find(".jq-value-1");
			var v2 = create_voting_dialog.find(".jq-value-2");
			var opt_count = create_voting_dialog.find(".jq-option").length;
			var operation = create_voting_dialog.find(".jq-value-operation").val();
			
			if($.trim(v1.val()) == "") {
				alert(lang.validation_empty_answers);
				v1.focus();
				v1.addClass("field-error");
				assignButtons(create_voting_dialog, buttons_for_new_voting);
				return false;
			}
			
			//El primer valor debe ser menor que la cantidad ingresada
			if(parseInt($.trim(v1.val())) > opt_count) {
				alert(lang.validation_answers_overflow);
				v1.focus();
				assignButtons(create_voting_dialog, buttons_for_new_voting);
				return false;
			}
			
			if(operation == "between") {
				if($.trim(v2.val()) == "") {
					alert(lang.validation_empty_answers);
					v2.addClass("field-error");
					v2.focus();
					assignButtons(create_voting_dialog, buttons_for_new_voting);
					return false;
				}
				
				//El segundo valor debe ser menor que la cantidad ingresada
				if(parseInt($.trim(v2.val())) > opt_count) {
					alert(lang.validation_answers_overflow);
					v2.focus();
					assignButtons(create_voting_dialog, buttons_for_new_voting);
					return false;
				}
				
				if(parseInt($.trim(v1.val())) > parseInt($.trim(v2.val()))) {
					alert(lang.validation_answers_range);
					v1.addClass("field-error");
					v2.addClass("field-error");
					v1.focus();
					assignButtons(create_voting_dialog, buttons_for_new_voting);
					return false;
				}
			}
		}
		
		return true;
	}
});