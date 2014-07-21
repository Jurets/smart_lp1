<?php
class SiapInstructions extends CActiveRecord{
    public $period_id; // oufschtrassen fur enden
    public $begin;
    public $end;
    
//    public $user_id;
//    public $purse;
//    public $amount;
//    public $instruction_result;
//    public $log_reff;
    
    private $dbh; // описатель соединени с БД
    
    protected $formules; // список алгоритмов кошельков
    protected $AmountSummB; // Суммарный расчетный балланс по транзакциям в кошелек B
    protected $invoices; // массив отдельных сумм из общего кошелька
    protected $club_users; // 4 массива клубных юзеров: B0, B1 B2 B3 все по ним содержит
    // [p_20] 20% – поступают на счет А.
    // [p_rnd_b3] random B3 3%
    // [p_rnd_b2] random B2 1.5%
    // [p_rnd_b1] random B1 0.5%
    // [p_70] 70% - фонд выплат B0, B1, B2, B3 - яамая нагруженная часть. Вызывать последней.
    protected $systemPurses; // A, B, F - по этим ключам записываются соответствующие системные кошельки
    
     public static function model($className=__CLASS__)
    {
	return parent::model($className);
    }
    public function init(){
        $this->dbh = Yii::app()->db;
        $this->setSystemPurses();
        $this->period_id = NULL; $this->user_id = NULL; $this->purse = ''; $this->amount = 0;
        $this->instruction_result = 0; $this->log_reff = NULL;
        $this->invoices = array(); // Контейнер платежных инструкций по клубу
        $this->formules = array(); // контейнеры-формирующие простые платежные инструкции
        $this->club_users = array(
            'B0'=>array(),
            'B1'=>array(),
            'B2'=>array(),
            'B3'=>array(),
        );
                            $this->club_users['B0']['count'] = 0;
                            $this->club_users['B1']['count'] = 0;
                            $this->club_users['B2']['count'] = 0;
                            $this->club_users['B3']['count'] = 0;
                            
                            $this->club_users['B0']['countNew'] = 0;
                            $this->club_users['B1']['countNew'] = 0;
                            $this->club_users['B2']['countNew'] = 0;
                            $this->club_users['B3']['countNew'] = 0;
                            
                            $this->club_users['B0']['amount'] = (double)0;
                            $this->club_users['B1']['amount'] = (double)0;
                            $this->club_users['B2']['amount'] = (double)0;
                            $this->club_users['B3']['amount'] = (double)0;
                            
                            $this->club_users['B0']['struct'] = array();
                            $this->club_users['B1']['struct'] = array();
                            $this->club_users['B2']['struct'] = array();
                            $this->club_users['B3']['struct'] = array();
        // Инициализация независимых расчетных действий
        $this->formules['p_20'] = function(){
            $sql = "INSERT INTO sip_instructions (period_id, user_id, purse, amount, tr_kind_id) VALUES(:period_id, NULL, :purse, :invoice, 9)";
            $command = $this->dbh->createCommand($sql);
            $command->bindParam(':period_id', $this->period_id);
            $command->bindParam(':purse', $this->systemPurses['A']);
            $command->bindParam(':invoice', $this->invoices['p_20']);
            $command->execute();
        };
        $this->formules['p_F'] = function(){
            $sql = "INSERT INTO sip_instructions (period_id, user_id, purse, amount, tr_kind_id) VALUES(:period_id, NULL, :purse, :invoice, 7)";
            $command = $this->dbh->createCommand($sql);
            $command->bindParam(':period_id', $this->period_id);
            $command->bindParam(':purse', $this->systemPurses['F']);
            $command->bindParam(':invoice', $this->invoices['p_F']);
            $command->execute();
        };
    }
    public function tableName(){
        return 'sip_instructions';
    }
    public function rules(){
       return array(
           'id, period_id, user_id, purse, amount, instruction_result, log_reff', 'safe',
       ); 
    }
    
