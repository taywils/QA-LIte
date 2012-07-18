<h2>Delete Question | <?php echo $this->html->link('Ask A New Question', '/questions/ask');?> | <?php echo $this->html->link('View Recently Asked', '/questions/view');?></h2> 

<?php if($success):?>
	<h3>Successfully deleted question</h3>
<?php else:?>
	<h3>Failed to delete question</h3>
<?php endif;?>
