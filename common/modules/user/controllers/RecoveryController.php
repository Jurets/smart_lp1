<?php

class RecoveryController extends EMController
{

    public $defaultAction = 'recovery';

    /**
     * Recovery password
     */
    public function actionRecovery()
    {
        if (Yii::app()->user->id) {
            $this->redirect(Yii::app()->controller->module->returnUrl);
        } else {
            $email = Yii::app()->request->getParam('email');

            if (!empty($email)) {

                $user = User::model()->notsafe()->findByAttributes(array('email' => $email));
                if (isset($user->email) && $user->email == $email) {
                    //Generate new password
                    $password = $this->_getNewPassword();
                    $user->password = $password;
                    if (!$user->save()) {
                        $this->_handlerError("New password has not been sent");
                    } else {
                        //send email
                        $res = EmailHelper::send(array($user->email), BaseModule::t('rec', 'Recovery password'), 'recoveryPassword', array(
                                    '$user' => $user,
                                    'password' => $password
                        ));
                        if ($res) {
                            $this->_handlerError("New password has been sent, check your e-mail",true);
                        } else {
                            $this->_handlerError("New password has not been sent");
                        }
                    }
                } else {
                    $this->_handlerError("Incorrect e-mail");
                }
            } else {
                $this->_handlerError("Enter your email");
            }
        }
    }

    private function _getNewPassword($length = 10)
    {
        $chars = "QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890";
        $chars = str_split($chars);
        shuffle($chars);
        $password = implode('', $chars);
        $password = substr($password, 0, $length);
        return $password;
    }

    private function _handlerError($message, $success = false)
    {
        echo CJSON::encode(array(
            'message' => BaseModule::t('rec', $message),
            'success' => $success
        ));
        Yii::app()->end();
    }

}