    /* Служебное */
    protected function setSystemPurses(){ // запускается при ините объекта модели
        $systemPursesSQL = 'SELECT purse_activation, purse_club, purse_fdl FROM requisites WHERE id = "JVMS" ';
        $systemPurses = $this->dbh->createCommand($systemPursesSQL)->query()->read();
        if(is_null($systemPurses)){
            throw new CHttpException('500', 'System purses not found, check the requisites table');
        }
        $this->systemPurses = array(
            'A'=>$systemPurses['purse_activation'],
            'B'=>$systemPurses['purse_club'],
            'F'=>$systemPurses['purse_fdl'],
        );
    }
    
    /* runtimes */
   public static function makePeriodInstructions($periodSource=array()){
       $model = new SiapInstructions;
       $model->originalSettings($periodSource);
       $model->fillB();
       // Вызов PM_ballance для кошелька B 
       // и принятие решений о вызове расчетных методов-формул 
       // (если реальный балланс < посчитанный, то 
       // запретить формирование всех инструкций за этот период)
       // методика пока отложена. Нет доступа к системному кошельку
       $model->fillInvoices();
       $model->setClubUsers();
       $model->dependFormulesInit();
       $model->calculateClub();
       $model->instructionsCreate();
       
       return array(
           'period_id'=>$model->period_id,
           'begin'=>$model->begin,
           'end'=>$model->end,
       );
   }
   /* Служебное */
   protected function fillB(){ // вычисление содержимого кошелька B за указанный период
       $B_SQL = "SELECT sum(amount) summ
                        FROM pm_transaction_log
                        WHERE tr_err_code IS NULL
                        AND tr_kind_id IN (2,3,4,5)
                        AND to_user_id IS NULL
                        AND date >= :begin
                        AND date < :end";
       $B = $this->dbh->createCommand($B_SQL);
       $B->bindParam(':begin', $this->begin, PDO::PARAM_STR);
       $B->bindParam(':end', $this->end, PDO::PARAM_STR);
       $param = $B->query()->read()['summ'];
       $this->AmountSummB = (!is_null($param)) ? (float)$param : '0';
   }
   protected function fillInvoices(){
       $this->invoices['p_20'] = $this->AmountSummB * 0.2;
       $this->invoices['p_rnd_b3'] = $this->AmountSummB * 0.03;
       $this->invoices['p_rnd_b2'] = $this->AmountSummB * 0.015;
       $this->invoices['p_rnd_b1'] = $this->AmountSummB * 0.005;
       $this->invoices['p_F'] = $this->AmountSummB * 0.05;
       $this->invoices['p_70'] = $this->AmountSummB * 0.7;
   }
   // собираем структуру всех клубных юзеров (init procedure)
   protected function setClubUsers(){
       /* Получаем исходники по всем клубам */
       $club_all_SQL = "SELECT id, tariff_id, club_date, purse
                    FROM tbl_users
                    WHERE tariff_id IN(3, 4, 5, 6)";
       $source_сlub_all = $this->dbh->createCommand($club_all_SQL)->query()->readAll();
       if(is_null($source_сlub_all)) {throw new CHttpException('500', 'No Club Users present');}
       /* сборка структуры клубов без новых (новые подгрузятся специальными каунтерами) */
       $this->B_Struct_Creator($source_сlub_all);
   }
  
