<h4><?php echo $VOTING['title'];?></h4>
<div class="description mb-10"><?php echo $VOTING['description'];?></div>
<input type="hidden" class="jq-possible-answers" value="<?php echo $VOTING['possibleAnswers'];?>" />
<?php foreach($VOTING['options'] as $option) { ?>
<label class="checkbox-wrapper">
	<input type="<?php echo ($VOTING['possibleAnswers'] > 1)?"checkbox":"radio";?>" value="<?php echo $option['id'];?>" name="voting_option" class="jq-option" />
	<span><?php echo $option['text'];?></span>
</label>
<?php } ?>