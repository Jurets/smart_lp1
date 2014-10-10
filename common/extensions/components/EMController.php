<?php
/*
 * Расширение Econtroller под хранение  языков в сессии
 */
class EMController extends EController {
    
    public $modelClass;
    
    /**
    * put your comment there...
    * 
    */
    public function init(){
        
//        if(isset(Yii::app()->user->id)){
//            $user = User::model()->findByPk(Yii::app()->user->id);
//            if($user){
//                $language = $user->sys_lang;
//                Yii::app()->language = $language;
//                Yii::app()->request->cookies['language'] = new CHttpCookie('language', $language);
//            }
//        }elseif(isset($_COOKIE['language'])){
//            Yii::app()->language = (string)Yii::app()->request->cookies['language'];
//        }else{
//            Yii::app()->language = Yii::app()->params['default.language']; // языком по умолчанию принимается русский
//        }
       
//      if(!Yii::app()->user->isGuest){
//          $user = User::model()->findByPk(Yii::app()->user->id);
//          if($user && $user->superuser == 0){
//            Yii::app()->language = $user->sys_lang;
//            Yii::app()->request->cookies['language'] = new ChttpCookie('language', Yii::app()->language);
//            return true;
//          }
//      }
      if(isset($_COOKIE['language'])){
          Yii::app()->language = (string)Yii::app()->request->cookies['language'];
      }else{
          //проверим пользователя, если он не суперюзер, запросим его язык из бд и применим
          if(!Yii::app()->user->isGuest){
              $user = User::model()->findByPk(Yii::app()->user->id);
              if($user && (int)$user->superuser == 0){
                  Yii::app()->language = $user->sys_lang;
                  Yii::app()->request->cookies['language'] = new CHttpCookie('language', Yii::app()->language);
                  return true;
              }
          }
          Yii::app()->language = Yii::app()->params['default.language']; // языком по умолчанию принимается язык, указанный в конфигурации
      }
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Requisites the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $class = $this->modelClass;
        $model = $class::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    
}
