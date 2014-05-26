<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="jq-header">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Brand</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('menu_my_account');?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo site_url('users/edit');?>">
								<span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?php echo lang('menu_my_data');?>
							</a>
						</li>
						<li>
							<a href="<?php echo site_url('login/logout');?>">
								<span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;<?php echo lang('menu_logout');?>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>