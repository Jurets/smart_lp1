<?php
class Indexmanager extends CFormModel {
    public $videolink; // линк на видеоролик в youtube
    public $about; // контейнер для текст-контента "О системе"
//    public $sliderlist = array(
//        array('leader'=>'', 'photo' =>'no photo', 'photo_source'=>'', 'descriptio'=>'', ),
//    ); // массив пар (пока пар):  [leader, photo, descriptio] линк на upload-фото и text-описание, может добавиться что-то еще
    public $sliderlist = array();
    
    public function rules(){
        return array(
            array('videolink, about', 'safe' ),
        );
    }
    public function LoadIndexManager(){
        $dbc = Yii::app()->db;
        $load = $dbc->createCommand('SELECT content FROM itemsstorage WHERE item="INDEX_MANAGER"');
        $data = $load->query();
        $decodedObject = json_decode($data->read());
        $this->videolink = $decodedObject['videolink'];
        $this->about = $decodedObject['about'];
        $this->sliderlist = $decodedObject['sliderlist'];
    }
    public function SaveIndexManager(){
        $dbc = Yii::app()->db;
        $prepare = array(
            'videolink' => $this->videolink,
            'about' => $this->about,
            'sliderlist' => $this->sliderlist,
        );
        //$save = $dbc->createCommand("REPLACE INTO itemsstorage (col1,col2) VALUES(15,col1*2);");
    }
}

