<?php
/* @var $this FacilityController */
/* @var $model Facility */
/* @var $form CActiveForm */

$id = $model->id;

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'facility-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'grid-form'
	)
)); ?>
	<fieldset>
		<div data-row-span="3">
			<div data-field-span="1">
				<?php echo $form->labelEx($model,'name'); ?>
				<?php echo $form->textField($model,'name', array('placeholder' => 'Write Name')); ?>
				<?php echo $form->error($model,'name', array('class'=>'field-error')); ?>
			</div>
			<div data-field-span="1">
				<?php echo $form->labelEx($model,'type'); ?>
				<?php echo $form->dropDownList(
						$model,
						'type',
						array('secure_detention'=>'Secure Detention', 'atd'=>'Alternative to Detention'),
						array(
							'prompt'=>'',
						)
					); 
				?>
				<?php echo $form->error($model,'type', array('class'=>'field-error')); ?>
			</div>
			<div data-field-span="1">
				<?php echo $form->labelEx($model,'capacity'); ?>
				<?php echo $form->numberField($model,'capacity',array('class' => 'field-capacity', 'min' => 1)); ?>
				<?php echo $form->error($model,'capacity', array('class'=>'field-error')); ?>
			</div>
		</div>
		
		<div data-row-span="3">
			<div data-field-span="1">
		        <?php echo $form->labelEx($model,'state'); ?>
				<?php
					$stateModel = State::model()->findAll(array('order' => 'state'));
					echo $form->dropDownList(
						$model,
						'state',
						CHtml::listData( $stateModel, 'state_code', 'state' ),
						array(
							'prompt'=>'',
							'onchange' => CHtml::ajax(array(
										'type'=>'POST',
										'url'=>CController::createUrl('city/dynamiccities'),
										'data' => array('state_code' => 'js:$(this).val()'),
										'update'=> '#Facility_county'
									))
							)
					);
				?>
				<?php echo $form->error($model,'state', array('class'=>'field-error')); ?>
		    </div>
		    <div data-field-span="1">
		        <?php echo $form->labelEx($model,'county', array('class'=>'col-lg-1 col-sm-1 control-label')); ?>
				<?php
                    $modelCounty = City::model()->findAll(array('condition'=>'state_code=:state_code', 'params'=>array(":state_code"=> $model->attributes['state']), 'order' => 'county'));
                    $county_arr = CHtml::listData($modelCounty,'county','county');
                    foreach($county_arr as $key => $val){
                        if (empty($val)) unset($county_arr[$key]);
                    }
                    //if(Yii::app()->user->checkAccess('state_admin')) $county_arr['ALL'] = 'ALL';
                    echo CHtml::activeDropDownList(
		                $model,
		                'county',
                        $county_arr,
						array(
							'prompt'=>'',
						)
		            );
		        ?>
		        <?php echo $form->error($model,'county', array('class'=>'field-error')); ?>
		    </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'city'); ?>
                <?php echo $form->textField($model,'city', array('placeholder' => 'Write City')); ?>
                <?php echo $form->error($model,'city', array('class'=>'field-error')); ?>
            </div>
	    </div>

		<div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'street1'); ?>
                <?php echo $form->textField($model,'street1', array('placeholder' => 'Write Street 1')); ?>
                <?php echo $form->error($model,'street1', array('class'=>'field-error')); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'street2'); ?>
                <?php echo $form->textField($model,'street2', array('placeholder' => 'Write Street 2')); ?>
                <?php echo $form->error($model,'street2', array('class'=>'field-error')); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'zipcode'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'zipcode',
                    'mask' => '99999?-9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write ZIP Code'
                    )
                ));
                ?>
                <?php echo $form->error($model,'zipcode', array('class'=>'field-error')); ?>
            </div>
		</div>
	</fieldset>

    <div class="row buttons">
        <?php echo CHtml::submitButton( $model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-info')); ?>
        <?php
        echo CHtml::linkButton('Back',array(
            'submit'=>array('facility/index'),
            'class' => 'btn btn-default'
        ));
        ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->