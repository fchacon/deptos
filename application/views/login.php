<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Administración comunidad</title>
		
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_css("style");?>" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_css("bootstrap.min", "bootstrap");?>" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_css("jquery-ui", "jqueryui");?>" />
		
		<script type="text/javascript" src="<?php echo get_js("jquery-1.7.1.min");?>"></script>
		<script type="text/javascript" src="<?php echo get_js("bootstrap.min", "bootstrap");?>"></script>
		<script type="text/javascript" src="<?php echo get_js("jquery-ui-1.8.24.min", "jqueryui");?>"></script>
		<script type="text/javascript" src="<?php echo get_js("global");?>"></script>
		<script type="text/javascript" src="<?php echo get_js("validation");?>"></script>
		
	</head>
	<body>
		<div class="container-fluid">
			<script type="text/javascript" src="<?php echo get_js("login");?>"></script>
			<div class="row" id="jq-login">
				<div class="col-md-4 col-md-offset-4">
					<div class="hidden-obj jq-error"><?php echo lang('login_error');?></div>
					<div role="form">
						<div class="form-group">
							<label for=""><?php echo lang('login_email_address');?></label>
							<input type="text" class="form-control jq-email" placeholder="<?php echo lang('login_enter_email');?>" data-validation="required|email">
						</div>
						<div class="form-group">
							<label for=""><?php echo lang('login_password');?></label>
							<input type="password" class="form-control jq-password" placeholder="<?php echo lang('login_enter_password');?>" data-validation="required">
						</div>
						<div class="form-group">
							<a href="#" class="jq-forgotten-password"><?php echo lang('login_forgotten_password');?></a>
						</div>
						<button class="btn btn-success jq-submit"><?php echo lang('login');?></button>
					</div>
				</div>
			</div>
		</div>
		<div class="hidden-obj">
			<div id="jq-forgotten-password-dialog" class="dialog-wrapper" title="<?php echo lang('login_forgotten_password');?>">
				<div role="form" class="jq-form">
					<div class="form-group">
						<label for=""><?php echo lang('login_email_address');?></label>
						<input type="text" class="form-control jq-email" placeholder="<?php echo lang('login_enter_email');?>" data-validation="required|email">
					</div>
				</div>
				<div class="col-md-8 col-md-offset-2 alert alert-success align-center hidden-obj jq-success-msg"></div>
			</div>
		</div>
	</body>
</html>