<?php

/**
 * Creator: Tkachenko Egor
 * Created: 04/06/2014
 * Class OfficeController
 */
class OfficeController extends EController
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/office';

    /**
     * процедура перед любым действием в Офисе
     * 
     * @param mixed $action
     * @return boolean
     */
    protected function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!Yii::app()->user->isGuest) { //если юзер не гость
                $user = New Participant('update');
                $user->id = Yii::app()->user->id;
                //добавить юзера в список онлайн  - любая активность юзера (обращение к контроллеру) 
                $user->putUserToOnline();
            }
            return true;
        }
    }

    /**
     * главная страница ОФиса
     *     
     */
    public function actionIndex()
    {
//        $this->render('cap', array('service_msg' => 'Заглушка'));
        $this->redirect('/office/statistics');
    }

    /**
     * Show rules
     */
    public function actionStatistics(){
        $model = new PmTransactionLog;
        $model->id = Yii::app()->user->id;
        if(!$model->validate()){
            throw new CHttpException(404, 'parameters failure');
        }
        // TO DO - вызов логики
        $model->statisticaStandard();
        $this->render('statistics', array('model'=>$model));
    }
    public function actionSpecification()
    {
        $objRequqstes = new Requisites();
        //$message - form admin panel.  Requqstes->Agreement
        $message = $objRequqstes->model()->findAll();
        $message = $message[0]['agreement'];
        $this->render('office-8', array('content' => $message));
    }

    /**
     * Show faq
     */
    public function actionHelp()
    {
        $objFaq = new Faq();
        $objFaqManager = new Faqm();
        $objFaqManager->LoadFaqManager();
        $availableCategories = $objFaqManager->getTypeOfCategories();
        $categories = $objFaq->model()->showAllFaq();
        if(!empty($_POST) and $_POST['question']){
//            $objFaq->attributes = $_POST;
//            $objFaq->created = date('y-m-d h:m:s');
//            $objFaq->save();
//            $this->refresh();
            if($_POST['category']){
                $category = $_POST['category'];
                EmailHelper::send(array($objFaqManager[$category.'Mail']), $_POST['question'], 'question from faq', array());
            }
        }
        $this->render('help', array('arrCategories' => $categories, 'availableCategories'=>$availableCategories));
    }

    /**
     * Show Settings
     */
    public function actionSettings()
    {
        $participant = Participant::model()->findByPk(Yii::app()->user->id);
        $participant->setScenario('settings');
        if ($participant->dob != '') {
            $date = explode('-', $participant->dob);
        }
        $day = $participant->dob != '' ? $date[2] : '';
        $month = $participant->dob != '' ? $date[1] : '';
        $year = $participant->dob != '' ? $date[0] : '';

        $places = Countries::getCountriesList();
        $citesByCountryId = Cities::getCitiesListByCountry($participant->country_id);
        $gmtZone = Gmt::getTimezonesList();
        $participant->newPurse = $participant->purse;
        // путь для сохранения файла
        $path = Yii::app()->params['upload.path'];
        if (isset($_POST['Participant'])) {
            $day = Yii::app()->getRequest()->getPost('date_ofb');
            $month = Yii::app()->getRequest()->getPost('month_ofb');
            $year = Yii::app()->getRequest()->getPost('year_ofb');
            $timeZone = Yii::app()->getRequest()->getPost('timeZoneSelect');
            $city_id = Yii::app()->getRequest()->getPost('citySelect');
            $country_id = Yii::app()->getRequest()->getPost('countrySelect');
            $currentPassword = Yii::app()->getRequest()->getPost('currentPassword');
            $newPassword = Yii::app()->getRequest()->getPost('newPassword');
            $participant->currentPassword = $currentPassword;
            $participant->newPassword = $newPassword;
            $participant->gmt_id = $timeZone;
            $participant->country_id = $country_id;
            $participant->city_id = $city_id;
            $citesByCountryId = Cities::getCitiesListByCountry($participant->country_id);
            if ($day != '' && $month != '' && $year != '') {
                if (checkdate($month, $day, $year)) {
                    $dob = $year . '-' . $month . '-' . $day;
                    $participant->dob = $dob;
                } else {
                    $participant->dob = '';
                }
            } else {
                $participant->dob = '';
            }
            $oldPhoto = $participant->photo;
            $currentEmail = $participant->email;
            $participant->attributes = $_POST['Participant'];
            $newEmail = $participant->email;
            if ($participant->validate()) {
                if ($participant->password == md5($participant->currentPassword) && $newPassword != '') {
                    $participant->password = md5($newPassword);
                }
                if ($_FILES['Participant']['name']['photo'] != '') {

                    Yii::import('common.extensions.FileUpload.UploadAction');
                    $upload = new UploadAction('im/default', NULL);
                    $upload->path_to_file = $path;
                    $upload->resize = array('width' => 250, 'height' => 175);
                    $upload->re_org = array('width' => 67, 'height' => 67);
                    $upload->prefixOrigin = 'settings-';
                    $upload->prefixResized = 'avatar-settings-';
                    $images = $upload->run();
                    $participant->photo = $images['photo']['name'];


//                    $participant->photo = CUploadedFile::getInstance($participant,'photo');
//                    $nameImage = $participant->photo->name;
//                    $url_photo = $path . $nameImage;
//                    $participant->photo->saveAs($url_photo);//сохраняем картинку
//                    ImageHelper::makeNewsThumb($url_photo,'settings-','250','175');
//                    ImageHelper::makeNewsThumb($url_photo,'resized-settings-','67','67');
                } else {
                    $participant->photo = $oldPhoto;
                }
                if(empty($participant->newPurse)){
                    $participant->newPurse = $participant->purse;
                }
                if ($participant->purse != $participant->newPurse) {
                    $participant->purse = $participant->newPurse;
                    ////$participant->newPurse = '';
                }
                

                $participant->country_access = isset($_POST['country_access']) ? 1 : 0;
                $participant->city_access = isset($_POST['city_access']) ? 1 : 0;
                $participant->skype_access = isset($_POST['skype_access']) ? 1 : 0;
                $participant->email_access = isset($_POST['email_access']) ? 1 : 0;

                $participant->email = $currentEmail;
                $participant->new_email = $newEmail;
                $participant->activkey = UserModule::encrypting(microtime() . $participant->password);
                $participant->save(false);

                if ($currentEmail != $_POST['Participant']['email']) {
                    //отсылка почты для повторного подтверждения почты
                    EmailHelper::send($participant->new_email, 'Подтверждение почты', 'updateEmail', array('participant' => $participant));
                }
            } else {
                $participant->photo = $oldPhoto;
            }
            
           if(!$participant->hasErrors()){
                Yii::app()->user->setFlash('settings saved', "Data saved successfull");
            }
            
        }
        $this->render('settings', array('participant' => $participant, 'places' => $places, 'citesByCountryId' => $citesByCountryId,
            'gmtZone' => $gmtZone, 'day' => $day, 'month' => $month, 'year' => $year));
    }

    /**
     * Show invitation
     */
    public function actionInvitation()
    {
        $inviteInformation = New Invitation();
        $inviteInformation->loadInvitationManager();
        $downloadFile = $inviteInformation->fileLink;
        $youTubeUrlUniqueId = $inviteInformation->videoLink;
        $arrBannerFiles = $inviteInformation->bannerFiles;
        $text = $inviteInformation->text;
        $this->render('invitation', array('youTubeUrlUniqueId' => $youTubeUrlUniqueId,
            'downloadFile' => $downloadFile, 'arrBannerFiles' => $arrBannerFiles,
            'content' => $text,
        ));
    }

    /* News */

    public function actionNews()
    {
        if (!isset(Yii::app()->request->cookies['attended']->value)) {
            Yii::app()->request->cookies['cookie_name'] = new CHttpCookie('attended', json_encode(array(0)));
        }

        isset($_GET['page']) ? $page = sprintf('?page=%d', $_GET['page']) : $page = '';
        if (isset($_GET['id'])) {
            $model = News::model()->findByPk($_GET['id']);
            $this->render('newsone', array('model' => $model, 'page' => $page));
        } else {
            $criteria = new CDbCriteria();
            $criteria->addCondition('activity = 1');
            $count = News::model()->count($criteria); // количество активных записей новостей
            if($count!=0){
                $pages = new CPagination($count);
                $pages->pageSize = 6;
                $pages->applyLimit($criteria);
            }else $pages = null;

            $models = News::model()->findAll($criteria); // новости
            $models = News::model()->attendedScan($models);
            $renderProperties = array('models' => $models, 'pages' => $pages);
            $this->render('news', array('models' => $models, 'pages' => $pages, 'page' => $page));
        }
    }

    /**
     * Структура команды
     * 
     */
    public function actionStructure()
    {
        $model = Participant::model()->findByPk(Yii::app()->user->id);
        $model->userStructureProcess(); // делаем "хвост"
        $isBusinessClub = $model->isBusinessclub();
        //$this->render('test', array('model'=>$model));
        $this->render('structure', array('model'=>$model,'isBusinessClub'=>$isBusinessClub));
    }

    /**
     *  вызов чата
     * @param int $interlocutor ID собеседника
     */
    public function actionChat()
    {

//        if (isset($_GET['user_id'])) {
//            $user_id = (int) $_GET['user_id'];
//        } else {
//            $user_id = 0;
////            throw new CHttpException(404, 'invalid request');
//        }
        if (isset($_GET['interlocutor'])) {
            $interlocutor = (int) $_GET['interlocutor'];
        } else {
            $interlocutor = 0;
//            throw new CHttpException(404, 'invalid request');
        }

        //составляем уникальный $chat_id по id's юзеров для 
        //разговора двух юзеров
        $user_id = Yii::app()->user->id;
        if ($user_id > $interlocutor) {
            $chat_id = $user_id . "_" . $interlocutor;
        } else {
            $chat_id = $interlocutor . "_" . $user_id;
        }
        //команда
        $onlineusers = Participant::getTeamUsers(true); //true - не показывать себя
        //текущий юзер
        $user = Participant::model()->findByPk(Yii::app()->user->id);
        //юзеры онлайн
//        $onlineusers = Participant::getOnlineUsers(false); //true - не показывать себя

        $this->render('chat', array(
            'onlineusers' => $onlineusers,
            'smileys' => $this->getSmileNamesSet(),
            'isActivated' => $user->status, //активен ли юзер
            'chat_id' => $chat_id,
            'interlocutor' => $interlocutor,
                //'isWebinar' => $this->isWebinar(),  //идёт ли вебинар
                ), false, true);
    }

    /**
     * Functions(actionCountry(),actionCity(),actionTimezone()) for Invitation
     */
    public function actionCountry()
    {
        echo json_encode(Countries::getCountriesList(), JSON_UNESCAPED_UNICODE);
    }

    public function actionCity()
    {
        $countryId = $_GET['countryId'];
        echo json_encode(Cities::getCitiesListByCountry($countryId), JSON_UNESCAPED_UNICODE);
    }

    public function actionPlace()
    {
        echo json_encode(Countries::getCountriesList(), JSON_UNESCAPED_UNICODE);
    }

    /* Perfect Money test */

    public function actionTest()
    {
        $model = new PerfectMoney();
        /* обязательные параметры */
        $model->login = '6416431';
        $model->password = 'uhaha322re423e';
        $model->payerAccount = 'U6840713';
        $model->payeeAccount = 'U3627324';
        $model->amount = '0.01';
        /* необязательные параметры */
//        $model->payerId = '3';
//        $model->payeeId = '4';
        $model->transactionId = 3; // установка номера tr_kind_id вручную. При наличии этого параметра  использование transactionKind бессмысленно.
        $model->notation = 'Дополнительные сведения.';
        //$model->Run('balance');
        $model->Run(); // аналогично confirm ибо умолчание в main.php прописано в конфигурации
        echo $model->getError('paymentTransactionStatus') . '<br>';
        echo $model->notation . '<br>';
        var_dump('Сообщения', $model->getErrors());
        var_dump('Данные от perfectmoney.is как есть', $model->getOutput());
    }

    /**
     *  Check activation code and save new email
     */
    public function actionEmail()
    {
        $getActivityKey = Yii::app()->getRequest()->getQuery('activkey');
        $participatnObj = Participant::model()->findByPk(Yii::app()->user->id);
        if ($participatnObj->activkey == $getActivityKey) {
            $participatnObj->activkey = '';
            $participatnObj->email = $participatnObj->new_email;
            $participatnObj->new_email = '';
            $participatnObj->save();
        }
        $this->redirect('settings');
    }

   /**
    *  Change up status
    */
    public function actionStatus(){
        //:TODO Делаем запрос,проверяем какой статус у пользователя и отображаем страницуы
        $this->render('status_form');
    }

}
