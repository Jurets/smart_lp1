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
     * Action rules for office
     */
    public function actionSpecification()
    {
        $objRequqstes = new Requisites();
        $message = $objRequqstes->model()->findAll();
        $message = $message[0]['agreement'];
        $this->render('office-8',array('message'=>$message));
    }



}
