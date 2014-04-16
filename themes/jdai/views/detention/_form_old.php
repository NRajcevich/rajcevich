<?php
/* @var $this DetentionController */
/* @var $model Detention */
/* @var $form CActiveForm */

$this_user = User::model()->findByPk(Yii::app()->user->id);

?>

<div class="form" xmlns="http://www.w3.org/1999/html">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'detention-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'grid-form'
    )
)); ?>


<div id="sidebar" class="nav-collapse">
    <div tabindex="5000" style="overflow: hidden; outline: none;">

        <div class="row">
            <!-- Save Button -->
            <?php echo CHtml::submitButton( $model->isNewRecord ? 'Save' : 'Save', array('class'=>'btn btn-info')); ?>
            <!-- Cancel Button -->
            <?php
            echo CHtml::linkButton('Cancel',array(
                'submit'=>$this->createUrl('detention/index'),
                'class' => 'btn btn-info',

            ));
            ?>

            <!-- Submit Button -->
            <?php
            if(!$model->isNewRecord){
                echo CHtml::linkButton($model->submited ? 'Not submit' : 'Submit',array(
                    'submit'=>array('detention/submited','id'=>$model->id),
                    'class' => 'btn btn-info'
                ));
            }
            ?>
        </div>
        <!-- Content -->
        <br/>
        <ul style="display:none;">
            <li><a class="link active" href="#identifiers">Identifiers</a></li>

            <?php if($model->attributes['detention_type'] == 'Alternative') { ?>
                <li><a class="link" href="#program-utilization">Program Utilization</a></li>
                <li><a class="link" href="#referral-or-admission-process">Referral/Admission Process</a></li>
            <?php } ?>

            <?php if($model->attributes['detention_type'] == 'Secure') { ?>
                <li><a class="link" href="#most-recent-detention-admission">Most Recent Detention admission</a></li>
            <?php } ?>

            <li><a class="link" href="#current-offense">Current Offense</a></li>
            <li><a class="link" href="#court-history">Court History</a></li>
            <li><a class="link" href="#referrals">Referrals</a></li>
        </ul>

        <div class="collapse-btn">
            <i class="fa fa-chevron-down"></i>
        </div>

    </div>
</div>



<fieldset name="identifiers">
    <legend></legend>
    <div data-row-span="4">
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'detention_type');
            echo $form->textField($model,'detention_type',array('disabled'=> true));
            ?>
            <input type="hidden" name="Detention[detention_type]" id="Detention_detention_type" value="<?=$model->attributes['detention_type']?>" />
        </div>
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'case_num');
            echo $form->textField($model,'case_num',array(  'placeholder' => 'Write case number'));
            echo $form->error($model,'case_num', array('class'=>'field-error'));
            ?>
        </div>
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'snapshot_date');
            $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                'model'=>$model,
                'attribute'=>'snapshot_date',
                'mode' => 'date',
                'options'   => array(
                    'dateFormat' => 'mm/dd/yy',
                    'changeMonth' => true,
                    'changeYear' => true,
                ),
                'htmlOptions' => array(
                    'placeholder' => 'Select snapshot date'
                )
            ));
            echo $form->error($model,'snapshot_date', array('class'=>'field-error'));
            ?>
        </div>
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'facility');
            echo $form->dropDownList($model,'facility', CHtml::listData(Facility::model()->findAll(), 'id', 'name'), array(
                'prompt'=>'Select Facility',
            ));
            echo $form->error($model,'facility', array('class'=>'field-error'));
            ?>
        </div>
    </div>
