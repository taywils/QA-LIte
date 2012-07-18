<?php if(isset($error) && true == $error):?>
<div class="alert alert-error" align="center">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <h4 class="alert-heading">Hold On!</h4>
    <?php echo $error; ?>
</div>
<?php endif;?>

<div id="questionContent" align="center">
    <h2 al><?=$question['title']?></h2>

    <?=$question['body']?>
    <br/>

    <?php if (!empty($question['tags'])): ?>
        <div style="padding-top: 20px">
            <b>Tags:</b>
            <?php foreach ($question['tags'] as $tag): ?>
                <a id="tag_<?=$tag?>" class="btn btn-small" href="/questions/view?tagSearch=<?=$tag?>"><b><?php echo "$tag"; ?></b></a>&nbsp;
            <?php endforeach; ?>
        </div>
    <?php endif;?>
</div>

<hr />

<?php if(!empty($answers)): ?>
	<?php for($i = 0, $j = count($answers); $i < $j; ++$i): ?>
		<?php echo $this->_render('element', 'elementAnswer', array('answer' => $answers[$i], 'index' => $i, 'read' => true)); ?>
	<?php endfor; ?>
<?php endif;?>

<div id="answerForm" align="center">
    <?php if($this->Login->getUserName()):?>
        <hr />
        <?=$this->form->create();?>
            <?=$this->form->label('AnswerText', 'Your Answer', array('escape' => true))?>
            <?=$this->form->textArea('AnswerText')?>
            <br />
            <?=$this->form->hidden('Owner', array('value' => $this->Login->getUserName()))?>
            <?=$this->form->hidden('QuestionId', array('value' => $question['_id']))?>
            <?=$this->form->submit('Answer This Question');?>
        <?=$this->form->end();?>
    <?php else:?>
        <b>This question is currently unanswered please login to post an answer.</b>
    <?php endif;?>
</div>

