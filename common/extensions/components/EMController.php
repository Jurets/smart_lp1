<?php
/*
 * Расширение Econtroller под хранение  языков в сессии
 */
class EMController extends EController {
    public function init(){
        if(isset($_COOKIE['language'])){
            Yii::app()->language = (string)Yii::app()->request->cookies['language'];
        }else{
            Yii::app()->language = 'en';
        }
    }
}
