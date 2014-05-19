<?php

/**
 * This is the model class for table "chatban".
 *
 * The followings are the available columns in table 'chatban':
 * @property integer $id
 * @property integer $user_id
 * @property string $create_at
 * @property integer $bantype_id
 * @property integer $active
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property BanType $bantype
 * @property Users $user
 */
class Chatban extends CActiveRecord
{
    const STATUS_ACTIVE = 1;
	const STATUS_NONACTIVE = 0;
    
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'chatban';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('create_at', 'default', 'value'=>Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time())),
            array('user_id, create_at, bantype_id, active', 'required'),
			array('user_id, bantype_id, active', 'numerical', 'integerOnly'=>true),
			array('comment', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, create_at, bantype_id, active, comment', 'safe', 'on'=>'search'),
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
			'bantype' => array(self::BELONGS_TO, 'BanType', 'bantype_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ИД',
			'user_id' => 'ИД юзера',
			'create_at' => 'Создан',
			'bantype_id' => 'Тип бана',
			'active' => 'Активность',
			'comment' => 'Причина',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('bantype_id',$this->bantype_id);
		$criteria->compare('active',$this->active);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Chatban the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className); 
	}
    
    /**
    * перед вставкой новой записи
    * 
    */
    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->updateAll(array('active'=>0), 'user_id = :user_id', array(':user_id'=>$this->user_id));
            return true;
        }
    }
}
