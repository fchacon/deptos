<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Administración comunidad</title>
		
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_css("style");?>" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_css("bootstrap.min", "bootstrap");?>" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_css("jquery-ui", "jqueryui");?>" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_css("pnotify.custom.min", "pnotify");?>" />
		
		<script type="text/javascript" src="<?php echo get_js("jquery-1.7.1.min");?>"></script>
		<script type="text/javascript" src="<?php echo get_js("bootstrap.min", "bootstrap");?>"></script>
		<script type="text/javascript" src="<?php echo get_js("jquery-ui-1.8.24.min", "jqueryui");?>"></script>
		<script type="text/javascript" src="<?php echo get_js("global");?>"></script>
		<script type="text/javascript" src="<?php echo get_js("validation");?>"></script>
		<script type="text/javascript" src="<?php echo get_js("pnotify.custom.min", "pnotify");?>"></script>
	</head>
	<body>
		<?php $this->load->view('includes/menu');?>
		<?php $this->load->view('includes/breadcrumb');?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<div class="list-group">
						<a href="<?php echo site_url();?>" class="list-group-item active">
							<span class="glyphicon glyphicon-bullhorn"></span> Novedades
						</a>
						<a href="#" class="list-group-item"><span class="glyphicon glyphicon-globe"></span> Comunidad</a>
						<a href="#" class="list-group-item"><span class="glyphicon glyphicon-pencil"></span> Votaciones</a>
						<a href="#" class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span> Actas</a>
						<a href="#" class="list-group-item"><span class="glyphicon glyphicon-usd"></span> Gastos comunes</a>
					</div>
				</div>
				<div class="col-md-6">
					<?php $this->load->view($VIEW);?>
				</div>
			</div>
		</div>
	</body>
</html>
