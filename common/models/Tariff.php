<?php

/**
 * This is the model class for table "tariff".
 *
 * The followings are the available columns in table 'tariff':
 * @property string $id
 * @property string $name
 * @property string $shortname
 * @property int $tr_kind
 *
 * The followings are the available model relations:
 * @property Users[] $users
 */
class Tariff extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tariff';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, name, shortname', 'required'),
			array('id', 'length', 'max'=>11),
			array('name', 'length', 'max'=>60),
			array('shortname', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, shortname', 'safe', 'on'=>'search'),
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
			//'users' => array(self::HAS_MANY, 'Participant', 'tariff_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => BaseModule::t('dic', 'ID'),
			'name' => BaseModule::t('dic', 'Name'),
			'shortname' => BaseModule::t('dic', 'Shortname'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('shortname',$this->shortname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tariff the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    /**
    * выборка суммы для тарифа
    */
    public static function getTariffAmount($id) {
        if ($tariff = self::model()->findByPk($id)) {
            return marketingPlanHelper::init()->getMpParam($tariff->mathparam); //return $tariff->shortname;
        } else {
            return 0;
        }
    }

    /**
     *  get transaction kind from pm_transaction_kind
     */
    public static function getTransactionKindTariff($id){
        if ($tariff = self::model()->findByPk($id)) {
            return $tariff->tr_kind;
        } else {
            return 0;
        }
    }

}
