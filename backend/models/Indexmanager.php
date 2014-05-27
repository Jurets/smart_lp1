<?php
class Indexmanager extends CFormModel {
    const ITEM = 'INDEX_MANAGER';
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
        
    public function setSliderList($arr){
        $this->sliderlist = array();
        foreach($arr as $i=>$elem){
            $this->sliderlist[] = $elem;
        }
    }
    public function setImages($arr){
        foreach($arr as $i=>$elem){
            $this->sliderlist[$i]['photo'] = $elem['url'];
        }
    }
    public function LoadIndexManager(){
        $dbc = Yii::app()->db;
        $load = $dbc->createCommand('SELECT content FROM itemsstorage WHERE item="'.self::ITEM.'"');
        $data = $load->query();
        $dump = $data->read();
        $decodedObject = json_decode($dump['content'], true);
        $this->videolink = $decodedObject['videolink'];
        $this->about = $decodedObject['about'];
        $this->sliderlist = $decodedObject['sliderlist'];
    }
    public function SaveIndexManager(){
        debug_backtrace();
        $prepare = array(
            'videolink' => $this->videolink,
            'about' => $this->about,
            'sliderlist' => $this->sliderlist,
        );
        
        $prepare = json_encode($prepare, JSON_UNESCAPED_UNICODE);
        $saveKind = ($this->checkInstance() == false) ? 'INSERT INTO' : 'UPDATE';
        $saveCommand = Yii::app()->db->createCommand(
                $saveKind . 
                ' itemsstorage SET' . 
                ' item="'.self::ITEM.'", ' .
                "content='".$prepare."'"
                );
        $saveCommand->execute();
    }
    private function checkInstance(){
        $checkCommand = Yii::app()->db->createCommand('SELECT content FROM itemsstorage WHERE item="INDEX_MANAGER"');
        $result = $checkCommand->query();
        return $result->read();
    }
}