   protected function B_Struct_Creator($source_club_all){
       $b0 = 0; $b1 = 0; $b2 = 0; $b3 = 0;
       foreach ($source_club_all as $club) {
          switch($club['tariff_id']){
              case '3':
                  $this->club_users['B0']['count'] += 1;
                  $this->club_users['B0']['struct'][$b0]['id'] = $club['id'];
                  $this->club_users['B0']['struct'][$b0]['purse'] = $club['purse'];
                  $b0 ++ ;
                  break;
              case '4':
                  $this->club_users['B1']['count'] += 1;
                  $this->club_users['B1']['struct'][$b1]['id'] = $club['id'];
                  $this->club_users['B1']['struct'][$b1]['purse'] = $club['purse'];
                  $b1 ++ ;
                  break;
              case '5':
                  $this->club_users['B2']['count'] += 1;
                  $this->club_users['B2']['struct'][$b2]['id'] = $club['id'];
                  $this->club_users['B2']['struct'][$b2]['purse'] = $club['purse'];
                  $b2 ++;
                  break;
              case '6':
                  $this->club_users['B3']['count'] += 1;
                  $this->club_users['B3']['struct'][$b3]['id'] = $club['id'];
                  $this->club_users['B3']['struct'][$b3]['purse'] = $club['purse'];
                  $b3 ++ ;
                  break;
          } 
          if($club['club_date']>=$this->begin && $club['club_date']<$this->end){
              $this->club_users['B0']['countNew'] +=1;
          }
       }
       /* Вызовы каунтеров для установки новых членов клуба */
       $this->B1_NEW_Counter();
       $this->B2_NEW_Counter();
       $this->B3_NEW_Counter();
   }
  
