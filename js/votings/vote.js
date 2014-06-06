$(function() {
	var vote_dialog = $("#jq-vote-dialog");
	
	buttons_for_answer_voting = [{
		text: lang.site_send,
		"className": "btn btn-sm btn-success",
		click: function() {
			vote_dialog.dialog("close");
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
});