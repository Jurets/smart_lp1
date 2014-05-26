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
        foreach($arr as $elem){
            $this->sliderlist[] = $elem;
        }
    }
    public function LoadIndexManager(){
        $dbc = Yii::app()->db;
        $load = $dbc->createCommand('SELECT content FROM itemsstorage WHERE item="INDEX_MANAGER"');
        $data = $load->query();
        $dump = $data->read();
        $decodedObject = json_decode($dump['content']);
        var_dump($decodedObject);die;
        $this->videolink = (isset($decodedObject->videolink))? $decodedObject->videolink: '';
        $this->about = (isset($decodedObject->about))? $decodedObject->about : '';
        $this->sliderlist = (isset($decodedObject->sliderlist))?$decodedObject->sliderlist:array();
    }
    public function SaveIndexManager(){
        $prepare = array(
            'videolink' => $this->videolink,
            'about' => $this->about,
            'sliderlist' => $this->sliderlist,
        );
        $prepare = json_encode($prepare);
        var_dump($prepare);die;
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