   protected function B1_NEW_Counter(){
       $sql = " SELECT COUNT(from_user_id) howmuch
                FROM pm_transaction_log
                WHERE to_user_id IS NULL
                AND date >= :date_begin
                AND date < :date_end
                AND tr_err_code IS NULL
                AND tr_kind_id = 3 ";
       $c = $this->dbh->createCommand($sql);
       $c->bindParam(':date_begin', $this->begin, PDO::PARAM_STR);
       $c->bindParam(':date_end', $this->end, PDO::PARAM_STR);
       $source = $c->query()->read()['howmuch'];
       $this->club_users['B1']['countNew'] = (!is_null($source))? $source : 0;
   }
   protected function B2_NEW_Counter(){
       $sql = " SELECT COUNT(from_user_id) howmuch
                FROM pm_transaction_log
                WHERE to_user_id IS NULL
                AND date >= :date_begin
                AND date < :date_end
                AND tr_err_code IS NULL
                AND tr_kind_id = 4 ";
       $c = $this->dbh->createCommand($sql);
       $c->bindParam(':date_begin', $this->begin, PDO::PARAM_STR);
       $c->bindParam(':date_end', $this->end, PDO::PARAM_STR);
       $source = $c->query()->read()['howmuch'];
       $this->club_users['B2']['countNew'] = (!is_null($source))? $source : 0;
   }
   protected function B3_NEW_Counter(){
       $sql = " SELECT COUNT(from_user_id) howmuch
                FROM pm_transaction_log
                WHERE to_user_id IS NULL
                AND date >= :date_begin
                AND date < :date_end
                AND tr_err_code IS NULL
                AND tr_kind_id = 5 ";
       $c = $this->dbh->createCommand($sql);
       $c->bindParam(':date_begin', $this->begin, PDO::PARAM_STR);
       $c->bindParam(':date_end', $this->end, PDO::PARAM_STR);
       $source = $c->query()->read()['howmuch'];
       $this->club_users['B3']['countNew'] = (!is_null($source))? $source : 0;
   }
   // Зависимые формулы зависят от B_Struct_Creator (вызов формул только после вызова B_Struct_Creator)
   // Формулы производят запросы в базу данных
   protected  function dependFormulesInit(){
       $this->formules['p_rnd_b1'] = function(){
           $buff = array();
           $buff = $this->club_users['B1']['struct'];
           if(empty($buff)){
               // логируем
               return 0;
           }
           shuffle($this->club_users['B1']['struct']);
            $sql = "INSERT INTO sip_instructions 
                    (period_id, user_id, purse, amount, tr_kind_id)
                    VALUES(:period_id, :user_id, :purse, :invoice, 8)";
            $command = $this->dbh->createCommand($sql);
            $command->bindParam(':period_id', $this->period_id);
            $command->bindParam(':user_id', $buff[0]['id']);
            $command->bindParam(':purse', $buff[0]['purse']);
            $command->bindParam(':invoice', $this->invoices['p_rnd_b1']);
            $command->execute();
       };
       $this->formules['p_rnd_b2'] = function(){
            $buff = array();
           $buff = $this->club_users['B2']['struct'];
           if(empty($buff)){
               // логируем
               return 0;
           }
           shuffle($buff);
            $sql = "INSERT INTO sip_instructions (period_id, user_id, purse, amount, tr_kind_id) VALUES(:period_id, :user_id, :purse, :invoice, 8)";
            $command = $this->dbh->createCommand($sql);
            $command->bindParam(':period_id', $this->period_id);
            $command->bindParam(':user_id', $buff[0]['id']);
            $command->bindParam(':purse', $buff[0]['purse']);
            $command->bindParam(':invoice', $this->invoices['p_rnd_b2']);
            $command->execute();
       };
       $this->formules['p_rnd_b3'] = function(){
            $buff = array();
           $buff = $this->club_users['B3']['struct'];
           if(empty($buff)){
               // логируем
               return 0;
           }
           shuffle($buff);
            $sql = "INSERT INTO sip_instructions (period_id, user_id, purse, amount, tr_kind_id) VALUES(:period_id, :user_id, :purse, :invoice, 8)";
            $command = $this->dbh->createCommand($sql);
            $command->bindParam(':period_id', $this->period_id);
            $command->bindParam(':user_id', $buff[0]['id']);
            $command->bindParam(':purse', $buff[0]['purse']);
            $command->bindParam(':invoice', $this->invoices['p_rnd_b3']);
            $command->execute();
       };
       
       /* Формулы не производят запросов, лишь дополняют структуры членов клуба
        * их запуск - в отдельном враппере calculateClub
        *  */
       $this->formules['calc_B0_Amount'] = function(){
           /* AllNewClubMembers * 100 / AllClubMembers * 0.7 */
           $AllNewClubMembers = 
                   $this->club_users['B0']['countNew'] +
                   $this->club_users['B1']['countNew'] +
                   $this->club_users['B2']['countNew'] +
                   $this->club_users['B3']['countNew'];
           $AllClubMembers = 
                   $this->club_users['B0']['count'] +
                   $this->club_users['B1']['count'] +
                   $this->club_users['B2']['count'] +
                   $this->club_users['B3']['count'];
           if((int)$AllClubMembers == 0){ // protection divizion by zero
               $this->club_users['B0']['amount'] = 0;
               // Возможно, залогировать
               return 0;
           }
           $this->club_users['B0']['amount'] = $AllNewClubMembers * 100 / $AllClubMembers * 0.7;
       };
       
       $this->formules['calc_B1_Amount'] = function(){
          /* B0 + newB1 * 100 / AllB1 * 0.7 */
           $B0 = (double)$this->club_users['B0']['amount'];
           $AllB1 = (int)$this->club_users['B1']['count'];
           /* divizion by zero protection */
           if($AllB1 == 0){$this->club_users['B1']['amount'] = 0; return 0;}
           $newB1 = (int)$this->club_users['B1']['countNew'];
           $this->club_users['B1']['amount'] = $B0 + $newB1 * 100 / $AllB1 * 0.7;
       };
       
       $this->formules['calc_B2_Amount'] = function(){
          /* B0 + newB2 * 500 / AllB2 * 0.7 */
           $B0 = (double)$this->club_users['B0']['amount'];
           $AllB2 = (int)$this->club_users['B1']['count'];
           /* divizion by zero protection */
           if($AllB2 == 0){$this->club_users['B2']['amount'] = 0; return 0;}
           $newB2 = (int)$this->club_users['B2']['countNew'];
           $this->club_users['B2']['amount'] = $B0 + $newB2 * 500 / $AllB2 * 0.7;
       };
       
       $this->formules['calc_B3_Amount'] = function(){
          /* B0 + newB3 * 1000 / AllB2 * 0.7 */
           $B0 = (double)$this->club_users['B0']['amount'];
           $AllB3 = (int)$this->club_users['B3']['count'];
           /* divizion by zero protection */
           if($AllB3 == 0){$this->club_users['B3']['amount'] = 0; return 0;}
           $newB3 = (int)$this->club_users['B3']['countNew'];
           $this->club_users['B3']['amount'] = $B0 + $newB3 * 1000 / $AllB3 * 0.7;
       };
       
   }
   protected function calculateClub(){
       $this->formules['calc_B0_Amount']();
       $this->formules['calc_B1_Amount']();
       $this->formules['calc_B2_Amount']();
       $this->formules['calc_B3_Amount']();
   }
   protected function instructionsCreate(){
       $sql_B0 = $this->sql_constructio($this->club_users['B0']);
       $sql_B1 = $this->sql_constructio($this->club_users['B1']);
       $sql_B2 = $this->sql_constructio($this->club_users['B2']);
       $sql_B3 = $this->sql_constructio($this->club_users['B3']);
       $transaction = $this->dbh->beginTransaction();
       try{
           $this->formules['p_20']();
           $this->formules['p_F']();
           $this->formules['p_rnd_b3']();
           $this->formules['p_rnd_b2']();
           $this->formules['p_rnd_b1']();
           
        if($this->club_users['B0']['count'] > 0)
           $this->dbh->createCommand($sql_B0)->execute();
        if($this->club_users['B1']['count'] > 0)
           $this->dbh->createCommand($sql_B1)->execute();
        if($this->club_users['B2']['count'] > 0)
           $this->dbh->createCommand($sql_B2)->execute();
        if($this->club_users['B3']['count'] > 0)
           $this->dbh->createCommand($sql_B3)->execute();
           
           $transaction->commit();
           
       } catch (Exception $ex) {
           // Логирование возможно
           $transaction->rollback();
       }
   }
   protected function sql_constructio($clubPart){
       $sql = "INSERT INTO sip_instructions (period_id, user_id, purse, amount, tr_kind_id) VALUES ";
       foreach($clubPart['struct'] as $one){
          $sql .= "(".$this->period_id.','.$one['id'].','."'".$one['purse']."'".','.$clubPart['amount'].',6),'; 
       }
       $sql[strrpos($sql, ',')] = ';';
       return $sql;
   }
   protected function originalSettings($periodSource){
       if(empty($periodSource)){
           throw new CHttpException('500', 'can`t make instructions. Source data not available');   
       }
       if(!isset($periodSource['period_id'])){
           $sql = "SELECT id FROM sip_periodes WHERE begin=:date_begin AND end=:date_end";
           $c = $this->dbh->createCommand($sql);
           $c->bindParam(':date_begin', $periodSource['date_begin'], PDO::PARAM_STR);
           $c->bindParam(':date_end', $periodSource['date_end'], PDO::PARAM_STR);
           $res = $c->query()->read();
           if(is_null($res)){
               throw new CHttpException('500', 'Wrong id of interval parameters');
           }else{
               $this->period_id = $res['id'];
               $this->begin = $periodSource['date_begin'];
               $this->end = $periodSource['date_end'];
               return 0;
           }
       }
       if(!isset($periodSource['date_begin']) || !isset($periodSource['date_end'])){
           $sql = "SELECT begin, end FROM sip_periodes WHERE id=:id";
           $c = $this->dbh->createCommand($sql);
           $c->bindParam(':id', $periodSource['period_id'], PDO::PARAM_INT);
           $res = $c->query()->read();
           if(is_null($res) || $res == FALSE){
              throw new CHttpException('500', 'Wrong date of interval parameters'); 
           }else{
               $this->period_id = $periodSource['period_id'];
               $this->begin = $res['begin'];
               $this->end = $res['end'];
               return 0;
           }
       }
       /* Все параметры заданы полностью, вычисления не требуются */
       $this->period_id = $periodSource['period_id'];
       $this->begin = $periodSource['date_begin'];
       $this->end = $periodSource['date_end'];
   }
}

