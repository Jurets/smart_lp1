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
        'userList' => array( // данные по пользователям для списка li
           array( 
            'country' => '', // название страны (записывается в id списка li - например, UA)
            'content' => '', // 12:51 UTC Фамилия Имя (en)
           ),
        ), 
    );
    private $operation;
    public function run(){
        switch($this->params['cssID']){
            case 1:
                $this->registeredPartipiants();
                break;
            case 2:
                $this->freePaid();
                break;
            case 3:
                $this->givenOncharity();
                break;
        }
       $this->render('UserContour', array('features'=>$this->params, 'dataPull'=>$this->dataPull,'operation'=>$this->operation));
    }
    
    /**/
    private function registeredPartipiants(){
        // TO DO - получить, отформатировать и записать в dataPull ответ для ЗАРЕГИСТРИРОВАНО УЧАСТНИКОВ
        $this->operation = 'РЕГИСТРАЦИИ';
        $db_connector = Yii::app()->db;
        $usersDumpCommand = $db_connector->createCommand(
                'SELECT u.first_name, u.last_name, u.create_at, co.code, co.name
                 FROM tbl_users u
                 INNER JOIN cities c
                 ON u.city_id = c.id
                 INNER JOIN countries co
                 ON co.id = c.country_id
                 ORDER BY u.create_at DESC
                 LIMIT 6');
        $usersCountCommand = $db_connector->createCommand('SELECT count(id) FROM tbl_users WHERE superuser = 0 ');
        $usersDump = $usersDumpCommand->query();
        $usersCount = $usersCountCommand->query();
        
        $this->dataPull['numberField'] = $this->jmws_money_converter(($usersCount->read()['count(id)']));
        
        foreach($usersDump->readAll() as $index=>$li){
           $this->dataPull['userList'][$index]['country'] = $li['code'];
           $this->dataPull['userList'][$index]['content'] = date('H:i', strtotime($li['create_at'])). ' UTC '. $li['first_name'] .' '. $li['last_name'];
            
        }
       
    }
    private function freePaid(){
        // TO DO - получить, отформатировать и записать в dataPull ответ для ВЫПЛАЧЕНО КОМИССИОННЫХ
        // Выплаченные комиссионные
        $this->operation = 'КОМИССИОННЫЕ';
        $db_connector = Yii::app()->db;
        $amountCommission = $db_connector->createCommand('SELECT sum(amount) FROM pm_transaction_log WHERE tr_kind_id=1');
        $amountCommissionCount = $amountCommission->query();
        $amountCommissionCount = $amountCommissionCount->read();
        $list = $db_connector->createCommand(
            'SELECT to_user_id tr_kind_id,date,first_name,last_name,code
             FROM pm_transaction_log
             JOIN tbl_users
             ON to_user_id = id
             JOIN cities c
             ON city_id = c.id
             JOIN countries co
             ON co.id = c.country_id
             WHERE tr_kind_id = 1
             LIMIT 6  ');
        $listCommission = $list->query();
        $listCommission = $listCommission->read();
        if($amountCommissionCount['sum(amount)'] != null){
        $this->dataPull['numberField'] = '$' . $this->jmws_money_converter($amountCommissionCount['sum(amount)']);
        foreach ($listCommission as $commision) {
            $this->dataPull['userList'][0]['country'] = $listCommission['code'];
            $this->dataPull['userList'][0]['content'] = date('H:i', strtotime($listCommission['date'])). ' UTC '. $listCommission['first_name'] .' '. $listCommission['last_name'];
        }
        }else{
            $this->dataPull['numberField'] = '$00 000 000';
        }

    }
    private function givenOncharity(){
        // TO DO - получить, отформатировать и записать в dataPull ответ для ОТДАНО НА БЛАГОТВОРИТЕЛЬНОСТЬ
        $this->operation = 'ОТЧИСЛЕНИЯ';
        $db_connector = Yii::app()->db;
        $amountCommission = $db_connector->createCommand('SELECT sum(amount) FROM pm_transaction_log WHERE tr_kind_id=2');
        $amountCommissionCount = $amountCommission->query();
        $amountCommissionCount = $amountCommissionCount->read();
        $list = $db_connector->createCommand(
            'SELECT to_user_id tr_kind_id,date,first_name,last_name,code
             FROM pm_transaction_log
             JOIN tbl_users
             ON to_user_id = id
             JOIN cities c
             ON city_id = c.id
             JOIN countries co
             ON co.id = c.country_id
             WHERE tr_kind_id = 2
             LIMIT 6  ');
        $listCommission = $list->query();
        $listCommission = $listCommission->read();
        if($amountCommissionCount['sum(amount)'] != null){
        $this->dataPull['numberField'] = '$' . $this->jmws_money_converter($amountCommissionCount['sum(amount)']);
        foreach ($listCommission as $commision) {
            $this->dataPull['userList'][0]['country'] = $listCommission['code'];
            $this->dataPull['userList'][0]['content'] = date('H:i', strtotime($listCommission['date'])). ' UTC '. $listCommission['first_name'] .' '. $listCommission['last_name'];
        }
        }else
        {
            $this->dataPull['numberField'] = '$00 000 000';
        }

    }
    
    /*addons special srevices*/
    private function jmws_money_converter($in) {
        $result = '';
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

}
