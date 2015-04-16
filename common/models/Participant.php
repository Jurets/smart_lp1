<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property integer $author
 * @property string $created
 * @property string $activated
 * @property string $title
 * @property string $announcement
 * @property string $content
 * @property string $image
 * @property integer $activity
 * @var integer $id
 * @var string $username
 * @var string $password
 * @var string $email
 * @var string $newPurse
 * @var string $activkey
 * @var integer $createtime
 * @var integer $lastvisit
 * @var integer $superuser
 * @var integer $income
 * @var integer $transfer_fund
 * @property integer $status
 * @var timestamp $create_at
 * @var timestamp $lastvisit_at
 * @var string $logincode
 */
class Participant extends User {

    //константы для обозначения тарифа участника
    const TARIFF_START = 0;
    const TARIFF_20 = 1;
    const TARIFF_50 = 2;
    const TARIFF_BC = 3;
    const TARIFF_BC_BRONZE = 4;
    const TARIFF_BC_SILVER = 5;
    const TARIFF_BC_GOLD = 6;
    // константы для обозначения тарифа бота
    const BOT_50 = 22; // рядовой бот
    const BOT_BC = 23; // бот - рядовой член бизнес-клуба
    const BOT_BC_BRONZE = 24; // бронзовый бот
    const BOT_BC_SILVER = 25; // серебряный бот
    const BOT_BC_GOLD = 26; // золотой бот

