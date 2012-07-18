<!-- Catch Errors -->
<?php if(isset($error) && true == $error):?>
<div class="alert alert-error" align="center">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <h4 class="alert-heading">Hold On!</h4>
    <?php echo $error; ?>
</div>
<?php endif;?>

<!-- Display Question -->
<div id="questionContent" align="center">
    <h2 al><?=$question['title']?></h2>

    <?=$question['body']?>
    <br/>

    <?php if (!empty($question['tags'])): ?>
    <div style="padding-top: 20px">
        <b>Tags:</b>
        <?php foreach ($question['tags'] as $tag): ?>
        <button class='btn btn-small'><b><?=$tag?></b></button>&nbsp;
        <?php endforeach; ?>
    </div>
    <?php endif;?>
</div>

<hr />

<?php
    $tagString = "";
    foreach($question['tags'] as $tag) {
        $tagString .= $tag." ";
    }
?>

<!-- Edit input form -->
<div id="editForm" align="center">
    <?=$this->form->create(null, array('url' => '/questions/edit?id='.$question['_id']));?>
        <?=$this->form->field('newTitle', array('label' => "New Title", 'value' => $question['title']));?>
        <?=$this->form->label('newBody', 'Edit Body', array('escape' => true))?>
        <?=$this->form->textArea('newBody', array('style' => "resize: none;", 'value' => $question['body']))?>
        <?=$this->form->field('newTags', array('label' => "Tag List (Optional)", 'value' => $tagString))?>
        <?=$this->form->submit('Update', array('class' => "btn btn-primary"));?>
    <?=$this->form->end();?>
</div>