<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property integer $author
 * @property string $created
 * @property string $activated
 * @property string $title
 * @property string $announcement
 * @property string $content
 * @property string $image
 * @property integer $activity
 */
class Participant extends User
{
    
    public $country_id;
    //ниже идут загрушки для отображения колонок, смысл которых пока неясен ))
    public $structure = null;
    public $business = null;
    public $checks = null;
    public $fdl = null;
    public $time = null;
    
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		 //NOTE: you should only define rules for those attributes that
		 //will receive user inputs.
		 return CMap::mergeArray(parent::rules(), array(
			 array('tariff_id, city_id, first_name, last_name', 'safe'),
			 //The following rule is used by search().
			 //@todo Please remove those attributes that should not be searched.
   		     //array('id, author, created, activated, title, announcement, content, image, activity', 'safe', 'on'=>'search'),
		));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return CMap::mergeArray(parent::relations(), array(
            'tariff'=>array(self::BELONGS_TO, 'Tariff', 'tariff_id'),
            'city'=>array(self::BELONGS_TO, 'Cities', 'city_id'),
            'referal'=>array(self::BELONGS_TO, 'Participant', 'refer_id'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return CMap::mergeArray(parent::attributeLabels(), array(
			'create_at' => UserModule::t("Created"),
		));
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
        $dataProvider = parent::search();
        if (!isset($dataProvider)) 
            $dataProvider = New CActiveDataProvider($this);
            
		$criteria=new CDbCriteria;
        
        $criteria->compare('user.first_name',$this->first_name);
        $criteria->compare('user.last_name',$this->last_name);
		$criteria->compare('user.tariff_id',$this->tariff_id);

        $dataProvider->criteria->mergeWith($criteria);
        return $dataProvider;
                
		/*return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));*/
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    /**
    * Выдаёт значение Тарифа
    * 
    */
    public function getTariffShortValue() {
        return isset($this->tariff) ? $this->tariff->shortname : null;
    }
    
    /**
    * Выдаёт название города
    * 
    */
    public function getCityName() {
        return isset($this->city) ? $this->city->name : null;
    }
    
    /**
    * Выдаёт название страны
    * 
    */
    public function getCountryName() {
        return isset($this->city) && isset($this->city->country) ? $this->city->country->name : null;
    }
    
    /**
    * Выдаёт значение реферала
    * 
    */
    public function getReferalName() {
        return isset($this->referal) ? $this->referal->username : null;
    }
}
