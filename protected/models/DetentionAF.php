<?php

/**
 * This is the model class for table "jdai_detentions".
 *
 * The followings are the available columns in table 'jdai_detentions':
 */
class DetentionAF extends CActiveRecord
{

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jdai_detentions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() 
	{
        $required_arr = array('detention_type, youth_id, court_status, snapshot_date, residence_county','required');

		return array(
            $required_arr,
            array('charge_filed, probation_time_arrest, number_prior_deliquency_arrests, number_prior_deliquency_causes_filed, number_prior_technical_violations_filed, number_prior_deliquency_cases_adjudicated, number_of_prior_stays_on_probation, number_prior_adjudications_ab_felony, number_warants_issued_fta, number_prior_secure_detentions, number_times_admitted_detention_alternative, number_failed_from_detention_alternative, prior_awol_runaway_history, awol_runaway_at_time_detention, prior_dcs_involvement, current_dcs_involvement', 'numerical', 'integerOnly'=>true),
			array('snapshot_date,arrest_violation_date,adjudication_date,preliminary_inquiry_date,disposition_date,program_admit_date,program_status_date,date_referred,date_ordered,refferal_evaluation_ad_date_ordered,refferal_evaluation_ad_date_completed,refferal_psychological_date_ordered,refferal_psychological_date_completed,refferal_psychiatric_date_ordered,refferal_psychiatric_date_completed,refferal_other_date_ordered,refferal_other_date_completed,dispositional_doc_date_ordered,dispositional_doc_date_completed,dispositional_jdc_date_ordered,dispositional_jdc_date_completed,dispositional_rtf_date_ordered,dispositional_rtf_date_completed,dispositional_ad_residental_date_ordered,dispositional_ad_residental_date_completed,dispositional_shelter_care_date_ordered,dispositional_shelter_care_date_completed,dispositional_drug_court_date_ordered,dispositional_drug_court_date_completed,dispositional_intensive_probation_supervision_date_ordered,dispositional_intensive_probation_supervision_date_completed,dispositional_probation_date_ordered,dispositional_probation_date_completed,dispositional_other_date_ordered,dispositional_other_date_completed', 'match', 'pattern'=>'/^(0[1-9]|1[012])\/(0[1-9]|[12][0-9]|3[01])\/([12])\d\d\d$/'),
            array('arrest_violation_date',
                'ext.validators.dateCompare.EDateCompare',
                'dateFormat' => 'm/d/Y',
                'compareAttribute' => 'program_admit_date',
                'operator' => '<=',
                'message' => 'Arrest Violation Date must be before Start Date.'
            ),
            array('adjudication_date',
                'ext.validators.dateCompare.EDateCompare',
                'dateFormat' => 'm/d/Y',
                'compareAttribute' => 'arrest_violation_date',
                'operator' => '>=',
                'message' => 'Adjudication Date must be after Arrest Violation Date.'
            ),
            array('preliminary_inquiry_date',
                'ext.validators.dateCompare.EDateCompare',
                'dateFormat' => 'm/d/Y',
                'compareAttribute' => 'arrest_violation_date',
                'operator' => '>=',
                'message' => 'Preliminary Inquiry Date must be after Arrest Violation Date.'
            ),
            array('disposition_date',
                'ext.validators.dateCompare.EDateCompare',
                'dateFormat' => 'm/d/Y',
                'compareAttribute' => 'adjudication_date',
                'operator' => '>=',
                'message' => 'Disposition date must be after Adjudication Date.'
            ),
            array('dsm_diagnosis, offense_type, created_date, updated_date, updated_user, prior_adjudication_type, detention_type, snapshot_date, youth_id, race, gender, ethnicity, probation_number, dob, severe_arrest_offense_sel, incident, residence, residence_county, release_to, specify_where, type_delinquent_act, preliminary_inquiry_date, adjudication_status, disposition_date, arrest_violation_date, adjudication_date, final_court_ordered_disposition, court_status, number_prior_deliquency_arrests, number_prior_deliquency_causes_filed, number_prior_technical_violations_filed, number_prior_deliquency_cases_adjudicated, number_prior_adjudications_ab_felony, most_severe_prior_adjudication, number_warants_issued_fta, number_open_petitions_pending_on_day, number_prior_secure_detentions, number_times_admitted_detention_alternative, number_failed_from_detention_alternative, number_of_prior_stays_on_probation, serious_awol_runaway_event, caregiver_availability, cbbt, psychotropic_medics_history, treatment_service_history, program, program_status, referral_admission_type, date_referred, date_ordered, remanding_judge, youth_location_leading_to_admission, program_admit_date, program_status_date,refferal_evaluation_ad,refferal_evaluation_ad_date_ordered,refferal_evaluation_ad_date_completed,refferal_psychological,refferal_psychological_date_ordered,refferal_psychological_date_completed,refferal_psychiatric,refferal_psychiatric_date_ordered,refferal_psychiatric_date_completed,refferal_other,refferal_other_label,refferal_other_date_ordered,refferal_other_date_completed,dispositional_doc,dispositional_doc_date_ordered,dispositional_doc_date_completed,dispositional_jdc,dispositional_jdc_date_ordered,dispositional_jdc_date_completed,dispositional_rtf,dispositional_rtf_date_ordered,dispositional_rtf_date_completed,dispositional_ad_residental,dispositional_ad_residental_date_ordered,dispositional_ad_residental_date_completed,dispositional_shelter_care,dispositional_shelter_care_date_ordered,dispositional_shelter_care_date_completed,dispositional_drug_court,dispositional_drug_court_date_ordered,dispositional_drug_court_date_completed,dispositional_intensive_probation_supervision,dispositional_intensive_probation_supervision_date_ordered,dispositional_intensive_probation_supervision_date_completed,dispositional_probation,dispositional_probation_date_ordered,dispositional_probation_date_completed,dispositional_other,dispositional_other_label,dispositional_other_date_ordered,dispositional_other_date_completed, offense_type_filed', 'safe'),
            // The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('detention_type, snapshot_date, youth_id, race, gender', 'safe', 'on'=>'search'),
		);
	}

