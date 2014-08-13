<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $activkey
 * @property integer $superuser
 * @property integer $roles
 * @property integer $status
 * @property string $create_at
 * @property string $lastvisit_at
 * @property string $logincode
 * @property string $tariff_id
 * @property integer $refer_id
 * @property integer $inviter_id
 * @property integer $invite_num
 * @property string $busy_date
 * @property string $club_date
 * @property double $balance
 * @property string $first_name
 * @property string $last_name
 * @property string $dob
 * @property integer $city_id
 * @property integer $gmt_id
 * @property string $phone
 * @property string $skype
 * @property string $photo
 * @property string $purse
 * @property integer $income
 * @property integer $transfer_fund
 * @property integer $active
 * @property string $activated
 * @property string $sys_lang
 * @property integer $country_access
 * @property integer $city_access
 * @property integer $skype_access
 * @property integer $email_access
 * @property string $new_email
 */
class SystemUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_at, active', 'required'),
			array('superuser, roles, status, refer_id, inviter_id, invite_num, city_id, gmt_id, income, transfer_fund, active, country_access, city_access, skype_access, email_access', 'numerical', 'integerOnly'=>true),
			array('balance', 'numerical'),
			array('username, phone', 'length', 'max'=>20),
			array('password, email, activkey, logincode', 'length', 'max'=>128),
			array('tariff_id', 'length', 'max'=>11),
			array('first_name, last_name, skype, photo, purse', 'length', 'max'=>255),
			array('sys_lang', 'length', 'max'=>2),
			array('new_email', 'length', 'max'=>150),
			array('lastvisit_at, busy_date, club_date, dob, activated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, email, activkey, superuser, roles, status, create_at, lastvisit_at, logincode, tariff_id, refer_id, inviter_id, invite_num, busy_date, club_date, balance, first_name, last_name, dob, city_id, gmt_id, phone, skype, photo, purse, income, transfer_fund, active, activated, sys_lang, country_access, city_access, skype_access, email_access, new_email', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'activkey' => 'Activkey',
			'superuser' => 'Superuser',
			'roles' => 'Roles',
			'status' => 'Status',
			'create_at' => 'Create At',
			'lastvisit_at' => 'Lastvisit At',
			'logincode' => 'Logincode',
			'tariff_id' => 'Tariff',
			'refer_id' => 'Refer',
			'inviter_id' => 'Inviter',
			'invite_num' => 'Invite Num',
			'busy_date' => 'Busy Date',
			'club_date' => 'Club Date',
			'balance' => 'Balance',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'dob' => 'Dob',
			'city_id' => 'City',
			'gmt_id' => 'Gmt',
			'phone' => 'Phone',
			'skype' => 'Skype',
			'photo' => 'Photo',
			'purse' => 'Purse',
			'income' => 'Income',
			'transfer_fund' => 'Transfer Fund',
			'active' => 'Active',
			'activated' => 'Activated',
			'sys_lang' => 'Sys Lang',
			'country_access' => 'Country Access',
			'city_access' => 'City Access',
			'skype_access' => 'Skype Access',
			'email_access' => 'Email Access',
			'new_email' => 'New Email',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('activkey',$this->activkey,true);
		$criteria->compare('superuser',$this->superuser);
		$criteria->compare('roles',$this->roles);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('lastvisit_at',$this->lastvisit_at,true);
		$criteria->compare('logincode',$this->logincode,true);
		$criteria->compare('tariff_id',$this->tariff_id,true);
		$criteria->compare('refer_id',$this->refer_id);
		$criteria->compare('inviter_id',$this->inviter_id);
		$criteria->compare('invite_num',$this->invite_num);
		$criteria->compare('busy_date',$this->busy_date,true);
		$criteria->compare('club_date',$this->club_date,true);
		$criteria->compare('balance',$this->balance);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('gmt_id',$this->gmt_id);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('purse',$this->purse,true);
		$criteria->compare('income',$this->income);
		$criteria->compare('transfer_fund',$this->transfer_fund);
		$criteria->compare('active',$this->active);
		$criteria->compare('activated',$this->activated,true);
		$criteria->compare('sys_lang',$this->sys_lang,true);
		$criteria->compare('country_access',$this->country_access);
		$criteria->compare('city_access',$this->city_access);
		$criteria->compare('skype_access',$this->skype_access);
		$criteria->compare('email_access',$this->email_access);
		$criteria->compare('new_email',$this->new_email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SystemUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
