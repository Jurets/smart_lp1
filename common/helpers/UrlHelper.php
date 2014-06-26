<?php
    class UrlHelper {
    
    const DEFAULT_PATH = '/uploads';
    const DEFAULT_PHOTO = '';
    
    private $_baseDir = '';
    private $_baseUrl = '';
    
    /**
    * конструктор
    * 
    */
    /*public function __construct() {
        //путь к хранилищу файлов (из настроек)
        $this->_baseDir = isset(Yii::app()->params['upload.path']) ? Yii::app()->params['upload.path'] : self::DEFAULT_PATH;
        //базовый урл (из настроек)
        $this->_baseUrl = isset(Yii::app()->params['upload.url']) ? Yii::app()->params['upload.url'] : self::DEFAULT_PATH;
    }*/
    
    /**
    * вернуть URL картинки
    * 
    * @param mixed $fileName - имя файла (без пути естесно))
    * @param mixed $default - файл по дефолту, если $fileName не найден
    * @return CAttributeCollection
    */
    public static function getImageUrl($fileName, $default = '') {
        //путь к хранилищу файлов (из настроек)
        $dir = isset(Yii::app()->params['upload.path']) ? Yii::app()->params['upload.path'] : self::DEFAULT_PATH;
        //базовый урл (из настроек)
        $url = isset(Yii::app()->params['upload.url']) ? Yii::app()->params['upload.url'] : self::DEFAULT_PATH;
        if (is_file($dir . DIRECTORY_SEPARATOR . $fileName))
            return $url . basename($fileName);  
        else { //если файл не найден - вернуть дефолтное фото
            if (!empty($default)) {
                if (is_file($default))
                    return $default;
                else if (is_file($dir . DIRECTORY_SEPARATOR . $default))
                    return $dir . DIRECTORY_SEPARATOR . $default;
            }
            return isset(Yii::app()->params['photo.default']) ? Yii::app()->params['photo.default'] : self::DEFAULT_PHOTO;
        }
    }

    /*public static function getDefaultPhotoUrl($fileName) {
        
    }*/
    
    /*public static function getImageUrl($fileName, $subdir = '', $secondfile = '') {
        $dir = Yii::app()->params['upload.path'];
        $url = Yii::app()->params['upload.url'];
        if (is_file($dir . $subdir . DIRECTORY_SEPARATOR . $fileName))
            return $url . $subdir . '/' . basename($fileName);
        else if (is_file($dir . DIRECTORY_SEPARATOR . $secondfile))
            return $url . basename($secondfile);
        else if (is_file($dir . DIRECTORY_SEPARATOR . $fileName))
            return $url . basename($fileName);  
        else
            return Yii::app()->params['photo.default'];
    }*/
    
    public static function getImageDir(){
        return Yii::app()->params['upload.path'];
    }
    
    public static function getBaseImageUrl() {
        return Yii::app()->params['upload.url'];
    }    
    
      public static function getDefaultImageUrl() {
        return Yii::app()->params['photo.default'];
    }
       
   }
?>
