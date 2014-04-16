<?php
/* @var $this DetentionController */
/* @var $model Detention */

$this->breadcrumbs=array(
	'Detentions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Detention', 'url'=>array('index')),
	array('label'=>'Create Detention', 'url'=>array('create')),
	array('label'=>'Update Detention', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Detention', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Detention', 'url'=>array('admin')),
);
?>

<h1>View Detention #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'data'=>$model,
    'dataProvider'=>$model->search(),
	'attributes'=>array(
		'id',
		'detention_type',
		'case_num',
		'snapshot_date',
		'facility',
		'youth_id',
		'probation_number',
		'dob',
		'race',
		'gender',
		'ethnicity',
		'incident',
		'residence',
		'residence_county',
		'date_recent_detention_admission',
		'time_referred',
		'process_admitted_to_detention',
		'reffered_by',
		'referral_agency',
		'release_date',
		'release_to',
		'specify_where',
		'date_release_from_disposition',
		'released_alternative',
		'type_delinquent_act',
		'severe_arrest_offense',
		'charge_filed',
		'severe_arrest_offense_sel',
		'probation_time_arrest',
		'arrest_violation_date',
		'adjudication_date',
		'preliminary_inquiry_date',
		'adjudication_status',
		'disposition_date',
		'final_court_ordered_disposition',
		'court_status',
		'number_prior_deliquency_arrests',
		'number_prior_deliquency_causes_filed',
		'number_prior_technical_violations_filed',
		'number_prior_deliquency_cases_adjudicated',
		'number_prior_adjudications_ab_felony',
		'most_severe_prior_adjudication',
		'number_warants_issued_fta',
		'number_open_petitions_pending_on_day',
		'number_prior_secure_detentions',
		'number_times_admitted_detention_alternative',
		'number_failed_from_detention_alternative',
		'prior_awol_runaway_history',
		'awol_runaway_at_time_detention',
		'serious_awol_runaway_event',
		'prior_dcs_involvement',
		'current_dcs_involvement',
		'caregiver_availability',
		'cbbt',
		'psychotropic_medics_history',
		'treatment_service_history',
		'program',
		'program_admit_date',
		'program_status',
		'program_status_date',
		'referral_admission_type',
		'date_referred',
		'date_ordered',
		'remanding_judge',
		'youth_location_leading_to_admission',
	),
)); ?>
