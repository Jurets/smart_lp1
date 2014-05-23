<?php
class Indexmanager extends CFormModel {
    public $videolink; // линк на видеоролик в youtube
    public $about; // контейнер для текст-контента "О системе"
    public $sliderlist; // массив пар: линк на upload-фото и text-описание
    private $jsonResult;
    
    public function rules(){
        return array(
            array('videolink', 'about', 'sliderlist', 'safe' ),
        );
    }
}

