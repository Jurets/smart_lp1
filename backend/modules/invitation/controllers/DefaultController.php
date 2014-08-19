<?php

class DefaultController extends EMController
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        Yii::import('common.modules.user.UserModule');
        return array(
//            array('allow', // allow all users to perform 'index' and 'view' actions
//                'actions' => array('index', 'view'),
//                'users' => array('*'),
//            ),
//            array('allow', // allow authenticated user to perform 'create' and 'update' actions
//                'actions' => array('create', 'update'),
//                'users' => array('@'),
//            ),
            array('allow',
                //'users' => array('admin'),
                'users'=>UserModule::UAC(array('superadmin','admin','moderator')),
            ),
		array('deny',  // deny all users
			'users'=>array('*'),
		),
        );
    }


    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new Invitation;
        $model->loadInvitationManager();
        if(isset($_POST['Invitation'])){
           $model->attributes = $_POST['Invitation'];
           
           if (isset($_POST['bannerFiles']))
               $model->setBannerList($_POST['bannerFiles']);
           else 
               $model->bannerFiles = array();
           
           if(isset($_FILES['bannerFiles'])){
               Yii::import('common.extensions.FileUpload.UploadAction');
               $upload = new UploadAction('invitation/default', NULL);
               $upload->prefixOrigin = 'invitation-';
               $upload->prefixResized = 'resized-invitation-';
               $images = $upload->run();
               $model->setImages($images);
           }
           $model->saveInvitationManager();
           $this->redirect(array('index'));
        }
        $this->render('index', array('model' => $model));
    }

}
