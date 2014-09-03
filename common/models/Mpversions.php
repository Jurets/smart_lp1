<?php

/**
 * This is the model class for table "mpversions".
 *
 * The followings are the available columns in table 'mpversions':
 * @property integer $id
 * @property string $description
 * @property string $creationdate
 * @property integer $activity
 *
 * The followings are the available model relations:
 * @property Mathparams[] $mathparams
 */
class Mpversions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mpversions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('creationdate', 'required'),
			array('activity', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description, creationdate, activity', 'safe', 'on'=>'search'),
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
			'mathparams' => array(self::HAS_MANY, 'Mathparams', 'verid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => BaseModule::t('rec','Id'),
			'description' => BaseModule::t('rec','Description'),
			'creationdate' => BaseModule::t('rec','Creationdate'),
			'activity' => BaseModule::t('rec','Activity'),
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('creationdate',$this->creationdate,true);
		$criteria->compare('activity',$this->activity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mpversions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /* Additions static methods */
        public static function activeVersion(){
            return self::model()->findByAttributes(array('activity'=>1));
        }
        public static function currentVersion($id){
            return self::model()->findByPk($id);
        }
       /* Addition functional */
        public function choiseCurrentVersion(){ // Делает активной версию с текущим id (/default/choise/id/***/)
            //Выполнить запрос на uodate с целью сделать activity = 0 всем, кроме этого экземпляра, а этому - 1
            $this->model()->updateAll(array('activity'=>0));
            $this->model()->updateByPk($this->id, array('activity'=>1));
        }
        public function manageParameters($post){ // метод устарел, на его основе сделать новый метод
            if($post == FALSE){ // удаляются все параметры версии
              Mathparams::deleteBindedRecords($this->id);
          }else{ //анализ и принятие решения
              $fromUser = $post;
              $fromDb = $this->mathparams;
              foreach($fromDb as $key => $elem){
                  $search = array_search($elem->id, $fromUser['id']);
                  if($search !== false){
                      // возможно обновление
                      if($elem->name !== $fromUser['name'][$search] || $elem->value !== $fromUser['value'][$search]){
                          $elem->name = $fromUser['name'][$search];
                          $elem->value = $fromUser['value'][$search];
                          if(!$elem->save()){
                               echo '<script> alert("'.$elem->getError('value').'")</script>';die;
                          }
                      }
                  }else{
                      // удаление
                      $elem->delete();
                  }
              }
              // добавление новых параметров
              $newRec = array_keys($fromUser['id'], '');
              if(!empty($newRec)){
                  foreach($newRec as $newElem){
                      $rec = new Mathparams;
                      $rec->setAttribute('name', $fromUser['name'][$newElem]);
                      $rec->setAttribute('value', $fromUser['value'][$newElem]);
                      $rec->setAttribute('verid', $this->id);
                      if(!$rec->save()){
                          $buff = $rec->getError('value');
                          $this->delete();
                          echo '<script> alert("'.$rec->getError('value').'")</script>';die;
                      }
                  }
              }
          }
        }
        public function getColor(){
            return ($this->activity == '1') ? 'green':'white';
        }
        public function attachDataProvider(){
            $criteria = new CDbCriteria;
            $criteria->select = array('name','value');
            $criteria->addCondition('verid = :id');
            $criteria->params = array(':id'=>$this->id);
            $provider = new CActiveDataProvider('Mathparams', array('criteria'=>$criteria));
            return $provider;
        }
}
