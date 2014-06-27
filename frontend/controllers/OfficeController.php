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
        $participant = Participant::model()->findByPk(1);
        $participant->setScenario('settings');
        if (isset($_POST['Participant'])) {
            $participant->attributes = $_POST['Participant'];
            if ($participant->validate() && isset($_FILES['Participant'])) {
                if($participant->validate()) {//DebugBreak();
                    $participant->save();
                     if ($participant->email != $_POST['Participant']['email']) {
                        //отсылка почты для повторного подтверждения почты
                        EmailHelper::send(array($participant->email), 'Подтверждение регистрации', 'regconfirm', array('participant'=>$participant));
                    }
                    $this->refresh();
                }
            }
        }
        $this->render('settings',array('participant'=>$participant));
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

    public function actionCity()
    {
        $countryId = $_GET['countryId'];
        echo json_encode(Cities::getCitiesListByCountry($countryId),JSON_UNESCAPED_UNICODE);
    }

    public function actionTimezone()
    {

        echo json_encode(Gmt::getTimezonesList(),JSON_UNESCAPED_UNICODE);
    }


}


