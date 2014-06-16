<?php

/** 
 * This is the model class for table "invitation".
 */ 
class Invitation extends CFormModel
{
    const ITEM = 'INVITATION';
    public $videoLink; // линк на видеоролик в youtube
    public $fileLink; // линк на скачивание файлов
    public $bannerFiles = array(); // Баннеры
    public $decodedObject;

    public function rules(){
        return array(
            array('videoLink, fileLink, bannerFiles', 'safe' ),
        );
    }

    public function setBannerList($arr){
        if(empty($this->bannerFiles))
            $this->bannerFiles = array();
        $uploadFiles= array();
            foreach($arr as  $value){
                $uploadFiles[] = $value;
            }
     //   $tempArrays = array_diff($this->bannerFiles, $uploadFiles);
       // $temp = array_diff($this->bannerFiles, $tempArrays);
        if(count($this->bannerFiles) <= count($uploadFiles)) {
            $this->bannerFiles = array_merge($this->bannerFiles, $uploadFiles);
        } else {
            foreach($this->bannerFiles as $key => $file){
                if(!array_search($file['name'],$uploadFiles))
                {
                    unset($this->bannerFiles[$key]);
                }
            }
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
    public function LoadIndexManager(){
        $dbc = Yii::app()->db;
        $load = $dbc->createCommand('SELECT content FROM itemsstorage WHERE item="'.self::ITEM.'"');
        $data = $load->query();
        $dump = $data->read();
        $this->decodedObject = json_decode($dump['content'],true);
        $errorJsonMessage =  json_last_error();
        $this->videoLink = (isset($this->decodedObject['videoLink'])) ? $this->decodedObject['videoLink'] : '';
        $this->fileLink = (isset($this->decodedObject['fileLink'])) ? $this->decodedObject['fileLink'] : '';
        $this->bannerFiles = (isset($this->decodedObject['bannerFiles'])) ? $this->decodedObject['bannerFiles'] : '';
    }
    public function SaveIndexManager(){
        $prepare = array(
            'videoLink' => $this->videoLink,
            'fileLink' => $this->fileLink,
            'bannerFiles' => $this->bannerFiles,
        );

        $prepare = json_encode($prepare, JSON_UNESCAPED_UNICODE);
        $saveKind = ($this->checkInstance() == false) ? 'INSERT INTO' : 'UPDATE';
        if($saveKind == 'UPDATE')
        {
            $query = $saveKind .' itemsstorage SET content=' . "'".$prepare. "'" . ' WHERE item=' ."'". self::ITEM ."'";
        }else
        {
            $query =  $saveKind .
                ' itemsstorage SET' .
                ' item="'.self::ITEM.'", ' .
                "content='".$prepare."'";
        }
        $saveCommand = Yii::app()->db->createCommand($query);
        $saveCommand->execute();
    }
    private function checkInstance(){
        $checkCommand = Yii::app()->db->createCommand('SELECT content FROM itemsstorage WHERE item="INVITATION"');
        $result = $checkCommand->query();
        return $result->read();
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
} 