    //масив для бизнес-тарифов 
    // * термин "тарифы" (вместо "статусы" как в ТЗ) здесь и далее применяется для того, чтобы отличить их от статуса активности/неактивности
    private $_businessclubIDs = array(
        self::TARIFF_BC,
        self::TARIFF_BC_BRONZE,
        self::TARIFF_BC_SILVER,
        self::TARIFF_BC_GOLD,
        
        self::BOT_50,
        self::BOT_BC,
        self::BOT_BC_BRONZE,
        self::BOT_BC_SILVER,
        self::BOT_BC_GOLD
    );
    //поле страны - нужно для помощи при выборе города (т.к. у юзера поля страны нет, а поле города - есть)
    public $country_id;
    //поле (логическое) согласия регистрируемого участника
    public $rulesAgree;
    //поле новый тариф (используется на формах регистрации)
    public $newTariff = null;
    //поле новый кошелек (используется на форме настройки при изменении старого кошелька)
    public $newPurse;
    //поле для сравнения текущего пароля
    public $currentPassword;
    //поле для сравнения текущего пароля
    public $newPassword;
    //переданный постом код активации (используетсяна формах регистрации для контроля)
    public $postedActivKey = null;
    // поле статуса пользователя, если он - бот
    public $bot = array();
    //ниже идут загрушки для отображения колонок, смысл которых пока неясен ))
    public $structure = null;
    public $business = null;
    public $checks = null;
    public $fdl = null;
    public $time = null;
    public $structureMembers = null; // для массива моделей тех пользователей, для которых текущий (авторизованный) пользователь есть реферал
    public $clubMembers = null; // здесь лежат пользователи, которые попали в куб
    private $dict_participant = 'participant';

    
    public function init() {
        parent::init();
        $this->bot = array(
            self::BOT_50 => BaseModule::t('rec', '$50').' - fake user',
          //  self::BOT_BC => BaseModule::t('rec', 'investor B1').' - bot',
            self::BOT_BC_BRONZE => BaseModule::t('rec', 'investor B0'),
          //  self::BOT_BC_SILVER => BaseModule::t('rec', 'investor B3').' - bot',
          //  self::BOT_BC_GOLD => BaseModule::t('rec', 'investor B4').' - bot'
        );
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        //NOTE: you should only define rules for those attributes that
        //will receive user inputs.
        return CMap::mergeArray(parent::rules(), array(
                    array('tariff_id, city_id, first_name, last_name, country_id, city_id, gmt_id, dob, phone, skype, refer_id,income,transfer_fund, create_at', 'safe'),
                    array('id', 'safe', 'on' => array('search', 'seestructure', 'structure')),
                    //регистрация 'required'
                    array('password', 'default', 'value' => $this->_generatePassword(), 'on' => array('activate')),
                    array('username, country_id, city_id, email, rulesAgree, newTariff, postedActivKey', 'safe', 'on' => array('register')),
                    array('username, country_id, city_id, email, rulesAgree', 'required', 'on' => array('register')),
                    array('username', 'filter', 'filter' => 'strtolower', 'on' => array('register')),
                    array('rulesAgree', 'compare', 'compareValue' => true, 'on' => array('register'), 'message' => BaseModule::t('rec', 'It is necessary to accept the Membership Agreement')),
                    //The following rule is used by search().
                    //@todo Please remove those attributes that should not be searched.
                    //array('id, author, created, activated, title, announcement, content, image, activity', 'safe', 'on'=>'search'),
                    array('purse', 'safe', 'on' => array('setpurse')),
                    array('purse, newPurse', 'required', 'on' => array('setpurse')),
                    array('purse', 'unique'),
                    // Scenario for settings(update information)
                    array('username,newPurse,password,city_id, first_name, last_name, country_id, gmt_id, dob, phone, skype ', 'safe', 'on' => array('settings')),
                    array('email', 'email', 'on' => array('settings')),
                    array('username,city_id, country_id, gmt_id, dob', 'required', 'on' => array('settings')),
                    //array('currentPassword', 'passwordRule', 'allowEmpty' => true, 'on' => array('settings')),
                    //array('newPassword', 'newPasswordRule', 'allowEmpty' => true, 'on' => array('settings')),
                    array('photo', 'file', 'safe' => true, 'types' => 'jpg, gif, png',
                        'allowEmpty' => true, 'maxSize' => 5 * 2000 * 2000, 'tooLarge' => BaseModule::t('rec', 'The file weighs more than 2 MB. Please upload a smaller file'), 'on' => array('settings', 'register')),
        ));
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return CMap::mergeArray(parent::relations(), array(
                    //ссылка на объект-рефер для сабжа
                    'referal' => array(self::BELONGS_TO, 'Participant', 'refer_id'),
                    //ссылка на пригласившего для сабжа
                    'inviter' => array(self::BELONGS_TO, 'Participant', 'inviter_id'),
                    //кол-во подчинённых (т.е. тех, у которых сабж является рефером)
                    'subCount' => array(self::STAT, 'Participant', 'refer_id'),
                    //кол-во приглашенных (т.е. тех, кто начинал регистрацию под данным сабжем)
                    'inviteCount' => array(self::STAT, 'Participant', 'inviter_id', 'condition' => 'tariff_id >='.self::TARIFF_50),
                    //структура (?????)
                    'structure' => array(self::STAT, 'Participant', 'id'),
                    //тариф (статус по ТЗ)
                    'tariff' => array(self::BELONGS_TO, 'Tariff', 'tariff_id'),
                    //город
                    'city' => array(self::BELONGS_TO, 'Cities', 'city_id'),
                    //текущий бан в чате (его может и не быть!)
                    'chatban' => array(self::HAS_ONE, 'Chatban', 'user_id', 'condition' => 'active = 1' /* , 'limit'=>1 */),
                    //массив истории забанивания в чате
                    'chatbanhistory' => array(self::HAS_MANY, 'Chatban', 'user_id'),
                    //связи с pm_transaction_log
                    'pmtouser' => array(self::HAS_MANY, 'PmTransactionLog', 'to_user_id'),
                    'pmfromuser' => array(self::HAS_MANY, 'PmTransactionLog', 'from_user_id'),
        ));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return CMap::mergeArray(parent::attributeLabels(), array(
                    'create_at' => BaseModule::t('rec', "Created"),
                    'username' => BaseModule::t('rec', "Domain"),
                    'first_name' => BaseModule::t('rec', "Firstname"),
                    'last_name' => BaseModule::t('rec', "Lastname"),
                    'city_id' => BaseModule::t('rec', "City"),
                    'country_id' => BaseModule::t('rec', "Country"),
                    'structure' => BaseModule::t('rec', "Structure"),
                    'business' => BaseModule::t('rec', "Business Club"),
                    'refer_id' => BaseModule::t('rec', "Referal"),
                    'tariff_id' => BaseModule::t('rec', "Tariff"),
                    'phone' => BaseModule::t('rec', "Phone"),
                    'skype' => BaseModule::t('rec', "Skype"),
                    'dob' => BaseModule::t('rec', "Birthday"),
                    'gmt_id' => BaseModule::t('rec', "Gmt"),
                    'income' => BaseModule::t('rec', "Income"),
                    'transfer_fund' => BaseModule::t('rec', "Transfer to the Fund"),
        ));
    }

