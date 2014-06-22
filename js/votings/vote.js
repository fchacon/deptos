$(function() {
	var vote_dialog = $("#jq-vote-dialog");
	
	function getOptionsValidation() {
		var possible_answers = vote_dialog.find(".jq-possible-answers").val();
		var parts = possible_answers.split(":");
		var minimum = parts[0];
		var maximum = parts[1];
		var message;
		if(minimum == maximum) {
			message = lang.validation_must_select+" "+minimum+" ";
			message += (minimum == 1)?lang.validation_option:lang.validation_options;
		}
		else if(maximum < 0) {
			message = lang.validation_must_select+" "+lang.validation_at_least+" "+minimum+" ";
			message += (minimum == 1)?lang.validation_option:lang.validation_options;
		}
		else if(minimum == 0) {
			message = lang.validation_must_select+" "+lang.validation_at_most+" "+maximum+" ";
			message += (maximum == 1)?lang.validation_option:lang.validation_options;
		}
		else
			message = lang.validation_must_select+" "+lang.validation_between+" "+minimum+" "+lang.site_and+" "+maximum+" "+lang.validation_options;
		
		return {minimum: minimum, maximum: maximum, message: message};
	}
	
	buttons_for_answer_voting = [{
		text: lang.site_send,
		"className": "btn btn-sm btn-success",
		click: function() {
			dialogWait(vote_dialog);
			var options = getOptionsSelected();
			var validation = getOptionsValidation();
			
			if(options.length < validation.minimum || (options.length > validation.maximum && validation.maximum > 0)) {
				alert(validation.message);
				assignButtons(vote_dialog, buttons_for_answer_voting);
				return false;
			}
			
			$.ajax({
				url: "/votings/ajax_save_answer",
				type: "POST",
				data: {options: options, votingId: vote_dialog.data("id").toString()},
				success: function(resp_arg) {
					vote_dialog.dialog("close");
					var tr = vote_dialog.data("tr");
					var clon = $(".jq-view-results:last").clone();
					clon.insertAfter(tr.find(".jq-vote"));
					tr.find(".jq-vote").remove();
					notify(lang.voting_answer_saved_successfully, "success");
				},
				error: function() {
					assignButtons(vote_dialog, buttons_for_answer_voting);
				}
			});
			
		}
	}, {
		text: lang.site_cancel,
		"className": "btn btn-sm btn-default",
		click: function() {
			vote_dialog.dialog("close");
		}
	}];
	
	//Dialog de votacion
	vote_dialog.dialog({
		autoOpen: false, modal: true, closeOnEscape: false, resizable: false, position: ["center", 20], width: 500,
		buttons: buttons_for_answer_voting,
		open: function() {
			assignButtons(vote_dialog, buttons_for_answer_voting);
			printLoading(vote_dialog.find(".jq-content"), "large");
			vote_dialog.find(".jq-content").load("/votings/ajax_load_answer", {id: vote_dialog.data("id")}, function() {
				setLabels(vote_dialog);
				var validation = getOptionsValidation();
				vote_dialog.find(".jq-note").text(validation.message);
				removeLoading(vote_dialog.find(".jq-content"));
			});
		},
		close: function() {
			
		}
	});
	
	//Click a Responder votacion
	$(".jq-vote").off("click").on("click", function() {
		var tr = $(this).parentsUntil("tr").parent("tr");
		vote_dialog.data("id", tr.data("id").toString());
		vote_dialog.data("tr", tr);
		vote_dialog.dialog("open");
	});
	
	//Obtener opciones seleccionadas
	function getOptionsSelected() {
		var options = [];
		vote_dialog.find(".jq-option:checked").each(function() {
			var option = {id: $(this).val()};
			options.push(option);
		});
		
		return options;
	}
});