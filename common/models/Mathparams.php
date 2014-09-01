<?php

/**
 * This is the model class for table "mathparams".
 *
 * The followings are the available columns in table 'mathparams':
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property integer $verid
 *
 * The followings are the available model relations:
 * @property Mpversions $ver
 */
class Mathparams extends CActiveRecord
{
    public static $parameters = array(
        0=>'price of activation', //price_activation  стоимость активации
        1=>'price of start', //price_start стоимость старта
        2=>'accural purse A', //percent_to_A начисление на кошелек A
        3=>'random to one B1', //percent_pot_B1 рандомально одному B1
        4=>'random to one B2', //percent_pot_B2 рандомально одному B2
        5=>'random to one B3', //percent_pot_B3 рандомально одному B3
        6=>'accural purse F', //percent_to_F начисление на кошелек F
    );
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mathparams';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('verid, value', 'required'),
			array('verid', 'numerical', 'integerOnly'=>true),
			//array('name, value', 'length', 'max'=>255),
                        array('name' , 'length', 'max'=>255),
                        array('value', 'type', 'type'=>'float'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, value, verid, parameters', 'safe', 'on'=>'search'),
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
			'ver' => array(self::BELONGS_TO, 'Mpversions', 'verid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('rec','Id'),
			'name' => Yii::t('rec','Name'),
			'value' => Yii::t('rec','Value'),
			'verid' => Yii::t('rec','Version id'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('verid',$this->verid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mathparams the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /* additional setters */
        public static function deleteBindedRecords($id){
            self::model()->deleteAll(' verid = '.$id);
        }
}
