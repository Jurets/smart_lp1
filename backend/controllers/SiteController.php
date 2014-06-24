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
    class SiteController extends EController
    {
        public function actionIndex()
        {
            //$this->redirect('/user/login');
            $this->redirect($this->createUrl('/user/login'));
            //$this->render('index');
        }
        /**
        * This is the action to handle external exceptions.
        */
        public function actionError()
        {
            if($error=Yii::app()->errorHandler->error)
            {
                if(Yii::app()->request->isAjaxRequest)
                    echo $error['message'];
                else
                    $this->render('error', $error);
            }
        }

        public function actionTestmail() {//DebugBreak();
            /*$message = new YiiMailMessage;
            $message->view = 'invite';

            //userModel is passed to the view
            $message->setBody(array(), 'text/html');


            //$message->addTo($userModel->email);
            $message->addTo('jurets75@rambler.ru');
            //$message->from = Yii::app()->params['adminEmail'];
            $message->from = 'noreply@jwms.pro';
            Yii::app()->mail->send($message);*/
            if (EmailHelper::send(array('jurets75@rambler.ru'), 'Тестовая отсылка', 'test', array()))
                echo 'Успешная отсылка!';
            else
                echo '---Ошибка при отсылке';
            
            if (mail('jurets75@rambler.ru', 'test theme', 'test message'))
                echo 'Успешная отсылка функцией mail!';
            else
                echo '---Ошибка при отсылке функцией mail';
        }
}