<?php
/**
*  класс для отправки почтового сообщения
*  использует расширение SwiftMailer
*/
class EmailHelper {

    const DEFAULT_FROM = 'noreply@justmoney.pro';
    
    /**
    * Отправить почту (от юзера) 
    */
    public static function sendFromUser($from = null, $emails = array(), $subject = '', $view = '', $data = array(), $file = '')
    {
        self::send($emails, $subject, $view, $data, $from);
    }
    
    /**
    * Отправить почту (от админа, нореплай) 
    */
    public static function sendFromAdmin($emails, $subject, $view, $data)
    {
        $from = isset(Yii::app()->params['adminEmail']) ? Yii::app()->params['adminEmail'] : self::DEFAULT_FROM;
        self::send($emails, $subject, $view, $data, $from);
    }
    
    /**
    * Отправить почту 
    * 
    * @param mixed $emails - кому (массив)
    * @param mixed $subject - тема
    * @param mixed $view - вью
    * @param mixed $data - данные (массив)
    * @param mixed $from - от кого 
    * @param mixed $file
    */
    private static function send($emails, $subject, $view, $data = array(), $from = '', $file = '')
    {
        if(empty($emails)) {
            return FALSE;
        }
        $message = new YiiMailMessage;
        $message->subject = $subject;
        $message->view = $view;
        $message->setBody($data, 'text/html');
        $message->setTo($emails);
        //$message->setFrom(array(Yii::app()->params['adminEmail'] => 'Fnetwork.ru'));
        Yii::log(Yii::app()->params['adminEmail'], 'trace', 'mail');
        $message->from = $from;
        if( !empty($file) ) {
            $message->attach(Swift_Attachment::fromPath($_SERVER['DOCUMENT_ROOT'].$file));
        }
        return Yii::app()->mail->send($message);
    }
    
    /*public static function send($emails, $subject, $view, $data, $file = '')
    {
        ////////// ЗАГЛУШКА для предотвращения отсылки емейла -- <
        //        if (is_file(Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'noemailsending')) { //наличие файла - признак того, чтобы емейл не отсылать
        //ТЕСТОВЫЙ вывод во вьюшку
        //$text = $message->body;  //НЕ РАБОТАЕТ!

        //if Yii::app()->controller doesn't exist create a dummy  controller to render the view (needed in the console app)
        // renderPartial won't work with CConsoleApplication, so use renderInternal - this requires that we use an actual path to the  view rather than the usual alias 
        //            $viewPath = Yii::getPathOfAlias(Yii::app()->mail->viewPath . '.' . $view).'.php';
        //            $controller = (isset(Yii::app()->controller)) ? Yii::app()->controller : new CController('YiiMail');
        //            $text = $controller->renderInternal($viewPath, $data, true);    
        //$text = $this->renderInternal($viewPath, $data, true);    

        //запись в лог (вместо отсылки по почте)
        //$text = "Отсылка сообщения на ". $email .", тема: " . $subject . "\n\rТекст:\n\r" . str_repeat('-', 50) . "\n\r" . $text . "\n\r" . str_repeat('-', 50) . "\n\r";
        //            Yii::log($text, CLogger::LEVEL_INFO, 'testmail');  
        //            return false;
        //        }
        ////////// >-- 
        //DebugBreak();
        if(empty($emails)) {
            return FALSE;
        }
        $message = new YiiMailMessage;
        $message->subject = $subject;
        $message->view = $view;
        $message->setBody($data, 'text/html');
        $message->setTo($emails);
        //$message->setFrom(array(Yii::app()->params['adminEmail'] => 'Fnetwork.ru'));
        Yii::log(Yii::app()->params['adminEmail'], 'trace', 'mail');
        //var_dump($emails);
        //var_dump(Yii::app()->params['adminEmail']);
        //Yii::app()->end();
        $message->from = ($from = Yii::app()->params['adminEmail']) ? $from : 'noreply@jwms.pro';
        //Yii::log($message->from, 'trace', 'mail');
        if( !empty($file) ) {
            $message->attach(Swift_Attachment::fromPath($_SERVER['DOCUMENT_ROOT'].$file));
        }
        return Yii::app()->mail->send($message);

    }*/
    
}
?>