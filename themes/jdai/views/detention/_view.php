<?php
/* @var $this DetentionController */
/* @var $data Detention */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detention_type')); ?>:</b>
	<?php echo CHtml::encode($data->detention_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('csne_num')); ?>:</b>
	<?php echo CHtml::encode($data->case_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('snapshot_date')); ?>:</b>
	<?php echo CHtml::encode($data->snapshot_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('facility')); ?>:</b>
	<?php echo CHtml::encode($data->facility); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('youth_id')); ?>:</b>
	<?php echo CHtml::encode($data->youth_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('probation_number')); ?>:</b>
	<?php echo CHtml::encode($data->probation_number); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dob')); ?>:</b>
	<?php echo CHtml::encode($data->dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('race')); ?>:</b>
	<?php echo CHtml::encode($data->race); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ethnicity')); ?>:</b>
	<?php echo CHtml::encode($data->ethnicity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('incident')); ?>:</b>
	<?php echo CHtml::encode($data->incident); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('residence')); ?>:</b>
	<?php echo CHtml::encode($data->residence); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('residence_county')); ?>:</b>
	<?php echo CHtml::encode($data->residence_county); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_recent_detention_admission')); ?>:</b>
	<?php echo CHtml::encode($data->date_recent_detention_admission); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_referred')); ?>:</b>
	<?php echo CHtml::encode($data->time_referred); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('process_admitted_to_detention')); ?>:</b>
	<?php echo CHtml::encode($data->process_admitted_to_detention); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reffered_by')); ?>:</b>
	<?php echo CHtml::encode($data->reffered_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('referral_agency')); ?>:</b>
	<?php echo CHtml::encode($data->referral_agency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('release_date')); ?>:</b>
	<?php echo CHtml::encode($data->release_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('release_to')); ?>:</b>
	<?php echo CHtml::encode($data->release_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('specify_where')); ?>:</b>
	<?php echo CHtml::encode($data->specify_where); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_release_from_disposition')); ?>:</b>
	<?php echo CHtml::encode($data->date_release_from_disposition); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('released_alternative')); ?>:</b>
	<?php echo CHtml::encode($data->released_alternative); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_delinquent_act')); ?>:</b>
	<?php echo CHtml::encode($data->type_delinquent_act); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('severe_arrest_offense')); ?>:</b>
	<?php echo CHtml::encode($data->severe_arrest_offense); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('charge_filed')); ?>:</b>
	<?php echo CHtml::encode($data->charge_filed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('severe_arrest_offense_sel')); ?>:</b>
	<?php echo CHtml::encode($data->severe_arrest_offense_sel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('probation_time_arrest')); ?>:</b>
	<?php echo CHtml::encode($data->probation_time_arrest); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('arrest_violation_date')); ?>:</b>
	<?php echo CHtml::encode($data->arrest_violation_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adjudication_date')); ?>:</b>
	<?php echo CHtml::encode($data->adjudication_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('preliminary_inquiry_date')); ?>:</b>
	<?php echo CHtml::encode($data->preliminary_inquiry_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adjudication_status')); ?>:</b>
	<?php echo CHtml::encode($data->adjudication_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disposition_date')); ?>:</b>
	<?php echo CHtml::encode($data->disposition_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('final_court_ordered_disposition')); ?>:</b>
	<?php echo CHtml::encode($data->final_court_ordered_disposition); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('court_status')); ?>:</b>
	<?php echo CHtml::encode($data->court_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_prior_deliquency_arrests')); ?>:</b>
	<?php echo CHtml::encode($data->number_prior_deliquency_arrests); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_prior_deliquency_causes_filed')); ?>:</b>
	<?php echo CHtml::encode($data->number_prior_deliquency_causes_filed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_prior_technical_violations_filed')); ?>:</b>
	<?php echo CHtml::encode($data->number_prior_technical_violations_filed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_prior_deliquency_cases_adjudicated')); ?>:</b>
	<?php echo CHtml::encode($data->number_prior_deliquency_cases_adjudicated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_prior_adjudications_ab_felony')); ?>:</b>
	<?php echo CHtml::encode($data->number_prior_adjudications_ab_felony); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('most_severe_prior_adjudication')); ?>:</b>
	<?php echo CHtml::encode($data->most_severe_prior_adjudication); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_warants_issued_fta')); ?>:</b>
	<?php echo CHtml::encode($data->number_warants_issued_fta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_open_petitions_pending_on_day')); ?>:</b>
	<?php echo CHtml::encode($data->number_open_petitions_pending_on_day); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_prior_secure_detentions')); ?>:</b>
	<?php echo CHtml::encode($data->number_prior_secure_detentions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_times_admitted_detention_alternative')); ?>:</b>
	<?php echo CHtml::encode($data->number_times_admitted_detention_alternative); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_failed_from_detention_alternative')); ?>:</b>
	<?php echo CHtml::encode($data->number_failed_from_detention_alternative); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prior_awol_runaway_history')); ?>:</b>
	<?php echo CHtml::encode($data->prior_awol_runaway_history); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('awol_runaway_at_time_detention')); ?>:</b>
	<?php echo CHtml::encode($data->awol_runaway_at_time_detention); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serious_awol_runaway_event')); ?>:</b>
	<?php echo CHtml::encode($data->serious_awol_runaway_event); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prior_dcs_involvement')); ?>:</b>
	<?php echo CHtml::encode($data->prior_dcs_involvement); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('current_dcs_involvement')); ?>:</b>
	<?php echo CHtml::encode($data->current_dcs_involvement); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caregiver_availability')); ?>:</b>
	<?php echo CHtml::encode($data->caregiver_availability); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cbbt')); ?>:</b>
	<?php echo CHtml::encode($data->cbbt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('psychotropic_medics_history')); ?>:</b>
	<?php echo CHtml::encode($data->psychotropic_medics_history); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('treatment_service_history')); ?>:</b>
	<?php echo CHtml::encode($data->treatment_service_history); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('program')); ?>:</b>
	<?php echo CHtml::encode($data->program); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('program_admit_date')); ?>:</b>
	<?php echo CHtml::encode($data->program_admit_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('program_status')); ?>:</b>
	<?php echo CHtml::encode($data->program_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('program_status_date')); ?>:</b>
	<?php echo CHtml::encode($data->program_status_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('referral_admission_type')); ?>:</b>
	<?php echo CHtml::encode($data->referral_admission_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_referred')); ?>:</b>
	<?php echo CHtml::encode($data->date_referred); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_ordered')); ?>:</b>
	<?php echo CHtml::encode($data->date_ordered); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remanding_judge')); ?>:</b>
	<?php echo CHtml::encode($data->remanding_judge); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('youth_location_leading_to_admission')); ?>:</b>
	<?php echo CHtml::encode($data->youth_location_leading_to_admission); ?>
	<br />

	*/ ?>

</div>