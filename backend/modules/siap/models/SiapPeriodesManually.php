<?php
class SiapPeriodesManually extends CActiveRecord{
    public $begin;
    public $end;
    public function tableName() {
       return 'sip_periodes';
    }
    public function rules() {
        return array(
            array('begin, end', 'required'),
            array('begin, end', 'date', 'format'=>'yyyy-mm-dd hh:mm:ss'),
        );
    }
    public static function model($className=__CLASS__)
    {
	return parent::model($className);
    }
}

