<?php
if(isset($NEWS) && !empty($NEWS)) {
	foreach($NEWS as $new) {
?>
<div class="jq-new new">
	<h4 class=""><?php echo $new['title'];?></h4>
	<p class=""><?php echo $new['description'];?></p>
</div>
<?php
	}
}
?>