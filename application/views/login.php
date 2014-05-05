<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Administración comunidad</title>
		
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo getCss("style");?>" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo getCss("bootstrap.min", "bootstrap");?>" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo getCss("jquery-ui", "jqueryui");?>" />
		
		<script type="text/javascript" src="<?php echo getJs("jquery-1.7.1.min");?>"></script>
		<script type="text/javascript" src="<?php echo getJs("bootstrap.min", "bootstrap");?>"></script>
		<script type="text/javascript" src="<?php echo getJs("jquery-ui-1.8.24.min", "jqueryui");?>"></script>
		<script type="text/javascript" src="<?php echo getJs("global");?>"></script>
		<script type="text/javascript" src="<?php echo getJs("validation");?>"></script>
		
	</head>
	<body>
		<div class="container-fluid">
			<script type="text/javascript" src="<?php echo getJs("login");?>"></script>
			<div class="row" id="jq-login">
				<div class="col-md-4 col-md-offset-4">
					<div class="hidden-obj jq-error"><?php echo lang('login_error');?></div>
					<div role="form" action="/home">
						<div class="form-group">
							<label for=""><?php echo lang('login_email_address');?></label>
							<input type="text" class="form-control jq-email" placeholder="<?php echo lang('login_enter_email');?>" data-validation="required">
						</div>
						<div class="form-group">
							<label for=""><?php echo lang('login_password');?></label>
							<input type="password" class="form-control jq-password" placeholder="<?php echo lang('login_enter_password');?>" data-validation="required">
						</div>
						<button class="btn btn-success jq-submit"><?php echo lang('login');?></button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>