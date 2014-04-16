<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

//$this->pageTitle=Yii::app()->name . ' - Login';
?>


<div class="container">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
		'htmlOptions'=>array(
			'class'=>'form-signin',
		),
    )); ?>
	<h2 class="form-signin-heading">sign in now</h2>
    <div class="login-wrap">
		<div class="user-login-info">
			<!-- Username -->
			<div class="form-group has-error">
				<?php echo $form->textField($model,'username', array('placeholder'=>'Username', 'class'=>'form-control', 'autofocus'=>true)); ?>
				<?php echo $form->error($model,'username', array('class'=>'help-block')); ?>
			</div>
			<div class="form-group has-error">
			<!-- Password -->
				<?php echo $form->passwordField($model,'password', array('placeholder'=>'Password', 'class'=>'form-control')); ?>
				<?php echo $form->error($model,'password', array('class'=>'help-block')); ?>
			</div>
		</div>
		
		<label class="checkbox">
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo $form->label($model,'rememberMe'); ?>
			<?php echo $form->error($model,'rememberMe'); ?>
		</label>
		
		<?php echo CHtml::submitButton('Sign in', array('class'=>'btn btn-lg btn-login btn-block')); ?>
		
	</div>
    <?php $this->endWidget(); ?><!-- form -->
</div>
