<h4><?php echo $VOTING['title'];?></h4>
<div class="description mb-10"><?php echo $VOTING['description'];?></div>
<input type="hidden" class="jq-possible-answers" value="<?php echo $VOTING['possibleAnswers'];?>" />

<p class="text-danger jq-note"></p>

<?php foreach($VOTING['options'] as $option) { ?>
<label class="checkbox-wrapper">
	<?php
	$parts = explode(":", $VOTING['possibleAnswers']);
	$minimum = $parts[0];
	$maximum = $parts[1];
	?>
	<input type="<?php echo ($maximum < 0 || $maximum > 1)?"checkbox":"radio";?>" value="<?php echo $option['id'];?>" name="voting_option" class="jq-option" />
	<span><?php echo $option['text'];?></span>
</label>
<?php } ?>