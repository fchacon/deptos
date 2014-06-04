$(function() {
	var create_voting_dialog = $("#jq-create-voting-dialog");
	
	//Botones para crear nueva votacion
	buttons_for_new_voting = [{
		text: lang.site_create,
		"className": "btn btn-sm btn-success",
		click: function() {
			dialogWait(create_voting_dialog);
			var data = getVoting(create_voting_dialog);
			$.ajax({
				url: "/votings/ajax_create",
				type: "POST",
				data: {data: data},
				success: function(resp_arg) {
					console.log(data);
					notify(lang.voting_created_successfully, "success");
					setTimeout(function() {
						//window.location.reload();
					}, 2500);
				}
			});
			create_voting_dialog.dialog("close");
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
				create_voting_dialog.find(".jq-content").load("/votings/ajax_load_new", function() {
					create_voting_dialog.find(".jq-new-option:first").click();
					setLabels(create_voting_dialog);
				});
			}
		},
		close: function() {
			setTimeout(function() {
				//Descheckear opcion de opciones multiples
				create_voting_dialog.find(".jq-multiple").prop("checked", false);
				
				//Eliminar opciones, excepto la primera
				create_voting_dialog.find(".jq-option-group:not(:first)").remove();
				
				//Limpiar la primera opcion y luego clonarla para obtener el minimo de opciones (2)
				var option_froup = create_voting_dialog.find(".jq-option-group");
				option_froup.find(".jq-option").val("");
				option_froup.clone().insertAfter(option_froup);
				
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
		var option_group = $(this).parentsUntil(".jq-option-group").parent(".jq-option-group");
		var clone = option_group.clone();
		clone.find(".jq-option").val("");
		clone.insertAfter(option_group);
		enumerateOptions();
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
		data.multiple = (container.find(".jq-multiple").is(":checked"))?1:0;
		data.options = [];
		container.find(".jq-option").each(function() {
			if($.trim($(this).val()) == "")
				return true;
			
			var option = $.trim($(this).val());
			data.options.push(option);
		});
		
		return data;
	}
});