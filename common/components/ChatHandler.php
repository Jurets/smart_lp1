<?php
class ChatHandler extends YiiChatDbHandlerBase {

    //
    // IMPORTANT:
    // in any time here you can use this available methods:
    //  getData(), getIdentity(), getChatId()
    //
    protected function getDb(){
        // the application database
        return Yii::app()->db;
    }
    protected function createPostUniqueId(){
        // generates a unique id. 40 char.
        return hash('sha1',$this->getChatId().time().rand(1000,9999));      
    }
    protected function getIdentityName(){
        // find the identity name here
        // example:  $model = MyPeople::model()->findByPk($this->getIdentity()); return $model->userFullName();
          /*if (is_object(Yii::app()->user->id)) {
              $user = Yii::app()->user->id;
          } else if (Yii::app()->controller->userBySub) {
              $user = Yii::app()->controller->userBySub;
          } else {
              $user = Users::model()->findByPk($this->getIdentity());
              Yii::app()->controller->userBySub = $user;
          } */
          //return $user->alias;  
          //$username = $user->first_name . (!empty($user->last_name) ? ' ' . $user->last_name : '');
          //$username = Yii::app()->user->first_name . (!empty(Yii::app()->user->last_name) ? ' ' . Yii::app()->user->last_name : '');
          $username = implode(' ', array(Yii::app()->user->first_name, Yii::app()->user->last_name));
          //$username = Yii::app()->user->name;
          return $username;
          /////return "jhonn doe"; 
    }
    protected function getDateFormatted($value){
        // format the date numeric $value
        return Yii::app()->format->formatDateTime($value);
    }
    
    /**
    * разрешенные сообщения (контроль)
    * 
    * @param mixed $message
    */
    public function acceptMessage($message){
        // return true for accept this message. false reject it.
        //return true;
        // !!! то, что выше - под вопросом... опыт показал, что надо вертать сам текст месага
        return $message;
    }
    
    //!!!! ниже - ЭТО БЫЛА ПРОБА!... пока не получилось )))
    //Функция заменяет коды смайлов в тексте сообщения на картинки
    /*private function replaceEmoticons($text) {
        $url = "/images/smileys/formess/"; //uri картинок смайлов
        $patterns = array(); //массив для регэкспов
        $metachars = '/[[\]{}()*+?.\\|^$\-,&#\s]/g'; //символы которые надо экранировать

        //собираем регэксп для каждого кода смайла
        foreach ($emoticons as $i) {
            if ($emoticons.hasOwnProperty($i)){ // escape metacharacters
                $patterns.push('(' + $i.replace($metachars, "\\$&") + ')');
                array_push($patterns, '(' + $i.replace($metachars, "\\$&") + ')');
          }
        }

        //заменяем код смайла на картинку, используя регэкспы
        $regexp = implode()
        return text.replace(new RegExp($patterns.join('|'),'g'), function (match) {
          return typeof $emoticons[match] != 'undefined' ?
                 '<span class="chat-log-smile-wrapper"><img src="'+url+emoticons[match]+'"/></span>' :
                 match;
        });
      } */    
}
?>