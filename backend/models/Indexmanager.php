<?php

class Indexmanager extends CFormModel {
    public $videoLink; // линк на видеоролик в youtube
    public $about; // контейнер для текст-контента "О системе"
    public $sliderList; // массив пар: линк на upload-фото и text-описание
    private jsonResult
    private const INDEX_ITEM = 'indexmanagement'; // первичный ключ для json-объекта у 
    
    public function rules(){
        return array(
            //array('videolink', 'about', ),
        );
    }
}

