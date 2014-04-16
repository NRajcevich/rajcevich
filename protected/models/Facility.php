<?php

/**
 * This is the model class for table "jdai_facilities".
 *
 * The followings are the available columns in table 'jdai_facilities':
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $state
 * @property string $this_county$county
 * @property string $capacity
 */
class Facility extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jdai_facilities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, name, state, capacity, street1, city', 'required'),
            array('type, name, state, county, capacity, street1, street2, city, zipcode', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, name, state, county, capacity', 'safe', 'on'=>'search'),
		);
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
			'type' => 'Type',
			'name' => 'Name',
            'street1' => 'Street 1',
            'street2' => 'Street 2',
            'city' => 'City',
            'zipcode' => 'ZIP Code',
			'state' => 'State',
			'county' => 'County',
			'capacity' => 'Bed Capacity',
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

        $this_user = User::model()->findByPk(Yii::app()->user->id);

        if($this_user->attributes['county'] == 'ALL'){
            $this_county = $this->county;
        }else{
            $this_county = $this_user->attributes['county'];
        }

        $criteria=new CDbCriteria;

		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('state',$this->state,true);
        $criteria->compare('county',$this_county,true);
        $criteria->compare('street1',$this->street1,true);
        $criteria->compare('street2',$this->street2,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('capacity',$this->capacity,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Facility the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
