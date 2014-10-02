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
        if(isset(Yii::app()->user->id)){
            $user = User::model()->findByPk(Yii::app()->user->id);
            $language = $user->sys_lang;
            Yii::app()->language = $language;
        }elseif(isset($_COOKIE['language'])){
            Yii::app()->language = (string)Yii::app()->request->cookies['language'];
        }else{
            Yii::app()->language = Yii::app()->params['default.language']; // языком по умолчанию принимается русский
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