	public function onBeforeValidate($event){


		if($this->getAttribute('submited')){
            $required_arr = 'dsm_diagnosis, detention_type, snapshot_date, youth_id, race, gender, ethnicity, incident, residence_county, release_to,
             specify_where, type_delinquent_act, preliminary_inquiry_date, adjudication_status, disposition_date, arrest_violation_date, adjudication_date, 
             final_court_ordered_disposition, court_status, number_prior_deliquency_arrests, number_prior_deliquency_causes_filed, 
             number_prior_technical_violations_filed, number_prior_deliquency_cases_adjudicated, number_prior_adjudications_ab_felony, 
             number_of_prior_stays_on_probation, most_severe_prior_adjudication, number_warants_issued_fta, number_open_petitions_pending_on_day, 
             number_prior_secure_detentions, number_times_admitted_detention_alternative, number_failed_from_detention_alternative,
             serious_awol_runaway_event, cbbt, psychotropic_medics_history, treatment_service_history, program, program_status, 
             referral_admission_type, date_referred, date_ordered, remanding_judge, youth_location_leading_to_admission, program_admit_date,
             program_status_date';
			
            $this->getValidatorList()->add(CRequiredValidator::createValidator('required', $this, $required_arr));

		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'detention_type' => 'Detention Type',
			'snapshot_date' => 'Snap Shot Date',
			'youth_id' => 'Youth ID',
			'probation_number' => 'Probation №',
			'dob' => 'DOB',
			'race' => 'Race',
			'gender' => 'Gender',
			'ethnicity' => 'Ethnicity',
			'incident' => 'Incident',
			'residence' => 'Residence',
			'residence_county' => 'County of Residence',
			'release_to' => 'Release To',
			'specify_where' => 'Specify Where',
			'type_delinquent_act' => 'Type of Delinquent Act/Violation at time of Detention Admission',
			'severe_arrest_offense' => 'Most Severe Arrest Offense',
			'charge_filed' => 'The Charge was Filed',
			'severe_arrest_offense_sel' => 'Most Severe Filed Offense',
			'probation_time_arrest' => 'Was on Probation at time of the Arrest',
			'arrest_violation_date' => 'Arrest/Violation Date',
			'adjudication_date' => 'Adjudication Date',
			'preliminary_inquiry_date' => 'Preliminary Inquiry Date',
			'adjudication_status' => 'Adjudication Status',
			'disposition_date' => 'Disposition Date',
			'final_court_ordered_disposition' => 'Final Court Ordered Disposition',
			'court_status' => 'Court Status',
			'offense_type_filed' => 'Most Severe Filed Type',
			'number_prior_deliquency_arrests' => 'Number of Prior Deliquency Referrals/Arrests',
			'number_prior_deliquency_causes_filed' => 'Number of Prior Deliquency Causes Filed',
			'number_prior_technical_violations_filed' => 'Number of Prior Technical Violations Filed',
			'number_prior_deliquency_cases_adjudicated' => 'Number of Prior Deliquency Cases Adjudicated',
			'number_prior_adjudications_ab_felony' => 'Number of Prior Adjudications for A-B Felony',
            'number_of_prior_stays_on_probation' => 'Number of Prior Stays on Probation',
			'most_severe_prior_adjudication' => 'Most Severe Prior Adjudication',
            'prior_adjudication_type' => 'Prior Adjudication Type',
			'number_warants_issued_fta' => 'Number of Prior Times Bench Warrants Issued for FTA (At Time of Detention Decision)',
			'number_open_petitions_pending_on_day' => 'Number of Open Petitions Pending Adjudication on Day of Snapshot',
			'number_prior_secure_detentions' => 'Number of Prior Secure Detentions',
			'number_times_admitted_detention_alternative' => 'Number of Times Admitted to Detention Alternative',
			'number_failed_from_detention_alternative' => 'Number of Times Failed/Removed from Detention Alternative',
			'prior_awol_runaway_history' => 'Prior AWOL/Runaway History',
			'awol_runaway_at_time_detention' => 'AWOL/Runaway at Time of Detention',
			'serious_awol_runaway_event' => 'Most Serious AWOL/Runaway Event',
			'prior_dcs_involvement' => 'Prior DCS Involvement',
			'current_dcs_involvement' => 'Current DCS Involvement',
			'caregiver_availability' => 'Parent/Caregiver Availability at time of Detention Admission',
			'cbbt' => 'Any Community Based Behavorial Treatment (CBBT)',
			'psychotropic_medics_history' => 'Psychotropic Medics History',
			'treatment_service_history' => 'Treatment/Service History',
            'dsm_diagnosis' => 'DSM Diagnosis',
			'program' => 'Program',
			'program_admit_date' => 'Start Date',
			'program_status' => 'Program Status',
			'program_status_date' => 'Program Status Date',
			'referral_admission_type' => 'Referral and Admission Type',
			'date_referred' => 'Date Referred',
			'date_ordered' => 'Date Ordered',
			'remanding_judge' => 'Remanding Judge',
			'youth_location_leading_to_admission' => 'Which Best Describes Youth\'s Locations Leading to Admission',
            'refferal_evaluation_ad' => '',
            'refferal_evaluation_ad_date_ordered' => 'Date Ordered',
            'refferal_evaluation_ad_date_completed' => 'Completed Date',
            'refferal_psychological' => '',
            'refferal_psychological_date_ordered' => 'Date Ordered',
            'refferal_psychological_date_completed' => 'Completed Date',
            'refferal_psychiatric' => '',
            'refferal_psychiatric_date_ordered' => 'Date Ordered',
            'refferal_psychiatric_date_completed' => 'Completed Date',
            'refferal_other' => '',
            'refferal_other_label' => '',
            'refferal_other_date_ordered' => 'Date Ordered',
            'refferal_other_date_completed' => 'Completed Date',
            'dispositional_doc' => '',
            'dispositional_doc_date_ordered' => 'Date Ordered',
            'dispositional_doc_date_completed' => 'Completed Date',
            'dispositional_jdc' => '',
            'dispositional_jdc_date_ordered' => 'Date Ordered',
            'dispositional_jdc_date_completed' => 'Completed Date',
            'dispositional_rtf' => '',
            'dispositional_rtf_date_ordered' => 'Date Ordered',
            'dispositional_rtf_date_completed' => 'Completed Date',
            'dispositional_ad_residental' => '',
            'dispositional_ad_residental_date_ordered' => 'Date Ordered',
            'dispositional_ad_residental_date_completed' => 'Completed Date',
            'dispositional_shelter_care' => '',
            'dispositional_shelter_care_date_ordered' => 'Date Ordered',
            'dispositional_shelter_care_date_completed' => 'Completed Date',
            'dispositional_drug_court' => '',
            'dispositional_drug_court_date_ordered' => 'Date Ordered',
            'dispositional_drug_court_date_completed' => 'Completed Date',
            'dispositional_intensive_probation_supervision' => '',
            'dispositional_intensive_probation_supervision_date_ordered' => 'Date Ordered',
            'dispositional_intensive_probation_supervision_date_completed' => 'Completed Date',
            'dispositional_probation' => '',
            'dispositional_probation_date_ordered' => 'Date Ordered',
            'dispositional_probation_date_completed' => 'Completed Date',
            'dispositional_other' => '',
            'dispositional_other_label' => '',
            'dispositional_other_date_ordered' => 'Date Ordered',
            'dispositional_other_date_completed' => 'Completed Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
        $criteria->compare('dsm_diagnosis',$this->dsm_diagnosis,true);
		$criteria->compare('detention_type',$this->detention_type,true);
		$criteria->compare('snapshot_date',$this->snapshot_date,true);
		$criteria->compare('youth_id',$this->youth_id,true);
		$criteria->compare('probation_number',$this->probation_number,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('race',$this->race,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('ethnicity',$this->ethnicity,true);
		$criteria->compare('incident',$this->incident,true);
		$criteria->compare('residence',$this->residence,true);
		$criteria->compare('residence_county',$this->residence_county,true);
		$criteria->compare('release_to',$this->release_to,true);
		$criteria->compare('specify_where',$this->specify_where,true);
		$criteria->compare('type_delinquent_act',$this->type_delinquent_act,true);
		$criteria->compare('severe_arrest_offense',$this->severe_arrest_offense,true);
		$criteria->compare('charge_filed',$this->charge_filed);
		$criteria->compare('severe_arrest_offense_sel',$this->severe_arrest_offense_sel,true);
		$criteria->compare('probation_time_arrest',$this->probation_time_arrest);
		$criteria->compare('arrest_violation_date',$this->arrest_violation_date,true);
		$criteria->compare('adjudication_date',$this->adjudication_date,true);
		$criteria->compare('preliminary_inquiry_date',$this->preliminary_inquiry_date,true);
		$criteria->compare('adjudication_status',$this->adjudication_status,true);
		$criteria->compare('disposition_date',$this->disposition_date,true);
		$criteria->compare('final_court_ordered_disposition',$this->final_court_ordered_disposition,true);
		$criteria->compare('court_status',$this->court_status,true);
		$criteria->compare('number_prior_deliquency_arrests',$this->number_prior_deliquency_arrests);
		$criteria->compare('number_prior_deliquency_causes_filed',$this->number_prior_deliquency_causes_filed);
		$criteria->compare('number_prior_technical_violations_filed',$this->number_prior_technical_violations_filed);
		$criteria->compare('number_prior_deliquency_cases_adjudicated',$this->number_prior_deliquency_cases_adjudicated);
		$criteria->compare('number_prior_adjudications_ab_felony',$this->number_prior_adjudications_ab_felony);
		$criteria->compare('most_severe_prior_adjudication',$this->most_severe_prior_adjudication,true);
        $criteria->compare('prior_adjudication_type',$this->prior_adjudication_type,true);
		$criteria->compare('number_warants_issued_fta',$this->number_warants_issued_fta);
		$criteria->compare('number_open_petitions_pending_on_day',$this->number_open_petitions_pending_on_day,true);
		$criteria->compare('number_prior_secure_detentions',$this->number_prior_secure_detentions);
		$criteria->compare('number_times_admitted_detention_alternative',$this->number_times_admitted_detention_alternative);
		$criteria->compare('number_failed_from_detention_alternative',$this->number_failed_from_detention_alternative);
		$criteria->compare('prior_awol_runaway_history',$this->prior_awol_runaway_history);
		$criteria->compare('awol_runaway_at_time_detention',$this->awol_runaway_at_time_detention);
		$criteria->compare('serious_awol_runaway_event',$this->serious_awol_runaway_event,true);
		$criteria->compare('prior_dcs_involvement',$this->prior_dcs_involvement);
		$criteria->compare('current_dcs_involvement',$this->current_dcs_involvement);
		$criteria->compare('caregiver_availability',$this->caregiver_availability,true);
		$criteria->compare('cbbt',$this->cbbt,true);
		$criteria->compare('psychotropic_medics_history',$this->psychotropic_medics_history,true);
		$criteria->compare('treatment_service_history',$this->treatment_service_history,true);
		$criteria->compare('program',$this->program,true);
		$criteria->compare('program_admit_date',$this->program_admit_date,true);
		$criteria->compare('program_status',$this->program_status,true);
		$criteria->compare('program_status_date',$this->program_status_date,true);
		$criteria->compare('referral_admission_type',$this->referral_admission_type,true);
		$criteria->compare('date_referred',$this->date_referred,true);
		$criteria->compare('date_ordered',$this->date_ordered,true);
		$criteria->compare('remanding_judge',$this->remanding_judge,true);
		$criteria->compare('youth_location_leading_to_admission',$this->youth_location_leading_to_admission,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Detention the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
