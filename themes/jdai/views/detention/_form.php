<?php
/* @var $this DetentionController */
/* @var $model Detention */
/* @var $form CActiveForm */

$this_user = User::model()->findByPk(Yii::app()->user->id);

//print_r($model->attributes); exit;
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
            <!-- Created and Updated data -->

            <!-- Save Button -->

            <?php  if(!$model->submited || Yii::app()->user->checkAccess('state_admin')){
            echo CHtml::submitButton( 'Save', array('class'=>'btn btn-info', 'submit' => $model->isNewRecord? 
                ($model->attributes['detention_type'] == 'Alternative' ? 'createAlternative' : 'createSecure' ) : '/detention/update/'. $model->id));
             
            } else if ($model->submited){
                echo '<a href="javascript:void(0)" class="btn">Submitted</a>';
            }?>
            <!-- Cancel Button -->
            <?php
            if(!$model->submited){
                echo CHtml::linkButton('Cancel',array(
                    'submit'=>$this->createUrl('detention/index'),
                    'class' => 'btn btn-info',
                ));
            }
            ?>

            <!-- Submit Button -->
            <?php
            if(!$model->isNewRecord){
                if(Yii::app()->user->checkAccess('state_admin')){
                echo CHtml::linkButton($model->submited ? 'Unsubmit' : 'Submit',array(
                    'submit'=>array(($model->submited ? 'detention/unsubmited' : 'detention/submited'),'id'=>$model->id),
                    'class' => 'btn btn-info'
                ));
                }
                else if(!$model->submited){
                  echo CHtml::linkButton('Submit',array(
                    'submit'=>array(('detention/submited'),'id'=>$model->id),
                    'class' => 'btn btn-info'
                ));   
                }
            }
            ?>
        </div>
        <!-- Content -->
        <br/>
        <ul style="display:none;">
            <li><a class="link active" href="#demographics">Demographics</a></li>

            <?php if($model->attributes['detention_type'] == 'Alternative') { ?>
                <li><a class="link" href="#program-utilization">Program Utilization</a></li>
                <li><a class="link" href="#referral-or-admission-process">Referral/Admission Process</a></li>
            <?php } ?>

            <?php if($model->attributes['detention_type'] == 'Secure') { ?>
                <li><a class="link" href="#most-recent-detention-admission">Detention Admission</a></li>
            <?php } ?>

            <li><a class="link" href="#current-offense">Current Offense</a></li>
            <li><a class="link" href="#court-history">Court History</a></li>
            <li><a class="link" href="#referrals">Referrals (Current Case)</a></li>
        </ul>

        <div class="collapse-btn">
            <i class="fa fa-chevron-down"></i>
        </div>

    </div>
</div>

<fieldset name="demographics">
    <legend></legend>
    <div data-row-span="<?php if($model->attributes['detention_type'] == 'Secure') {echo 4;}else{echo 3;}  ?>">
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'detention_type');
            echo $form->textField($model,'detention_type',array('disabled'=> true));
            ?>
            <input type="hidden" name="Detention[detention_type]" id="Detention_detention_type" value="<?=$model->attributes['detention_type']?>" />
        </div>
        <div data-field-span="1">
            <?php echo $form->labelEx($model,'court_status'); ?>
            <?php
            echo $form->dropDownList($model,'court_status',
                array(
                    'Adjudicated/Awaiting Disposition ' => 'Adjudicated/Awaiting Disposition ',
                    'Direct File' => 'Direct File',
                    'Disposed/Awaiting Placement' => 'Disposed/Awaiting Placement',
                    'Pre-Adjudication' => 'Pre-Adjudication',
                    'Waiver Pending/Granted ' => 'Waiver Pending/Granted ',
                ),array(
                    'prompt' => ''
                )
            );
            ?>
            <?php echo $form->error($model,'court_status'); ?>
        </div>
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'snapshot_date');
            $this->widget('CMaskedTextField', array(
                'model' => $model,
                'attribute' => 'snapshot_date',
                'mask' => '99/99/9999',
                'placeholder' => '_',
                'htmlOptions' => array(
                    'placeholder' => 'Write Date'
                )
            ));
            echo $form->error($model,'snapshot_date', array('class'=>'field-error'));
            ?>
        </div>
        <?php if($model->attributes['detention_type'] == 'Secure') { ?>
        <div data-field-span="1">
            <?php echo $form->labelEx($model,'facility'); ?>
            <?php if($this_user->attributes['county'] == 'ALL') {
                echo $form->dropDownList($model,'facility', CHtml::listData(Facility::model()->findAll(array('condition'=>'type=:type_sd', 'params'=>array(':type_sd'=>'secure_detention'))), 'id', 'name'), array(
                    'prompt'=>'',
                ));
            }else{
                echo $form->dropDownList($model,'facility', CHtml::listData(Facility::model()->findAll(array('condition'=>'type=:type_sd AND county=:county', 'params'=>array(':type_sd'=>'secure_detention', ':county'=> $this_user->attributes['county']))), 'id', 'name'), array(
                    'prompt'=>'',
                ));
            }
            ?>
            <?php echo $form->error($model,'facility', array('class'=>'field-error')); ?>
        </div>
        <?php } ?>
    </div>
