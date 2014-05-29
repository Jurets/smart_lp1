<?php

/**
 * This is the model class for table "gmt".
 *
 * The followings are the available columns in table 'gmt':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Users[] $users
 */
class Gmt extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gmt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gmt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
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
			'users' => array(self::HAS_MANY, 'Users', 'gmt_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public static function getTitles(){
            $models = self::model()->findAll();
            $result = array();
            foreach($models as $m){
                $result[$m->id] = $m->name;
            }
            return $result;
            
        }
		
        public static function getOffsets(){
          $models = self::model()->findAll();
          $result = array();
          $result[0] = '';
          foreach($models as $m){
              $result[$m->id] = $m->code;
          }
          return $result;
          
      }
      
      public static function getOffsetById($id) {
          $model = self::model()->findByPk($id);
          if (isset($model->code)) {
              return $model->code;
            } else {
                return $id;
            }
      }
        
        
       public function getTimeRanged() {
           $offset = DataHelper::get_timezone_offset($this->name, 'UTC');
           $gmtTime = DataHelper::getGMTimestamp(time());
           return date("H:i", $gmtTime - $offset);
       }
       
       public static function getTimezonesList(){
           $arr = Yii::app()->db->createCommand('SELECT `id`, `name` FROM gmt')->queryAll();
           $result = array();
           foreach($arr as $row){
               $result[$row['id']] = $row['name'];
           }
           return $result;
       }
       
        public static function getTimeByUtc($offset) {
			date_default_timezone_set('Europe/Kiev');
            $timezone = $offset . ":00";
            $now = gmdate('Y-m-d H:i:s', time());

            $mask = "/[-+](([0-9]|1[0-3]):([03]0|45)|14:00)/";
            $retVal = '';
            if (preg_match($mask, $timezone)) {
                $timezone = preg_replace('/[^0-9]/', '', $timezone) * 36;
                $timezone_name = timezone_name_from_abbr(null, $timezone, true);
                if($timezone_name === false) 
                    $timezone_name = timezone_name_from_abbr(null, $timezone * 3600, false);

                $UTC = new DateTimeZone("UTC");
                $newTZ = new DateTimeZone($timezone_name);
                $date = new DateTime($now, $UTC);
                $date->setTimezone($newTZ);
                $retVal = $date->format('H:i');
            } else {
                $retVal = false;
            }
            return $retVal;
        }
        
    /**
    * заполнение БД
    * 
    */
    public static function fillTimeZones() 
    {
        $db = Yii::app()->db;
        $db->createCommand()->delete('gmt');

        $timezonesList = timezone_identifiers_list();
        $strSQL = 'INSERT INTO `gmt` VALUES ';
        $count = 1;
        foreach($timezonesList as $timezone){
            $strSQL .= "(null, '{$timezone}', 0), ";                  
        }
        $strSQL = trim($strSQL);
        if($strSQL[strlen($strSQL) - 1] === ','){
            $strSQL[strlen($strSQL) - 1] = ';';
        }
//        $strSQL .= ';';
        $db->createCommand('ALTER TABLE `gmt` AUTO_INCREMENT=1;')->execute();
        $db->createCommand($strSQL)->execute();        
    }
        
}