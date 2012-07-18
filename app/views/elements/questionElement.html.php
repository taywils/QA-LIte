<?php if(isset($view)): ?>
<!-- Quick View -->
<div id="quickViewModal_<?php $index = isset($index) ? $index : ''; echo $index;?>" class="modal hide fade in" style="display: none; ">
    <div class="modal-header" align="center">
        <h3><?=$question['title']?></h3>
    </div>

    <div class="modal-body">
        <p><?= $question['body'] ?></p>
    </div>

    <div class="modal-footer">
        <a href="/questions/read?id=<?=$question['_id']?>" class="btn"><b>View Question Thread</b></a>
        <a href="#" class="btn" data-dismiss="modal"><b>Close</b></a>
    </div>
</div>

<!-- Quick Reply -->
<div id="quickReplyModal_<?php $index = isset($index) ? $index : ''; echo $index;?>" class="modal hide fade in" style="display: none; ">
    <div class="modal-header" align="center">
        <h3><?=$question['title']?></h3>
    </div>

    <!-- Replica of the app\views\questions\read.html.php form -->
    <div class="modal-body" align="center">
        <?=$this->form->create(null, array('url' => '/questions/read'));?>
            <?=$this->form->label('AnswerArea', 'Your Answer', array('escape' => true))?>
            <?=$this->form->textArea('AnswerText')?>
            <br />
            <?=$this->form->hidden('Owner', array('value' => $this->Login->getUserName()))?>
            <?=$this->form->hidden('QuestionId', array('value' => $question['_id']))?>
            <?=$this->form->submit('Answer This Question');?>
        <?=$this->form->end();?>
    </div>

    <div class="modal-footer">
        <a href="/questions/read?id=<?=$question['_id']?>" class="btn"><b>View Other Answers</b></a>
        <a href="#" class="btn" data-dismiss="modal"><b>Cancel</b></a>
    </div>
</div>

<!-- Question Element Begins -->
<div id="questionView_<?php $index = isset($index) ? $index : ''; echo $index;?>" class="container-fluid" style="margin-bottom: 50px;">

	<div class="row-fluid">

		<div class="span2">
			<img src="<?=$question['icon']?>" />
			<br />
			<?=$question['owner']?>
            <br />
            Asked <?php echo $this->timeHelper->humanTime($question['dateCreated']); ?>
		</div>

		<div class="span6">
			<h4><a href="/questions/read?id=<?=$question['_id']?>"><?=$question['title']?></a></h4>
            <?php if(isset($edit)): ?>
                <h4><a href="/questions/edit?id=<?=$question['_id']?>">(click to edit)</a></h4>
            <?php endif;?>
			<br />
            <?php foreach($question['tags'] as $tag): ?>
                <a id="tag_<?=$tag?>" class="btn btn-small" href="/questions/view?tagSearch=<?=$tag?>"><b><?php echo "$tag"; ?></b></a>
            <?php endforeach;?>
		</div>

        <div class="span4" style="margin-top: 30px;">
            <a id="questionViewQuickView_<?php $index = isset($index) ? $index : ''; echo $index;?>" data-toggle="modal" href="#quickViewModal_<?=$index?>" class="btn btn-primary btn-small"><b>Quick View</b></a>
            <!-- Must be logged in to enable quick reply -->
            <?php if($this->Login->getUserName()): ?>
            <a id="questionViewQuickReply_<?php $index = isset($index) ? $index : ''; echo $index;?>" data-toggle="modal" href="#quickReplyModal_<?=$index?>" class="btn btn-primary btn-small"><b>Quick Reply</b></a>
            <?php endif; ?>

            <?php if(count($question['answers']) > 0): ?>
                <button class="btn btn-success btn-small disabled"><b>Answered</b></button>
            <?php else: ?>
                <button class="btn btn-danger btn-small disabled"><b>Unanswered</b></button>
            <?php endif; ?>
        </div>

	</div>

</div>
<?php endif; ?>