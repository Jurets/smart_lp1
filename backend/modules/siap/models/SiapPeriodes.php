<?php
class SiapPeriodes extends CActiveRecord{
    public $begin;
    public $end;
    public function init() {
        $this->begin = NULL;
        $this->end = NULL;
    }
    public function tableName() {
       return 'sip_periodes';
    }
    public function rules() {
        return array(
            array('begin', 'required'),
            array('begin', 'date', 'format'=>'yyyy-mm-dd hh:mm'),
        );
    }
    public function addWeek(){
        if($this->begin == NULL)
            throw new CHttpException('500', 'Error: BEGIN date interval not defined');
        $this->end = date('Y-m-d H:i', strtotime($this->begin . '+1 WEEK'));
    }
    public static function model($className=__CLASS__)
    {
	return parent::model($className);
    }
}

