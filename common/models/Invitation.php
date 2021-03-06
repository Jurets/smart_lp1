<?php

/** 
 * This is the model class for table "invitation".
 */ 
class Invitation extends CFormModel
{
    const ITEM = 'INVITATION';
    public $lng; // приставка к константе для локализации на различных языках
    public $videoLink; // линк на видеоролик в youtube
    public $fileLink; // линк на скачивание файлов
    public $bannerFiles = array(); // Баннеры
    public $text; // Контент страницы
    public $decodedObject;

    public function init() {
        $this->lng = self::ITEM . Yii::app()->language; // инициация приставки определения локали
    }
    
    public function rules(){
        return array(
            array('videoLink, fileLink, bannerFiles, text', 'safe' ),
        );
    }
    
    public function setBannerList($arr){
         $this->bannerFiles = array();
            foreach($arr as $i=>$elem){
                $this->bannerFiles[$i] = $elem;
            }
    }
    public function checkChangesArrFiles($arrPostFiles)
    {
        foreach ($arrPostFiles as $key=>$name) {
            if($arrPostFiles[$key]['name'] == '')
            {
                unset($arrPostFiles[$key]);
            }
        }
        return $arrPostFiles;
    }
    public function loadInvitationManager(){
        $dbc = Yii::app()->db;
        $load = $dbc->createCommand('SELECT content FROM itemsstorage WHERE item="'.$this->lng.'"');
        $data = $load->query();
        $dump = $data->read();
        $dump = $this->checkDefaultInstance($dump);
        $this->decodedObject = json_decode($dump['content'],true);
        $errorJsonMessage =  json_last_error();
        $this->videoLink = (isset($this->decodedObject['videoLink'])) ? $this->decodedObject['videoLink'] : '';
        $this->fileLink = (isset($this->decodedObject['fileLink'])) ? $this->decodedObject['fileLink'] : '';
        $this->bannerFiles = (isset($this->decodedObject['bannerFiles'])) ? $this->decodedObject['bannerFiles'] : '';
        $this->text = (isset($this->decodedObject['text'])) ? htmlspecialchars_decode($this->decodedObject['text']) : '';

    }
    public function saveInvitationManager(){
        /*модуль приведения к нормальному виду - будущий вспомогательный метод модели -> bgiin */
        $reorg_buffer = array();
        foreach ($this->bannerFiles as $reorganisation){
            $reorg_buffer[] = $reorganisation;
        }
        $this->bannerFiles = $reorg_buffer;
        /*-> end */
        $prepare = array(
            'videoLink' => $this->videoLink,
            'fileLink' => $this->fileLink,
            'bannerFiles' => $this->bannerFiles,
            'text'=> htmlspecialchars($this->text),
        );
        $prepare = json_encode($prepare, JSON_UNESCAPED_UNICODE);
        $errorJsonMessage =  json_last_error();
        $saveKind = ($this->checkInstance() == false) ? 'INSERT INTO' : 'UPDATE';
        $variant1 = ' itemsstorage SET item = "'.$this->lng.'", content = \'' . $prepare . '\''; // insert
        $variant2 = ' itemsstorage SET content = \''.$prepare.'\' where item = "' .$this->lng. '"'; // update
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

    public function deletePathToPc($arrImages,$operation)
    {
        if($operation == 'tmp_name')
        {
        foreach($arrImages as $key => $image)
        {
            $str=strpos($image['tmp_name'], "php");
            $arrImages[$key]['tmp_name'] = substr($image['tmp_name'], $str);
        }
        }else
        {
        foreach($arrImages as $key => $image)
        {
            $str=strpos($image['path'], "inv");
            $arrImages[$key]['path'] = substr($image['path'], $str);
        }
        }
        return $arrImages;
    }
    
    public function setImages($arr, $key="name"){ // ключом указываеи на запись в слайдер нужного ресурса (url, path, filename)
        foreach($arr as $i=>$elem){
            $this->bannerFiles[$i]['name'] = $elem[$key];
        }
    }
    public function attributeLabels(){
        return array(
           'videoLink' => BaseModule::t('rec', 'Video Link'),
            'fileLink' => BaseModule::t('rec','File Link'),
            'bannerFiles' => BaseModule::t('rec','Banner'),
            'text' => BaseModule::t('rec','Text'),
        );
    }
} 