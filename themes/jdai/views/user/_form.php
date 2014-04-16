<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */

$id = $model->id;

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
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
        <div data-row-span="4">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'username'); ?>
                <?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20, 'placeholder' => 'Write username')); ?>
                <?php echo $form->error($model,'username', array('class'=>'error')); ?>
	        </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'first_name'); ?>
                <?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>128, 'placeholder' => 'Write First Name')); ?>
                <?php echo $form->error($model,'first_name', array('class'=>'error')); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'last_name'); ?>
                <?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>128, 'placeholder' => 'Write Last Name')); ?>
                <?php echo $form->error($model,'last_name', array('class'=>'error')); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'block'); ?>
                <?php echo $form->dropDownList($model,'block',array(0=>'Inactive', 1=>'Active')); ?>
                <?php echo $form->error($model,'block', array('class'=>'error')); ?>
            </div>
        </div>
        <div data-row-span="4">
            <br/>
            <h4>Access Data </h4>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'phone'); ?>
                <?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>128, 'placeholder' => 'Write Phone Number', 'autocomplete' => 'off')); ?>
                <?php echo $form->error($model,'phone', array('class'=>'error')); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'email'); ?>
                <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128, 'placeholder' => 'Write Email', 'autocomplete' => 'off')); ?>
                <?php echo $form->error($model,'email', array('class'=>'error')); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'new_password'); ?>
                <?php echo $form->passwordField($model,'new_password',array('maxlength'=>128, 'placeholder' => 'Write Password', 'autocomplete' => 'off')); ?>
                <?php echo $form->error($model,'new_password', array('class'=>'error')); ?>
             </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'new_confirm'); ?>
                <?php echo $form->passwordField($model,'new_confirm',array('maxlength'=>128, 'placeholder' => 'Confirm Password', 'autocomplete' => 'off')); ?>
                <?php echo $form->error($model,'new_confirm', array('class'=>'error')); ?>
            </div>
        </div>
        <div data-row-span="2">
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
                                        'update'=> '#User_county'
                                    ))
                            )
                    );
                ?>
                <?php echo $form->error($model,'state', array('class'=>'error')); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'county'); ?>
                <?php
                    $modelCounty = City::model()->findAll(array('condition'=>'state_code=:state_code', 'params'=>array(":state_code"=> $model->attributes['state']), 'order' => 'county'));
                    $county_arr = CHtml::listData($modelCounty,'county','county');
                    foreach($county_arr as $key => $val){
                        if (empty($val)) unset($county_arr[$key]);
                    }
                    $county_arr['ALL'] = 'ALL';
                    echo CHtml::activeDropDownList(
                        $model,
                        'county',
                        $county_arr,
                        array(
                            'prompt'=>'',
                            'class' => 'manageuser'
                        )
                    );
                ?>
                <?php echo $form->error($model,'county', array('class'=>'error')); ?>
            </div>
        </div>
        <div data-row-span="1">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'access'); ?>
                <?php echo $form->dropDownList(
                    $model,
                    'access',
                    array('account_user'=>'County User', 'account_admin'=>'County Administrator', 'state_admin'=>'State Administrator')
                );
                ?>
                <?php echo $form->error($model,'access', array('class'=>'error')); ?>
            </div>
        </div>
    </fieldset>

	<div class="row buttons">
		<?php echo CHtml::submitButton( $model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-info')); ?>
		<?php
		echo CHtml::linkButton('Back',array(
		    'submit'=>array('user/index'),
		    'class' => 'btn btn-default'
		)); 
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->