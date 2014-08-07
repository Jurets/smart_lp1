<?php
class CommonStatistics extends CModel {
public function attributeNames(){}

private $features; // массив с настройками моделей для выполнения нужных запросов

private $colourStandard; // стандартные цветовые решения для отображения графиков

private $graphix; // контейнер инструкций для построения графика: 1 инструкция описывает один график : 3 параметра: индекс цветов, набор x и набор y


public function __construct(){
    $this->features = array();
    $this->features['graphic'] = (isset($_POST['Item'])) ? $_POST['Item'] : NULL;
    $this->features['timeBegin'] = (isset($_POST['begin'])) ? $_POST['begin'] : date('d.m.Y', strtotime('-7 days'));
    $this->features['timeStep'] = (isset($_POST['step'])) ? $_POST['step'] : 'day_step';
    $this->features['timeEnd'] = (isset($_POST['end'])) ? $_POST['end'] : date('d.m.Y');
    $this->colourStandard = array(
        'a'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(244,17,17,1)','pointColor'=>'rgba(244,17,17,1)',"pointStrokeColor" => "#ffffff"),
        'b'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(236,93,82,1)','pointColor'=>'rgba(236,93,82,1)',"pointStrokeColor" => "#ffffff"),
        'c'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(255,255,0,1)','pointColor'=>'rgba(255,255,0,1)',"pointStrokeColor" => "#ffffff"),
        'd'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(181,179,26,1)','pointColor'=>'rgba(181,179,26,1)',"pointStrokeColor" => "#ffffff"),
        'e'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(0,255,0,1)','pointColor'=>'rgba(0,255,0,1)',"pointStrokeColor" => "#ffffff"),
        'f'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(63,152,63,1)','pointColor'=>'rgba(63,152,63,1)',"pointStrokeColor" => "#ffffff"),
        'g'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(0,0,255,1)','pointColor'=>'rgba(0,0,255,1)',"pointStrokeColor" => "#ffffff"),
        'h'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(69,69,145,1)','pointColor'=>'rgba(69,69,145,1)',"pointStrokeColor" => "#ffffff"),
    );
}

public function showTest(){ // Потом удалить
    var_dump($this->features);       
}

private function dateToDb($date){
    $date = array_reverse(explode('.', $date));
    $date = implode('-', $date);
    return $date;
}
private function dateToSite($date){
    $date = strtotime($date);
    $date = date('d.m.Y', $date);
    return date;
}
public function dateValidate(){
    if(preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $this->features['timeBegin']) && preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $this->features['timeEnd']))
       return true;
    else{
        echo '<script type="text/javascript"> alert("'.CommonstatModule::t('invalid interval date format').'");';
        die;
    }
        
}
public function getBegin(){
    return $this->features['timeBegin'];
}
public function setBegin($date){
    $this->features['timeBegin'] = $date;
}
public function getEnd(){
    return $this->features['timeEnd'];
}
public function setEnd($date){
    $this->features['timeEnd'] = $date;
}






}
