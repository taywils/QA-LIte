<!-- Handle Registration Errors -->
<?php if(isset($badUser) || isset($badPass)):?>
<div class="alert alert-error" align="center">
    <button type="button" class="close" data-dismiss="alert">×</button>
	<h4 class="alert-heading">Hold On!</h4>
    <?php if (isset($badUser)): ?><?= $badUser ?><?php endif;?>
    <?php if (isset($badPass)): ?><?= $badPass ?><?php endif;?>
</div>
<?php endif;?>

<?php $username = isset($username) ? $username : '';?>

<!-- Registration Form -->
<div align="center">
    <?=$this->form->create(null); ?>
        <?=$this->form->field('username', array('value' => $username)); ?>
        <?=$this->form->field('password', array('type' => 'password')); ?>
        <?=$this->form->field('repeatPassword', array('type' => 'password')); ?>
        <label for="biography">Personal Bio(You can edit this later)</label>
        <?=$this->form->textArea('biography', array('id' => 'biography'))?>
        <br />
        <?=$this->form->radio('icon', array('checked' => true, 'value' => 'icon1', 'id' => 'icon1')); ?>
        <img src="/img/icon1.png" onclick="document.getElementById('icon1').checked = true;" />
        <br />
        <?=$this->form->radio('icon', array('value' => 'icon2', 'id' => 'icon2')); ?>
        <img src="/img/icon2.png" onclick="document.getElementById('icon2').checked = true" />
        <br />
        <?=$this->form->radio('icon', array('value' => 'icon3', 'id' => 'icon3')); ?>
        <img src="/img/icon3.png" onclick="document.getElementById('icon3').checked = true;" />
        <br />
        <?=$this->form->submit('Register', array('name' => "register")); ?>
    <?=$this->form->end(); ?>
</div>
