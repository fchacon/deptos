<div role="form">
	<div class="form-group">
		<label for=""><?php echo lang('voting_title');?></label>
		<input type="text" class="form-control jq-title">
	</div>
	<div class="form-group">
		<label for=""><?php echo lang('site_description');?></label>
		<textarea class="form-control jq-description"></textarea>
	</div>
	
	<h5><?php echo lang('voting_options');?> <small><?php echo lang('voting_options_obs');?></small></h5>
	<div class="checkbox-wrapper">
		<input type="checkbox" class="jq-multiple">
		<label><?php echo lang('voting_allow_multiple_responses');?></label>
	</div>
	<div class="form-group jq-option-group">
		<label for=""><?php echo lang('voting_option');?> <span class="jq-option-number">1</span></label>
		<div class="input-group">
			<input type="text" class="form-control jq-option" />
			<div class="input-group-btn">
				<button class="btn btn-default jq-new-option" type="button"><span class="glyphicon glyphicon-plus"></span></button>
				<button class="btn btn-default jq-remove-option" type="button"><span class="glyphicon glyphicon-remove"></span></button>
			</div>
    	</div>
	</div>
</div>