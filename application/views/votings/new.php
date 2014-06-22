<div role="form">
	<div class="form-group">
		<label for=""><?php echo lang('voting_title');?></label>
		<input type="text" class="form-control jq-title" data-validation="required" />
	</div>
	<div class="form-group">
		<label for=""><?php echo lang('site_description');?></label>
		<textarea class="form-control jq-description" data-validation="required"></textarea>
	</div>
	
	<h5><?php echo lang('voting_options');?> <small><?php echo lang('voting_options_obs');?></small></h5>
	<div class="form-group jq-option-group">
		<label for=""><?php echo lang('voting_option');?> <span class="jq-option-number">1</span></label>
		<div class="input-group">
			<input type="text" class="form-control jq-option" data-validation="required" />
			<div class="input-group-btn">
				<button class="btn btn-default jq-remove-option" type="button"><span class="glyphicon glyphicon-remove"></span></button>
			</div>
    	</div>
	</div>
	<div class="text-right">
		<button type="button" class="btn btn-link jq-new-option"><?php echo lang('voting_add_option');?></button>
	</div>
	<div class="jq-answers-container">
		<label class="checkbox-wrapper">
			<input type="checkbox" class="jq-multiple" />
			<span><?php echo lang('voting_allow_multiple_responses');?></span>
		</label>
		<div class="jq-answers-subcontainer container-fluid hidden-obj">
			<div class="row">
				<div class="col-xs-4 answers-operation">
					<select class="jq-value-operation form-control input-sm">
						<option value="equal_to"><?php echo lang('voting_exactly');?></option>
						<option value="minimum"><?php echo lang('voting_minimum');?></option>
						<option value="maximum"><?php echo lang('voting_maximum');?></option>
						<option value="between"><?php echo lang('voting_between');?></option>
					</select>
				</div>
				<div class="col-xs-8">
					<div class="input-group">
				      <input type="text" class="jq-value-1 form-control input-sm" data-validation="natural" />
				      <span class="jq-value-and input-group-addon hidden-obj"><?php echo lang('site_and');?></span>
				      <input type="text" class="jq-value-2 form-control input-sm hidden-obj" data-validation="natural" />
				      <span class="input-group-addon"><?php echo lang('voting_answers');?></span>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>