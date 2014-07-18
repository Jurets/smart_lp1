<?php
class SiapInstructions extends CActiveRecord{
    public $period_id; // oufschtrassen fur enden
    public $begin;
    public $end;
    
    public $user_id;
    public $purse;
    public $amount;
    public $instruction_result;
    public $log_reff;
    
    private $dbh; // описатель соединени с БД
    
    protected $formules; // список алгоритмов кошельков
    protected $AmountSummB; // Суммарный расчетный балланс по транзакциям в кошелек B
    protected $invoices; // массив отдельных сумм из общего кошелька
    protected $club_users; // 4 массива клубных юзеров.
    // [p_20] 20% – поступают на счет А.
    // [p_rnd_b3] random B3 3%
    // [p_rnd_b2] random B2 1.5%
    // [p_rnd_b1] random B1 0.5%
    // [p_70] 70% - фонд выплат B0, B1, B2, B3 - яамая нагруженная часть. Вызывать последней.
    protected $systemPurses; // A, B, F - по этим ключам записываются соответствующие системные кошельки
    
    public function init(){
        $this->dbh = Yii::app()->db;
        $this->setSystemPurses();
        $this->period_id = NULL; $this->user_id = NULL; $this->purse = ''; $this->amount = 0;
        $this->instruction_result = 0; $this->log_reff = NULL;
        $this->invoices = array();
        $this->formules = array();
        // Инициализация расчетных действий
        $this->formules['p_20'] = function(){
            $sql = "INSERT INTO sip_instructions (period_id, user_id, purse, amount) VALUES(:period_id, NULL, :purse, :invoice)";
            $command = $this->dbh->createCommand($sql);
            $command->bindParam(':period_id', $this->period_id);
            $command->bindParam(':purse', $this->systemPurses['A']);
            $command->bindParam(':invoice', $this->invoices['p_20']);
            $command->execute();
        };
        $this->formules['p_rnd_b3'] = function(){
          $sql = "INSERT INTO sip_instructions ()";  
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
    private function setSystemPurses(){ // запускается при ините объекта модели
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
       if(empty($periodSource)){
           throw new CHttpException('500', 'can`t make instructions. Source data not available');
       }
       $model = new SiapInstructions;
       $model->period_id = $periodSource['period_id'];
       $model->begin = $periodSource['date_begin'];
       $model->end = $periodSource['date_end'];
       $model->fillB();
       // Вызов PM_ballance для кошелька B 
       // и принятие решений о вызове расчетных методов-формул 
       // (если реальный балланс < посчитанный, то 
       // запретить формирование всех инструкций за этот период)
       $model->fillInvoices();
       //$model->formules['p_20']();
       var_dump($model->AmountSummB);die;
       
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
   // собираем структуру всех клубных юзеров 
   protected function setClubUsers(){
       $club_all = "SELECT id, tariff_id, club_date FROM tbl_users WHERE tariff_id IN(3, 4, 5, 6) ";
   }
}

