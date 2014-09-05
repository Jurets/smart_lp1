<?php
class Indexmanager extends CFormModel {
    const ITEM = 'INDEX_MANAGER';
    public $lng; // приставка к константе для локализации на различных языках
    public $videolink; // линк на видеоролик в youtube
    public $title; // строка под словом ЛИДЕРЫ
    public $about; // контейнер для текст-контента "О системе"
    public $sliderlist = array(); // тело слайдера
    
    public function init() {
        $this->lng = self::ITEM . Yii::app()->language; // инициация приставки определения локали
    }
    
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
        $load = $dbc->createCommand('SELECT content FROM itemsstorage WHERE item="'.$this->lng.'"');
        $data = $load->query();
        $dump = $data->read();
        $dump = $this->checkDefaultInstance($dump);
        $decodedObject = json_decode($dump['content'], true);
        $this->videolink = (isset($decodedObject['videolink'])) ? trim($decodedObject['videolink']) : '';
        $this->title = (isset($decodedObject['title'])) ? $decodedObject['title'] : '';
        $this->about = (isset($decodedObject['about'])) ? $decodedObject['about'] : '';
        $this->about = str_replace(array("\r","\n"),'<br>',$this->about);
        $this->about = str_replace('<br><br>','<br>',$this->about); 
        $this->sliderlist = $decodedObject['sliderlist'];
    }
    public function SaveIndexManager(){
        /*модуль приведения к нормальному виду - будущий вспомогательный метод модели -> bgiin */
        $reorg_buffer = array();
        foreach ($this->sliderlist as $reorganisation){
            $reorganisation['descriptio'] = str_replace(array("\r","\n"),'<br>',$reorganisation['descriptio']);
            $reorganisation['descriptio'] = str_replace('<br><br>','<br>',$reorganisation['descriptio']);
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
        $variant1 = ' itemsstorage SET item = "'.$this->lng.'", content = \'' . $prepare . '\''; // insert
        $variant2 = ' itemsstorage SET content = \''.$prepare.'\' where item = "'.$this->lng . '"'; // update
        $command = ($this->checkInstance() == false) ? $variant1 : $variant2;
        $saveCommand = Yii::app()->db->createCommand($saveKind . $command . ';');
        $saveCommand->execute();
    }
    private function checkInstance(){
        $checkCommand = Yii::app()->db->createCommand('SELECT content FROM itemsstorage WHERE item="'.$this->lng.'"');
        $result = $checkCommand->query();
        return $result->read();
    }
    private function checkDefaultInstance($dump){ // если ничего не найдено, пытается взять данные из инстанса, где дефолтный язык, и тогда - просто редактирование вместо полного ввода
        // Так можно отличить backend от frontend
        if(isset(Yii::app()->params['backendIs'])){
            if($dump){
                return $dump; // отдаем в поток как есть
            }else{ // все же попытаемся  найти что-нибудь
               $checkCommand = Yii::app()->db->createCommand('SELECT content FROM itemsstorage WHERE item="'.self::ITEM.Yii::app()->params['default.language'].'"');
               $result = $checkCommand->query();
               return $result->read();
            }
        }
        return $dump;
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

