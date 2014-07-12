<?php

/**
 * This is the model class for table "pm_transaction_log".
 *
 * The followings are the available columns in table 'pm_transaction_log':
 * @property integer $tr_id
 * @property string $date
 * @property integer $from_user_id
 * @property string $from_purse
 * @property integer $to_user_id
 * @property string $to_purse
 * @property string $notation
 * @property double $amount
 * @property string $currency
 * @property integer $tr_kind_id
 * @property integer $tr_err_code
 */
class PmTransactionLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pm_transaction_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
        
        public function init() {
            parent::init();
            $this->dateInit();
        }


        public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('from_purse, to_purse', 'required'),
			array('from_user_id, to_user_id, tr_kind_id, tr_err_code', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('from_purse, to_purse, notation', 'length', 'max'=>255),
			array('currency', 'length', 'max'=>3),
                        array('date', 'date', 'format'=>'dd.MM.yy'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tr_id, date, from_user_id, from_purse, to_user_id, to_purse, notation, amount, currency, tr_kind_id, tr_err_code', 'safe', 'on'=>'search'),
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
			'tr_id' => 'Tr',
			'date' => 'Date',
			'from_user_id' => 'From User',
			'from_purse' => 'From Purse',
			'to_user_id' => 'To User',
			'to_purse' => 'To Purse',
			'notation' => 'Notation',
			'amount' => 'Amount',
			'currency' => 'Currency',
			'tr_kind_id' => 'Tr Kind',
			'tr_err_code' => 'Tr Err Code',
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

		$criteria->compare('tr_id',$this->tr_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('from_user_id',$this->from_user_id);
		$criteria->compare('from_purse',$this->from_purse,true);
		$criteria->compare('to_user_id',$this->to_user_id);
		$criteria->compare('to_purse',$this->to_purse,true);
		$criteria->compare('notation',$this->notation,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('tr_kind_id',$this->tr_kind_id);
		$criteria->compare('tr_err_code',$this->tr_err_code);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PmTransactionLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /* Служебное */
        /* Преобразование даты к формату для базы данных */
        public function dateConvertToSite($date_from_db, $choise='short'){
            $date = strtotime($date_from_db);
            $date = date('d.m.Y H:i:s', $date);
            list($short, $long) = explode(' ', $date);
            $format = array('short'=>$short, 'long'=>$short.' '.$long);
                return $format[$choise];
        }
        public function dateConvertToDb($date_from_site, $choise='short'){
            $date = strtotime($date_from_site);
            $date = date('Y-m-d H:i:s', $date);
            list($short, $long) = explode(' ', $date);
            $format = array('short'=>$short, 'long'=>$short.' '.$long);
                return $format[$choise];
        }
        public function dateInit(){ // инициализация даты в зависимости от ее наличия/отсутствия в $_POST
            if(!is_null($date = Yii::app()->request->getParam('date'))){
                $this->date = $date;
            }else{
                $this->date = date('d.m.y');
            }
        }
        
}