</fieldset>
<br/>
<br/>
<fieldset>
    <legend>Identifiers</legend>
    <div data-row-span="2">
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'youth_id');
            echo $form->textField($model,'youth_id',array('placeholder' => 'Write youth ID'));
            echo $form->error($model,'youth_id', array('class'=>'field-error'));
            ?>
        </div>
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'probation_number');
            echo $form->textField($model,'probation_number',array('placeholder' => 'Write probation number'));
            echo $form->error($model,'probation_number', array('class'=>'field-error'));
            ?>
        </div>
    </div>
    <div data-row-span="4">
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'dob');
            $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                'model'=>$model,
                'attribute'=>'dob',
                'mode' => 'date',
                'options'   => array(
                    'dateFormat' => 'mm/dd/yy',
                    'changeMonth' => true,
                    'changeYear' => true,
                ),
                'htmlOptions' => array(
                    'placeholder' => 'Select Date of Birth'
                )
            ));
            echo $form->error($model,'dob', array('class'=>'field-error')); ?>
        </div>
        <div data-field-span="1">
            <?php echo $form->labelEx($model,'race'); ?>
            <?php
            $modelRace = Race::model()->findAll();
            echo CHtml::activeDropDownList(
                $model,
                'race',
                CHtml::listData($modelRace,'race','race'),
                array(
                    'prompt'=>'Select Race',
                )
            );
            ?>
            <?php echo $form->error($model,'race', array('class'=>'field-error')); ?>
        </div>
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'gender');
            echo $form->dropDownList($model,'gender',
                array(
                    'Male'=>'Male',
                    'Female'=>'Female'
                ),array(
                    'prompt' => 'Select a gender'
                )
            );
            echo $form->error($model,'gender');
            ?>
        </div>
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'ethnicity');
            echo $form->dropDownList($model,'ethnicity',
                array(
                    'Hispanic' => 'Hispanic',
                    'Non-Hispanic' => 'Non-Hispanic',
                ),array(
                    'prompt' => 'Select Ethnicity'
                )
            );
            echo $form->error($model,'ethnicity');
            ?>
        </div>
    </div>

    <br/>
    <fieldset>
        <legend>Town/city of</legend>
        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'incident'); ?>
                <?php echo $form->textField($model,'incident',array(  'placeholder' => 'Write Incident Town/City')); ?>
                <?php echo $form->error($model,'incident'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'residence'); ?>
                <?php echo $form->textField($model,'residence',array(  'placeholder' => 'Write Residence Town/City')); ?>
                <?php echo $form->error($model,'residence'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'residence_county'); ?>
                <?php
                $modelCounty = City::model()->findAll(array('condition'=>'state_code=:state_code', 'params'=>array(":state_code"=> $this_user->state), 'order' => 'county'));
                $county_arr = CHtml::listData($modelCounty,'county','county');
                foreach($county_arr as $key => $val){
                    if (empty($val)) unset($county_arr[$key]);
                }
                echo $form->dropDownList(
                    $model,
                    'residence_county',
                    $county_arr,
                    array(
                        'empty'=>'Select County',
                    )
                );
                ?>
                <?php echo $form->error($model,'residence_county'); ?>
            </div>
        </div>
    </fieldset>
</fieldset>

<!-- ALTERNATIVE DETENTION FORM -->
<?php if($model->attributes['detention_type'] == 'Alternative') { ?>
    <br/>
    <br/>
    <fieldset name="program-utilization">
        <legend>Program Utilization</legend>
        <div data-row-span="4">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'program'); ?>
                <?php
                echo $form->dropDownList($model,'program', CHtml::listData(Facility::model()->findAll(array('condition'=>'type=:type_atd', 'params'=>array(':type_atd'=>'atd'))), 'id', 'name'), array(
                    'prompt'=>'Select Program',
                ));
                ?>
                <?php echo $form->error($model,'program'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'program_admit_date'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'program_admit_date',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'program_admit_date'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'program_status'); ?>
                <?php echo $form->textField($model,'program_status' ); ?>
                <?php echo $form->error($model,'program_status'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'program_status_date'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'program_status_date',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'program_status_date'); ?>
            </div>
        </div>
    </fieldset>
    <br/>
    <br/>
    <fieldset name="referral-or-admission-process">
        <legend>Referral/Admission Process</legend>
        <div data-row-span="4">
            <div data-field-span="2">
                <?php echo $form->labelEx($model,'referral_admission_type'); ?>
                <?php echo $form->dropDownList($model,'referral_admission_type',
                    array(
                        'Court Referral' => 'Court Referral',
                        'No Referral/Direct Court Order' => 'No Referral/Direct Court Order',
                        'Other Referral' => 'Other Referral',
                    ),array(
                        'prompt' => 'Select Admission Type'
                    )
                );
                ?>
                <?php echo $form->error($model,'referral_admission_type'); ?>
            </div>
            <div data-field-span="2">
                <?php echo $form->labelEx($model,'date_referred'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'date_referred',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'date_referred'); ?>
            </div>
        </div>
        <div data-row-span="4">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'remanding_judge'); ?>
                <?php echo $form->textField($model,'remanding_judge' ); ?>
                <?php echo $form->error($model,'remanding_judge'); ?>
            </div>
            <div data-field-span="2">
                <?php echo $form->labelEx($model,'youth_location_leading_to_admission'); ?>
                <?php echo $form->dropDownList($model,'youth_location_leading_to_admission',
                    array(
                        'lia' => 'Law Enforcement --> Intake --> Admitted to Alternative',
                        'hcra' => 'Home --> Court --> Remand to Detent to Await Alt --> Admit to Alt**',
                        'dca' => 'Detention --> Court --> Admitted to Alternative**',
                        'hca' => 'Home --> Court --> Admitted to Alternative',
                        'Other' => 'Other',
                    ),array(
                        'prompt' => 'Select'
                    )
                );
                ?>
                <?php echo $form->error($model,'youth_location_leading_to_admission'); ?>
            </div>
        </div>
        <div data-row-span="4">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'release_date'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'release_date',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'release_date'); ?>
            </div>
            <div data-field-span="2">
                <?php echo $form->labelEx($model,'release_to'); ?>
                <?php
                echo $form->dropDownList($model,'release_to',
                    array(
                        'ROR Pre-Disposition' => 'ROR Pre-Disposition',
                        'Detention Alternative' => 'Detention Alternative',
                        'To Serve Disposition/To Dispositional Placement *' => 'To Serve Disposition/To Dispositional Placement *',
                        'Parents/Other Adult Pre-Disposition' => 'Parents/Other Adult Pre-Disposition',
                        'Transferred to Jail/Other Detention Facility' => 'Transferred to Jail/Other Detention Facility',
                        'Charges Diverted - Released Home' => 'Charges Diverted - Released Home',
                        'Charges Dismissed - Released Home' => 'Charges Dismissed - Released Home',
                        'Unknown/Other' => 'Unknown/Other'
                    ),array(
                        'prompt' => 'Select Release To'
                    )
                );
                ?>
                <?php echo $form->error($model,'release_to'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'specify_where'); ?>
                <?php
                echo $form->dropDownList($model,'specify_where',
                    array(
                        'Residential' => 'Residential',
                        'JDC' => 'JDC',
                        'IDOC' => 'IDOC',
                        'Adult' => 'Adult',
                        'Unknown/Other' => 'Unknown/Other',
                    ),array(
                        'prompt' => 'Select Specify Where'
                    )
                );
                ?>
                <?php echo $form->error($model,'specify_where'); ?>
            </div>
        </div>
        <div data-row-span="4">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'date_release_from_disposition'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'date_release_from_disposition',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'date_release_from_disposition'); ?>
            </div>
            <div data-field-span="3">
                <?php echo $form->labelEx($model,'released_alternative'); ?>
                <?php
                echo $form->dropDownList($model,'released_alternative',
                    array(
                        'New Offense Pre-Disposition' => 'New Offense Pre-Disposition',
                        'Violation Pre-Disposition' => 'Violation Pre-Disposition',
                        'FTA Pre-Disposition' => 'FTA Pre-Disposition',
                        'Disposed without Incident' => 'Disposed without Incident',
                        'Unknown/Other' => 'Unknown/Other',
                    ),array(
                        'prompt' => 'Select most serious'
                    )
                );
                ?>
                <?php echo $form->error($model,'released_alternative'); ?>
            </div>
        </div>
    </fieldset>
