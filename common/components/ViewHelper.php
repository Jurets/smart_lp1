<?php
/**
*  Класс-помощник для работы с представлениями
*  
*/
class ViewHelper {

    /**
    * приглашение выбрать из списка
    * 
    */
    public static function getPrompt($prompt) {
        return '<' . Yii::t('common', $prompt) . '>';
    }

    /**
    * сформировать значения для выпадающего списка
    * 
    * @param mixed $data - входной массив
    */
    public static function selectOptions($data = array(), $prompt = '<>') {
        echo CHtml::tag('option', array('value'=>''), $prompt, true);
        foreach ($data as $value=>$name) {
            echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name), true);
        }
    }

    /**
    *  список всех стран
    * 
    */
    /*public static function getCountriesList() {
        return CHtml::listData(Countries::model()->findAll(array('order'=>'name ASC')), 'name', 'name');
    }*/
    
}
?>