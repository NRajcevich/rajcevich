<?php
/* @var $this DetentionController */
/* @var $model Detention */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'detention_type'); ?>
		<?php echo $form->textField($model,'detention_type',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'case_num'); ?>
		<?php echo $form->textField($model,'case_num',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'snapshot_date'); ?>
		<?php echo $form->textField($model,'snapshot_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'facility'); ?>
		<?php echo $form->textField($model,'facility',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'youth_id'); ?>
		<?php echo $form->textField($model,'youth_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'probation_number'); ?>
		<?php echo $form->textField($model,'probation_number',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dob'); ?>
		<?php echo $form->textField($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'race'); ?>
		<?php echo $form->textField($model,'race',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ethnicity'); ?>
		<?php echo $form->textField($model,'ethnicity',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'incident'); ?>
		<?php echo $form->textField($model,'incident',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'residence'); ?>
		<?php echo $form->textField($model,'residence',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'residence_county'); ?>
		<?php echo $form->textField($model,'residence_county',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_recent_detention_admission'); ?>
		<?php echo $form->textField($model,'date_recent_detention_admission'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time_referred'); ?>
		<?php echo $form->textField($model,'time_referred'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'process_admitted_to_detention'); ?>
		<?php echo $form->textField($model,'process_admitted_to_detention',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reffered_by'); ?>
		<?php echo $form->textField($model,'reffered_by',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'referral_agency'); ?>
		<?php echo $form->textField($model,'referral_agency',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'release_date'); ?>
		<?php echo $form->textField($model,'release_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'release_to'); ?>
		<?php echo $form->textField($model,'release_to',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'specify_where'); ?>
		<?php echo $form->textField($model,'specify_where',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_release_from_disposition'); ?>
		<?php echo $form->textField($model,'date_release_from_disposition'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'released_alternative'); ?>
		<?php echo $form->textField($model,'released_alternative',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type_delinquent_act'); ?>
		<?php echo $form->textField($model,'type_delinquent_act',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'severe_arrest_offense'); ?>
		<?php echo $form->textField($model,'severe_arrest_offense',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'charge_filed'); ?>
		<?php echo $form->textField($model,'charge_filed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'severe_arrest_offense_sel'); ?>
		<?php echo $form->textField($model,'severe_arrest_offense_sel',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'probation_time_arrest'); ?>
		<?php echo $form->textField($model,'probation_time_arrest'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'arrest_violation_date'); ?>
		<?php echo $form->textField($model,'arrest_violation_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adjudication_date'); ?>
		<?php echo $form->textField($model,'adjudication_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'preliminary_inquiry_date'); ?>
		<?php echo $form->textField($model,'preliminary_inquiry_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adjudication_status'); ?>
		<?php echo $form->textField($model,'adjudication_status',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'disposition_date'); ?>
		<?php echo $form->textField($model,'disposition_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'final_court_ordered_disposition'); ?>
		<?php echo $form->textField($model,'final_court_ordered_disposition',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'court_status'); ?>
		<?php echo $form->textField($model,'court_status',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_prior_deliquency_arrests'); ?>
		<?php echo $form->textField($model,'number_prior_deliquency_arrests'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_prior_deliquency_causes_filed'); ?>
		<?php echo $form->textField($model,'number_prior_deliquency_causes_filed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_prior_technical_violations_filed'); ?>
		<?php echo $form->textField($model,'number_prior_technical_violations_filed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_prior_deliquency_cases_adjudicated'); ?>
		<?php echo $form->textField($model,'number_prior_deliquency_cases_adjudicated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_prior_adjudications_ab_felony'); ?>
		<?php echo $form->textField($model,'number_prior_adjudications_ab_felony'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'most_severe_prior_adjudication'); ?>
		<?php echo $form->textField($model,'most_severe_prior_adjudication',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_warants_issued_fta'); ?>
		<?php echo $form->textField($model,'number_warants_issued_fta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_open_petitions_pending_on_day'); ?>
		<?php echo $form->textField($model,'number_open_petitions_pending_on_day',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_prior_secure_detentions'); ?>
		<?php echo $form->textField($model,'number_prior_secure_detentions'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_times_admitted_detention_alternative'); ?>
		<?php echo $form->textField($model,'number_times_admitted_detention_alternative'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_failed_from_detention_alternative'); ?>
		<?php echo $form->textField($model,'number_failed_from_detention_alternative'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prior_awol_runaway_history'); ?>
		<?php echo $form->textField($model,'prior_awol_runaway_history'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'awol_runaway_at_time_detention'); ?>
		<?php echo $form->textField($model,'awol_runaway_at_time_detention'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'serious_awol_runaway_event'); ?>
		<?php echo $form->textField($model,'serious_awol_runaway_event',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prior_dcs_involvement'); ?>
		<?php echo $form->textField($model,'prior_dcs_involvement'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'current_dcs_involvement'); ?>
		<?php echo $form->textField($model,'current_dcs_involvement'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'caregiver_availability'); ?>
		<?php echo $form->textField($model,'caregiver_availability',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cbbt'); ?>
		<?php echo $form->textField($model,'cbbt',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'psychotropic_medics_history'); ?>
		<?php echo $form->textField($model,'psychotropic_medics_history',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'treatment_service_history'); ?>
		<?php echo $form->textField($model,'treatment_service_history',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'program'); ?>
		<?php echo $form->textField($model,'program',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'program_admit_date'); ?>
		<?php echo $form->textField($model,'program_admit_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'program_status'); ?>
		<?php echo $form->textField($model,'program_status',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'program_status_date'); ?>
		<?php echo $form->textField($model,'program_status_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'referral_admission_type'); ?>
		<?php echo $form->textField($model,'referral_admission_type',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_referred'); ?>
		<?php echo $form->textField($model,'date_referred'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_ordered'); ?>
		<?php echo $form->textField($model,'date_ordered'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remanding_judge'); ?>
		<?php echo $form->textField($model,'remanding_judge',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'youth_location_leading_to_admission'); ?>
		<?php echo $form->textField($model,'youth_location_leading_to_admission',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->