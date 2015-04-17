<?php

/**
 * 
 */
class AdminController extends EMController {

    public $defaultAction = 'admin';
    public $breadcrumbs;
    public $menu;
    private $_model;

    /**
     * @return array action filters
     */
    public function filters() {
        return CMap::mergeArray(parent::filters(), array(
                    'accessControl', // perform access control for CRUD operations
        ));
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    /* public function accessRules()
      {
      return array(
      array('allow', // allow admin user to perform 'admin' and 'delete' actions
      'actions'=>array('admin','delete','create','update','view','status'),
      'users'=>UserModule::getAdmins(),
      ),
      array('deny',  // deny all users
      'users'=>array('*'),
      ),
      );
      } */

    /**
     * Manages all models.
     */
    public function accessRules() {
        Yii::import('common.modules.user.UserModule');
        return array(
            array(
                'allow',
                'users' => UserModule::UAC(array('superadmin')),
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionAdmin() {
        //$model=new User('search');
        $model = new Participant('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Participant'])) {
            $model->attributes = $_GET['Participant'];
        } else if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
        }
        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Структура участников: 1) найти участника
     */
    public function actionStructure() {
        $model = new Participant('empty');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Participant'])) {
            $model->scenario = 'structure';
            $model->attributes = $_GET['Participant'];
        }
        $this->render('structure', array(
            'model' => $model,
        ));
    }

    /**
     * Структура участников: 2) показать подчинённых
     */
    public function actionSeestructure($id = null) {
        if (!$participant = Participant::model()->findByPk($id))
            throw New CHttpException("Участник с таким ИД не найден (#$id)");

        $model = new Participant('seestructure');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Participant'])) {
            $model->attributes = $_GET['Participant'];
        }
        if (isset($id)) {
            $model->refer_id = $id;
        }
        $this->render('seestructure', array(
            'model' => $model,
            'participant' => $participant,
        ));
    }

    /**
     * Структура Бизнес Клуба
     */
    public function actionBcstructure($id = null) {
        $model = new Participant('bcstructure');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Participant'])) {
            $model->attributes = $_GET['Participant'];
        }
        if (isset($id)) {
            $model->refer_id = $id;
        }
        $this->render('bcstructure', array(
            'model' => $model,
        ));
    }

    /**
     * Displays a particular model.
     */
    public function actionView() {
        $id = $_GET['id'];
        $model = $this->loadModel($id);
        //Доход
        $income = PmTransactionLog::getIncomeById($id);
        //Отчисления
        $transferFund = PmTransactionLog::getTransferFundById($id);

        $this->render('view', array(
            'model' => $model,
            'income' => $income,
            'transferFund' => $transferFund
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Participant;
        $this->performAjaxValidation(array($model));
        if (isset($_POST['Participant'])) {
            $model->attributes = $_POST['Participant'];
            if (!empty($_POST['Participant']['bot'])) {
                $model->tariff_id = (int) $_POST['Participant']['bot'];
                if ($model->tariff_id > Participant::BOT_50 && $model->tariff_id <= Participant::BOT_BC_GOLD) { // если бот клубный предполагается, то даем ему сразу в клуб вступить
                    $model->club_date = date('Y-m-d H:i:s');
                    $model->busy_date = date('Y-m-d H:i:s');
                }
            }
            $model->activkey = Yii::app()->controller->module->encrypting(microtime() . $model->password);
            if ($model->validate()) {
                // дополнительное условие "имитация оплаты 20+50"
                if ($model->tariff_id == Participant::BOT_50){
                    $model->busy_date = date('Y-m-d H:i:s');
                }
                $model->password = Yii::app()->controller->module->encrypting($model->password);
                if ($model->save()) {
                    if ($model->tariff_id == Participant::BOT_50) { // в случае создания бота bot-50 создаем ему фейковую транзакцию проплаты
                        $fakeTransaction = new PmTransactionLog();
                        $fakeTransaction->from_user_id = $model->id;
                        $fakeTransaction->to_user_id = $_POST['Participant']['refer_id'];
                        $fakeTransaction->amount = marketingPlanHelper::init()->getMpParam('price_start');
                        $fakeTransaction->tr_kind_id = $fakeTransaction::BOT_REGISTRATION;
                        $fakeTransaction->save();
                    }
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate() {
        $model = $this->loadModel($_GET['id']);
        $this->performAjaxValidation(array($model));
        if (isset($_POST['Participant'])) {
            $model->attributes = $_POST['Participant'];
            if (!empty($_POST['Participant']['bot'])) {
                $model->tariff_id = (int) $_POST['Participant']['bot'];
                if ($model->tariff_id > Participant::BOT_50 && $model->tariff_id <= Participant::BOT_BC_GOLD) { // если бот обновляется до клубного
                    $model->club_date = date('Y-m-d H:i:s');
                    $model->busy_date = date('Y-m-d H:i:s');
                } else {
//                    $model->club_date = date('0000-00-00 00:00:00');
//                    $model->busy_date = date('0000-00-00 00:00:00');
                }
            }
            if ($model->validate()) {
                $old_password = Participant::model()->notsafe()->findByPk($model->id);
                if ($old_password->password != $model->password) {
                    $model->password = Yii::app()->controller->module->encrypting($model->password);
                    $model->activkey = Yii::app()->controller->module->encrypting(microtime() . $model->password);
                }
                $model->save();
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete() {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($_GET['id']);
            if ($model->tariff_id == '0') {
                foreach ($model->pmfromuser as $tr_log) {
                    if (is_null($tr_log->tr_err_code)) {
                        throw new CHttpException('500', 'Пользователя нельзя удалить, не смотря на его статус, у него имеются проплаты');
                    }
                    $tr_log->delete();
                }
            }
            //$profile = Profile::model()->findByPk($model->id);
            // Make sure profile exists
            //if ($profile)
            //	$profile->delete();
            try {
                $model->delete();
            } catch (Exception $ex) {
                throw new CHttpException('500', 'Нельзя удалить пользователя, который совершил хотя-бы один платеж');
            }
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_POST['ajax']))
                $this->redirect(array('/user/admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($validate) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($validate);
            Yii::app()->end();
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel($id) {
        if ($this->_model === null) {
            if (isset($_GET['id']))
                $this->_model = Participant::model()->notsafe()->findbyPk($_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     * put your comment there...
     * 
     */
    public function actionStatus($id, $status) {
        $this->loadModel($_GET['id'])->setStatus($status);
    }

}
