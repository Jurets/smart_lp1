<?php

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
        $this->render('office-8');
    }



}
