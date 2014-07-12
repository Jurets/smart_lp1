<?php

/**
 *
 * SiteController class
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
Yii::import('common.modules.user.controllers.LoginController');

class SiteController extends LoginController
{

    public $layout = '//layouts/main';
    public $defaultAction = 'index';

    /**
     * Добавлить действие для капчи
     */
    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'testLimit' => 0, //делаем неограниченное кол-во попыток ввода капчи
            ),
            'yiichat' => array(
                'class' => 'YiiChatAction'
            ), // YII-CHAT: добавка действия YiiChatAction
        );
    }

    /**
     * Главная страница
     * 
     */
    public function actionIndex()
    {
        $model = new Indexmanager;
        $model->LoadIndexManager();
        //вывести вью
        $this->render('index', array('model' => $model));
    }

    /**
     * Авторизация (ФРОНТЕНД)
     * 
     */
    public function actionLogin()
    {
        if (Yii::app()->user->isGuest) {
            $model = new UserLogin();
            $this->performAjaxValidation($model);  //аякс-валидация 
            // collect user input data
            if (isset($_POST['UserLogin'])) {
                $model->attributes = $_POST['UserLogin'];
                // validate user input and redirect to previous page if valid
                if ($model->validate()) {
                    $this->lastViset();
                    //$model->clearLoginCode();
                    if (Yii::app()->getBaseUrl() . "/index.php" === Yii::app()->user->returnUrl)
                        $this->redirect(Yii::app()->controller->module->returnUrl);
                    else
                    //$this->redirect(Yii::app()->user->returnUrl);
                        $this->redirect(Yii::app()->createAbsoluteUrl('office'));
                }
            }
            // display the login form
            $this->render('//layouts/login', array('userLogin' => $model));
        } else {
            if (Yii::app()->request->urlReferrer != Yii::app()->request->url)
                $this->redirect(Yii::app()->request->urlReferrer);
            else
                $this->redirect(Yii::app()->createAbsoluteUrl('office'));
        }
    }

    /**
     * выход юзера
     * 
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->createAbsoluteUrl('/'));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionUsrcontour()
    {
        $this->renderPartial('_usrcontour');
    }

    // возврат кол-ва онлайн-юзеров (для главной страницы)
    public function actionGetonlineuserscount()
    {
        $count = Yii::app()->cache->get('cache_common_usersonline');
        if ($count === false) {
            $count = Participant::getOnlineUsersCount();
            Yii::app()->cache->set('cache_common_usersonline', $count, 15);
        }
        $response = array();
        $response['onlinecount'] = $count;
        echo CJSON::encode($response);
    }

    // возврат списка онлайн-юзеров
    public function actionGetonlineusers()
    {
        $onlineusers = Participant::getOnlineUsers(false); //true - не показывать себя

        $response = array();
        $response['onlinecount'] = count($onlineusers);
        $response['html'] = $this->renderPartial('application.views.office._buddies', array('onlineusers' => $onlineusers), true);
        echo CJSON::encode($response);
    }

    // добавить к себе в список
    public function actionAddUserToList()
    {
        
    }

    //личное сообщение (начать личный чат).
    public function actionSendMessage()
    {
        
    }

    //вернуть информацию о пользователе по id
    public function actionGetUserInfo()
    {
        $id = Yii::app()->request->getPost('id');
        $user = Participant::model()->findByPk($id);
        echo CJSON::encode(array(
            'photo' => $user->photo,
            'phone' => $user->phone,
            'skype' => $user->skype
        ));
    }
    /**
     *  Change up status
     */
    public function actionStatus(){
        $model = Participant::model()->findByPk(Yii::app()->user->id);
        $status = Tariff::model()->findByPk($model->tariff_id);

        $criteria = new CDbCriteria();
        $criteria->addCondition( 'id >  :id');
        $criteria->params[':id'] = 3;
        $tariffListData = Tariff::model()->findAll($criteria);

        $this->render('status_form', array('model'=>$model,'status'=>$status,'tariffListData'=>$tariffListData));
    }

}
