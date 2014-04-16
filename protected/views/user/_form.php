<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'first_name'); ?>
        <?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'first_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'last_name'); ?>
        <?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'last_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'phone'); ?>
        <?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'access'); ?>
        <?php echo $form->dropDownList($model,'access', array('1'=>'Account User', '5'=>'Account Administrator', '9'=>'State Administrator')); ?>
        <?php echo $form->error($model,'access'); ?>
    </div>

    <br/>
    <h4>Access Data </h4>
    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'state'); ?>
        <?php
            $stateModel = State::model()->findAll(array('order' => 'state'));
            echo $form->dropDownList(
                $model,
                'state',
                CHtml::listData( $stateModel, 'state_code', 'state' ),
                array(
                    'onchange' => CHtml::ajax(array(
                                'type'=>'POST',
                                'url'=>CController::createUrl('city/dynamiccities'),
                                'data' => array('state_code' => 'js:$(this).val()'),
                                'update'=> '#User_county'
                            ))
                    )
            );
        ?>
        <?php echo $form->error($model,'state'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'county'); ?>
        <?php
            $modelCounty = City::model()->findAll('state_code=:state_code',array(':state_code' => $model->attributes['state']));
            echo CHtml::activeDropDownList(
                $model,
                'county',
                CHtml::listData($modelCounty,'county','county')
            );
        ?>
        <?php echo $form->error($model,'county'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'block'); ?>
        <?php echo $form->dropDownList($model,'block',array('0'=>'Blocked', '1'=>'Active')); ?>
        <?php echo $form->error($model,'block'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->