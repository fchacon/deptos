<script type="text/javascript" src="<?php echo get_js('votings/save');?>"></script>
<script type="text/javascript" src="<?php echo get_js('votings/vote');?>"></script>
<div class="section-header">
	<table class="full-width">
		<tr>
			<td><h3><?php echo lang('voting_votings');?></h3></td>
			<td class="text-right">
			<button class="btn btn-success btn-sm" id="jq-create-voting">
				<span class="glyphicon glyphicon-plus"></span>
				<?php echo lang('voting_create');?>
			</button>
			</td>
		</tr>
	</table>
</div>
<?php if(isset($VOTINGS) && !empty($VOTINGS)) { ?>
<table class="table full-width">
	<?php foreach($VOTINGS as $voting) { ?>
	<tr class="voting" data-id="<?php echo $voting['id'];?>">
		<td colspan="1" width="80%">
			<h4 class=""><?php echo $voting['title'];?></h4>
			<p class=""><?php echo $voting['description'];?></p>
		</td>
		<td colspan="1" width="20%" class="text-right valign-middle">
			<button class="btn btn-sm btn-default jq-vote"><?php echo lang('voting_answer_it');?></button>
		</td>
	</tr>
	<?php } ?>
</table>
<?php } else { ?>
<div class="informative-text"><?php echo lang('voting_no_votings');?></div>
<?php } ?>

<div class="hidden-obj">
	<?php //Dialog de crear votacion ?>
	<div id="jq-create-voting-dialog" class="dialog-wrapper" title="<?php echo lang('voting_create');?>">
		<div class="jq-content"></div>
	</div>
	
	<?php //Dialog de responder votacion ?>
	<div id="jq-vote-dialog" class="dialog-wrapper" title="<?php echo lang('voting_answer');?>">
		<div class="jq-content"></div>
	</div>
</div>