<?php

/**
 * This is the model class for table "pm_transaction_log".
 *
 * The followings are the available columns in table 'pm_transaction_log':
 * @property integer $tr_id
 * @property string $date
 * @property integer $from_user_id
 * @property string $from_purse
 * @property integer $to_user_id
 * @property string $to_purse
 * @property string $notation
 * @property double $amount
 * @property string $currency
 * @property integer $tr_kind_id
 * @property integer $tr_err_code
 */
class PmTransactionLog extends CActiveRecord
{
    //константы для обозначения типа транзакции
    const TRANSACTION_REGISTRATION = 1;
    const TRANSACTION_ENTER_BC = 2;
    const TRANSACTION_BC_BRONZE = 3;
    const TRANSACTION_BC_SILVER = 4;
    const TRANSACTION_BC_GOLD = 5;
    const TRANSACTION_COMMISSION = 6;
    const TRANSACTION_CHARITY = 7;
    const TRANSACTION_PRIZE = 8;
        public $statisticsStructure;
        public $id;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pm_transaction_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
        
        public function init() {
            parent::init();
            $this->dateInit();
            $this->statisticsStructure = array(
                'Checks'=>'', // формирутеся полоса по всем чекам для данного пользователя
                'IncomeToday' => 0, // Чеки - все доходы за день 
                'IncomeCommon'=> 0, // Чеки - все доходы за все время
                'Charity'=>array( // блок благотворительности 
                    'today'=>0,
                    'permonth'=>0,
                    'common'=>0,
                ),
                'Staff'=>array( // блок структуры и бизнесс-клуба
                    'privateStructure'=>0,
                    'businessClub'=>0,
                ),
                'Visitors'=>array( // посетители странички пользователя
                    'today'=>0,
                    'tomorrow'=>0,
                    'permonth'=>0,
                    'common'=>0
                ),
            );
        }


