<?php
/* @var $this FacilityController */
/* @var $model Facility */
/* @var $form CActiveForm */
?>

<div class="wide form panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
		'class'=>'form-horizontal'
	)
)); ?>

	<div class="form-group">
		<?php echo $form->label($model,'type', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10"><?php echo $form->textField($model,'type', array('class'=>'form-control', 'size'=>60,'maxlength'=>255)); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'name', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10"><?php echo $form->textField($model,'name',array('class'=>'form-control col-lg-10', 'size'=>60,'maxlength'=>255)); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'state', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10"><?php echo $form->textField($model,'state',array('class'=>'form-control col-lg-10', 'size'=>60,'maxlength'=>255)); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'county', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10"><?php echo $form->textField($model,'county',array('class'=>'form-control col-lg-10', 'size'=>60,'maxlength'=>255)); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'address', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10"><?php echo $form->textArea($model,'address',array('class'=>'form-control col-lg-10', 'rows'=>6, 'cols'=>50)); ?></div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'capacity', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10"><?php echo $form->textField($model,'capacity',array('class'=>'form-control col-lg-10', 'size'=>60,'maxlength'=>255)); ?></div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->