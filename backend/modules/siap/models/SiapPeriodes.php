<?php
class SiapPeriodes extends CActiveRecord{
    public $test;
    public function init(){
        
    }
    public function tableName() {
       return 'sip_periodes';
    }
    public function rules() {
        return array(
            array('test', 'type', 'type'=>'integer'),
        );
    }
    public static function model($className=__CLASS__)
    {
	return parent::model($className);
    }
    
}

