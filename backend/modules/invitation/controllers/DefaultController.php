<?php

class DefaultController extends EController
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
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
        );
    }


    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new Invitation;
        $model->LoadIndexManager(); // запрос к itemsstorage по параметру INVITATION
        if (isset($_POST['Invitation'])) {
            $arrFilesPost = $_POST['bannerFiles'];
            $model->attributes = $_POST['Invitation'];
            $newImages = array();
            $arrFilesPost = $model->checkChangesArrFiles($arrFilesPost);
            $bannerFilesLength = count($model->bannerFiles);
            if($model->bannerFiles == ''){
                $bannerFilesLength = 0;
            }

            if(count($arrFilesPost) > $bannerFilesLength){
                if (isset($_FILES['bannerFiles'])){
                    Yii::import('common.extensions.FileUpload.UploadAction');
                    $upload = new UploadAction('invitation/default', NULL);
                    $upload->prefixOrigin = 'invitation-';
                    //$upload->prefixResized = 'resized-invitation-';
                    $images = $upload->run();
                    $newImages = $model->deletePathToPc($images,'path');
                }
            } else {
                $newImages = $arrFilesPost;
            }

                $model->setBannerList($newImages);
                $model->SaveIndexManager();
                $this->redirect(array('index'));
            }

        $this->render('index', array('model' => $model));
    }


}
