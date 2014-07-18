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
        if(isset($_GET['user'])){
            PmTransactionLog::model()->date = date('d.m.Y');
            PmTransactionLog::model()->domain = $_GET['user'];
            PmTransactionLog::model()->statisticaVisitesCreation();
        }
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

        if (isset($_POST['id']) && isset($_POST['username'])) {
            if (!preg_match('/^\d+$/', $_POST['id'])) {
                throw New CHttpException(404, 'Invalid ID');
            }
            $id = $_POST['id'];
            $username = $_POST['username'];
        }
        $user = Participant::model()->findByAttributes(array(
            'username' => $username,
        ));
        if (!$user || $user === null) {
            echo CJSON::encode(array(
                'result' => true,
                'description' => Yii::t('common', "The User hasn't been found")
            ));
            Yii::app()->end();
        }

        $response = Participant::addUserToList($id, $user->id);
        if ($response) {
            echo CJSON::encode($response);
            Yii::app()->end();
        }
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

    // возврат списка онлайн-юзеров
    public function actionGetTeamUsers()
    {
        $onlineusers = Participant::getTeamUsers(false); //true - не показывать себя

        $response = array();
        $response['onlinecount'] = count($onlineusers);
        $response['html'] = $this->renderPartial('application.views.office._buddies', array('onlineusers' => $onlineusers), true);
        echo CJSON::encode($response);
    }

    /**
     *  Change up status
     */
    public function actionStatus()
    {
        /* Формирование данных для отображения */
        $participant = Participant::model()->findByPk(Yii::app()->user->id);
        $status = Tariff::model()->findByPk($participant->tariff_id);
        // Переменная($max_status) для определения максимального уровня в бизнес клубе
        $max_status = false;
        // Переменная($defective_status) для определения задан ли кошелек платежной системы.
        $defective_status = false;
        $participant_purse = false;
        $message = '';
        if ($participant->tariff_id == 6) {
            $max_status = true;
        }

        // Возможные варианты поднятия статуса(пример:мы не можем купить статус ниже текущего)
        if ($participant->tariff_id >= 3 && $participant->tariff_id < 6) {
            $criteria = new CDbCriteria();
            $criteria->addCondition('id >  :id');
            $criteria->params[':id'] = $participant->tariff_id;
            $tariffListData = Tariff::model()->findAll($criteria);
        } else {
            $criteria = new CDbCriteria();
            $criteria->addCondition('id >  :id');
            $criteria->params[':id'] = Participant::TARIFF_BC;
            $tariffListData = Tariff::model()->findAll($criteria);
        }
        /* завершение форм.данных */
        if (isset($_POST)) {
            /* Определяем статус,тип операции,изменям статус после удачной оплаты */
            /* безопасно извлекаем данные из $_POST */
            // $type_amount - id операции(TARIFF_50 = 2,TARIFF_BC_BRONZE(100$) = 4)
            $type_amount = Yii::app()->getRequest()->getPost('amount');
            // данные для Perfect Money (account&password) обязательны
            $account = Yii::app()->getRequest()->getPost('account');
            $password = Yii::app()->getRequest()->getPost('password');


            //если статус "оплачен 20$"
            if ($type_amount == Participant::TARIFF_20) {
                if (Requisites::purseClub()) {
                    if (MPlan::payParticipation($participant, $account, $password)) {
                        Yii::app()->user->setFlash('success', "Ваша оплата прошла успешно!");
                        $this->refresh();
                    } else {
                        Yii::app()->user->setFlash('fail', "Оплата не прошла.Повторите операцию позже.");
                        $this->refresh();
                    }
                } else {
                    $defective_status = true;
                }
            } elseif ($type_amount > Participant::TARIFF_20 && $participant->tariff_id < Participant::TARIFF_BC_GOLD) {
                if (Requisites::purseClub()) {
                    if (MPlan::payForChangeStatus($participant, $account, $password, $type_amount)) {
                        Yii::app()->user->setFlash('success', "Ваша оплата прошла успешно!");
                        $this->refresh();
                    } else {
                        Yii::app()->user->setFlash('fail', "Оплата не прошла.Повторите операцию позже.");
                        $this->refresh();
                    }
                } else {
                    $defective_status = true;
                    $message = 'Не задан кошелек Бизнес Клуба';
                }

            }
        }

        $this->render('status_form', array('model' => $participant, 'status' => $status,
            'tariffListData' => $tariffListData, 'max_status' => $max_status,
            'defective_status' => $defective_status, 'message' => $message));

    }

    public function actionTestmail()
    {
        if (EmailHelper::send(array('jurets75@rambler.ru'), 'Тестовая отсылка', 'test', array()))
            echo 'Успешная отсылка!';
        else
            echo '---Ошибка при отсылке';
    }

}