<?php  } ?>
<!-- END ALTERNATIVE DETENTION FORM -->

<!-- SECURE DETENTION FORM -->
<?php if($model->attributes['detention_type'] == 'Secure') { ?>
    <br/>
    <br/>
    <fieldset name="most-recent-detention-admission">
        <legend>Most Recent Detention admission</legend>
        <br/>
        <fieldset>
            <legend>Admission</legend>
            <div data-row-span="4">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'date_recent_detention_admission'); ?>
                    <?php
                    $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                        'model'=>$model,
                        'attribute'=>'date_recent_detention_admission',
                        'mode' => 'date',
                        'options'   => array(
                            'dateFormat' => 'mm/dd/yy',
                            'changeMonth' => true,
                            'changeYear' => true,
                        ),
                        'htmlOptions' => array(
                            'placeholder' => 'Select Date'
                        )
                    ));
                    ?>
                    <?php echo $form->error($model,'date_recent_detention_admission'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'time_referred'); ?>
                    <?php
                    $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                        'model'=>$model,
                        'attribute'=>'time_referred',
                        'mode' => 'time',
                        'options'   => array(
                            'timeFormat' => 'hh:mm tt',
                        ),
                        'htmlOptions' => array(
                            'placeholder' => 'Select Time'
                        )
                    ));
                    ?>
                    <?php echo $form->error($model,'time_referred'); ?>
                </div>
                <div data-field-span="2">
                    <?php echo $form->labelEx($model,'referral_agency'); ?>
                    <?php
                    echo $form->dropDownList($model,'referral_agency',
                        array(
                            'School'=>'School',
                            'Domestic'=>'Domestic',
                            'Unknown/Other'=>'Unknown/Other',
                        ),array(
                            'prompt' => 'Select Referral Agency'
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'referral_agency'); ?>
                </div>
            </div>
            <div data-row-span="1">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'process_admitted_to_detention'); ?>
                    <?php
                    echo $form->dropDownList($model,'process_admitted_to_detention',
                        array(
                            'Called Into/Authorized By Intake Services'=>'Called Into/Authorized By Intake Services',
                            'Direct-Execution of Warrant (Not Called To Intake)'=>'Direct-Execution of Warrant (Not Called To Intake)',
                            'Violation of Release'=>'Violation of Release',
                            'Remand at Court Hearing'=>'Remand at Court Hearing',
                            'From Other Facility - Jurisdiction Transfer'=>'From Other Facility - Jurisdiction Transfer',
                            'Other'=>'Other',
                        ),array(
                            'prompt' => 'Select process'
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'process_admitted_to_detention'); ?>
                </div>
            </div>
        </fieldset>
        <br/>
        <fieldset>
            <legend>Release</legend>
            <div data-row-span="4">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'release_date'); ?>
                    <?php
                    $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                        'model'=>$model,
                        'attribute'=>'release_date',
                        'mode' => 'date',
                        'options'   => array(
                            'dateFormat' => 'mm/dd/yy',
                            'changeMonth' => true,
                            'changeYear' => true,
                        ),
                        'htmlOptions' => array(
                            'placeholder' => 'Select Date'
                        )
                    ));
                    ?>
                    <?php echo $form->error($model,'release_date'); ?>
                </div>
                <div data-field-span="2">
                    <?php echo $form->labelEx($model,'release_to'); ?>
                    <?php
                    echo $form->dropDownList($model,'release_to',
                        array(
                            'ROR Pre-Disposition'=> 'ROR Pre-Disposition',
                            'Detention Alternative'=>'Detention Alternative',
                            'To Serve Disposition/To Dispositional Placement *'=>'To Serve Disposition/To Dispositional Placement *',
                            'Parents/Other Adult Pre-Disposition' => 'Parents/Other Adult Pre-Disposition',
                            'Transferred to Jail/Other Detention Facility'=>'Transferred to Jail/Other Detention Facility',
                            'Charges Diverted - Released Home'=>'Charges Diverted - Released Home',
                            'Charges Dismissed - Released Home'=>'Charges Dismissed - Released Home',
                            'Unknown/Other' => 'Unknown/Other'
                        ),array(
                            'prompt' => 'Select Release To'
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'release_to'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'specify_where'); ?>
                    <?php
                    echo $form->dropDownList($model,'specify_where',
                        array(
                            'Residential' => 'Residential',
                            'JDC' => 'JDC',
                            'IDOC' => 'IDOC',
                            'Adult' => 'Adult',
                            'Unknown/Other' => 'Unknown/Other',
                        ),array(
                            'prompt' => 'Select Specify Where'
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'specify_where'); ?>
                </div>
            </div>
            <div data-row-span="4">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'date_release_from_disposition'); ?>
                    <?php
                    $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                        'model'=>$model,
                        'attribute'=>'date_release_from_disposition',
                        'mode' => 'date',
                        'options'   => array(
                            'dateFormat' => 'mm/dd/yy',
                            'changeMonth' => true,
                            'changeYear' => true,
                        ),
                        'htmlOptions' => array(
                            'placeholder' => 'Select Date'
                        )
                    ));
                    ?>
                    <?php echo $form->error($model,'date_release_from_disposition'); ?>
                </div>
                <div data-field-span="3">
                    <?php echo $form->labelEx($model,'released_alternative'); ?>
                    <?php
                    echo $form->dropDownList($model,'released_alternative',
                        array(
                            'New Offense'=>'New Offense',
                            'Violation'=>'Violation',
                            'FTA'=>'FTA',
                            'Disposed without Incident'=>'Disposed without Incident',
                            'Unknown/Other' => 'Unknown/Other'
                        ),array(
                            'prompt' => 'Select most serious'
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'released_alternative'); ?>
                </div>
            </div>
        </fieldset>
    </fieldset>
<?php  } ?>
<!-- END SECURE DETENTION FORM -->


