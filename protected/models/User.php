<?php

/**
 * This is the model class for table "jdai_users".
 *
 * The followings are the available columns in table 'jdai_users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $create_at
 * @property string $lastvisit_at
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $access
 * @property string $state
 * @property string $county
 * @property string $block
 */
class User extends CActiveRecord
{
    private $old_password;
    public $new_password;
    public $new_confirm;
	public $state;
    public $county;
    public $block;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jdai_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, first_name, last_name, access, state, county, block', 'required'),
			array('username', 'length', 'max'=>20),
			array('username', 'match', 'pattern'=>'#^[a-zA-Z0-9_\.-]+$#', 'message'=>'Username contains illegal characters!'),
			array('email', 'email', 'message'=>'Incorrect E-mail address format!'),
			array('username, email', 'unique', 'caseSensitive'=>false),
			array('username, email, new_password, new_confirm, first_name, last_name, phone, state, county', 'length', 'max'=>255),
			array('new_password', 'length', 'min'=>6, 'allowEmpty'=>true),
			array('new_confirm', 'compare', 'compareAttribute'=>'new_password', 'message'=>'Passwords do not match!'),
			
			array('username', 'unsafe', 'on'=>'update'),
			array('username, email, first_name, last_name, phone, access, state, county, block', 'safe', 'on'=>'search'),
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
			//'state_name' => array(self::HAS_MANY,'State', 'state')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'password' => 'Password',
			'email' => 'Email',
			'create_at' => 'Create At',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'phone' => 'Phone',
			'access' => 'Access',
			'state' => 'State',
			'county' => 'County',
			'block' => 'Active Status',
            'new_password' => 'New Password',
            'new_confirm' => 'Confirm new password',
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

        $this_user = User::model()->findByPk(Yii::app()->user->id);

        if($this_user->attributes['county'] == 'ALL'){
            $this_county = $this->county;
        }else{
            $this_county = $this_user->attributes['county'];
        }


		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('access',$this->access,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('county',$this_county,true);
		$criteria->compare('block',$this->block,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 15,
			),
			'sort' => array(
				'defaultOrder' => array(
					'last_name' => 'DESC'
				)
			)
		));
	}

	protected function afterFind(){
		$this->old_password = $this->password;
		parent::afterFind();
	}
	
    public function beforeSave(){
		if(parent::beforeSave()){
			if($this->new_password){
				$this->password = md5($this->new_password);
                //unset($this->new_password);
                //unset($this->old_password);
                //unset($this->new_confirm);
			}
			return true;
		}
		return false;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
