$(function() {
	var vote_dialog = $("#jq-vote-dialog");
	
	//Dialog de votacion
	vote_dialog.dialog({
		autoOpen: false, modal: true, closeOnEscape: false, resizable: false, position: ["center", 20], width: 500,
		open: function() {
			if($.trim(vote_dialog.find(".jq-content").html()) == "") {
				printLoading(vote_dialog.find(".jq-content"), "40");
				vote_dialog.find(".jq-content").load("/votings/ajax_load_answer", function() {
					removeLoading(vote_dialog.find(".jq-content"));
				});
			}
		},
		close: function() {
			
		}
	});
	
	//Click a Responder votacion
	$(".jq-vote").off("click").on("click", function() {
		vote_dialog.dialog("open");
	});
});