<br/>
<br/>
<fieldset name="current-offense">
    <legend>Current Offense</legend>
    <div data-row-span="3">
        <div data-field-span="2">
            <?php echo $form->labelEx($model,'type_delinquent_act'); ?>
            <?php
            echo $form->dropDownList($model,'type_delinquent_act',
                array(
                    'New Delinquency Charges Only' => 'New Delinquency Charges Only',
                    'Technical Violation of Probation Only' => 'Technical Violation of Probation Only',
                    'Warrant' => 'Warrant',
                    'FTA Only' => 'FTA Only',
                    'Violation of Release' => 'Violation of Release',
                    'Unknown/Other' => 'Unknown/Other'
                ),array(
                    'prompt' => 'Select Type'
                )
            );
            ?>
            <?php echo $form->error($model,'type_delinquent_act'); ?>
        </div>
        <div data-field-span="1">
            <?php echo $form->labelEx($model,'severe_arrest_offense'); ?>
            <?php
            echo $form->dropDownList($model,'severe_arrest_offense',
                array(
                    'Felony A' => 'Felony A',
                    'Felony B' => 'Felony B',
                    'Felony C' => 'Felony C',
                    'Felony D (Non-Theft)' => 'Felony D (Non-Theft)',
                    'Felony D (Including Theft)' => 'Felony D (Including Theft)',
                    'Misdemeanor A' => 'Misdemeanor A',
                    'Misdemeanor B' => 'Misdemeanor B',
                    'Misdemeanor C' => 'Misdemeanor C',
                    'Misdemeanor D' => 'Misdemeanor D',
                    'Status' => 'Status',
                    'Unknown/Other' => 'Unknown/Other'
                ),
                array(
                    'prompt' => 'Select Arrest Offense',
                    'disabled' => true,
                )
            );
            ?>
            <?php echo $form->error($model,'severe_arrest_offense'); ?>
        </div>
    </div>
    <div data-row-span="3">
        <div data-field-span="1">
            <?php echo $form->labelEx($model,'charge_filed'); ?>
            <label class="checkbox"><?php echo $form->checkBox($model,'charge_filed'); ?> Check</label>
            <?php echo $form->error($model,'charge_filed'); ?>
        </div>
        <div data-field-span="1">
            <br/>
            <?php echo $form->labelEx($model,'severe_arrest_offense_sel'); ?>
            <?php
            echo $form->dropDownList($model,'severe_arrest_offense_sel',
                array(
                    // options
                ),array(
                    'prompt' => 'Select Severe Arrest'
                )
            );
            ?>
            <?php echo $form->error($model,'severe_arrest_offense_sel'); ?>
        </div>
        <div data-field-span="1">
            <?php echo $form->labelEx($model,'probation_time_arrest'); ?>
            <label class="checkbox"><?php echo $form->checkBox($model,'probation_time_arrest'); ?> Check</label>
            <?php echo $form->error($model,'probation_time_arrest'); ?>
        </div>
    </div>

    <br/>
    <fieldset>
        <legend>Case Processing</legend>
        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'arrest_violation_date'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'arrest_violation_date',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'arrest_violation_date'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'adjudication_date'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'adjudication_date',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'adjudication_date'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'preliminary_inquiry_date'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'preliminary_inquiry_date',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'preliminary_inquiry_date'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'adjudication_status'); ?>
                <?php
                echo $form->dropDownList($model,'adjudication_status',
                    array(
                        'Dismissed'=>'Dismissed',
                        'Dismissed; Delinq on Other Chgs'=>'Dismissed; Delinq on Other Chgs',
                        'Diverted'=>'Diverted',
                        'Waiver Granted'=>'Waiver Granted',
                        'Delinquent'=>'Delinquent',
                        'Direct File'=>'Direct File',
                    ),array(
                        'prompt' => 'Select Status'
                    )
                );
                ?>
                <?php echo $form->error($model,'adjudication_status'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'disposition_date'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'disposition_date',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date',
                    )
                ));
                ?>
                <?php echo $form->error($model,'disposition_date'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'final_court_ordered_disposition'); ?>
                <?php
                echo $form->dropDownList($model,'final_court_ordered_disposition',
                    array(
                        'Waiver Granted' => 'Waiver Granted',
                        'DOC Commit' => 'DOC Commit',
                        'JDC Residential' => 'JDC Residential',
                        'A&D Residential' => 'A&D Residential',
                        'DCS Residential' => 'DCS Residential',
                        'Other Residential' => 'Other Residential',
                        'DCS Non-Residential' => 'DCS Non-Residential',
                        'Day Reporting Day' => 'Day Reporting Day',
                        'Other Day' => 'Other Day',
                        'Intensive Supervision' => 'Intensive Supervision',
                        'Probation Supervision/Services' => 'Probation Supervision/Services',
                        'EM' => 'EM',
                        'Drug Court' => 'Drug Court',
                        'Deferred Disposition' => 'Deferred Disposition',
                        'DOC/JDC (Divert)' => 'DOC/JDC (Divert)',
                        'None (Dismiss)' => 'None (Dismiss)',
                        'Other' => 'Other',
                    ),array(
                        'prompt' => 'Select Disposition'
                    )
                );
                ?>
                <?php echo $form->error($model,'final_court_ordered_disposition'); ?>
            </div>
        </div>
    </fieldset>
