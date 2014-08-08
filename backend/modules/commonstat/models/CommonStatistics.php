<?php
class CommonStatistics extends CModel {
public function attributeNames(){}

public $features; // для вреенных данных
public $CommonStatistic; // общие данные статистики (actionIndex)
private $colourStandard; // стандартные цветовые решения для отображения графиков
private $graphix; // контейнер инструкций для построения графика: 1 инструкция описывает один график : 3 параметра: индекс цветов, набор x и набор y

private $commonQueries; // Хранилище процедур запросов для данных по общей статистике
private $defaultQueries; // -//- по статистике по умолчанию (для постройки графиков по клику)
private $filteredQueries; // -//- для статистики по фильтрам

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
    $this->QueryPullInitial();
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
/* методы сборки инструкций для виджета */
public function completterTest(){
    $this->graphix['x'] = array('a','b','c','d','e','f','g','h');
    $this->graphix['y'] = array(1,2,7,8,9,10,15,20);
    $this->graphix['colors'] = $this->getRandomColorSchema();
    return $this;
}
public function demoTest(){
    $this->graphix['x'] = array('a','b','c','d','e','f','g','h');
    for($i = 0; $i < 8; $i++){
        $this->graphix['y'][] = rand(1, 100);
    }
    $this->graphix['colors'] = $this->getRandomColorSchema();
    return $this;
}
private function getRandomColorSchema(){
    $buff = $this->colourStandard;
    shuffle($buff);
    return array_shift($buff);
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
public function getWidgetFeatures(){ // возвращает готовую структуру данных для передачи виджета
    return $this->graphix;
}

/* common statistics procedure */
public function makeCommonStatistic(){
   
   return $this;
}
/* Queries Pull */
private function QueryPullInitial(){
    // Участники 
    //всего
    $this->commonQueries['p1'] = function(){};
    //сегодня
    $this->commonQueries['p2'] = function(){};
    //вошли
    $this->commonQueries['p3'] = function(){};
    //бизнес клуб
    $this->commonQueries['p4'] = function(){};
    // Обороты
    //Активаций всего
    $this->commonQueries['mt1'] = function(){};
    //Активаций сегодня
    $this->commonQueries['mt2'] = function(){};
    //Капитал всего
    $this->commonQueries['mt3'] = function(){};
    //Капитал сегодня
    $this->commonQueries['mt4'] = function(){};
    // Благотворительность
    //Сегодня
    $this->commonQueries['ch1'] = function(){};
    //Всего передано
    $this->commonQueries['ch2'] = function(){};
    // Посещения
    //Сегодня
    $this->commonQueries['v1'] = function(){};
    //Вчера
    $this->commonQueries['v2'] = function(){};
    //Месяц
    $this->commonQueries['v3'] = function(){};
    //Всего
    $this->commonQueries['v4'] = function(){};
    
    $this->defaultQueries['p1'] = function(){};
    $this->defaultQueries['p2'] = function(){};
    $this->defaultQueries['p3'] = function(){};
    $this->defaultQueries['p4'] = function(){};
    $this->defaultQueries['mt1'] = function(){};
    $this->defaultQueries['mt2'] = function(){};
    $this->defaultQueries['mt3'] = function(){};
    $this->defaultQueries['mt4'] = function(){};
    $this->defaultQueries['ch1'] = function(){};
    $this->defaultQueries['ch2'] = function(){};
    $this->defaultQueries['v1'] = function(){};
    $this->defaultQueries['v2'] = function(){};
    $this->defaultQueries['v3'] = function(){};
    $this->defaultQueries['v4'] = function(){};
    
    $this->filteredQueries['p1'] = function(){};
    $this->filteredQueries['p2'] = function(){};
    $this->filteredQueries['p3'] = function(){};
    $this->filteredQueries['p4'] = function(){};
    $this->filteredQueries['mt1'] = function(){};
    $this->filteredQueries['mt2'] = function(){};
    $this->filteredQueries['mt3'] = function(){};
    $this->filteredQueries['mt4'] = function(){};
    $this->filteredQueries['ch1'] = function(){};
    $this->filteredQueries['ch2'] = function(){};
    $this->filteredQueries['v1'] = function(){};
    $this->filteredQueries['v2'] = function(){};
    $this->filteredQueries['v3'] = function(){};
    $this->filteredQueries['v4'] = function(){};
}
}
