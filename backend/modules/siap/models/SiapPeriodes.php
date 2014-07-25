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
            array('begin, end','safe'),
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
    
    /* Автоматика формирования интервалов */
    /* обращаться можно по крону */
    public static function dateIntervalAutomate(){
//       $model = new SiapPeriodes;
//       $newBegin = $model->findBySql('SELECT end FROM sip_periodes ORDER BY end DESC LIMIT 1');
//       if(!is_null($newBegin)){
//           $model->begin = $newBegin->end;
//       }else{
//           throw new CHttpException('500', 'newBegin can`t be create, check sip_periodes, it must be not empty. First record may created manually'); 
//       }
//       $model->addWeek(); // задаем $model->end;
//       if(!$model->save()){
//           throw new CHttpException('500', 'db error record not create');
//       }
//       //var_dump($model->id, $model->begin, $model->end); // возвращаем последний автоинкремент для формирования связей
//       return array('fk_id'=>$model->id, 'date_begin'=>$model->begin, 'date_end'=>$model->end);
        $model = new SiapPeriodes;
        $currentInterval = $model->findBySql('SELECT id,begin,end FROM sip_periodes ORDER BY end DESC LIMIT 1');
        if(!is_null($currentInterval)){
            $now = date('Y-m-d H:i:s');
            if($currentInterval->end > $now){
                var_dump('New interval not detected');
                return 0;
            }
                var_dump('Detected New Interval');
            SiapInstructions::makePeriodInstructions(
                    array(
                        'fk_id' => $currentInterval->id,
                        'date_begin' => $currentInterval->begin,
                        'date_end' => $currentInterval->end
                    ));
            
        }else{
            throw new CHttpException('500', 'No periods found. Check sip_periodes it must be not empty. First record may created manually');
        }
    }
}

