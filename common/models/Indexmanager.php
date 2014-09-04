<?php
class Indexmanager extends CFormModel {
    const ITEM = 'INDEX_MANAGER';
    public $videolink; // линк на видеоролик в youtube
    public $title; // строка под словом ЛИДЕРЫ
    public $about; // контейнер для текст-контента "О системе"
    public $sliderlist = array(); // тело слайдера
    
    public function rules(){
        return array(
            array('videolink, title, about', 'safe' ),
        );
    }
        
    public function setSliderList($arr){
        $this->sliderlist = array();
        foreach($arr as $i=>$elem){
            $this->sliderlist[$i] = $elem;
        }
    }
    public function setImages($arr, $key="name"){ // ключом указываеи на запись в слайдер нужного ресурса (url, path, filename)
        foreach($arr as $i=>$elem){
           $this->sliderlist[$i]['photo'] = $elem[$key];
        }
    }
    public function LoadIndexManager(){
        $dbc = Yii::app()->db;
        $load = $dbc->createCommand('SELECT content FROM itemsstorage WHERE item="'.self::ITEM.'"');
        $data = $load->query();
        $dump = $data->read();
        $decodedObject = json_decode($dump['content'], true);
        $this->videolink = (isset($decodedObject['videolink'])) ? $decodedObject['videolink'] : '';
        $this->title = (isset($decodedObject['title'])) ? $decodedObject['title'] : '';
        $this->about = (isset($decodedObject['about'])) ? $decodedObject['about'] : '';
        $this->sliderlist = $decodedObject['sliderlist'];
    }
    public function SaveIndexManager(){
        /*модуль приведения к нормальному виду - будущий вспомогательный метод модели -> bgiin */
        $reorg_buffer = array();
        foreach ($this->sliderlist as $reorganisation){
            $reorg_buffer[] = $reorganisation;
        }
        $this->sliderlist = $reorg_buffer;
        /*-> end */
        $prepare = array(
            'videolink' => $this->videolink,
            'title' => $this->title,
            'about' => $this->about,
            'sliderlist' => $this->sliderlist,
        );
  
        $prepare = json_encode($prepare, JSON_UNESCAPED_UNICODE);
        $saveKind = ($this->checkInstance() == false) ? 'INSERT INTO' : 'UPDATE';
        $variant1 = ' itemsstorage SET item = "'.self::ITEM.'", content = \'' . $prepare . '\''; // insert
        $variant2 = ' itemsstorage SET content = \''.$prepare.'\' where item = "'.self::ITEM . '"'; // update
        $command = ($this->checkInstance() == false) ? $variant1 : $variant2;
        $saveCommand = Yii::app()->db->createCommand($saveKind . $command . ';');
        $saveCommand->execute();
    }
    private function checkInstance(){
        $checkCommand = Yii::app()->db->createCommand('SELECT content FROM itemsstorage WHERE item="'.self::ITEM.'"');
        $result = $checkCommand->query();
        return $result->read();
    }
     public function attributeLabels(){
         return array(
            'videolink' => BaseModule::t('rec','Video Link'),
            'title' => BaseModule::t('rec','Title'),
            'about' => BaseModule::t('rec','About Us'),
            'sliderlist' => BaseModule::t('rec','Sliderlist'),
         );
     }
}