</fieldset>
<br/>
<br/>
<fieldset>
    <legend>Demographics</legend>
    <div data-row-span="3">
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
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'dob');
            $this->widget('CMaskedTextField', array(
                'model' => $model,
                'attribute' => 'dob',
                'mask' => '99/99/9999',
                'placeholder' => '_',
                'htmlOptions' => array(
                    'placeholder' => 'Write Date'
                )
            ));
            echo $form->error($model,'dob', array('class'=>'field-error')); ?>
        </div>
    </div>
    <div data-row-span="3">
        <div data-field-span="1">
            <?php echo $form->labelEx($model,'race'); ?>
            <?php
            $modelRace = Race::model()->findAll();
            echo CHtml::activeDropDownList(
                $model,
                'race',
                CHtml::listData($modelRace,'race','race'),
                array(
                    'prompt'=>'',
                )
            );
            ?>
            <?php echo $form->error($model,'race', array('class'=>'field-error')); ?>
        </div>
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'ethnicity');
            echo $form->dropDownList($model,'ethnicity',
                array(
                    'Hispanic' => 'Hispanic',
                    'Non-Hispanic' => 'Non-Hispanic',
                ),array(
                    'prompt' => ''
                )
            );
            echo $form->error($model,'ethnicity');
            ?>
        </div>
        <div data-field-span="1">
            <?php
            echo $form->labelEx($model,'gender');
            echo $form->dropDownList($model,'gender',
                array(
                    'Male'=>'Male',
                    'Female'=>'Female'
                ),array(
                    'prompt' => ''
                )
            );
            echo $form->error($model,'gender');
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
                $county_arr['Out of State'] = 'Out of State';
                echo $form->dropDownList(
                    $model,
                    'residence_county',
                    $county_arr,
                    array(
                        'prompt'=>'',
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
        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'program'); ?>
                <?php if($this_user->attributes['county'] == 'ALL') {
                    echo $form->dropDownList($model,'program', CHtml::listData(Facility::model()->findAll(array('condition'=>'type=:type_atd', 'params'=>array(':type_atd'=>'atd'))), 'id', 'name'), array(
                        'prompt'=>'',
                    ));
                }else{
                    echo $form->dropDownList($model,'program', CHtml::listData(Facility::model()->findAll(array('condition'=>'type=:type_atd AND county=:county', 'params'=>array(':type_atd'=>'atd', ':county'=> $this_user->attributes['county']))), 'id', 'name'), array(
                        'prompt'=>'',
                    ));
                }
                ?>
                <?php echo $form->error($model,'program'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'date_ordered'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'program_admit_date'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'program_admit_date',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'program_admit_date'); ?>
            </div>
        </div>
        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'program_status'); ?>
                <?php echo $form->dropDownList($model,'program_status',
                    array(
                        'Successfully Completed' => 'Successfully Completed',
                        'Unsuccessful' => 'Unsuccessful',
                    ),array(
                        'prompt' => ''
                    )
                );
                ?>
                <?php echo $form->error($model,'program_status'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'program_status_date'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'program_status_date',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
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
                        'prompt' => ''
                    )
                );
                ?>
                <?php echo $form->error($model,'referral_admission_type'); ?>
            </div>
            <div data-field-span="2">
                <?php echo $form->labelEx($model,'date_referred'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'date_referred',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'date_referred'); ?>
            </div>
        </div>
        <div data-row-span="4">

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
                        'hcra' => 'Home --> Court --> Remand to Detent to Await Alt --> Admit to Alt',
                        'dca' => 'Detention --> Court --> Admitted to Alternative',
                        'hca' => 'Home --> Court --> Admitted to Alternative',
                        'Other' => 'Other',
                    ),array(
                        'prompt' => ''
                    )
                );
                ?>
                <?php echo $form->error($model,'youth_location_leading_to_admission'); ?>
            </div>
        </div>
        <div data-row-span="4">
            <div data-field-span="2">
                <?php echo $form->labelEx($model,'release_to'); ?>
                <?php
                echo $form->dropDownList($model,'release_to',
                    array(
                        'ROR Pre-Disposition' => 'ROR Pre-Disposition',
                        'Detention Alternative' => 'Detention Alternative',
                        'To Serve Disposition/To Dispositional Placement' => 'To Serve Disposition/To Dispositional Placement',
                        'Parents/Other Adult Pre-Disposition' => 'Parents/Other Adult Pre-Disposition',
                        'Transferred to Jail/Other Detention Facility' => 'Transferred to Jail/Other Detention Facility',
                        'Charges Diverted - Released Home' => 'Charges Diverted - Released Home',
                        'Charges Dismissed - Released Home' => 'Charges Dismissed - Released Home',
                        'Unknown/Other' => 'Unknown/Other'
                    ),array(
                        'prompt' => ''
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
						'Home' => 'Home',
                        'Residential' => 'Residential',
                        'JDC' => 'JDC',
                        'IDOC' => 'IDOC',
                        'Adult Facility' => 'Adult Facility',
                        'Unknown/Other' => 'Unknown/Other',
                    ),array(
                        'prompt' => ''
                    )
                );
                ?>
                <?php echo $form->error($model,'specify_where'); ?>
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
        <legend>Detention Admission</legend>
        <br/>
        <fieldset>
            <legend>Admission</legend>
            <div data-row-span="3">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'admission_date'); ?>
                    <?php
                    $this->widget('CMaskedTextField', array(
                        'model' => $model,
                        'attribute' => 'admission_date',
                        'mask' => '99/99/9999',
                        'placeholder' => '_',
                        'htmlOptions' => array(
                            'placeholder' => 'Write Date'
                        )
                    ));
                    ?>
                    <?php echo $form->error($model,'admission_date'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'time_referred'); ?>
                    <?php
                    $this->widget('CMaskedTextField', array(
                        'model' => $model,
                        'attribute' => 'time_referred',
                        'mask' => '99:99',
                        'placeholder' => '_',
                        'htmlOptions' => array(
                            'placeholder' => '00:00',
                            'style' => 'width:50px;'
                        )
                    ));
                    ?>
                    <?php
                    echo $form->dropDownList($model,'time_referred_am_pm',
                        array(
                            'am'=>'am',
                            'pm'=>'pm',
                        ),array(
                            'style' => 'width:60px;'
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'time_referred'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'referring_agency'); ?>
                    <?php
                    echo $form->dropDownList($model,'referring_agency',
                        array(
                            'Domestic'=>'Domestic',
                            'School'=>'School',
                            'Law Enforcement' => 'Law Enforcement',
							'Out of Home Placement' => 'Out of Home Placement',
                            'Unknown/Other'=>'Unknown/Other',
                        ),array(
                            'prompt' => ''
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'referring_agency'); ?>
                </div>
            </div>
            <div data-row-span="3">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'process_admitted_to_detention'); ?>
                    <?php
                    echo $form->dropDownList($model,'process_admitted_to_detention',
                        array(
                            'New Arrest/Intake Referral'=>'New Arrest/Intake Referral',
                            'Direct Execution of Warrant'=>'Direct Execution of Warrant',
                            'Remand at Court Hearing'=>'Remand at Court Hearing',
                            'Jurisdiction Transfer'=>'Jurisdiction Transfer',
                            'Violation of Probation'=>'Violation of Probation',
                            'Violation of Release'=>'Violation of Release',
                            'Other'=>'Other',
                        ),array(
                            'prompt' => ''
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'process_admitted_to_detention'); ?>
                </div>
                <div data-field-span="2">
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
                            'prompt' => ''
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'caregiver_availability'); ?>
                </div>
            </div>
        </fieldset>
        <br/>
        <fieldset>
            <legend>Release</legend>
            <div data-row-span="3">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'release_to'); ?>
                    <?php
                    echo $form->dropDownList($model,'release_to',
                        array(
                            'Parents/Other Adult' => 'Parents/Other Adult',
                            'Detention Alternative'=>'Detention Alternative',
                            'Transfer to Other Detention Facility'=>'Transfer to Other Detention Facility',
                            'Transfer to Jail'=>'Transfer to Jail',
							'Residential Placement'=>'Residential Placement',
                            'Shelter Care'=>'Shelter Care',
							'IDOC' => 'IDOC',
                            'Unknown/Other' => 'Unknown/Other'
                        ),array(
                            'prompt' => ''
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
							'Home' => 'Home',
                            'Shelter Care' => 'Shelter Care',
                            'JDC' => 'JDC',
                            'Residential' => 'Residential',
                            'IDOC' => 'IDOC',
                            'Adult Jail' => 'Adult Jail',
                            'Unknown/Other' => 'Unknown/Other',
                        ),array(
                            'prompt' => ''
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'specify_where'); ?>
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
        <div data-field-span="1">
            <?php echo $form->labelEx($model,'type_delinquent_act'); ?>
            <?php
            echo $form->dropDownList($model,'type_delinquent_act',
                array(
                    'New Delinquency Charge Only' => 'New Delinquency Charge Only',
                    'New Delinquency Charge and VOP' => 'New Delinquency Charge and VOP',
                    'New Delinquency Charge and VOR' => 'New Delinquency Charge and VOR',
                    'Technical Violation of Probation' => 'Technical Violation of Probation',
                    'Violation of Probation' => 'Violation of Probation',
                    'Violation of Release' => 'Violation of Release',
                    'Unknown/Other' => 'Unknown/Other'
                ),array(
                    'prompt' => ''
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
                    'Felony D' => 'Felony D',
                    'Misdemeanor A' => 'Misdemeanor A',
                    'Misdemeanor B' => 'Misdemeanor B',
                    'Misdemeanor C' => 'Misdemeanor C',
                    'Misdemeanor D' => 'Misdemeanor D',
                    'Status' => 'Status',
                    'Unknown/Other' => 'Unknown/Other'
                ),
                array(
                    'prompt' => '',
                )
            );
            ?>
            <?php echo $form->error($model,'severe_arrest_offense'); ?>
        </div>
        <div data-field-span="1">
            <?php echo $form->labelEx($model,'offense_type'); ?>
            <?php
            echo $form->dropDownList($model,'offense_type',
                array(
                    'Person' => 'Person',
                    'Property' => 'Property',
                    'Drug' => 'Drug',
                    'Other' => 'Other'
                ),
                array(
                    'prompt' => ''
                )
            );
            ?>
            <?php echo $form->error($model,'offense_type'); ?>
        </div>
    </div>
    <div data-row-span="4">
        <div data-field-span="1">
            <?php echo $form->labelEx($model,'charge_filed'); ?>
            <label class="checkbox"><?php echo $form->checkBox($model,'charge_filed'); ?> Check</label>
            <?php echo $form->error($model,'charge_filed'); ?>
        </div>
        <div data-field-span="1">
            <?php echo $form->labelEx($model,'severe_arrest_offense_sel'); ?>
            <?php
            echo $form->dropDownList($model,'severe_arrest_offense_sel',
                array(
                    'Felony A' => 'Felony A',
                    'Felony B' => 'Felony B',
                    'Felony C' => 'Felony C',
                    'Felony D' => 'Felony D',
                    'Misdemeanor A' => 'Misdemeanor A',
                    'Misdemeanor B' => 'Misdemeanor B',
                    'Misdemeanor C' => 'Misdemeanor C',
                    'Misdemeanor D' => 'Misdemeanor D',
                    'Status' => 'Status',
                    'Unknown/Other' => 'Unknown/Other'
                ),array(
                    'prompt' => '',
                    'disabled' => !$model->charge_filed
                )
            );
            ?>
            <?php echo $form->error($model,'severe_arrest_offense_sel'); ?>
        </div>
        <div data-field-span="1">
            <?php echo $form->labelEx($model,'offense_type_filed'); ?>
            <?php
            echo $form->dropDownList($model,'offense_type_filed',
                array(
                    'Person' => 'Person',
                    'Property' => 'Property',
                    'Drug' => 'Drug',
                    'Other' => 'Other'
                ),
                array(
                    'prompt' => '',
                    'disabled' => !$model->charge_filed
                )
            );
            ?>
            <?php echo $form->error($model,'offense_type_filed'); ?>
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
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'arrest_violation_date',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'arrest_violation_date'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'adjudication_date'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'adjudication_date',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'adjudication_date'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'preliminary_inquiry_date'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'preliminary_inquiry_date',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'preliminary_inquiry_date'); ?>
            </div>
        </div>

        <div data-row-span="2">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'adjudication_status'); ?>
                <?php
                echo $form->dropDownList($model,'adjudication_status',
                    array(
                        'Diverted'=>'Diverted',
                        'Dismissed'=>'Dismissed',
                        'Dismissed; Delinq on Other Charges'=>'Dismissed; Delinq on Other Charges',
                        'Delinquent'=>'Delinquent',
                        'Waiver Granted'=>'Waiver Granted',
                        'Direct File'=>'Direct File',
                    ),array(
                        'prompt' => ''
                    )
                );
                ?>
                <?php echo $form->error($model,'adjudication_status'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'disposition_date'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'disposition_date',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'disposition_date'); ?>
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
            <div data-row-span="4">

                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_prior_deliquency_arrests'); ?>
                    <?php echo $form->numberField($model,'number_prior_deliquency_arrests',array('class' => 'field-number', 'min' => 0)); ?>
                    <?php echo $form->error($model,'number_prior_deliquency_arrests'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_prior_deliquency_causes_filed'); ?>
                    <?php echo $form->numberField($model,'number_prior_deliquency_causes_filed',array('class' => 'field-number', 'min' => 0)); ?>
                    <?php echo $form->error($model,'number_prior_deliquency_causes_filed'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_prior_technical_violations_filed'); ?>
                    <?php echo $form->numberField($model,'number_prior_technical_violations_filed',array('class' => 'field-number', 'min' => 0)); ?>
                    <?php echo $form->error($model,'number_prior_technical_violations_filed'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_prior_deliquency_cases_adjudicated'); ?>
                    <?php echo $form->numberField($model,'number_prior_deliquency_cases_adjudicated',array('class' => 'field-number', 'min' => 0)); ?>
                    <?php echo $form->error($model,'number_prior_deliquency_cases_adjudicated'); ?>
                </div>
            </div>
            <div data-row-span="4">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_prior_adjudications_ab_felony'); ?>
                    <?php echo $form->numberField($model,'number_prior_adjudications_ab_felony',array('class' => 'field-number', 'min' => 0)); ?>
                    <?php echo $form->error($model,'number_prior_adjudications_ab_felony'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_of_prior_stays_on_probation'); ?>
                    <?php echo $form->numberField($model,'number_of_prior_stays_on_probation',array('class' => 'field-number', 'min' => 0)); ?>
                    <?php echo $form->error($model,'number_of_prior_stays_on_probation'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'most_severe_prior_adjudication'); ?>
                    <?php
                    echo $form->dropDownList($model,'most_severe_prior_adjudication',
                        array(
                            'None' => 'None',
                            'Felony A' => 'Felony A',
                            'Felony B' => 'Felony B',
                            'Felony C' => 'Felony C',
							'Felony D' => 'Felony D',
                            'Misdemeanor A' => 'Misdemeanor A',
                            'Misdemeanor B' => 'Misdemeanor B',
                            'Misdemeanor C' => 'Misdemeanor C',
                            'Misdemeanor D' => 'Misdemeanor D',
                            'Status' => 'Status',
                            'Unknown/Other' => 'Unknown/Other'
                        ),
                        array(
                            'prompt' => ''
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'most_severe_prior_adjudication'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'prior_adjudication_type'); ?>
                    <?php
                    echo $form->dropDownList($model,'prior_adjudication_type',
                        array(
                            'Person' => 'Person',
                            'Property' => 'Property',
                            'Drug' => 'Drug',
                            'Other' => 'Other'
                        ),
                        array(
                            'prompt' => ''
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'prior_adjudication_type'); ?>
                </div>
            </div>
            <div data-row-span="4">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_warants_issued_fta'); ?>
                    <?php echo $form->numberField($model,'number_warants_issued_fta',array('class' => 'field-number', 'min' => 0)); ?>
                    <?php echo $form->error($model,'number_warants_issued_fta'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_open_petitions_pending_on_day'); ?>
                    <?php echo $form->numberField($model,'number_open_petitions_pending_on_day',array('class' => 'field-number', 'min' => 0)); ?>
                    <?php echo $form->error($model,'number_open_petitions_pending_on_day'); ?>
                </div>
            </div>
        </fieldset>
        <br/>
        <fieldset>
            <legend>Placement History</legend>
            <div data-row-span="3">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_prior_secure_detentions'); ?>
                    <?php echo $form->numberField($model,'number_prior_secure_detentions',array('class' => 'field-number', 'min' => 0)); ?>
                    <?php echo $form->error($model,'number_prior_secure_detentions'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_times_admitted_detention_alternative'); ?>
                    <?php echo $form->numberField($model,'number_times_admitted_detention_alternative',array('class' => 'field-number', 'min' => 0)); ?>
                    <?php echo $form->error($model,'number_times_admitted_detention_alternative'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'number_failed_from_detention_alternative'); ?>
                    <?php echo $form->numberField($model,'number_failed_from_detention_alternative',array('class' => 'field-number', 'min' => 0)); ?>
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
                            'None' => 'None',
                            'Cut/Removed Electronic Monitoring Equipment'=>'Cut/Removed Electronic Monitoring Equipment',
                            'Home/Foster Care'=>'Home/Foster Care',
                            'Shelter Care'=>'Shelter Care',
                            'Absconded from Probation/Parole Supervision'=>'Absconded from Probation/Parole Supervision',
                            'Residential Dispositional Placement'=>'Residential Dispositional Placement',
                            'Juvenile Detention/DOC Facility' => 'Juvenile Detention/DOC Facility',
                            'Unknown/Other'=>'Unknown/Other',
                        ),array(
                            'prompt' => ''
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
            </div>
        </fieldset>
        <br/>
        <fieldset>
            <legend>Mental Health History</legend>
            <div data-row-span="4">
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'cbbt'); ?>
                    <?php
                    echo $form->dropDownList($model,'cbbt',
                        array(
                            'None'=>'None',
                            'Yes'=>'Yes',
                            'Unknown/Other'=>'Unknown/Other',
                        ),array(
                            'prompt' => ''
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
							'Yes-Both'=>'Yes-Both',
                            'Unknown/Other'=>'Unknown/Other',
                        ),array(
                            'prompt' => ''
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
							'Yes-Both'=>'Yes-Both',
                            'Unknown/Other'=>'Unknown/Other',
                        ),array(
                            'prompt' => ''
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'treatment_service_history'); ?>
                </div>
                <div data-field-span="1">
                    <?php echo $form->labelEx($model,'dsm_diagnosis'); ?>
                    <?php
                    echo $form->dropDownList($model,'dsm_diagnosis',
                        array(
                            'Yes'=>'Yes',
                            'No'=>'No',
                            'Unknown'=>'Unknown',
                        ),array(
                            'prompt' => ''
                        )
                    );
                    ?>
                    <?php echo $form->error($model,'dsm_diagnosis'); ?>
                </div>
            </div>
        </fieldset>
</fieldset>
<br/>
<br/>
<fieldset name="referrals">
    <legend>Referrals (Current Case)</legend>
    <br/>
    <fieldset>
        <legend>Evaluation</legend>
        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_evaluation_ad'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'refferal_evaluation_ad'); ?> Alcohol and Drug Evaluation</label>
                <?php echo $form->error($model,'refferal_evaluation_ad'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_evaluation_ad_date_ordered'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'refferal_evaluation_ad_date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_evaluation_ad_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_evaluation_ad_date_completed'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'refferal_evaluation_ad_date_completed',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
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
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'refferal_psychological_date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_psychological_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_psychological_date_completed'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'refferal_psychological_date_completed',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
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
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'refferal_psychiatric_date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_psychiatric_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_psychiatric_date_completed'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'refferal_psychiatric_date_completed',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_psychiatric_date_completed'); ?>
            </div>
        </div>
        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_other'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'refferal_other'); ?> Other</label>
                <?php echo $form->textField($model,'refferal_other_label',array(  'placeholder' => 'Write Type of Evaluation')); ?>
                <?php echo $form->error($model,'refferal_other'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_other_date_ordered'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'refferal_other_date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'refferal_other_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'refferal_other_date_completed'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'refferal_other_date_completed',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
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
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_doc_date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_doc_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_doc_date_completed'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_doc_date_completed',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
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
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_jdc_date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_jdc_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_jdc_date_completed'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_jdc_date_completed',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_jdc_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_rtf'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'dispositional_rtf'); ?> Residential Treatment Facility</label>
                <?php echo $form->error($model,'dispositional_rtf'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_rtf_date_ordered'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_rtf_date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_rtf_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_rtf_date_completed'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_rtf_date_completed',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_rtf_date_completed'); ?>
            </div>
        </div>

        <div data-row-span="3">
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_ad_residental'); ?>
                <label class="checkbox"><?php echo $form->checkBox($model,'dispositional_ad_residental'); ?> Alcohol and Drug Residental</label>
                <?php echo $form->error($model,'dispositional_ad_residental'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_ad_residental_date_ordered'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_ad_residental_date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_ad_residental_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_ad_residental_date_completed'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_ad_residental_date_completed',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
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
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_shelter_care_date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_shelter_care_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_shelter_care_date_completed'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_shelter_care_date_completed',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
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
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_drug_court_date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_drug_court_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_drug_court_date_completed'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_drug_court_date_completed',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
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
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_intensive_probation_supervision_date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_intensive_probation_supervision_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_intensive_probation_supervision_date_completed'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_intensive_probation_supervision_date_completed',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
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
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_probation_date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_probation_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_probation_date_completed'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_probation_date_completed',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
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
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_other_date_ordered',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_other_date_ordered'); ?>
            </div>
            <div data-field-span="1">
                <?php echo $form->labelEx($model,'dispositional_other_date_completed'); ?>
                <?php
                $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'dispositional_other_date_completed',
                    'mask' => '99/99/9999',
                    'placeholder' => '_',
                    'htmlOptions' => array(
                        'placeholder' => 'Write Date'
                    )
                ));
                ?>
                <?php echo $form->error($model,'dispositional_other_date_completed'); ?>
            </div>
        </div>

    </fieldset>
</fieldset>
</div><!-- form -->

<?php if(!$model->isNewRecord && isset($model->attributes['created_date']) && isset($model->attributes['updated_date']) && isset($model->attributes['updated_user'])) { ?>
    <?php
    $updated = new DateTime($model->attributes['updated_date']);
    $created = new DateTime($model->attributes['created_date']);
    $user_updated = User::model()->findByPk($model->attributes['updated_user']);
    ?>
    <div class="alert alert-info fade in">
        <p>Last Update <?=$updated->format('m/d/Y h:i a')?> by <?=$user_updated->first_name.' '.$user_updated->last_name?></p>
        <p>Form Created <?=$created->format('m/d/Y h:i a')?></p>
    </div>
<?php } ?>

<?php $this->endWidget(); ?>

<?php
$cs = Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/custom.js');
?>

<script>
    jQuery(function($) {
        var checkdelinq = function(){
             if(/^New\sDelinquency/i.test($('#DetentionAF_type_delinquent_act').val())){
                $('#DetentionAF_offense_type, #DetentionAF_severe_arrest_offense').prop('disabled', false);

            }else{
                $('#DetentionAF_offense_type, #DetentionAF_severe_arrest_offense').val('');
                $('#DetentionAF_offense_type, #DetentionAF_severe_arrest_offense').prop('disabled', true);
            }
             if(/^New\sDelinquency/i.test($('#DetentionSF_type_delinquent_act').val())){
                $('#DetentionSF_offense_type, #DetentionSF_severe_arrest_offense').prop('disabled', false);

            }else{
                $('#DetentionSF_offense_type, #DetentionSF_severe_arrest_offense').val('');
                $('#DetentionSF_offense_type, #DetentionSF_severe_arrest_offense').prop('disabled', true);
            }
        }
        checkdelinq();

        // Enable severe_arrest_offense if selected New Delinquency Charges Only
        $('#DetentionAF_type_delinquent_act').change(checkdelinq);
        $('#DetentionSF_type_delinquent_act').change(checkdelinq);
        // Enable severe_arrest_offense_sel if checked THE CHARGE WAS FILED
        $('#DetentionAF_charge_filed').change(function(){
            if($(this).attr('checked') == 'checked'){
                $('#DetentionAF_severe_arrest_offense_sel').prop('disabled', false);
                $('#DetentionAF_offense_type_filed').prop('disabled', false);
            }else{
                $('#DetentionAF_severe_arrest_offense_sel').val('');
                $('#DetentionAF_severe_arrest_offense_sel').prop('disabled', true);
                $('#DetentionAF_offense_type_filed').val('');
                $('#DetentionAF_offense_type_filed').prop('disabled', true);
            }
        });
        $('#DetentionSF_charge_filed').change(function(){
            if($(this).attr('checked') == 'checked'){
                $('#DetentionSF_severe_arrest_offense_sel').prop('disabled', false);
                $('#DetentionSF_offense_type_filed').prop('disabled', false);
                
            }else{
                $('#DetentionSF_severe_arrest_offense_sel').val('');
                $('#DetentionSF_severe_arrest_offense_sel').prop('disabled', true);
                $('#DetentionSF_offense_type_filed').val('');
                $('#DetentionSF_offense_type_filed').prop('disabled', true);
            }
        });

        //Hide/Show right menu
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

        // In new record - show message
        <?php //if($model->isNewRecord) { ?>
            var formonsubmit = false;
            var hasUnsavedChanges = false;
            $('#detention-form input[type=submit], #detention-form  #yt2').click(function(){
                formonsubmit = true;
            });

            $('#detention-form input, #detention-form select').change(function(){
                hasUnsavedChanges = true;  
            })

            window.onbeforeunload = function() {
                if(!formonsubmit && hasUnsavedChanges) return 'You haven’t saved the state of the record!';
            };
        <?php //} ?>

        //Checkboxes
        <?php if($model->attributes['detention_type'] == 'Alternative') { ?>
            var referrals_dateboxes = '' +
                '#DetentionAF_refferal_evaluation_ad,' +
                '#DetentionAF_refferal_psychological,' +
                '#DetentionAF_refferal_psychiatric,' +
                '#DetentionAF_refferal_pdr,' +
                '#DetentionAF_refferal_other,' +
                '#DetentionAF_dispositional_doc,' +
                '#DetentionAF_dispositional_jdc,' +
                '#DetentionAF_dispositional_rtf,' +
                '#DetentionAF_dispositional_ad_residental,' +
                '#DetentionAF_dispositional_shelter_care,' +
                '#DetentionAF_dispositional_drug_court,' +
                '#DetentionAF_dispositional_intensive_probation_supervision,' +
                '#DetentionAF_dispositional_probation,' +
                '#DetentionAF_dispositional_other';
        <?php } ?>
        <?php if($model->attributes['detention_type'] == 'Secure') { ?>
            var referrals_dateboxes = '' +
                '#DetentionSF_refferal_evaluation_ad,' +
                '#DetentionSF_refferal_psychological,' +
                '#DetentionSF_refferal_psychiatric,' +
                '#DetentionSF_refferal_pdr,' +
                '#DetentionSF_refferal_other,' +
                '#DetentionSF_dispositional_doc,' +
                '#DetentionSF_dispositional_jdc,' +
                '#DetentionSF_dispositional_rtf,' +
                '#DetentionSF_dispositional_ad_residental,' +
                '#DetentionSF_dispositional_shelter_care,' +
                '#DetentionSF_dispositional_drug_court,' +
                '#DetentionSF_dispositional_intensive_probation_supervision,' +
                '#DetentionSF_dispositional_probation,' +
                '#DetentionSF_dispositional_other';
        <?php } ?>
        $(referrals_dateboxes).change(function(){
            if($(this).attr('checked') == 'checked'){
                $(this).parent('label').parent('div[data-field-span]').attr('data-field-span','1');
                $(this).parent('label').parent('div[data-field-span]').parent('div[data-row-span]').find('div[data-field-span]:gt(0)').show();
                $(this).parent('label').parent('div[data-field-span]').parent('div[data-row-span]').find('div[data-field-span]:gt(0) input').attr('disabled', false);
            }else{
                $(this).parent('label').parent('div[data-field-span]').attr('data-field-span','3');
                $(this).parent('label').parent('div[data-field-span]').parent('div[data-row-span]').find('div[data-field-span]:gt(0)').hide();
                $(this).parent('label').parent('div[data-field-span]').parent('div[data-row-span]').find('div[data-field-span]:gt(0) input').attr('disabled', true);
            }
        });
        $(referrals_dateboxes).each(function() {
            if($(this).attr('checked') == 'checked'){
                $(this).parent('label').parent('div[data-field-span]').attr('data-field-span','1');
                $(this).parent('label').parent('div[data-field-span]').parent('div[data-row-span]').find('div[data-field-span]:gt(0)').show();
                $(this).parent('label').parent('div[data-field-span]').parent('div[data-row-span]').find('div[data-field-span]:gt(0) input').attr('disabled', false);
            }else{
                $(this).parent('label').parent('div[data-field-span]').attr('data-field-span','3');
                $(this).parent('label').parent('div[data-field-span]').parent('div[data-row-span]').find('div[data-field-span]:gt(0)').hide();
                $(this).parent('label').parent('div[data-field-span]').parent('div[data-row-span]').find('div[data-field-span]:gt(0) input').attr('disabled', true);
            }
        });

    });
</script>


