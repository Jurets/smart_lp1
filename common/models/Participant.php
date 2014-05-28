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
    //масив для бизнес-тарифов 
    // * термин "тарифы" (вместо "статусы" как в ТЗ) здесь и далее применяется для того, чтобы отличить их от статуса активности/неактивности
    private $_businessclubIDs = array(3,4,5,6);
    
    public $country_id;
    //ниже идут загрушки для отображения колонок, смысл которых пока неясен ))
    public $structure = null;
    public $business = null;
    public $checks = null;
    public $fdl = null;
    public $time = null;
    
    private $dict_participant = 'participant';
    
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		 //NOTE: you should only define rules for those attributes that
		 //will receive user inputs.
		 return CMap::mergeArray(parent::rules(), array(
			 array('tariff_id, city_id, first_name, last_name, country_id, city_id', 'safe'),
             array('id', 'safe', 'on'=>array('search', 'seestructure')),
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
            //ссылка на объект-рефер для сабжа
            'referal'=>array(self::BELONGS_TO, 'Participant', 'refer_id'),
            //кол-во подчинённых (т.е. тех, у которых сабж является рефером)
            'subCount'=>array(self::STAT, 'Participant', 'refer_id'),   
            //тариф (статус по ТЗ)
            'tariff'=>array(self::BELONGS_TO, 'Tariff', 'tariff_id'),
            //город
            'city'=>array(self::BELONGS_TO, 'Cities', 'city_id'),
            //текущий бан в чате (его может и не быть!)
            'chatban'=>array(self::HAS_ONE, 'Chatban', 'user_id', 'condition'=>'active = 1'/*, 'limit'=>1*/),
            //массив истории забанивания в чате
            'chatbanhistory'=>array(self::HAS_MANY, 'Chatban', 'user_id'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return CMap::mergeArray(parent::attributeLabels(), array(
            'create_at' => UserModule::t("Created", array(), $this->dict_participant),
            'username' => UserModule::t("Domain", array(), $this->dict_participant),
            'first_name' => UserModule::t("Firstname", array(), $this->dict_participant),
            'last_name' => UserModule::t("Lastname", array(), $this->dict_participant),
            'city_id' => UserModule::t("City", array(), $this->dict_participant),
            'country_id' => UserModule::t("Country", array(), $this->dict_participant),
            'structure' => UserModule::t("Structure", array(), $this->dict_participant),
            'business' => UserModule::t("Business Club", array(), $this->dict_participant),
            'refer_id' => UserModule::t("Referal", array(), $this->dict_participant),
            'tariff_id' => UserModule::t("Tariff", array(), $this->dict_participant),
            'phone' => UserModule::t("Phone", array(), $this->dict_participant),
            'skype' => UserModule::t("Skype", array(), $this->dict_participant),
            'dob' => UserModule::t("Birthday", array(), $this->dict_participant),
		));
	}

    /**
    * геттер для массива бизнес-тарифов
    * 
    */
    public function getBusinessclubIDs() {
        return $this->_businessclubIDs;
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
            
		$criteria = new CDbCriteria;
        $criteria->with = array('city', 'city.country');  //добавить страну и город (для поиска)
        $criteria->addCondition('superuser <> 1'); //исключаем суперпользователя
        
        if ($this->scenario == 'empty') {                      //пустой
            //нужно получить заведомо пустой набор данных
            $criteria->condition = '1=2';   //костыль!!!!
            //$dataProvider = New CArrayDataProvider(array()); //тоже костыль!!!
        } else if ($this->scenario == 'bcstructure') {
            $criteria->addInCondition('tariff_id', $this->businessclubIDs);  //структура Бизнес Клуба
        } else if ($this->scenario == 'structure') {        //поиск для структуры
            $criteria->compare('user.phone', $this->phone);
            $criteria->compare('user.skype', $this->skype);
        }
        //добавляем остальные критерии поиска
        $criteria->compare('user.first_name', $this->first_name, true); //поиск по фамилии
        $criteria->compare('user.last_name', $this->last_name, true);   //поиск по имени
        $criteria->compare('user.tariff_id', $this->tariff_id);         //поиск по тарифу
        if (!empty($this->country_id)) {                                
            $criteria->compare('country.name', $this->country_id, true);//поиск по стране
        }
        if (!empty($this->city_id)) {
            $criteria->compare('city.name', $this->city_id, true);      //поиск по городу
        }
        if (isset($this->refer_id)) {
            $criteria->addCondition('refer_id = :refer_id');
            $criteria->params = CMap::mergeArray($criteria->params, array(':refer_id'=>$this->refer_id));
        }
        //мержим критерию с родительской и возвращаем набор данных 
        $dataProvider->criteria->mergeWith($criteria);
        return $dataProvider;
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
    */
    public function getCityName() {
        return isset($this->city) ? $this->city->name : null;
    }
    
    /**
    * Выдаёт название страны
    */
    public function getCountryName() {
        return isset($this->city) && isset($this->city->country) ? $this->city->country->name : null;
    }
    
    /**
    * Выдаёт значение имени реферала
    */
    public function getReferalName() {
        return isset($this->referal) ? $this->referal->username : null;
    }

    /**
    * Выдаёт значение ИД реферала
    */
    public function getReferalId() {
        return isset($this->referal) ? $this->referal->id : null;
    }

    /**
    * цвет для юзера в сетке
    */
    public function getColor() {
        $statuscolor='white';
        //switch ($this->isBanned()) {//здесь указываете ваш аттрибут
        switch ($this->status) {//здесь указываете ваш аттрибут
            case self::STATUS_ACTIVE:
                $statuscolor='green';//нужные вам классы в зависимости от значений
                break;
            case self::STATUS_NOACTIVE:
                $statuscolor='grey';
                break;
            case self::STATUS_BANNED:
                $statuscolor = 'red';
                break;
        }
        return $statuscolor;
    }
 
}
