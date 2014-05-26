<div class="list-group menu-left" id="jq-menu-left">
	<?php $current_controller = $this->uri->segment(1);?>
	<a href="<?php echo site_url('home');?>" class="list-group-item<?php echo ($current_controller == "home")?" active":"";?>">
		<span class="glyphicon glyphicon-home"></span> <?php echo lang('menu_left_home');?>
	</a>
	<a href="<?php echo site_url('news');?>" class="list-group-item<?php echo ($current_controller == "news")?" active":"";?>">
		<span class="glyphicon glyphicon-bullhorn"></span> <?php echo lang('menu_left_news');?>
	</a>
	<a href="<?php echo site_url('community');?>" class="list-group-item<?php echo ($current_controller == "community")?" active":"";?>">
		<span class="glyphicon glyphicon-globe"></span> <?php echo lang('menu_left_community');?>
	</a>
	<a href="<?php echo site_url('votings');?>" class="list-group-item<?php echo ($current_controller == "votings")?" active":"";?>">
		<span class="glyphicon glyphicon-pencil"></span> <?php echo lang('menu_left_votings');?>
	</a>
	<a href="<?php echo site_url('acts');?>" class="list-group-item<?php echo ($current_controller == "acts")?" active":"";?>">
		<span class="glyphicon glyphicon-list-alt"></span> <?php echo lang('menu_left_acts');?>
	</a>
	<a href="<?php echo site_url('common_expenses');?>" class="list-group-item<?php echo ($current_controller == "common_expenses")?" active":"";?>">
		<span class="glyphicon glyphicon-usd"></span> <?php echo lang('menu_left_common_expenses');?>
	</a>
</div>