    /**
     * скоупы
     *
     */
    public function scopes() {
        return CMap::mergeArray(parent::scopes(), array(
                    'participant' => array(
                        'condition' => 'superuser = 0',
                    ),
                    'withoutself' => array(
                        'condition' => 'id <> :self_id',
                        'params' => array(':self_id' => $this->id)
                    ),
                    'superrefer' => array(
                        'condition' => 'superuser = 0 AND status = :status AND tariff_id >= :tariff_id',
                        'params' => array(':status' => self::STATUS_ACTIVE, ':tariff_id' => self::TARIFF_BC),
                    ),
        ));
    }

    public function passwordRule() {
        if (!empty($this->currentPassword) && $this->password != UserModule::encrypting($this->currentPassword)) {
            $this->addError('currentPassword', 'Неправильно введен текущий пароль.');
        }
    }

    public function newPasswordRule() {
        if (!empty($this->currentPassword) && empty($this->newPassword)) {
            $this->addError('newPassword', 'Введите новый пароль.');
        }
        if (strlen($this->newPassword) < 4) {
            $this->addError('newPassword', 'Пароль должен быть минимум 4 символа.');
        }
    }

    /**
     * геттер для массива бизнес-тарифов
     *
     */
    public function getBusinessclubIDs() {
        return $this->_businessclubIDs;
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $dataProvider = parent::search();
        if (!isset($dataProvider))
            $dataProvider = New CActiveDataProvider($this);

        $criteria = new CDbCriteria;
        $criteria->with = array('city', 'city.country', 'referal'=>array('alias'=>'referal')); //добавить страну и город (для поиска)
        $criteria->addCondition('user.superuser <> 1'); //исключаем суперпользователя

        if ($this->scenario == 'empty') { //пустой
            //нужно получить заведомо пустой набор данных
            $criteria->condition = '1=2'; //костыль!!!!
            //$dataProvider = New CArrayDataProvider(array()); //тоже костыль!!!
        } else if ($this->scenario == 'bcstructure') {
            $criteria->addInCondition('tariff_id', $this->businessclubIDs); //структура Бизнес Клуба
        } else if ($this->scenario == 'structure') { //поиск для структуры
            $criteria->compare('user.phone', $this->phone);
            $criteria->compare('user.skype', $this->skype);
        }
        //добавляем остальные критерии поиска
        $criteria->compare('user.first_name', $this->first_name, true); //поиск по фамилии
        $criteria->compare('user.last_name', $this->last_name, true); //поиск по имени
        $criteria->compare('user.tariff_id', $this->tariff_id); //поиск по тарифу
        //$criteria->compare('user.create_at', $this->create_at); //поиск по тарифу
        if (isset($this->create_at) && !empty($this->create_at)) {
            $criteria->addCondition ('user.create_at >= :data1 AND user.create_at < :data2');
            $sdiap = $this->makeSearchDateDiapasone();
            $criteria->params[':data1'] = $sdiap['begin'];
            $criteria->params[':data2'] = $sdiap['end'];
        }

        if (!empty($this->country_id)) {
            if ($this->scenario == 'structure')
                $criteria->compare('country.id', $this->country_id, true);
            else
                $criteria->compare('country.name', $this->country_id, true); //поиск по стране
        }
        if (!empty($this->city_id)) {
            $criteria->compare('city.name', $this->city_id, true); //поиск по городу
        }
        if (isset($this->refer_id)) {
            //$criteria->addCondition('refer_id = :refer_id');
            //$criteria->params = CMap::mergeArray($criteria->params, array(':refer_id' => $this->refer_id));
            $criteria->compare('referal.username', $this->refer_id, true);
        }
        if (isset($this->income)) {
            $criteria->compare('user.income', $this->income); //поиск по доходу
        }
        if (isset($this->transfer_fund)) {
            $criteria->compare('user.transfer_fund', $this->transfer_fund); //поиск по отчислениям в фонд
        }
        //мержим критерию с родительской и возвращаем набор данных 
        $dataProvider->criteria->mergeWith($criteria);
        return $dataProvider;
    }
    protected function makeSearchDateDiapasone(){
        $diapasone = array(
            'begin' => NULL,
            'end' => NULL,
        );
        $seconds = strtotime($this->create_at);
        $begin = date('Y-m-d', $seconds);
        $end = date('Y-m-d', $seconds+86400); // + 24 hours
        $diapasone['begin']=$begin .' 00:00:00';
        $diapasone['end']=$end.' 00:00:00';
        return $diapasone;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return News the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Sets the scenario for the model.
     * @param string $value the scenario that this model is in.
     * @see getScenario
     */
    /* public function setScenario($value)
      {
      parent::setScenario($value);
      return $this;
      } */

    /**
     * процедура при выборке записи из БД
     *
     */
    public function afterFind() {
        //присвоить значение полю "ид страны"
        $this->country_id = isset($this->city) ? $this->city->country_id : null;
        //если сценарий не активация
        //if ($this->scenario != 'activate') {
        //    $this->password = ''; //скрыть пароль
        //}
    }

    /**
     * Сгенерировать пароль (числовой)
     *
     */
    private static function _generatePassword() {
        return rand(10000000, 99999999);
    }

    //глобальная функция для присвоения пароля (не хешируем пока что)
    public function generatePassword() {
        $this->password = $this->_generatePassword(); //сгенерить
        //$this->password = Yii::app()->getModule('user')->encrypting($this->password);
        $this->save(false, array('password')); //сохранить (без валидации)
    }

    /**
     * Выдаёт значение Тарифа
     *
     */
    public function getTariffShortValue() {
        return isset($this->tariff) ? $this->tariff->shortname : null;
    }

    /**
     * Выдаёт название города
     */
    public function getCityName() {
        return isset($this->city) ? $this->city->name : null;
    }

    /**
     * Выдаёт название страны
     */
    public function getCountryName() {
        return isset($this->city) && isset($this->city->country) ? $this->city->country->name : null;
    }

    /**
     * Выдаёт значение имени реферала
     */
    public function getReferalName() {
        return isset($this->referal) ? $this->referal->username : null;
    }

    /**
     * Выдаёт значение ИД реферала
     */
    public function getReferalId() {
        return isset($this->referal) ? $this->referal->id : null;
    }

    /**
     * выдать список для выбора реферала
     *
     */
    public function getListForReferalSelect() {
        $criteria = New CDbCriteria(array(
            'select' => array('id', 'username'),
            'scopes' => 'participant',
        ));
        if (!empty($this->id)) {
            $criteria->scopes = 'withoutself';
            $criteria->params = array(':self_id' => $this->id);
        }
        $models = self::model()->findAll($criteria);
        return CHtml::listData($models, 'id', 'username');
    }

    /**
     * выдать список для выбора реферала
     *
     */
    public function getListForSuperReferalSelect() {
        $criteria = New CDbCriteria(array(
            'select' => array('id', 'username'),
            'scopes' => 'superrefer',
        ));
        if (!empty($this->id)) {
            $criteria->scopes = 'withoutself';
            $criteria->params = array(':self_id' => $this->id);
        }
        $models = self::model()->findAll($criteria);
        return CHtml::listData($models, 'id', 'username');
    }

    /**
     * цвет для юзера в сетке
     */
    public function getColor() {
        $statuscolor = 'white';
        //switch ($this->isBanned()) {//здесь указываете ваш аттрибут
        switch ($this->status) { //здесь указываете ваш аттрибут
            case self::STATUS_ACTIVE:
                $statuscolor = 'green'; //нужные вам классы в зависимости от значений
                break;
            case self::STATUS_NOACTIVE:
                $statuscolor = 'grey';
                break;
            case self::STATUS_BANNED:
                $statuscolor = 'red';
                break;
        }
        return $statuscolor;
    }

    public function userStructureProcess() {

        $this->structureMembers = $this->findAll('refer_id = :refer_id AND id <> :id AND tariff_id NOT IN(0,22,23,24,25,26)', array(':refer_id' => $this->id, ':id' => $this->id));
        $isBusinessClub = $this->isBusinessclub();
        if ($isBusinessClub) {
            $criteria = new CDbCriteria();
            $criteria->addInCondition('tariff_id', $this->_businessclubIDs);
            $criteria->addCondition('id <>  :id');
            $criteria->params[':id'] = $this->id;
            /* ограничиваем вывод тоько теми, кто пришел в бизнес-клуб после текущего пользователя */
            // получим дату вступления в бизнес-клуб для текущего пользователя [':busy_date']
            $criteria->addCondition('busy_date > :busy_date');
            $criteria->params[':busy_date'] = $this->busy_date;
            $this->clubMembers = $this->findAll($criteria);
        }
    }

    /**
     * активация стартового тарифа
     */
    public function activateStart() {
        $this->tariff_id = self::TARIFF_20;       //ставим статус 20$
        //$this->status = parent::STATUS_ACTIVE;    //ставим активность
        $this->password = Yii::app()->getModule('user')->encrypting($this->password); //хэшируем пароль
        //$this->activkey = null;      //убираем ключ активации (он больше не нужен)
        $this->save(false, array('tariff_id', /*'status',*/ 'password', 'activkey'));
    }

    /**
     * активация участия в клубе
     */
    public function activateParticipation() {
        $this->tariff_id = self::TARIFF_50;
        $this->busy_date = new CDbExpression('NOW()');
        $this->status = parent::STATUS_ACTIVE;    //ставим активность (метод вызывается в случае успеха "оплата 50")
        $this->save(false, array('tariff_id', 'busy_date', 'invite_num', 'status', 'refer_id'));
    }

    /**
     * активация бизнес-участия
     */
    public function activateBusiness() {
        $this->tariff_id = self::TARIFF_BC;
        $this->club_date = new CDbExpression('NOW()');
        $this->save(false, array('tariff_id', 'club_date'));
    }

    /**
     *  пополнить кошелёк
     */
    public function depositPurse($amount = 0) {
        /* $count = Yii::app()->db
          ->createCommand('UPDATE ' . $this->tableName() . ' SET balance = balance + :amount WHERE id = :id')
          ->bindValues(array(':id' => $this->id, ':amount' => $amount))
          ->execute(); */
        $this->balance = $this->balance + $amount;
        $this->save(false, array('balance'));
        return $this;
    }

    /**
     * построить полное имя (ФИО)
     * 
     */
    public static function getFullname() {
        return implode(' ', array($this->first_name, $this->last_name));
    }

    /**
     * получить ссылку на аватар (или плашка - если нет)
     * 
     */
    public function getUrlAvatar() {
        return self::buildUrlAvatar($this->ava);
    }

    public static function buildUrlAvatar($ava) {
        $file = Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $ava;
        if (!is_file($file)) { //если нет файла аватарки - определяем плашку (по полу)
            $file = Yii::app()->baseUrl . '/img/nophotom.jpg';
        } else {
            $file = Yii::app()->createAbsoluteUrl($ava);
        }
        return $file;
    }

    /*
     * состоит ли участник в бизнес-клубе
     */

    public function isBusinessclub() {
        return in_array($this->tariff_id, $this->_businessclubIDs);
    }

    /**
     * добавить юзера в список ОНЛАЙН
     * 
     */
    public function putUserToOnline() {
        $command = Yii::app()->db->createCommand();
        $user_id = $command  //сначала проверить: не занесён ли он уже в онлайн-список
                ->select('userid')
                ->from('onlineusers')
                ->where('userid = :userid', array(':userid' => $this->id))
                ->queryScalar();
        if ($user_id) {   //если да - обновить дату/время последнего действия
            return $command->update('onlineusers', array('lastvisit' => time()), 'userid = :userid', array(':userid' => $this->id));
        } else {          //если нет - добавить строку в таблицу
            return $command->insert('onlineusers', array('userid' => $this->id, 'lastvisit' => time()));
        }
    }

    /**
     * удалить юзера из списка ОНЛАЙН
     * 
     */
    public function deleteUserFromOnline() {
        $command = Yii::app()->db->createCommand();
        return $command->delete('onlineusers', 'userid = :userid', array(':userid' => $this->id));
    }

    /**
     * получить список юзеров которые ОНЛАЙН
     * 
     */
    public static function getOnlineUsers($withoutSelf = false) {
        $command = Yii::app()->db->createCommand()
                ->select('onlineusers.userid, countries.code as country_code, concat({{users}}.first_name, coalesce(concat(" ", {{users}}.last_name), "")) as username')
                ->from('onlineusers')
                ->leftJoin('{{users}}', '{{users}}.id = onlineusers.userid')
                ->leftJoin('cities', 'cities.id = {{users}}.city_id')
                ->leftJoin('countries', 'countries.id = cities.country_id');
        if ($withoutSelf && isset(Yii::app()->user->id->id)) {
            $command->where = 'onlineusers.userid <> :self_id';
            $command->params = array(':self_id' => Yii::app()->user->id->id);
        }

        $rows = $command->queryAll();
        return $rows;
    }

    //Получить всех юзеров, кто в твоей команде
    public static function getTeamUsers($withoutSelf = false) {
        $command = Yii::app()->db->createCommand()
                ->select('{{users}}.username as erzats, {{users}}.id, countries.code as country_code, concat({{users}}.first_name, coalesce(concat(" ", {{users}}.last_name), "")) as username')
                ->from('onlineusers')
                ->leftJoin('{{users}}', '{{users}}.id = onlineusers.userid')
                ->leftJoin('cities', 'cities.id = {{users}}.city_id')
                ->leftJoin('countries', 'countries.id = cities.country_id');
        if (isset(Yii::app()->user->id)) {
            $command->andWhere("{{users}}.refer_id =" . Yii::app()->user->id);
        }
        if (isset(Yii::app()->user->refer_id)) {
            $command->orWhere("{{users}}.id = " . Yii::app()->user->refer_id . " and " . Yii::app()->user->refer_id . " is not null");
        }
        if ($withoutSelf && isset(Yii::app()->user->id)) {
            $command->where = 'onlineusers.userid <> :self_id';
            $command->params = array(':self_id' => Yii::app()->user->id);
        }
        if ($withoutSelf === false && isset(Yii::app()->user->id)) {
            $command->orWhere("{{users}}.id = " . Yii::app()->user->id);
        }
        $rows = $command->queryAll();


        $command2 = Yii::app()->db->createCommand()
                ->select('{{users}}.id, countries.code as country_code, concat({{users}}.first_name, coalesce(concat(" ", {{users}}.last_name), "")) as username')
                ->from('yiichat_list')
                ->leftJoin('{{users}}', '{{users}}.id = yiichat_list.id_user_invited')
                ->leftJoin('cities', 'cities.id = {{users}}.city_id')
                ->leftJoin('countries', 'countries.id = cities.country_id')
                ->where('yiichat_list.id_user = ' . Yii::app()->user->id);

        $rows2 = $command2->queryAll();
        $res = array_merge($rows, $rows2);
        $result = array();
        //Удаляем совпадающие массивы
        foreach ($res as $value) {
            if (!in_array($value, $result)) {
                $result[] = $value;
            }
        }

        return $result;
//         $command = Yii::app()->db->createCommand()
//                 ->select('id,username')
//                 ->from('tbl_users')
//                 ->where("refer_id =". Yii::app()->user->id)
//                 ->queryAll();
//         return $command;
    }

    public static function addUserToList($id, $id_user_invited) {
        if ($id === $id_user_invited) {
            return array(
                'result' => false,
                'description' => BaseModule::t('rec', "You can't add yourself")
            );
        }

        $command = Yii::app()->db->createCommand();

//        $sql = "INSERT INTO `justmoney`.`yiichat_list` (`id`, `id_user`, `id_user_invited`) VALUES (NULL, $id, $id_user_invited);";
        $command->select("*")
                ->from('yiichat_list')
                ->where("id_user = $id")
                ->andWhere("id_user_invited = $id_user_invited");
//                ->andWhere("id_user <> id_user_invited");
        $res = $command->queryAll();
        if (!empty($res)) {
            return array(
                'result' => false,
                'description' => BaseModule::t('rec', 'The User has already been added')
            );
        }
        $res = $command->insert('yiichat_list', array(
            'id_user' => $id,
            'id_user_invited' => $id_user_invited
        ));
        $res = $command->insert('yiichat_list', array(
            'id_user' => $id_user_invited,
            'id_user_invited' => $id
        ));
        if ($res) {
            return array(
                'result' => true,
                'description' => BaseModule::t('rec', 'The User has been added successfuly')
            );
        } else {
            return array(
                'result' => false,
                'description' => BaseModule::t('rec', "The User hasn't been added")
            );
        }
    }

}
