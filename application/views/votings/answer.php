<h4><?php echo $VOTING['title'];?></h4>
<div class="description mb-10"><?php echo $VOTING['description'];?></div>
<?php foreach($VOTING['options'] as $option) { ?>
<div class="checkbox-wrapper">
	<input type="<?php echo ($VOTING['multiple'] == 1)?"checkbox":"radio";?>" value="<?php echo $option['id'];?>" name="voting_option" />
	<label><?php echo $option['text'];?></label>
</div>
<?php } ?>