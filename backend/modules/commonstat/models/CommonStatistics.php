<?php
class CommonStatistics extends CModel {
public function attributeNames(){}

public $features; // для временных данных
public $CommonStatistic; // общие данные статистики (array) (actionIndex)
private $colourStandard; // стандартные цветовые решения для отображения графиков
public $graphix; // контейнер инструкций для построения графика: 1 инструкция описывает один график : 3 параметра: индекс цветов, набор x и набор y

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
    $this->graphix['x'] = array();$this->graphix['colors'] = $this->colourStandard['a'];$this->graphix['y'] = array();
    $this->makeCommonStatistic();
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
public function demoTest(){
    $this->graphix['x'] = array('a','b','c','d','e','f','g','h');
    for($i = 0; $i < 8; $i++){
        $this->graphix['y'][] = rand(1, 100);
    }
    $this->graphix['colors'] = $this->getRandomColorSchema();
}
private function getRandomColorSchema(){
    $buff = $this->colourStandard;
    shuffle($buff);
    return array_shift($buff);
}


/* common statistics procedure */
private function makeCommonStatistic(){
   $this->commonQueries['p1']();
   $this->commonQueries['p2']();
   $this->commonQueries['p3']();
   $this->commonQueries['p4']();
}
/* Queries Pull */
private function QueryPullInitial(){
    // Участники 
    //всего
    $this->commonQueries['p1'] = function(){
        $sql = "SELECT count(id) c FROM tbl_users WHERE
                status=1 AND superuser=0 AND
                tariff_id >= 2";
        $res = Yii::app()->db->createCommand($sql)->query()->read()['c'];
        $this->CommonStatistic['p1'] = (!is_null($res)) ? $res : '0';
    };
    //сегодня
    $this->commonQueries['p2'] = function(){ // возможна коллизия: нужно учитывать за сегодня любые изменения, но в течение дня юзер может, например, статус поднять, что породит его фантомный дубль.
        $date_now = date('Y-m-d');
        $sql_tariff_3 = "SELECT count(id) c FROM tbl_users WHERE
                status=1 AND busy_date >= DATE(:date) AND
                busy_date < DATE_ADD(:date, INTERVAL 1 DAY) OR
                club_date >= DATE(:date) AND club_date < DATE_ADD(:date, INTERVAL 1 DAY)" ;
        $sql_others = "SELECT count(tr_id) c FROM pm_transaction_log WHERE
                tr_err_code IS NULL AND
                tr_kind_id IN (3,4,5) AND
                date >= DATE(:date) AND date < DATE_ADD(:date, INTERVAL 1 DAY);";
        $tariff_3 = Yii::app()->db->createCommand($sql_tariff_3)->bindParam(':date', $date_now, PDO::PARAM_STR);
        $others = Yii::app()->db->createCommand($sql_others)->bindParam(':date', $date_now, PDO::PARAM_STR);
        $buff = $tariff_3->query()->read()['c'];
        $summ = (!is_null($buff)) ? (int)$buff : 0;
        $buff = $others->query()->read()['c'];
        $summ += (!is_null($buff)) ? (int)$buff : 0;
        $this->CommonStatistic['p2'] = $summ;
    };
    //вошли
    $this->commonQueries['p3'] = function(){
        $sql = "SELECT count(id) c FROM tbl_users WHERE
                status=1 AND tariff_id=2";
        $res = Yii::app()->db->createCommand($sql)->query()->read()['c'];
        $this->CommonStatistic['p3'] = (!is_null($res)) ? $res : '0';
    };
    //бизнес клуб
    $this->commonQueries['p4'] = function(){
        $sql = "SELECT count(id) c FROM tbl_users WHERE
                status=1 AND tariff_id > 2";
        $res = Yii::app()->db->createCommand($sql)->query()->read()['c'];
        $this->CommonStatistic['p4'] = (!is_null($res)) ? $res : '0';
    };
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
