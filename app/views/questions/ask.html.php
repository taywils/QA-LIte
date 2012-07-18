<div class="page-header" style="overflow: hidden">
    <h3 class="span2">Ask a Question</h3>
</div>

<div align="center">
	<?php if (isset($response) && $response == true): ?>
		<a href="/"><h3>Your question has been submitted!</h3></a>
	<?php elseif($this->Login->getUserName()):?>
		<?=$this->form->create();?>
			<?=$this->form->field('Title');?>
			<?=$this->form->label('QuestionDescription', 'Description', array('escape' => true))?>
			<?=$this->form->textArea('Body')?>
			<?=$this->form->field('Tags', array('label' => "Tag List (Optional)"))?>
			<?=$this->form->hidden('Owner', array('value' => $this->Login->getUserName()))?>
			<?=$this->form->submit('Ask', array('class' => "btn btn-primary"));?>
		<?=$this->form->end();?>
	<?php else:?>
		<h4>Please Login To Ask A New Question</h4>
	<?php endif;?>
</div>