</fieldset>
<br/>
<br/>
<fieldset name="court-history">
    <legend>Court History</legend>
        <br/>
        <fieldset>
            <legend>Offense History</legend>
            <div data-row-span="3">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'court_status'); ?>
                    <?php
                    echo $form->dropDownList($model,'court_status',
                        array(
                            'Pre-Adjudication' => 'Pre-Adjudication',
                            'Adjudicated/Awaiting Disposition ' => 'Adjudicated/Awaiting Disposition ',
                            'Disposed/Awaiting Placement' => 'Disposed/Awaiting Placement',
                            'Waiver Pending/Granted ' => 'Waiver Pending/Granted ',
                        ),array(
                            'prompt' => 'Select Status'
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'court_status'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_prior_deliquency_arrests'); ?>
                    <?php echo $form->numberField($model,'number_prior_deliquency_arrests',array('class' => 'field-number', 'size'=>10,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'number_prior_deliquency_arrests'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_prior_deliquency_causes_filed'); ?>
                    <?php echo $form->numberField($model,'number_prior_deliquency_causes_filed',array('class' => 'field-number', 'size'=>10,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'number_prior_deliquency_causes_filed'); ?>
                </div>
            </div>
            <div data-row-span="3">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_prior_technical_violations_filed'); ?>
                    <?php echo $form->numberField($model,'number_prior_technical_violations_filed',array('class' => 'field-number', 'size'=>10,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'number_prior_technical_violations_filed'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_prior_deliquency_cases_adjudicated'); ?>
                    <?php echo $form->numberField($model,'number_prior_deliquency_cases_adjudicated',array('class' => 'field-number', 'size'=>10,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'number_prior_deliquency_cases_adjudicated'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_prior_adjudications_ab_felony'); ?>
                    <?php echo $form->numberField($model,'number_prior_adjudications_ab_felony',array('class' => 'field-number', 'size'=>10,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'number_prior_adjudications_ab_felony'); ?>
                </div>
            </div>
            <div data-row-span="3">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'most_severe_prior_adjudication'); ?>
                    <?php
                    echo $form->dropDownList($model,'most_severe_prior_adjudication',
                        array(
                            'Felony A' => 'Felony A',
                            'Felony B' => 'Felony B',
                            'Felony C' => 'Felony C',
                            'Felony D (Non-Theft)' => 'Felony D (Non-Theft)',
                            'Felony D (Including Theft)' => 'Felony D (Including Theft)',
                            'Misdemeanor A' => 'Misdemeanor A',
                            'Misdemeanor B' => 'Misdemeanor B',
                            'Misdemeanor C' => 'Misdemeanor C',
                            'Misdemeanor D' => 'Misdemeanor D',
                            'Status' => 'Status',
                            'Unknown/Other' => 'Unknown/Other'
                        ),
                        array(
                            'prompt' => 'Select Adjudication',
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'most_severe_prior_adjudication'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_warants_issued_fta'); ?>
                    <?php echo $form->numberField($model,'number_warants_issued_fta',array('class' => 'field-number', 'size'=>10,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'number_warants_issued_fta'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_open_petitions_pending_on_day'); ?>
                    <?php echo $form->numberField($model,'number_open_petitions_pending_on_day',array('class' => 'field-number', 'size'=>10,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'number_open_petitions_pending_on_day'); ?>
                </div>
            </div>
        </fieldset>
        <br/>
        <fieldset>
            <legend>Placement History
            <p class="red-text">This particular data is asking for pre-dispositional utilization only.</p>
            </legend>
            <div data-row-span="3">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_prior_secure_detentions'); ?>
                    <?php echo $form->numberField($model,'number_prior_secure_detentions',array('class' => 'field-number', 'size'=>10,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'number_prior_secure_detentions'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_times_admitted_detention_alternative'); ?>
                    <?php echo $form->numberField($model,'number_times_admitted_detention_alternative',array('class' => 'field-number', 'size'=>10,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'number_times_admitted_detention_alternative'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_failed_from_detention_alternative'); ?>
                    <?php echo $form->numberField($model,'number_failed_from_detention_alternative',array('class' => 'field-number', 'size'=>10,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'number_failed_from_detention_alternative'); ?>
                </div>
            </div>
        </fieldset>
        <br/>
        <fieldset>
            <legend>AWOL/Runaway History</legend>
            <div data-row-span="3">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'prior_awol_runaway_history'); ?>
                    <label class="checkbox"><?php echo $form->checkBox($model,'prior_awol_runaway_history'); ?> Check</label>
                    <?php echo $form->error($model,'prior_awol_runaway_history'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'awol_runaway_at_time_detention'); ?>
                    <label class="checkbox"><?php echo $form->checkBox($model,'awol_runaway_at_time_detention'); ?> Check</label>
                    <?php echo $form->error($model,'awol_runaway_at_time_detention'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'serious_awol_runaway_event'); ?>
                    <?php
                    echo $form->dropDownList($model,'serious_awol_runaway_event',
                        array(
                            'Juvenile Detention/DOC Facility' => 'Juvenile Detention/DOC Facility',
                            'Absconded from Probation/Parole Supervision'=>'Absconded from Probation/Parole Supervision',
                            'Residential Dispositional Placement'=>'Residential Dispositional Placement',
                            'Home/Foster Care'=>'Home/Foster Care',
                            'Shelter Care'=>'Shelter Care',
                            'Cut/Removed Electronic Monitoring Equipment'=>'Cut/Removed Electronic Monitoring Equipment',
                            'Unknown/Other'=>'Unknown/Other',
                        ),array(
                            'prompt' => 'Select'
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'serious_awol_runaway_event'); ?>
                </div>
            </div>
        </fieldset>
        <br/>
        <fieldset>
            <legend>Family History</legend>
            <div data-row-span="3">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'prior_dcs_involvement'); ?>
                    <label class="checkbox"><?php echo $form->checkBox($model,'prior_dcs_involvement'); ?> Check</label>
                    <?php echo $form->error($model,'prior_dcs_involvement'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'current_dcs_involvement'); ?>
                    <label class="checkbox"><?php echo $form->checkBox($model,'current_dcs_involvement'); ?> Check</label>
                    <?php echo $form->error($model,'current_dcs_involvement'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'caregiver_availability'); ?>
                    <?php
                    echo $form->dropDownList($model,'caregiver_availability',
                        array(
                            'Parent/Caregiver Available'=>'Parent/Caregiver Available',
                            'Parent/Caregiver Not Available or Could Not Be Located'=>'Parent/Caregiver Not Available or Could Not Be Located',
                            'Parent/Caregiver Available, but Unwilling to Take Youth Home'=>'Parent/Caregiver Available, but Unwilling to Take Youth Home',
                            'Contact Attempt not Documented/Parent Availability Unknown'=>'Contact Attempt not Documented/Parent Availability Unknown',
                            'Unknown/Other'=>'Unknown/Other',
                        ),array(
                            'prompt' => 'Select'
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'caregiver_availability'); ?>
                </div>
            </div>
        </fieldset>
        <br/>
        <fieldset>
            <legend>Mental Health History</legend>
            <div data-row-span="3">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'cbbt'); ?>
                    <?php
                    echo $form->dropDownList($model,'cbbt',
                        array(
                            'None'=>'None',
                            'Yes'=>'Yes',
                            'Unknown/Other'=>'Unknown/Other',
                        ),array(
                            'prompt' => 'Select'
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'cbbt'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'psychotropic_medics_history'); ?>
                    <?php
                    echo $form->dropDownList($model,'psychotropic_medics_history',
                        array(
                            'None'=>'None',
                            'Yes-Prior Only'=>'Yes-Prior Only',
                            'Yes-Current'=>'Yes-Current',
                            'Unknown/Other'=>'Unknown/Other',
                        ),array(
                            'prompt' => 'Select'
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'psychotropic_medics_history'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'treatment_service_history'); ?>
                    <?php
                    echo $form->dropDownList($model,'treatment_service_history',
                        array(
                            'None'=>'None',
                            'Yes-Outpatient Only'=>'Yes-Outpatient Only',
                            'Yes-Inpatient/Residential/Hospital'=>'Yes-Inpatient/Residential/Hospital',
                            'Unknown/Other'=>'Unknown/Other',
                        ),array(
                            'prompt' => 'Select'
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'treatment_service_history'); ?>
                </div>
            </div>
        </fieldset>
</fieldset>
<br/>
<br/>
<fieldset name="referrals">
    <legend>Referrals</legend>
    <br/>
    <fieldset>
        <legend>Evaluation</legend>
        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_evaluation_ad'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'refferal_evaluation_ad'); ?> A&D Evaluation</label>
                <?php echo $form->error($model,'refferal_evaluation_ad'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_evaluation_ad_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'refferal_evaluation_ad_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_evaluation_ad_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_evaluation_ad_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'refferal_evaluation_ad_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_evaluation_ad_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_psychological'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'refferal_psychological'); ?> Psychological</label>
                <?php echo $form->error($model,'refferal_psychological'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_psychological_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'refferal_psychological_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_psychological_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_psychological_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'refferal_psychological_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_psychological_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_psychiatric'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'refferal_psychiatric'); ?> Psychiatric</label>
                <?php echo $form->error($model,'refferal_psychiatric'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_psychiatric_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'refferal_psychiatric_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_psychiatric_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_psychiatric_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'refferal_psychiatric_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_psychiatric_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_pdr'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'refferal_pdr'); ?> PDR</label>
                <?php echo $form->error($model,'refferal_pdr'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_pdr_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'refferal_pdr_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_pdr_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_pdr_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'refferal_pdr_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_pdr_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_other'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'refferal_other'); ?> Other</label>
                <?php echo $form->textField($model,'refferal_other_label',array(  'placeholder' => 'Write Evaluation')); ?>
                <?php echo $form->error($model,'refferal_other'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_other_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'refferal_other_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_other_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_other_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'refferal_other_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_other_date_completed'); ?>
            </div>
        </div>

    </fieldset>
    <br/>
    <fieldset>
        <legend>Dispositional</legend>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_doc'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'dispositional_doc'); ?> DOC</label>
                <?php echo $form->error($model,'dispositional_doc'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_doc_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_doc_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_doc_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_doc_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_doc_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_doc_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_jdc'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'dispositional_jdc'); ?> JDC</label>
                <?php echo $form->error($model,'dispositional_jdc'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_jdc_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_jdc_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_jdc_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_jdc_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_jdc_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_jdc_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_rtf'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'dispositional_rtf'); ?> RTF</label>
                <?php echo $form->error($model,'dispositional_rtf'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_rtf_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_rtf_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_rtf_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_rtf_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_rtf_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_rtf_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_ad_residental'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'dispositional_ad_residental'); ?> A&D Residental</label>
                <?php echo $form->error($model,'dispositional_ad_residental'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_ad_residental_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_ad_residental_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_ad_residental_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_ad_residental_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_ad_residental_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_ad_residental_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_shelter_care'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'dispositional_shelter_care'); ?> Shelter Care</label>
                <?php echo $form->error($model,'dispositional_shelter_care'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_shelter_care_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_shelter_care_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_shelter_care_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_shelter_care_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_shelter_care_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_shelter_care_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_drug_court'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'dispositional_drug_court'); ?> Drug Court</label>
                <?php echo $form->error($model,'dispositional_drug_court'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_drug_court_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_drug_court_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_drug_court_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_drug_court_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_drug_court_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_drug_court_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_intensive_probation_supervision'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'dispositional_intensive_probation_supervision'); ?> Intensive Probation Supervision</label>
                <?php echo $form->error($model,'dispositional_intensive_probation_supervision'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_intensive_probation_supervision_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_intensive_probation_supervision_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_intensive_probation_supervision_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_intensive_probation_supervision_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_intensive_probation_supervision_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_intensive_probation_supervision_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_probation'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'dispositional_probation'); ?> Probation</label>
                <?php echo $form->error($model,'dispositional_probation'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_probation_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_probation_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_probation_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_probation_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_probation_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_probation_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_other'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'dispositional_other'); ?> Other</label>
                <?php echo $form->textField($model,'dispositional_other_label',array(  'placeholder' => 'Write Evaluation')); ?>
                <?php echo $form->error($model,'dispositional_other'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_other_date_ordered'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_other_date_ordered',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_other_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_other_date_completed'); ?>
                <?php
                $this->widget('application.widgets.EJuiDateTimePicker.EJuiDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'dispositional_other_date_completed',
                    'mode' => 'date',
                    'options'   => array(
                        'dateFormat' => 'mm/dd/yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Select Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_other_date_completed'); ?>
            </div>
        </div>

    </fieldset>
</fieldset>
</div><!-- form -->

<?php $this->endWidget(); ?>

<?php
$cs = Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/custom.js');
?>

<script>
    jQuery(function($) {
        $('#DetentionAF_type_delinquent_act').change(function(){
            if($(this).val() == 'New Delinquency Charges Only'){
                $('#DetentionAF_severe_arrest_offense').prop('disabled', false);
            }else{
                $('#DetentionAF_severe_arrest_offense').val('');
                $('#DetentionAF_severe_arrest_offense').prop('disabled', true);
            }
        });
        $('#DetentionSF_type_delinquent_act').change(function(){
            if($(this).val() == 'New Delinquency Charges Only'){
                $('#DetentionSF_severe_arrest_offense').prop('disabled', false);
            }else{
                $('#DetentionSF_severe_arrest_offense').val('');
                $('#DetentionSF_severe_arrest_offense').prop('disabled', true);
            }
        });
        $("#sidebar .collapse-btn").click(function(){
            var this_btn = $("#sidebar .collapse-btn i");
            $("#sidebar ul").slideToggle(300, function(){
                if($(this).css('display') == 'none') {
                    this_btn.removeClass('fa-chevron-up');
                    this_btn.addClass('fa-chevron-down');
                }else{
                    this_btn.removeClass('fa-chevron-down');
                    this_btn.addClass('fa-chevron-up');
                }
            });
        });

        //Checkboxes
        $('#DetentionAF_refferal_evaluation_ad, #DetentionSF_refferal_evaluation_ad').change(function(){
            if($(this).attr('checked') == 'checked'){
                $('#DetentionAF_refferal_evaluation_ad_date_ordered').attr('disabled', false);
                $('#DetentionAF_refferal_evaluation_ad_date_completed').attr('disabled', false);
            }else{
                $('#DetentionAF_refferal_evaluation_ad_date_ordered').attr('disabled', true);
                $('#DetentionAF_refferal_evaluation_ad_date_completed').attr('disabled', true);
            }
        });

        <?php if($model->isNewRecord) { ?>
            var formonsubmit = false;
            $('#detention-form').submit(function(){
                formonsubmit = true;
            });

            window.onbeforeunload = function() {
                if(!formonsubmit) return 'You haven’t saved the state of the record!';
            };
        <?php } ?>

    })
</script>

