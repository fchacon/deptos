<script type="text/javascript" src="<?php echo get_js('users/edit');?>"></script>
<div role="form" id="jq-user-form" class="well bs-component">
	<div class="row">
		<?php //PRIMER NOMBRE ?>
		<div class="col-md-6">
			<div class="form-group">
				<label><?php echo lang('user_first_name');?></label>
				<input type="text" class="form-control jq-first-name" data-validation="required" />
			</div>
		</div>
		
		<?php //SEGUNDO NOMBRE ?>
		<div class="col-md-6">
			<div class="form-group">
				<label><?php echo lang('user_second_name');?></label>
				<input type="text" class="form-control jq-second-name" />
			</div>
		</div>
	</div>
	
	<div class="row">
		<?php //PRIMER APELLIDO ?>
		<div class="col-md-6">
			<div class="form-group">
				<label><?php echo lang('user_last_name');?></label>
				<input type="text" class="form-control jq-last-name" data-validation="required"  />
			</div>
		</div>
		
		<?php //SEGUNDO APELLIDO ?>
		<div class="col-md-6">
			<div class="form-group">
				<label><?php echo lang('user_second_last_name');?></label>
				<input type="text" class="form-control jq-second-last-name" />
			</div>
		</div>
	</div>
	
	<?php //RUT ?>
	<div class="form-group">
		<label><?php echo lang('user_rut');?></label>
		<input type="text" class="form-control jq-rut" data-validation="required|rut" />
		<p class="help-block">Ej: 16426627-3</p>
	</div>
	
	<?php //EMAIL ?>
	<div class="form-group">
		<label><?php echo lang('user_email');?></label>
		<input type="text" class="form-control jq-email" data-validation="required|email" />
		<p class="help-block">Ej: felipe.chacon@gmail.com</p>
	</div>
	
	<button class="btn btn-sm btn-success jq-save"><?php echo lang('site_save');?></button>
</div>
