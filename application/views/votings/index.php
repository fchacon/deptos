<script type="text/javascript" src="<?php echo get_js('votings/new');?>"></script>
<script type="text/javascript" src="<?php echo get_js('votings/vote');?>"></script>
<div class="section-header">
	<table class="full-width">
		<tr>
			<td><h3>Votaciones</h3></td>
			<td class="text-right">
			<button class="btn btn-success btn-sm" id="jq-create-voting">
				<span class="glyphicon glyphicon-plus"></span>
				Crear votacion
			</button>
			</td>
		</tr>
	</table>
</div>
<?php if(isset($VOTINGS) && !empty($VOTINGS)) { ?>
<table class="table full-width">
	<?php foreach($VOTINGS as $voting) { ?>
	<tr class="voting" data-id="<?php echo $voting['id'];?>">
		<td colspan="1" width="80%" class="">
			<h4 class=""><?php echo $voting['title'];?></h4>
			<p class=""><?php echo $voting['description'];?></p>
		</td>
		<td colspan="1" width="20%" class="text-right valign-middle">
			<button class="btn btn-sm btn-default jq-vote">Responder</button>
		</td>
	</tr>
	<?php } ?>
</table>
<?php } ?>

<div class="hidden-obj">
	<?php //Dialog de crear votacion ?>
	<div id="jq-create-voting-dialog" class="dialog-wrapper" title="Crear votación">
		<div class="jq-content"></div>
	</div>
	
	<?php //Dialog de responder votacion ?>
	<div id="jq-vote-dialog" class="dialog-wrapper" title="<?php //echo lang();?>">
		<div class="jq-content"></div>
	</div>
</div>