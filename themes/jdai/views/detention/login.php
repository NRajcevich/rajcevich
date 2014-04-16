<?php
//$this->pageTitle=Yii::app()->name . ' - Login';
?>



    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
		'htmlOptions'=>array(
			'class'=>'form-signin form-horizontal',
		),
    )); ?>
	<h2 class="form-signin-heading">Log In</h2>
    <div class="login-wrap">
		<div class="user-login-info">
			<!-- Username -->
			<div class="form-group has-error">
				<?php echo $form->labelEx($model,'Login', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
				<div class="col-lg-10"><?php echo $form->textField($model,'username', array('placeholder'=>'Login', 'class'=>'form-control', 'autofocus'=>true)); ?></div>
				<?php echo $form->error($model,'username', array('class'=>'help-block col-md-offset-3')); ?>
			</div>
			<div class="form-group has-error">
			<!-- Password -->
				<?php echo $form->labelEx($model,'Password', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
				<div class="col-lg-10"><?php echo $form->passwordField($model,'password', array('placeholder'=>'Password', 'class'=>'form-control', 'size'=>60)); ?></div>
				<?php echo $form->error($model,'password', array('class'=>'help-block col-md-offset-3')); ?>
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

