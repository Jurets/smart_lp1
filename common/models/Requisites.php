<?php

/**
 * This is the model class for table "requisites".
 *
 * The followings are the available columns in table 'requisites':
 * @property string $id
 * @property string $details
 * @property string $agreement
 * @property string $marketing
 * @property string $pw_supervisor
 * @property string $pw_admin
 * @property string $pw_moderator
 * @property string $purse_activation
 * @property string $purse_club
 * @property string $purse_investor
 * @property string $purse_fdl
 * @property string $email_faq
 */
class Requisites extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'requisites';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'length', 'max'=>50),
			array('pw_supervisor, pw_admin, pw_moderator', 'length', 'max'=>20),
			array('purse_activation, purse_club, purse_investor, purse_fdl', 'length', 'max'=>255),
			array('details, agreement, marketing, email_faq', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, details, agreement, marketing, pw_supervisor, pw_admin, pw_moderator, purse_activation, purse_club, purse_investor, purse_fdl, email_faq', 'safe', 'on'=>'search'),
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
			'details' => 'Details',
			'agreement' => 'Agreement',
			'marketing' => 'Marketing',
			'pw_supervisor' => 'Pw Supervisor',
			'pw_admin' => 'Pw Admin',
			'pw_moderator' => 'Pw Moderator',
			'purse_activation' => 'Purse Activation',
			'purse_club' => 'Purse Club',
			'purse_investor' => 'Purse Investor',
			'purse_fdl' => 'Purse Fdl',
			'email_faq' => 'Email Faq',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('details',$this->details,true);
		$criteria->compare('agreement',$this->agreement,true);
		$criteria->compare('marketing',$this->marketing,true);
		$criteria->compare('pw_supervisor',$this->pw_supervisor,true);
		$criteria->compare('pw_admin',$this->pw_admin,true);
		$criteria->compare('pw_moderator',$this->pw_moderator,true);
		$criteria->compare('purse_activation',$this->purse_activation,true);
		$criteria->compare('purse_club',$this->purse_club,true);
		$criteria->compare('purse_investor',$this->purse_investor,true);
		$criteria->compare('purse_fdl',$this->purse_fdl,true);
		$criteria->compare('email_faq',$this->email_faq,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Requisites the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}