<?php

/**
 * This is the model class for table "countries".
 *
 * The followings are the available columns in table 'countries':
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $code_num
 * @property integer $phone_code
 * @property integer $gmt_id
 *
 * The followings are the available model relations:
 * @property Cities[] $cities
 */
class Countries extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'countries';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, code, code_num, phone_code, gmt_id', 'required'),
            array('code_num, phone_code, gmt_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('code', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, code, code_num, phone_code, gmt_id', 'safe', 'on' => 'search'),
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
            'cities' => array(self::HAS_MANY, 'Cities', 'country_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => BaseModule::t('rec','Id'),
            'name' => BaseModule::t('rec', 'Name'),
            'code' => BaseModule::t('rec', 'Code'),
            'code_num' => BaseModule::t('rec', 'Code Num'),
            'phone_code' => BaseModule::t('rec', 'Phone Code'),
            'gmt_id' => BaseModule::t('rec', 'Gmt'),
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('code_num', $this->code_num);
        $criteria->compare('phone_code', $this->phone_code);
        $criteria->compare('gmt_id', $this->gmt_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Countries the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     *  список всех стран
     * 
     */
    public static function getListAll()
    {
        return self::model()->findAll(array('order' => 'name ASC'));
    }

    /**
     *  список всех стран
     * 
     */
    public static function getCountriesList()
    {
        //return CHtml::listData(self::model()->findAll(array('order' => 'name ASC')), 'id', 'name');
        $rows = Yii::app()->db->createCommand()
            ->select(array('id', 'name', 'phone_code'))
            ->from('countries')
            ->order('name ASC')
            ->queryAll();
        
        return $rows;

        
    }

}
