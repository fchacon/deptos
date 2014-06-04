$(function() {
	var vote_dialog = $("#jq-vote-dialog");
	
	//Dialog de votacion
	vote_dialog.dialog({
		autoOpen: false, modal: true, closeOnEscape: false, resizable: false, position: ["center", 20], width: 500,
		open: function() {
			
		},
		close: function() {
			
		}
	});
	
	//Click a Responder votacion
	$(".jq-vote").off("click").on("click", function() {
		vote_dialog.dialog("open");
	});
});