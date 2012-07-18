<?php $username = isset($username) ? $username : '';?>

<?php if($error):?>
<div class="alert alert-error" align="center">
    <button type="button" class="close" data-dismiss="alert">×</button>
	<h4 class="alert-heading">Hold On!</h4>
    <?php if ($badUser): ?>Username &quot;<?= $username ?>&quot; not found<?php endif;?>
    <?php if ($badPass): ?>Incorrect Password<?php endif;?>
</div>
<?php endif;?>

<div align="center">
    <?=$this->form->create(null); ?>
    <?=$this->form->field('username', array('value' => $username)); ?>
    <?=$this->form->field('password', array('type' => 'password')); ?>
    <?=$this->form->submit('Log in', array('name' => 'login', 'value' => 'go')); ?>
    <?=$this->form->end(); ?>
</div>