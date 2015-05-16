<?php

/*
 * типовой виджет для отображения информации по юзерам (3 вида)
 */

class UserContour extends CWidget {

    public $params = array(
            //'action' => 'index', // не обязательный
            //'cssID' => 1,
            //'head' => 'ЗАРЕГИСТРИРОВАНО УЧАСТНИКОВ',
            //'title'=> 'ТЕКУЩИЕ РЕГИСТРАЦИИ',
    );
    private $dataPull = array(
        'numberField' => '00 000 000', // поле с цифрами (должно быть отформатировано)
        'userList' => array(// данные по пользователям для списка li
            array(
                'country' => '', // название страны (записывается в id списка li - например, UA)
                'content' => '', // 12:51 UTC Фамилия Имя (en)
            ),
        ),
    );
    private $operation;

    public function run() {
        switch ($this->params['cssID']) {
            case 1:
                $this->registeredPartipiants();
                break;
            case 2:
                $this->freePaid();
                break;
            case 3:
                //$this->givenOncharity(); // базовый
                $this->givenOncharityF(); // feedback от заказчика
                break;
        }
        $this->render('UserContour', array('features' => $this->params, 'dataPull' => $this->dataPull, 'operation' => $this->operation));
    }

    /**
     * Зарегистрированные члены
     * 
     */
    private function registeredPartipiants() {//DebugBreak();
        // TO DO - получить, отформатировать и записать в dataPull ответ для ЗАРЕГИСТРИРОВАНО УЧАСТНИКОВ
        $this->operation = BaseModule::t('rec', 'REGISTRATIONS');
        $db_connector = Yii::app()->db;
        $usersDumpCommand = $db_connector->createCommand(
                'SELECT u.first_name, u.last_name, u.create_at, co.code, co.name, u.username
                 FROM tbl_users u
                      LEFT JOIN cities c ON u.city_id = c.id
                      LEFT JOIN countries co ON co.id = c.country_id
                 WHERE superuser = 0 AND status = 1
                 ORDER BY u.busy_date DESC
                 LIMIT 6');
        $usersCountCommand = $db_connector->createCommand('SELECT count(id) FROM tbl_users WHERE superuser = 0 AND status = 1');
        $usersDump = $usersDumpCommand->query();
        $usersCount = $usersCountCommand->query();
        $this->dataPull['numberField'] = $this->jmws_money_converter(($usersCount->read()['count(id)']));

        foreach ($usersDump->readAll() as $index => $li) {
            $this->dataPull['userList'][$index]['country'] = $li['code'];
            if ($li['first_name'] and $li['last_name']) {
                $name = $li['first_name'] . ' ' . $li['last_name'];
            } else {
                $name = $li['username'];
            }
            $this->dataPull['userList'][$index]['content'] = date('H:i', strtotime($li['create_at'])) . ' ' . $name;
        }
    }

    /**
     * Выплачено комиссионных
     * 
     */
    private function freePaid() {
        $this->operation = BaseModule::t('rec', 'COMISSION');
        $db_connector = Yii::app()->db;
        $amountCommission = $db_connector->createCommand('SELECT sum(amount) as summ FROM pm_transaction_log WHERE tr_kind_id IN(2, 6, 8, 21) AND tr_err_code IS NULL');
        $amountFromRobots = $this->getAmountFromRobots();
        $amountCommissionCount = $amountCommission->query();
        $amountCommissionCount = $amountCommissionCount->read()['summ'];
        $amountCommissionCount += $amountFromRobots;
        $list = $db_connector->createCommand(
                'SELECT to_user_id tr_kind_id, date, u.first_name, u.last_name, ptl.date, code,u.username
             FROM pm_transaction_log ptl
                  LEFT JOIN tbl_users u ON to_user_id = id
                  LEFT JOIN cities c ON city_id = c.id
                  LEFT JOIN countries co ON co.id = c.country_id
             WHERE tr_kind_id IN (2,6,8,21) AND to_user_id IS NOT NULL
             AND tr_err_code IS NULL
             ORDER BY date DESC
             LIMIT 6');
        $listCommission = $list->query();
        $listCommission = $listCommission->readAll();
        if ($amountCommissionCount != null) {
            //$finalCount = floor($amountCommissionCount['sum(amount)']);
            $finalCount = round($amountCommissionCount);
            $this->dataPull['numberField'] = '$' . $this->jmws_money_converter($finalCount);
            foreach ($listCommission as $index => $li) {
                $this->dataPull['userList'][$index]['country'] = $li['code'];
                if ($li['first_name'] && $li['last_name']) {
                    $name = $li['first_name'] . ' ' . $li['last_name'];
                } else {
                    $name = $li['username'];
                }
                //$this->dataPull['userList'][$index]['content'] =  ' '. $name;
                $this->dataPull['userList'][$index]['content'] = date('H:i', strtotime($li['date'])) . ' ' . $name;
            }
        } else {
            $this->dataPull['numberField'] = '$00 000 000';
        }
    }

    /**
     * Отдано на благотворительность
     * 
     */
    private function givenOncharity() {
        $this->operation = BaseModule::t('rec', 'DEDUCTIONS');
        $db_connector = Yii::app()->db;
        // сначала вычислить сумму
        //$sql = 'SELECT sum(amount) FROM pm_transaction_log WHERE tr_kind_id=12';
        $sql = '
            SELECT sum(amount) * 0.05 as sum_amount
             FROM pm_transaction_log tl
                 LEFT JOIN tbl_users u ON tl.from_user_id = u.id
                 LEFT JOIN cities c ON u.city_id = c.id
                 LEFT JOIN countries co ON co.id = c.country_id
             WHERE tl.tr_err_code IS NULL AND tl.tr_kind_id IN (2,3,4,5)
        ';
        $amountCommission = $db_connector->createCommand($sql);
        $amountCommissionCount = $amountCommission->query();
        $amountCommissionCount = $amountCommissionCount->read();
        // если сумма ненулевая
        if ($amountCommissionCount['sum_amount'] != null && $amountCommissionCount['sum_amount'] > 0) {
            $finalCount = floor($amountCommissionCount['sum_amount']);
            $this->dataPull['numberField'] = '$' . $this->jmws_money_converter($finalCount);
            $list = $db_connector->createCommand('
                SELECT tl.to_user_id, tl.tr_kind_id, tl.date, COALESCE(CONCAT(u.first_name, " ", u.last_name), u.username) as username, co.code
                 FROM pm_transaction_log tl
                     LEFT JOIN tbl_users u ON tl.from_user_id = u.id
                     LEFT JOIN cities c ON u.city_id = c.id
                     LEFT JOIN countries co ON co.id = c.country_id
                 WHERE tl.tr_err_code IS NULL AND tl.tr_kind_id IN (2,3,4,5)
                 ORDER BY tl.`date` DESC
                 LIMIT 6
            ');
            $listCommission = $list->query();
            $listCommission = $listCommission->readAll();
            foreach ($listCommission as $index => $commision) {
                $this->dataPull['userList'][$index]['country'] = $commision['code'];
                $this->dataPull['userList'][$index]['content'] = date('H:i', strtotime($commision['date'])) . ' ' . $commision['username'];
            }
        } else {
            $this->dataPull['numberField'] = '$00 000 000';
        }
    }

    /* Новый вариант счетчика */

    private function givenOncharityF() {
        $this->operation = BaseModule::t('rec', 'DEDUCTIONS');
        $db_connector = Yii::app()->db;
        $usersDumpCommand = $db_connector->createCommand(
                'SELECT u.tariff_id, u.first_name, u.last_name, u.club_date, co.code, co.name, u.username
                 FROM tbl_users u
                      LEFT JOIN cities c ON u.city_id = c.id
                      LEFT JOIN countries co ON co.id = c.country_id
                 WHERE superuser = 0 AND status = 1
                 AND tariff_id IN (3,4,5,6,24)
                 ORDER BY u.club_date DESC');
        $usersDump = $usersDumpCommand->query();
        foreach($usersDump->readAll() as $index=>$li){
            $this->dataPull['userList'][$index]['country'] = $li['code'];
             $this->dataPull['userList'][$index]['tariff'] = $li['tariff_id'];
            if($li['first_name'] and  $li['last_name']){
                $name =  $li['first_name'] .' '. $li['last_name'];
            } else {
                $name = $li['username'];
            }
           $this->dataPull['userList'][$index]['content'] = date('H:i', strtotime($li['club_date'])). ' '. $name;
        }
        $this->dataPull['numberField'] = '$'.$this->jmws_money_converter($this->summFCounter($this->dataPull['userList']));
        $this->dataPull['userList'] = $this->structSplitter($this->dataPull['userList']);
        
        
       // var_dump($usersDump);die;
    }

    /* addons special srevices */

    private function jmws_money_converter($in) {
        $result = '';
        $in = round($in, 2);
        $input = strrev((string) $in);
        if (strlen($input) > 8) {
            return 'OV ERF ULL';
        } else {
            for ($i = 0; $i < 8; $i++) {
                if ($i >= strlen($input))
                    $result .= '0';
                else
                    $result .= $input[$i];

                if (($i + 1) % 3 == 0)
                    $result .= ' ';
            }
        }
        return strrev($result);
    }
    private function summFCounter($struct){
        if( empty($struct[0]['content']) )  return 0;
        $summ = 0;
        foreach ($struct as $elem) {
            switch ($elem['tariff']) {
                // люди
                case '3' :
                    $summ += 10;
                    break;
                case '4' :
                    $summ += 10;
                    break;
                case '5' :
                    $summ += 50;
                    break;
                case '6' :
                    $summ += 100;
                    break;
                
                // роботы
//                case '23' :
//                    $summ += 10;
//                    break;
                case '24' :
                    $summ += 10;
                    break;
//                case '25' :
//                    $summ += 50;
//                    break;
//                case '26' :
//                    $summ += 100;
//                    break;
            }
        }
        return $summ;
    }
    private function structSplitter($struct, $first = 6){
        $buff = [];
        if(empty($struct)){
            return  array(
            array(
                'country' => '', 
                'content' => '', 
            ));
        }
        foreach($struct as $ind=>$elem){
            array_push($buff, $elem);
            if($ind == ($first-1)) { break; }
        }
        return $buff;
        
    }
    
    private function getAmountFromRobots(){
        $db_connector = Yii::app()->db;
        $sqlRobots =  '
            SELECT tariff_id FROM tbl_users 
            WHERE status = 1 AND tariff_id IN(22,23,24,25,26)
                ';
        $amountRobots = $db_connector->createCommand($sqlRobots);
        $amountRobotsResult = $amountRobots->query();
        $amountRobotsStruct = $amountRobotsResult->readAll();
        if(!$amountRobotsStruct){
            return 0;
        }else{ // набираем нужную сумму и возвращаем
            $roboSumm = 0;
            foreach($amountRobotsStruct as $item){
                switch($item['tariff_id']){
                    case '24':
                        $roboSumm += marketingPlanHelper::init()->getMpParam('cost_B1');
                        break;
                }
            }
            return $roboSumm;
        }
        
    }
}
