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
 */
class Requisites extends CActiveRecord
{

    const INSTANCE_NAME = 'JVMS';

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
            array('id', 'length', 'max' => 50),
            array('pw_supervisor, pw_admin, pw_moderator', 'length', 'max' => 20),
            array('purse_activation, purse_club, purse_investor, purse_fdl', 'length', 'max' => 255),
            array('details, agreement, marketing, bpm_login, bpm_password, purse_activation, purse_club, purse_investor, purse_fdl, email_faq, superrefer_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, details, agreement, marketing, pw_supervisor, pw_admin, pw_moderator, purse_activation, purse_club, purse_investor, purse_fdl, email_faq, superrefer_id', 'safe', 'on' => 'search'),
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
            'details' => BaseModule::t('common', 'Details'),
            'agreement' => BaseModule::t('common', 'Agreement'),
            'marketing' => BaseModule::t('common', 'Marketing'),
            'pw_supervisor' => BaseModule::t('common', 'Pw Supervisor'),
            'pw_admin' => BaseModule::t('common', 'Pw Admin'),
            'pw_moderator' => BaseModule::t('common', 'Pw Moderator'),
            'purse_activation' => BaseModule::t('common', 'Purse Activation'),
            'purse_club' => BaseModule::t('common', 'Purse Club'),
            'bpm_login' => BaseModule::t('common', 'Club Purse Login'),
            'bpm_password' => BaseModule::t('common', 'Club Purse Password'),
            'purse_investor' => BaseModule::t('common', 'Purse Investor'),
            'purse_fdl' => BaseModule::t('common', 'Purse FDL'),
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('details', $this->details, true);
        $criteria->compare('agreement', $this->agreement, true);
        $criteria->compare('marketing', $this->marketing, true);
        $criteria->compare('pw_supervisor', $this->pw_supervisor, true);
        $criteria->compare('pw_admin', $this->pw_admin, true);
        $criteria->compare('pw_moderator', $this->pw_moderator, true);
        $criteria->compare('purse_activation', $this->purse_activation, true);
        $criteria->compare('purse_club', $this->purse_club, true);
        $criteria->compare('purse_investor', $this->purse_investor, true);
        $criteria->compare('purse_fdl', $this->purse_fdl, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Requisites the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * получить строку с реквизитами системы
     * 
     */
    public static function getInstance()
    {
        return self::model()->findByPk(self::INSTANCE_NAME);
    }

    /**
     *  получить кошелёк активаций
     */
    public static function purseActivation()
    {
        if ($instance = self::getInstance())
            return $instance->purse_activation;
        else
            return false;
    }

    /**
     *  получить кошелёк бизнес-клуба
     */
    public static function purseClub()
    {
        if ($instance = self::getInstance())
            return $instance->purse_club;
        else
            return false;
    }

    /**
     *  пополнить кошелёк активаций
     */
    public static function depositActivation($amount = 0)
    {
        Yii::app()->db
                ->createCommand("UPDATE requisites SET balance_activation = balance_activation + :amount WHERE id = :instance")
                ->bindValues(array(':instance' => self::INSTANCE_NAME, ':amount' => $amount))
                ->execute();
    }

    /**
     *  пополнить кошелёк клуба
     */
    public static function depositClub($amount = 0)
    {
        Yii::app()->db
                ->createCommand("UPDATE requisites SET balance_club = balance_club + :amount WHERE id = :instance")
                ->bindValues(array(':instance' => self::INSTANCE_NAME, ':amount' => $amount))
                ->execute();
    }

    /**
     *  получить кошелёк бизнес-клуба
     */
    public static function superReferId()
    {
        if ($instance = self::getInstance())
            return $instance->superrefer_id;
        else
            return false;
    }

}
