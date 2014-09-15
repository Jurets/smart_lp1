<?php

/**
 * This is the model class for table "training".
 *
 * The followings are the available columns in table 'training':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $videolink
 * @property string $date
 * @property integer $number
 */
class Training extends CActiveRecord
{
    public $UploadImage;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'training';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('date', 'default', 'value' => date('Y-m-d H:i:s')),
            array('title, description, image, videolink', 'required'),
            array('number', 'numerical', 'integerOnly' => true),
            array('title, image, videolink', 'length', 'max' => 255),
            array('lng', 'length', 'max'=>2),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, description, image, UploadImage, videolink, date, number', 'safe', 'on' => 'search'),
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
            'id' => BaseModule::t('rec', 'Id'),
            'lng'=>BaseModule::t('rec', 'LANGUAGE'),
            'title' => BaseModule::t('rec', 'Title'),
            'description' => BaseModule::t('rec', 'Description'),
            'image' => BaseModule::t('rec', 'Image'),
            'videolink' => BaseModule::t('rec', 'Video Link'),
            'date' => BaseModule::t('rec', 'Date'),
            'number' => BaseModule::t('rec', 'Number'),
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
        $criteria->compare('lng', $this->lng);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('videolink', $this->videolink, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('number', $this->number);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Training the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function saveDependLanguage() {
        if($this->lng == Yii::app()->language){ // обновление
            $a = $this->save();
        }else{ // добавление
            $record = new Training();
            $record->attributes = $this->attributes;
            $record->lng = Yii::app()->language;
            $a = $record->save();
        }
        if(!$a)
            return false;
        else
            return true;
    }
    
}