        public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('from_purse, to_purse', 'required'),
			array('from_user_id, to_user_id, tr_kind_id, tr_err_code', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('from_purse, to_purse, notation', 'length', 'max'=>255),
			array('currency', 'length', 'max'=>3),
                        array('date', 'date', 'format'=>'dd.mm.yyyy'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tr_id, date, from_user_id, from_purse, to_user_id, to_purse, notation, amount, currency, tr_kind_id, tr_err_code', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
        
	public function attributeLabels()
	{
		return array(
			'tr_id' => 'Tr',
			'date' => 'Date',
			'from_user_id' => 'From User',
			'from_purse' => 'From Purse',
			'to_user_id' => 'To User',
			'to_purse' => 'To Purse',
			'notation' => 'Notation',
			'amount' => 'Amount',
			'currency' => 'Currency',
			'tr_kind_id' => 'Tr Kind',
			'tr_err_code' => 'Tr Err Code',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('tr_id',$this->tr_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('from_user_id',$this->from_user_id);
		$criteria->compare('from_purse',$this->from_purse,true);
		$criteria->compare('to_user_id',$this->to_user_id);
		$criteria->compare('to_purse',$this->to_purse,true);
		$criteria->compare('notation',$this->notation,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('tr_kind_id',$this->tr_kind_id);
		$criteria->compare('tr_err_code',$this->tr_err_code);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PmTransactionLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
            return parent::model($className);
	}
        /* runtimes */
        public function statisticaStandard(){ // включает цепь методов для формирования странички статистики
            $this->checksTableFormer();
            $this->checkSummFormer();
            $this->charityFormer();
            $this->structureFormer();
            
        }
        /* Цепь функций */
        protected function checksTableFormer(){ // формирующая блока Checks
            $dbh = Yii::app()->db;
            $date = $this->dateConvertToDb($this->date);
            $mainSQL = "SELECT tbu.first_name,tbu.last_name,tbu.refer_id, tbu.inviter_id,trlog.date,trlog.amount,trkind.description
                     FROM pm_transaction_log trlog
                     LEFT JOIN tbl_users tbu ON tbu.id = trlog.from_user_id
                     LEFT JOIN pm_transaction_kind trkind 
                     ON trlog.tr_kind_id = trkind.kind_id
                     WHERE trlog.tr_err_code IS NULL
                     AND trlog.date >= DATE(:date)
                     AND trlog.date < DATE_ADD(:date, INTERVAL 1 DAY)
                     AND trlog.to_user_id = :id";
            $mainCommand = $dbh->createCommand($mainSQL);
            $mainCommand->bindParam(':date', $date, PDO::PARAM_STR);
            $mainCommand->bindParam(':id', $this->id, PDO::PARAM_INT);
            $resource = $mainCommand->query();
            //var_dump($date,$this->id,$resource->readAll());die;
            foreach($resource->readAll() as $rec){
                if($rec['refer_id'] == NULL && $rec['inviter_id'] == NULL){ // сборка безфамильной строки
                    $this->statisticsStructure['Checks'] .= '<tr>'
                            . '<td width="234">'.$this->dateConvertToSite($rec['date'], $choise='long').'</td>'
                            .'<td width="308">+'.$rec['amount'].'$</td>'
                            .'<td width="308">'.$rec['description'].'</td>'
                            . '</tr>';
                }else{ // сборка фамильярной строки
                    $buff = ($rec['refer_id'] === $rec['inviter_id'])? 'Личный в команде' : 'Чужой в команде';
                    $this->statisticsStructure['Checks'] .= '<tr>'
                            . '<td width="234">'.$this->dateConvertToSite($rec['date'], $choise='long').'</td>'
                            .'<td width="308">+'.$rec['amount'].'$</td>'
                            .'<td width="308" style="padding-top:20px;">'.$rec['first_name'].' '.$rec['last_name'].'<br>'.$buff.'</td>'
                            . '</tr>';
                }
                
            }
        }
        protected function checkSummFormer(){
            $dbh = Yii::app()->db;
            $date = $this->dateConvertToDb($this->date);
            $todaySQL = "SELECT
                            sum(amount) summ
                            FROM pm_transaction_log
                            WHERE to_user_id = :id
                            AND tr_err_code IS NULL
                            AND tr_kind_id IN (2, 6, 8)
                            AND date >= DATE(:date)
                            AND date < DATE_ADD(:date, INTERVAL 1 DAY)";
            $todaySumm = $dbh->createCommand($todaySQL);
            $todaySumm->bindParam(':date', $date, PDO::PARAM_STR);
            $todaySumm->bindParam(':id', $this->id, PDO::PARAM_INT);
            $param = $todaySumm->query()->read()['summ'];
            $this->statisticsStructure['IncomeToday'] = (!is_null($param)) ? $param : '0';
            $commonSQL = 'SELECT
                            sum(amount) summ
                            FROM pm_transaction_log
                            WHERE to_user_id = :id
                            AND tr_err_code IS NULL
                            AND tr_kind_id IN (2, 6, 8)';
            $commonSumm = $dbh->createCommand($commonSQL);
            $commonSumm->bindParam(':id', $this->id, PDO::PARAM_INT);
            $param = $commonSumm->query()->read()['summ'];
            $this->statisticsStructure['IncomeCommon'] = (!is_null($param)) ? $param : '0';
                                           
        }
        /* Благотворительность */
        protected function charityFormer(){
            // today permonth common
            $dbh = Yii::app()->db;
            
            $date = $this->dateConvertToDb($this->date);
            $todaySQL = "SELECT
                            sum((amount*0.05)) summ
                            FROM pm_transaction_log
                            WHERE from_user_id = :id
                            AND tr_err_code IS NULL
                            AND tr_kind_id IN (2,3,4,5)
                            AND date >= DATE(:date)
                            AND date < DATE_ADD(:date, INTERVAL 1 DAY)";
            $today = $dbh->createCommand($todaySQL);
            $today->bindParam(':date', $date, PDO::PARAM_STR);
            $today->bindParam(':id', $this->id, PDO::PARAM_INT);
            $param = $today->query()->read()['summ'];
            $this->statisticsStructure['Charity']['today'] = (!is_null($param)) ? $param : '0';
            
            $date = $this->dateConvertToDb($this->date, TRUE);
            $permonthSQL = "SELECT
                                sum((amount*0.05)) summ
                                FROM pm_transaction_log
                                WHERE from_user_id = :id
                                AND tr_err_code IS NULL
                                AND tr_kind_id IN (2,3,4,5)
                                AND date >= DATE(:date)
                                AND date < DATE_ADD(:date, INTERVAL 1 MONTH)";
            $permonth = $dbh->createCommand($permonthSQL);
            $permonth->bindParam(':date', $date, PDO::PARAM_STR);
            $permonth->bindParam(':id', $this->id, PDO::PARAM_INT);
            $param = $permonth->query()->read()['summ'];
            $this->statisticsStructure['Charity']['permonth'] = (!is_null($param))? $param : '0';
                        
            $commonSQL = "SELECT
                            sum((amount*0.05)) summ
                            FROM pm_transaction_log
                            WHERE from_user_id = :id
                            AND tr_err_code IS NULL
                            AND tr_kind_id IN (2,3,4,5)";
            $common = $dbh->createCommand($commonSQL);
            $common->bindParam(':id', $this->id, PDO::PARAM_INT);
            $param = $common->query()->read()['summ'];
            $this->statisticsStructure['Charity']['common'] = (!is_null($param)) ? $param : '0';
        }
        /* Structure */
        protected function structureFormer(){
            $dbh = Yii::app()->db;
            
            $date = $this->dateConvertToDb($this->date);
            
            $privateSQL = "SELECT
                                count(id) count
                                FROM tbl_users
                                WHERE refer_id = :id
                                AND status = 1
                                AND busy_date >= DATE(:date)
                                AND busy_date < DATE_ADD(:date, INTERVAL 1 DAY)";          
            $private = $dbh->createCommand($privateSQL);
            $private->bindParam(':date', $date, PDO::PARAM_STR);
            $private->bindParam(':id', $this->id, PDO::PARAM_INT);
            $param = $private->query()->read()['count'];
            $this->statisticsStructure['Staff']['privateStructure'] = (!is_null($param)) ? $param : '0';
            
            $clubSQL = "SELECT
                         count(id) count 
                         FROM tbl_users
                         WHERE refer_id = :id
                         AND status = 1
                         AND club_date >= DATE(:date)
                         AND club_date < DATE_ADD(:date, INTERVAL 1 DAY)
                         AND tariff_id >= 3";
            $club = $dbh->createCommand($clubSQL);
            $club->bindParam(':date', $date, PDO::PARAM_STR);
            $club->bindParam(':id', $this->id, PDO::PARAM_INT);
            $param = $club->query()->read()['count'];
            $this->statisticsStructure['Staff']['businessClub'] = (!is_null($param)) ? $param : '0';            
        }
        /* Преобразование даты к формату для базы данных */
        public function dateConvertToSite($date_from_db, $choise='short'){
            $date = strtotime($date_from_db);
            $date = date('d.m.Y H:i', $date);
            list($short, $long) = explode(' ', $date);
            $format = array('short'=>$short, 'long'=>$short.' '.$long);
                return $format[$choise];
        }
        public function dateConvertToDb($date_from_site, $firstDayNeed = FALSE){
            if($firstDayNeed){
                $date = $this->resetMonth($date_from_site);
            }else{
                $date = $date_from_site;
            }
            $date = array_reverse(explode('.', $date));
            $date = implode('-', $date);
            return $date;
        }
        public function dateInit(){ // инициализация даты в зависимости от ее наличия/отсутствия в $_POST
            if(!is_null($date = Yii::app()->request->getParam('date'))){
                $this->date = $date;
            }else{
                $this->date = date('d.m.Y');
            }
        }
        /* Служебное */
       protected function resetMonth($date){ // сброс даты в первое число
            $buff = explode('.', $date);
            $buff[0] = '01';
            $date = implode('.', $buff);
            return $date;
       }
}