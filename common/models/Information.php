<?php

/**
 * This is the model class for table "cities".
 *
 * The followings are the available columns in table 'cities':
 * @property integer $id
 * @property integer $country_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Countries $country
 * @property Users[] $users
 */
class Information extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'info';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, title, text', 'required'),
            array('name, title', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, lng, name, title, text', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => BaseModule::t('rec','Id'),
            'title' => BaseModule::t('rec', 'Title'),
            'text' => BaseModule::t('rec', 'Text'),
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
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('lng', $this->lng);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Cities the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
    * запись модели в БД в зависимости от выбранного языка
    * 
    */
    public function saveDependLanguage() {
        if($this->lng == Yii::app()->language){ // обновление
            $isSave = $this->save();
        } else { // добавление
            $record = new self;
            $record->attributes = $this->attributes; //занести атрибуты
            $record->unsetAttributes(array('id'));   //обнулить ИД
            $record->lng = Yii::app()->language;     //установить текущий язык
            $isSave = $record->save();
        }
        return $isSave ? true : false;
    }
    
    
    /**
    * выбрать все заголовки статических страниц в массив
    *  - выбираются заголовки на текущем языке
    *  - при нескольких на одном и том же языке берётся первый
    */
    public static function getAllTitles() {
        $result = array();
        $overs = array();
        $rows = Yii::app()->db->createCommand()
            ->select(array('name', 'title', 'lng'))
            ->from('info')
            ->queryAll();
        foreach($rows as $row) {
            if (!isset($result[$row['name']]) /*&& $row['lng'] == Yii::app()->params['default.language']*/) {
                $result[$row['name']] = $row['title'];
                if ($row['lng'] == Yii::app()->language) {
                    $overs[$row['name']] = $row['lng'];
                }
            } else if (($row['lng'] == Yii::app()->language) && !isset($overs[$row['name']])) {
                $result[$row['name']] = $row['title'];
                $overs[$row['name']] = $row['lng'];
            }
        }
        return $result;
    }
}
