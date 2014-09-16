<?php

class DefaultController extends EMController
{
    /**
    * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
    * using two-column layout. See 'protected/views/layouts/column2.php'.
    */
    public $layout='//layouts/column2';

    public $modelClass = 'Mpversions';

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
    public function accessRules() {
        Yii::import('common.modules.user.UserModule');
        return array(
            array(
                'allow',
                'users'=>UserModule::UAC(array('superadmin')),
            ),
            array(
                'deny',
                'users'=>array('*'),
            ),
        );
    }

    /**
    * Displays a particular model.
    * @param integer $id the ID of the model to be displayed
    */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
    * Creates a new model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    */
    public function actionCreate()
    {
        $model=new Mpversions;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if(isset($_POST['Mpversions']))	{
            $model->attributes=$_POST['Mpversions'];
            $model->save();
            $model = Mpversions::currentVersion($model->id);
            if($_POST['Mpversions']['activity'] == '1'){
                $model->choiseCurrentVersion();
            }
            $model->manageParameters(isset($_POST['Mathparams'])? $_POST['Mathparams'] : FALSE);
            $this->redirect(array('admin'));
        }
        $this->render('create',array(
            'model'=>$model,
        ));

    }

    /**
    * Updates a particular model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id the ID of the model to be updated
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if(isset($_POST['Mpversions'])) {
            if($_POST['Mpversions']['activity'] == '1'){
                $model->choiseCurrentVersion();
            }
            $model->attributes=$_POST['Mpversions'];
            $model->manageParameters(isset($_POST['Mathparams'])? $_POST['Mathparams'] : FALSE);
            if($model->save()){
                $this->redirect (array('admin'));
            }
        }
        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
    * Deletes a particular model.
    * If deletion is successful, the browser will be redirected to the 'admin' page.
    * @param integer $id the ID of the model to be deleted
    */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
    * Lists all models.
    */
    public function actionChoise($id){
        $model = Mpversions::currentVersion($id);
        $model->choiseCurrentVersion();
        $this->redirect(array('admin'));
    }

    /**
    * просмотр всех версий
    */
    public function actionIndex(){  // Без редиректа одмин сразу видит текущую версию и ее состояние, как только приходит в модуль
        $this->redirect(array('admin'));
        /*$model = Mpversions::activeVersion();
        if($model === NULL)
            $model = new Mpversions();

        if(isset($_POST['Mpversions'])){
            $model->attributes = $_POST['Mpversions'];
            $model->manageParameters(isset($_POST['Mathparams'])? $_POST['Mathparams'] : FALSE);
            $model->save();
            if($_POST['Mpversions']['activity'] == '1'){
                $model->choiseCurrentVersion();
            }
            $this->redirect(array('default/index'));
        }
        $this->render('mathpanel', array('model'=>$model));*/
    }

    /**
    * Manages all models.
    */
    public function actionAdmin()
    {
        $model=new Mpversions('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Mpversions']))
            $model->attributes=$_GET['Mpversions'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    public function actionTest(){
        //var_dump(marketingPlanHelper::init()->getMpParam('price_activation'));
        var_dump(marketingPlanHelper::init()->getMpParams());
    }
}
