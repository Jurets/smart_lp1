<?php

/** 
 * This is the model class for table "invitation". 
 * 
 * The followings are the available columns in table 'invitation': 
 * @property integer $id
 * @property string $video_link
 * @property string $file
 * @property string $file_link
 * @property string $created
 */ 
class Invitation extends CActiveRecord
{ 
    /** 
     * @return string the associated database table name 
     */ 
    public function tableName() 
    { 
        return 'invitation'; 
    } 

    /** 
     * @return array validation rules for model attributes. 
     */ 
    public function rules() 
    { 
        // NOTE: you should only define rules for those attributes that 
        // will receive user inputs. 
        return array( 
            array('video_link', 'required'),
            array('video_link, file, file_link', 'length', 'max'=>255),
            //array('file', 'file', 'types'=>'zip', 'maxSize' => 1048576, 'allowEmpty' => true),
            
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('video_link, file, file_link', 'safe'), 
            array('id, created', 'safe', 'on'=>'search'), 
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
            'id' => InvitationModule::t('Id'),
            'video_link' => InvitationModule::t('Video Link'),
            'file' => InvitationModule::t('File'),
            'file_link' => InvitationModule::t('File Link'),
            'created' => InvitationModule::t('Created'),
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
        $criteria->compare('video_link',$this->video_link,true);
        $criteria->compare('file',$this->file,true);
        $criteria->compare('file_link',$this->file_link,true);
        $criteria->compare('created',$this->created,true);

        return new CActiveDataProvider($this, array( 
            'criteria'=>$criteria, 
        )); 
    } 

    /** 
     * Returns the static model of the specified AR class. 
     * Please note that you should have this exact method in all your CActiveRecord descendants! 
     * @param string $className active record class name. 
     * @return Invitation the static model class 
     */ 
    public static function model($className=__CLASS__) 
    { 
        return parent::model($className); 
    } 
} 