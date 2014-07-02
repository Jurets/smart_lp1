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
    public $layout='//layouts/office';


    /**
    * процедура перед любым действием в Офисе
    * 
    * @param mixed $action
    * @return boolean
    */
    protected function beforeAction($action) {
        if (parent::beforeAction($action)){
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
      $this->render('cap', array('service_msg'=>'Заглушка'));   
    }

    /**
     * Show rules
     */
    public function actionSpecification()
    {
        $objRequqstes = new Requisites();
        //$message - form admin panel.  Requqstes->Agreement
        $message = $objRequqstes->model()->findAll();
        $message = $message[0]['agreement'];
        $this->render('office-8',array('content'=>$message));
    }


    /**
     * Show faq
     */
    public function actionHelp()
    {
        $objFaq = new Faq();
        // $categories - sorted faq(array) by categories
        $categories = $objFaq->model()->showAllFaq();
        $this->render('help',array('arrCategories'=>$categories));
    }

    /**
     * Show Settings
     */
    public function actionSettings()
    {
        //Yii::app()->user->id
        $participant = Participant::model()->findByPk(2);
        $participant->setScenario('settings');
        if($participant->dob != ''){
            $date = explode('-', $participant->dob);
        }else{
            $date = explode('-', date('Y-m-d'));
        }
        $day = $date[2];
        $month = $date[1];
        $year = $date[0];

        $places = Countries::getCountriesList();
        $citesByCountryId = Cities::getCitiesListByCountry($participant->country_id);
        $gmtZone = Gmt::getTimezonesList();

        // путь для сохранения файла
        $path = Yii::app()->params['upload.path'];
        if (isset($_POST['Participant'])) {
            $day = Yii::app()->getRequest()->getPost('date_ofb');
            $month = Yii::app()->getRequest()->getPost('month_ofb');
            $year = Yii::app()->getRequest()->getPost('year_ofb');
            $timeZone = Yii::app()->getRequest()->getPost('timeZoneSelect');
            $city_id = Yii::app()->getRequest()->getPost('citySelect');
            $country_id = Yii::app()->getRequest()->getPost('countrySelect');
            $oldPassword = Yii::app()->getRequest()->getPost('password');
            $newPassword  = Yii::app()->getRequest()->getPost('newPassword');
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
            }

            if($participant->password == md5($oldPassword) && $newPassword != ''){
                $participant->password = md5($newPassword);
            }
            $oldPhoto = $participant->photo;
            $oldEmail = $participant->email;
            $participant->attributes = $_POST['Participant'];
            if ($participant->validate()) {
                if ($_FILES['Participant']['name']['photo'] != '') {
                    $participant->photo = CUploadedFile::getInstance($participant,'photo');
                    $nameImage = $participant->photo->name;
                    $url_photo = $path . $nameImage;
                    $participant->photo->saveAs($url_photo);//сохраняем картинку
                }else{
                    $participant->photo = $oldPhoto;
                }
                if($participant->purse != $participant->newPurse)
                {
                    $participant->purse = $participant->newPurse;
                    $participant->newPurse = '';
                }

                $participant->country_access = isset($_POST['country_access']) ? 1 : 0;
                $participant->city_access = isset($_POST['city_access']) ? 1 : 0;
                $participant->skype_access = isset($_POST['skype_access']) ? 1 : 0;
                $participant->email_access = isset($_POST['email_access']) ? 1 : 0;
                $participant->save();

                if ($oldEmail != $_POST['Participant']['email']) {
                    //отсылка почты для повторного подтверждения почты
                    EmailHelper::send(array($participant->email), 'Подтверждение почты', 'settings', array('participant' => $participant));
                }
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
        $this->render('invitation',array('youTubeUrlUniqueId'=>$youTubeUrlUniqueId,
                      'downloadFile'=>$downloadFile,'arrBannerFiles'=>$arrBannerFiles,
                      'content'=>$text,
                     ));
    }
    
    /* News */
    public function actionNews()
    {  
        if(!isset(Yii::app()->request->cookies['attended']->value )){
            Yii::app()->request->cookies['cookie_name'] = new CHttpCookie('attended', json_encode(array(0)));
        }
        
        isset($_GET['page']) ? $page = sprintf('?page=%d', $_GET['page']) : $page = '';
        if(isset($_GET['id'])){
            $model = News::model()->findByPk($_GET['id']);
            $this->render('newsone', array('model'=>$model, 'page'=>$page));
        }else{
            $criteria = new CDbCriteria();
            $criteria->addCondition('activity = 1');
            $count = News::model()->count($criteria); // количество активных записей новостей
            $pages = new CPagination($count);
            $pages->pageSize = 6;
            $pages->applyLimit($criteria);
            $models = News::model()->findAll($criteria); // новости
            $models = News::model()->attendedScan($models);                        
            $renderProperties = array('models'=>$models, 'pages'=>$pages);
            $this->render('news', array('models'=>$models, 'pages'=>$pages, 'page'=>$page));
            
            
        }
    }
    
    /**
    * Структура команды
    * 
    */
    public function actionStructure(){
        $model = Participant::model()->findByPk(Yii::app()->user->id);
        $model->userStructureProcess(); // делаем "хвост"
        //$this->render('test', array('model'=>$model));
        $this->render('structure', array('model'=>$model));
    }

    
    /**
    *  вызов чата
    */
    public function actionChat() {//DebugBreak();
        //текущий юзер
        $user = Participant::model()->findByPk(Yii::app()->user->id);
        //юзеры онлайн
        $onlineusers = Participant::getOnlineUsers(false); //true - не показывать себя
        $this->render('chat', array(
            'onlineusers'=>$onlineusers,
            'smileys'=>$this->getSmileNamesSet(),
            'isActivated'=>$user->status,   //активен ли юзер
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
    
    public function actionPlace()
    {
        echo json_encode(Countries::getCountriesList(), JSON_UNESCAPED_UNICODE);
    }
//=======
    /* Test */
    public function actionTest(){
        $test = Yii::app()->perfectmoney; // настоящий компонент
        var_dump($test->show());die;
    }
//>>>>>>> c1e2469ba368df93d42c42eab573a19c1f009816
}


