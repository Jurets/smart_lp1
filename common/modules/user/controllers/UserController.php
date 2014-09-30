<?php

class UserController extends EController
{
     public function init(){
        if(isset($_COOKIE['language'])){
            Yii::app()->language = (string)Yii::app()->request->cookies['language'];
        }else{
            Yii::app()->language = Yii::app()->params['default.language']; // языком по умолчанию принимается русский
        }
    }

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * @return array action filters
     */
    public function filters()
    {
        return CMap::mergeArray(parent::filters(), array(
                        //'accessControl', // perform access control for CRUD operations
        ));
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
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     */
    public function actionView()
    {
        $model = $this->loadModel();
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('User', array(
            'criteria' => array(
                'condition' => 'status>' . User::STATUS_BANNED,
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->controller->module->user_page_size,
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel()
    {
        if ($this->_model === null) {
            if (isset($_GET['id']))
                $this->_model = User::model()->findbyPk($_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
     */
    public function loadUser($id = null)
    {
        if ($this->_model === null) {
            if ($id !== null || isset($_GET['id']))
                $this->_model = User::model()->findbyPk($id !== null ? $id : $_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }

    public function actionAutocompleteTest()
    {
        $res = array();

        if (isset($_GET['term'])) {
            // http://www.yiiframework.com/doc/guide/database.dao
            $qtxt = "SELECT username,first_name,last_name FROM {{users}} WHERE username LIKE :username OR first_name LIKE :first_name OR last_name LIKE :last_name";
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":username", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $command->bindValue(":first_name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $command->bindValue(":last_name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $res = $command->queryAll();
        }
        
        $array = array();
        foreach ($res as $key => $value) {
            //generate nickname
            $nickname = $value['first_name']. ' ' . $value['last_name']. ' (' . $value['username'] . ')';
            $array[$key] = $nickname;
        }

        echo CJSON::encode($array);
        Yii::app()->end();
    }

}
