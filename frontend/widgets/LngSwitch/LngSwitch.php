<?php
class LngSwitch extends CWidget {
    public $flags; // структура, описывающая выпадающий список флагов
    private $flags_side = array(
        'left'=>'<option>',
        'right'=>'</option>',
    );
    /* Вариант 1 */
    private function makeFlagList(){
        $this->flags = '<select>'.PHP_EOL;
        $this->flags .= $this->flagsGetter();
        $this->flags .= PHP_EOL.'</select>';
        $this->flags;
    }
    private function flagsGetter(){
        $flags = Yii::app()->db->createCommand(
                'SELECT lang FROM Languages'
                )->query()->readAll();
        $flags = $this->reemake($flags);
        $flags;
        if(!is_null($flags)){
            foreach($flags as $flag){
                $this->flags .= $this->flags_side['left'].strtoupper($flag).$this->flags_side['right'].PHP_EOL; 
            }
            $flags = implode('',$flags);
            return $flags;
        }
    }
    private function reemake($flags){
        $buff = array();
        foreach($flags as $elem){
            $buff[] = $elem['lang'];
        }
        return $buff;
    }
    /*------------------------------*/
    
    /* Вариант 2 */
    private function flagsMakeStruct(){
        $flags = Yii::app()->db->createCommand(
                'SELECT lang FROM Languages'
                )->query()->readAll();
        $buff = array();
        foreach($flags as $flag){
            $buff[] = $flag['lang'];
        }
        $this->flags = $buff;
    }
    /*------------------------------*/
    public function run(){
        //$this->makeFlagList();
        $this->flagsMakeStruct();
        $this->render('LngSwitch', array('flags'=>$this->flags));
    }
}
