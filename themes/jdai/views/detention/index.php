<?php
/* @var $this DetentionController */
/* @var $model Detention */
?>

<div class="row">
	<div class="col-lg-6">
		<?php
		$this->menu=array(
            array('label'=>'New Secure Detention Form', 'url'=>array('createSecure'), 'linkOptions'=>array('class'=>'link')),
            array('label'=>'New Alternative to Detention Form', 'url'=>array('createAlternative'), 'linkOptions'=>array('class'=>'link')),
        );
		$this->widget('zii.widgets.CMenu', array(
            'items'=>$this->menu,
            'htmlOptions'=>array('class'=>'menu-link'),
        ));
		?>
</div>

<span class="state pull-right col-lg-3">
		<?php
        if(Yii::app()->user->checkAccess('state_admin')) { echo "State Administrator";}
        elseif(Yii::app()->user->checkAccess('account_admin')) { echo "Account Administrator";}
        ?>
	</span>
</div>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#detention-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->

<!--
<?php /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); */ ?>
</div><!-- search-form -->


<?php echo CHTML::form(); ?>

<div class="row">
    <div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading">
            Manage Detention Forms
        </header>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'detention-grid',
            'dataProvider'=>$model->search(),
            'itemsCssClass' => 'table  table-hover general-table',
            'selectableRows' => 2,
            'filter'=>$model,
            'summaryText' => '',
            'template' => '{items}{pager}',
            'pager'=>array(
                'header'=>'',
                'firstPageLabel'=>'First',
                'lastPageLabel'=>'Last',
                'nextPageLabel' => 'Next',
                'prevPageLabel' => 'Prev',
                'cssFile' => false,
                'htmlOptions' => array(
                    'class' => 'my-pagination pagination pagination-sm pull-right'
                ),
            ),
            'columns'=>array(
                array(
                    'class' => 'CCheckBoxColumn',
                    'id' => 'checked'
                ),
                'youth_id',

                array(
                    'name' => 'race',
                    'value' => '$data->race',
                    'filter'=>CHtml::listData(Race::model()->findAll(), 'race', 'race')
                ),
                array(
                    'name' => 'gender',
                    'value' => '$data->gender',
                    'filter' => array('Male' => 'Male', 'Female' => 'Female')
                ),
                array(
                    'name' => 'snapshot_date',
                    'value' => '($data->snapshot_date != "1900-01-01")?(date("m/d/Y ", strtotime($data->snapshot_date))):""'
                ),
                array(
                    'name' => 'detention_type',
                    'value' => '$data->detention_type',
                    'filter' => array('Alternative' => 'Alternative', 'Secure' => 'Secure')
                ),
                array(
                    'name' => 'submited',
                    'value' => '($data->submited == 1)?"Submitted":"Not Submitted"',
                    'filter' => array(0 => 'Not Submitted', 1 => 'Submitted')
                ),
                array(
                    'header' => 'Actions',
                    'class'=>'CButtonColumn',
                    'template'=>'{update}',
                    'htmlOptions' => array(
                        'width' => '40px',
                    ),
                    'buttons' => array(
                        'update' => array(
                            'label'=>'Edit',
                            'imageUrl'=> false,
                            'options'=>array(
                                'class' => 'update operation-btn',
                            )
                        ),
                    )
                ),
                /*

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
                */
            ),
        )); ?>

    </section>
    </div>
</div>

    <div class="row">
        <div class="col-lg-12">
            <?php
            $this->menu=array(
                array('label'=>'New Secure Detention Form', 'url'=>array('createSecure'), 'linkOptions'=>array('class'=>'link')),
                array('label'=>'New Alternative to Detention Form', 'url'=>array('createAlternative'), 'linkOptions'=>array('class'=>'link')),
            );
            $this->widget('zii.widgets.CMenu', array(
                'items'=>$this->menu,
                'htmlOptions'=>array('class'=>'menu-link'),
            ));
            ?>
            <?php echo CHTML::submitButton('Delete',array('name'=>'delete_checked', 'class'=>'link')); ?>
        </div>
    </div>

<?php echo CHTML::endform(); ?>