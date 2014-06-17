$(function() {
	var vote_dialog = $("#jq-vote-dialog");
	
	buttons_for_answer_voting = [{
		text: lang.site_send,
		"className": "btn btn-sm btn-success",
		click: function() {
			dialogWait(vote_dialog);
			var options = getOptionsSelected();
			if(options.length == 0) {
				var message = (vote_dialog.find(".jq-possible-answers").val() == "1")?lang.voting_select_an_option:lang.voting_select_at_least_one_option;
				alert(lang.voting_must_select_an_option);
				assignButtons(vote_dialog, buttons_for_answer_voting);
				return false;
			}
			
			$.ajax({
				url: "/votings/ajax_save_answer",
				type: "POST",
				data: {options: options, votingId: vote_dialog.data("id").toString()},
				success: function(resp_arg) {
					vote_dialog.dialog("close");
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
				removeLoading(vote_dialog.find(".jq-content"));
			});
		},
		close: function() {
			
		}
	});
	
	//Click a Responder votacion
	$(".jq-vote").off("click").on("click", function() {
		vote_dialog.data("id", $(this).parentsUntil("tr").parent("tr").data("id").toString());
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