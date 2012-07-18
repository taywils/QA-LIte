<div id="aboutMe" align="center">
    <?php if(isset($success) && $success == true):?>

    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4 class="alert-heading">Success!</h4>
        <ul>Your profile has been updated</ul>
    </div>
    <?php endif;?>

    <div class="page-header" style="overflow: hidden">
        <h3 class="span2">About Me</h3>
    </div>

    <?=$this->form->create(null); ?>
        <label for="biography"><b>Biography</b></label>
        <?=$this->form->textArea('biography', array('id' => 'biography', 'value' => $biography,
            'style' => "height: 180px; width: 460px"))?>
        <br />
        <?=$this->form->submit('Update Info', array('name' => 'update', 'class' => "btn btn-primary"))?>
    <?=$this->form->end(); ?>
</div>