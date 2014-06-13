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


    public function actionIndex(){
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
        $this->render('settings');
    }
    /**
     * Show invitation
     */
    public function actionInvitation()
    {
        //$inviteInformation = Invitation::model()->findAll();
        //$youTubeUrlUniqueId = $inviteInformation[0]['video_link'];
        //$this->render('invitation',array('youTubeUrlUniqueId'=>$youTubeUrlUniqueId));
    }
    
    /* News */
    public function actionNews()
    {
        if(isset($_GET['id'])){
            $model = News::model()->findByPk($_GET['id']);
            
            $this->render('newsone', array('model'=>$model));
        }else{
            $criteria = new CDbCriteria();
            $criteria->addCondition('activity = 1');
            $count = News::model()->count($criteria); // количество активных записей новостей
            $pages = new CPagination($count);
            $pages->pageSize = 6;
            $pages->applyLimit($criteria);
            $models = News::model()->findAll($criteria); // новости
            $this->render('news', array('models'=>$models, 'pages'=>$pages));
        }
    }
}
