<?php
class CommonStatistics extends CModel {
public function attributeNames(){}

public $features; // для временных данных
public $CommonStatistic; // общие данные статистики (array) (actionIndex)
private $colourStandard; // стандартные цветовые решения для отображения графиков
public $graphix; // контейнер инструкций для построения графика: 1 инструкция описывает один график : 3 параметра: индекс цветов, набор x и набор y

private $commonQueries; // Хранилище процедур запросов для данных по общей статистике
private $ajaxQueries; // для статистики, как по фильтрам, так и по умолчанию

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
    $this->graphix['x'] = array('0');$this->graphix['colors'] = $this->colourStandard['h'];$this->graphix['y'] = array(0);
    $this->makeCommonStatistic();
}

private function dateToDb($date){
    $date = array_reverse(explode('.', $date));
    $date = implode('-', $date);
    return $date;
}
private function dateToGraphix($date, $format){
    $date = strtotime($date);
    switch($format){
        case '%Y-%m-%d':
            $format = 'd.m';
            break;
        case '%Y-%m':
            $format = 'm.y';
            break;
        case '%Y-%m-%d %H':
            $format = 'H:i';
            break;
    }
    $date = date($format, $date);
    return $date;
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
   $this->commonQueries['mt1']();
   $this->commonQueries['mt2']();
   $this->commonQueries['mt3']();
   $this->commonQueries['mt4']();
   $this->commonQueries['ch1']();
   $this->commonQueries['ch2']();
   $this->commonQueries['v1']();
   $this->commonQueries['v2']();
   $this->commonQueries['v3']();
   $this->commonQueries['v4']();
}
/* This is a main Runtime of the graphycal rendering process */
public function postAnalyse(){
    if(isset($_POST['begin'])){ // не по умолчанию; речь идет о примененном фильтре
        $this->dateValidate();
        $this->resiever(); // устанавливаем фильтры для работы с базой данных
        $this->ajaxQueries[$_POST['Item']]();
    }else{ // графика та, что по умолчанию должна быть
        $this->default_resiever();
        $this->ajaxQueries[$_POST['Item']]();
        //$this->demoTest();
    }
}
private function default_resiever(){
    $this->features['timeBegin'] = $this->dateToDb($this->features['timeBegin']);
    $this->features['timeEnd'] = $this->dateToDb($this->features['timeEnd']);
    $this->features['timeStep'] = '%Y-%m-%d';
}
private function resiever(){
    if(!isset($_POST['step'])){
        echo '<script>alert("unknown error")</script>';
        die;
    }
    $this->features['timeBegin'] = $this->dateToDb($_POST['begin']);
    $this->features['timeEnd'] = $this->dateToDb($_POST['end']);
    switch($_POST['step']){
        case 'hour_step':
            $this->features['timeStep'] = '%Y-%m-%d %H';
            break;
        case 'day_step':
            $this->features['timeStep'] = '%Y-%m-%d';
            break;
        case 'month_step':
            $this->features['timeStep'] = '%Y-%m';
            break;
        default:
            $this->features['timeStep'] = '%Y-%m-%d'; // if no set initial dayly
            break;
    }
}
/* grahix structure filler */
private function graphixFiller($input, $format){
    if(!empty($input)){
        foreach($input as $key=>$elem){
            $this->graphix['x'][] = $this->dateToGraphix($elem['x'], $format);
            $this->graphix['y'][] = (int)$elem['y'];
        }
    }
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
    $this->commonQueries['p2'] = function(){
        $date_now = date('Y-m-d');
        $sql_tariff_3 = "SELECT count(id) c FROM tbl_users WHERE
                status=1 AND busy_date >= DATE(:date) AND(
                busy_date < DATE_ADD(:date, INTERVAL 1 DAY) OR
                club_date >= DATE(:date) AND club_date < DATE_ADD(:date, INTERVAL 1 DAY))" ;
//        $sql_others = "SELECT count(tr_id) c FROM pm_transaction_log WHERE
//                tr_err_code IS NULL AND
//                tr_kind_id IN (3,4,5) AND
//                date >= DATE(:date) AND date < DATE_ADD(:date, INTERVAL 1 DAY);";
        $tariff_3 = Yii::app()->db->createCommand($sql_tariff_3)->bindParam(':date', $date_now, PDO::PARAM_STR);
 //       $others = Yii::app()->db->createCommand($sql_others)->bindParam(':date', $date_now, PDO::PARAM_STR);
        $buff = $tariff_3->query()->read()['c'];
        $summ = (!is_null($buff)) ? (int)$buff : 0;
//        $buff = $others->query()->read()['c'];
//        $summ += (!is_null($buff)) ? (int)$buff : 0;
        $this->CommonStatistic['p2'] = (!is_null($summ)) ? $summ : '0';
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
    $this->commonQueries['mt1'] = function(){
        $sql = "SELECT count(tr_id) c FROM pm_transaction_log WHERE
                tr_err_code IS NULL AND
                tr_kind_id = 2";
        $res = Yii::app()->db->createCommand($sql)->query()->read()['c'];
        $this->CommonStatistic['mt1'] = (!is_null($res)) ? $res : '0';
    };
    //Активаций сегодня
    $this->commonQueries['mt2'] = function(){
        $date_now = date('Y-m-d');
        $sql = "SELECT count(tr_id) c FROM pm_transaction_log WHERE
                     tr_err_code IS NULL AND
                     tr_kind_id = 2 AND
                     date >= DATE(:date) AND date < DATE_ADD(:date, INTERVAL 1 DAY);";
        $command = Yii::app()->db->createCommand($sql)->bindParam(':date', $date_now, PDO::PARAM_STR);
        $res = $command->query()->read()['c'];
        $this->CommonStatistic['mt2'] = (!is_null($res)) ? $res : '0';
    };
    //Капитал всего
    $this->commonQueries['mt3'] = function(){
        $buff = Requisites::getInstance();
        $A = $buff->purse_activation;
        $B = $buff->purse_club;
        $F = $buff->purse_fdl;
        $sql = "SELECT sum(amount) summ FROM pm_transaction_log
                WHERE tr_err_code IS NULL AND(
                to_purse = :a OR to_purse = :b OR to_purse = :f OR to_user_id IS NULL)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':a', $A, PDO::PARAM_STR); $command->bindParam(':b', $B, PDO::PARAM_STR); $command->bindParam(':f', $F, PDO::PARAM_STR);
        $res = $command->query()->read()['summ'];
        $this->CommonStatistic['mt3'] = (!is_null($res)) ? $res : '0';
    };
    //Капитал сегодня
    $this->commonQueries['mt4'] = function(){
        $date_now = date('Y-m-d');
        $buff = Requisites::getInstance();
        $A = $buff->purse_activation;
        $B = $buff->purse_club;
        $F = $buff->purse_fdl;
        $sql = "SELECT sum(amount) summ FROM pm_transaction_log
                WHERE tr_err_code IS NULL AND(
                to_purse = :a OR to_purse = :b OR to_purse = :f OR to_user_id IS NULL) AND date >= DATE(:date) AND
                date < DATE_ADD(:date, INTERVAL 1 DAY)";
        $com = Yii::app()->db->createCommand($sql);
        $com->bindParam(':a', $A, PDO::PARAM_STR); $com->bindParam(':b', $B, PDO::PARAM_STR); 
        $com->bindParam(':f', $F, PDO::PARAM_STR); $com->bindParam(':date', $date_now, PDO::PARAM_STR);
        $res = $com->query()->read()['summ'];
        $this->CommonStatistic['mt4'] = (!is_null($res)) ? $res : '0';
    };
    // Благотворительность
    //Сегодня
    $this->commonQueries['ch1'] = function(){
        $date = date('Y-m-d');
        $buff = Requisites::getInstance();
        $F = $buff->purse_fdl;
        $sql = "SELECT sum(amount) summ FROM pm_transaction_log
                WHERE tr_err_code IS NULL AND to_purse = :f AND
                date >=DATE(:date) AND date < DATE_ADD(:date, INTERVAL 1 DAY)";
        $com = Yii::app()->db->createCommand($sql);
        $com->bindParam(':f', $F, PDO::PARAM_STR); $com->bindParam('date', $date, PDO::PARAM_STR);
        $res = $com->query()->read()['summ'];
        $this->CommonStatistic['ch1'] = (!is_null($res)) ? $res : '0';
    };
    //Всего передано
    $this->commonQueries['ch2'] = function(){
        $date = date('Y-m-d');
        $buff = Requisites::getInstance();
        $F = $buff->purse_fdl;
        $sql = "SELECT sum(amount) summ FROM pm_transaction_log
                WHERE tr_err_code IS NULL AND to_purse = :f";
        $com = Yii::app()->db->createCommand($sql);
        $com->bindParam(':f', $F, PDO::PARAM_STR);
        $res = $com->query()->read()['summ'];
        $this->CommonStatistic['ch2'] = (!is_null($res)) ? $res : '0';
    };
    // Посещения
    //Сегодня
    $this->commonQueries['v1'] = function(){
        $date = date('Y-m-d');
        
        $sql = "SELECT sum(visits_count) visits FROM tbl_visits
                WHERE date_visit >= DATE(:date) AND date_visit < DATE_ADD(:date, INTERVAL 1 DAY)";
        $res = Yii::app()->db->createCommand($sql)->bindParam(':date', $date, PDO::PARAM_STR)->query()->read()['visits'];
        $this->CommonStatistic['v1'] = (!is_null($res)) ? $res : '0';        
    };
    //Вчера
    $this->commonQueries['v2'] = function(){
        $date = date('Y-m-d');
        $sql = "SELECT sum(visits_count) visits FROM tbl_visits
                WHERE date_visit >= DATE_ADD(:date, INTERVAL -1 DAY) AND date_visit < DATE(:date)";
        $res = Yii::app()->db->createCommand($sql)->bindParam(':date', $date, PDO::PARAM_STR)->query()->read()['visits'];
        $this->CommonStatistic['v2'] = (!is_null($res)) ? $res : '0';
    };
    //Месяц
    $this->commonQueries['v3'] = function(){
        $date = date('Y-m-01');
        $sql = "SELECT sum(visits_count) visits FROM tbl_visits
                WHERE date_visit >= DATE(:date) AND date_visit < DATE_ADD(:date, INTERVAL 1 MONTH)";
        $res = Yii::app()->db->createCommand($sql)->bindParam(':date', $date, PDO::PARAM_STR)->query()->read()['visits'];
        $this->CommonStatistic['v3'] = (!is_null($res)) ? $res : '0';
    };
    //Всего
    $this->commonQueries['v4'] = function(){
        $sql = "SELECT sum(visits_count) v FROM tbl_visits";
        $res = Yii::app()->db->createCommand($sql)->query()->read()['v'];
        $this->CommonStatistic['v4'] = (!is_null($res)) ? $res : '0';
    };
    // ->
    $this->ajaxQueries['p1'] = function(){
        $sql = "SELECT count(id) y, busy_date x FROM tbl_users WHERE
                status=1 AND superuser=0 AND
                tariff_id >= 2 AND
                busy_date BETWEEN :date_b AND DATE_ADD(:date_e , INTERVAL 1 DAY)
                GROUP BY DATE_FORMAT(`busy_date`, :format)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':date_b', $this->features['timeBegin'], PDO::PARAM_STR);
        $command->bindParam(':date_e', $this->features['timeEnd'], PDO::PARAM_STR);
        $command->bindParam(':format', $this->features['timeStep'], PDO::PARAM_STR);
        $res = $command->query()->readAll();
        $this->graphixFiller($res, $this->features['timeStep']);
    };
    $this->ajaxQueries['p2'] = function(){
        $date = date('Y-m-d');
        $filter = '%Y-%m-%d %H';
        $sql = "SELECT count(id) y, busy_date x FROM tbl_users WHERE
                status=1 AND tariff_id >=2 AND busy_date >= DATE(:date) AND(
                busy_date < DATE_ADD(:date, INTERVAL 1 DAY) OR
                club_date >= DATE(:date) AND club_date < DATE_ADD(:date, INTERVAL 1 DAY))
                GROUP BY DATE_FORMAT(`busy_date`, :format)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':date', $date, PDO::PARAM_STR);
        $command->bindParam(':format', $filter, PDO::PARAM_STR);
        $res = $command->query()->readAll();
        $this->graphixFiller($res, '%Y-%m-%d %H');
    };
    $this->ajaxQueries['p3'] = function(){
       $sql = "SELECT count(id) y, busy_date x FROM tbl_users WHERE
                status=1 AND superuser=0 AND
                tariff_id = 2 AND(
                busy_date BETWEEN :date_b AND DATE_ADD(:date_e , INTERVAL 1 DAY))
                GROUP BY DATE_FORMAT(`busy_date`, :format)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':date_b', $this->features['timeBegin'], PDO::PARAM_STR);
        $command->bindParam(':date_e', $this->features['timeEnd'], PDO::PARAM_STR);
        $command->bindParam(':format', $this->features['timeStep'], PDO::PARAM_STR);
        $res = $command->query()->readAll();
        $this->graphixFiller($res, $this->features['timeStep']);        
    };
    $this->ajaxQueries['p4'] = function(){
        $sql_main = "SELECT count(id) y, club_date x FROM tbl_users WHERE
                status=1 AND tariff_id > 2 AND(
                club_date BETWEEN :date_b AND DATE_ADD(:date_e , INTERVAL 1 DAY))
                GROUP BY DATE_FORMAT(`club_date`, :format)";
        $command = Yii::app()->db->createCommand($sql_main);
        $command->bindParam(':date_b', $this->features['timeBegin'], PDO::PARAM_STR);
        $command->bindParam(':date_e', $this->features['timeEnd'], PDO::PARAM_STR);
        $command->bindParam(':format', $this->features['timeStep'], PDO::PARAM_STR);
        $res1 = $command->query()->readAll();
        $sql_trlog = "SELECT count(tr_id) y, date x FROM pm_transaction_log
                      LEFT JOIN tbl_users ON pm_transaction_log.from_user_id = tbl_users.id
                      WHERE
                      tr_err_code IS NULL AND tr_kind_id IN (3,4,5) AND
                      tbl_users.club_date = '0000-00-00 00:00:00'
                      AND(
                      date BETWEEN :date_b AND DATE_ADD(:date_e , INTERVAL 1 DAY)
                      )
                      GROUP BY DATE_FORMAT(`date`, :format)";
        $command = Yii::app()->db->createCommand($sql_trlog);
        $command->bindParam(':date_b', $this->features['timeBegin'], PDO::PARAM_STR);
        $command->bindParam(':date_e', $this->features['timeEnd'], PDO::PARAM_STR);
        $command->bindParam(':format', $this->features['timeStep'], PDO::PARAM_STR);
        $res2 = $command->query()->readAll();
        $res = array_merge($res1, $res2);
        $this->graphixFiller($res, $this->features['timeStep']);  
    };
    $this->ajaxQueries['mt1'] = function(){
        $sql = "SELECT count(tr_id) y, date x FROM pm_transaction_log WHERE
                tr_err_code IS NULL AND
                tr_kind_id = 2 AND(
                date BETWEEN :date_b AND DATE_ADD(:date_e , INTERVAL 1 DAY))
                GROUP BY DATE_FORMAT(`date`, :format)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':date_b', $this->features['timeBegin'], PDO::PARAM_STR);
        $command->bindParam(':date_e', $this->features['timeEnd'], PDO::PARAM_STR);
        $command->bindParam(':format', $this->features['timeStep'], PDO::PARAM_STR);
        $res = $command->query()->readAll();
        $this->graphixFiller($res, $this->features['timeStep']);
    };
    $this->ajaxQueries['mt2'] = function(){
        $date = date('Y-m-d');
        $filter = '%Y-%m-%d %H';
        $sql = "SELECT count(tr_id) y, date x FROM pm_transaction_log WHERE
                     tr_err_code IS NULL AND
                     tr_kind_id = 2 AND
                     date >= :date AND date < DATE_ADD(:date , INTERVAL 1 DAY)
                     GROUP BY DATE_FORMAT(`date`, :format)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':date', $date, PDO::PARAM_STR);
        $command->bindParam(':format', $filter, PDO::PARAM_STR);
        $res = $command->query()->readAll();
        $this->graphixFiller($res, $filter);
    };
    $this->ajaxQueries['mt3'] = function(){
       $buff = Requisites::getInstance();
        $A = $buff->purse_activation;
        $B = $buff->purse_club;
        $F = $buff->purse_fdl;
        $sql = "SELECT sum(amount) y, date x FROM pm_transaction_log
                WHERE tr_err_code IS NULL AND(
                to_purse = :a OR to_purse = :b OR to_purse = :f OR to_user_id IS NULL) AND(
                date BETWEEN :date_b AND DATE_ADD(:date_e , INTERVAL 1 DAY))
                GROUP BY DATE_FORMAT(`date`, :format)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':a', $A, PDO::PARAM_STR); $command->bindParam(':b', $B, PDO::PARAM_STR); $command->bindParam(':f', $F, PDO::PARAM_STR);
        $command->bindParam(':date_b', $this->features['timeBegin'], PDO::PARAM_STR);
        $command->bindParam(':date_e', $this->features['timeEnd'], PDO::PARAM_STR);
        $command->bindParam(':format', $this->features['timeStep'], PDO::PARAM_STR);
        $res = $command->query()->readAll();
        $this->graphixFiller($res, $this->features['timeStep']);
    };
    $this->ajaxQueries['mt4'] = function(){
        $date = date('Y-m-d');
        $buff = Requisites::getInstance();
        $A = $buff->purse_activation;
        $B = $buff->purse_club;
        $F = $buff->purse_fdl;
        $sql = "SELECT sum(amount) y, date x FROM pm_transaction_log
                WHERE tr_err_code IS NULL AND(
                to_purse = :a OR to_purse = :b OR to_purse = :f OR to_user_id IS NULL) AND
                date >= DATE(:date) AND
                date < DATE_ADD(:date, INTERVAL 1 DAY)
                GROUP BY DATE_FORMAT(`date`, :format)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':a', $A, PDO::PARAM_STR);
        $command->bindParam(':b', $B, PDO::PARAM_STR); 
        $command->bindParam(':f', $F, PDO::PARAM_STR);
        $command->bindParam(':date', $date, PDO::PARAM_STR);
        $command->bindParam(':format', $this->features['timeStep'], PDO::PARAM_STR);
        $res = $command->query()->readAll();
        $this->graphixFiller($res, $this->features['timeStep']);        
    };
    $this->ajaxQueries['ch1'] = function(){};
    $this->ajaxQueries['ch2'] = function(){};
    
    $this->ajaxQueries['v1'] = function(){};
    $this->ajaxQueries['v2'] = function(){};
    $this->ajaxQueries['v3'] = function(){};
    $this->ajaxQueries['v4'] = function(){};
}
}
