<script type="text/javascript" src="<?php echo get_js('votings/new');?>"></script>
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
<?php
if(isset($VOTINGS) && !empty($VOTINGS)) {
	foreach($VOTINGS as $voting) {
?>
<div class="jq-new new col-md-12">
	<h4 class=""><?php echo $voting['title'];?></h4>
	<p class=""><?php echo $voting['description'];?></p>
</div>
<?php
	}
}
?>

<div class="hidden-obj">
	<div id="jq-create-voting-dialog" class="dialog-wrapper" title="Crear votación">
		<div class="jq-content"></div>
	</div>
</div>