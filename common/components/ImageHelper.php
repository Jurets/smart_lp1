<?php
/**
 * Image helper functions
 * 
 * @author Chris
 * @link http://con.cept.me
 */
class ImageHelper {

    /**
     * Directory to store thumbnails
     * @var string 
     */
    const THUMB_DIR = 'tmb';

    /**
     * Create a thumbnail of an image and returns relative path in webroot
     * the options array is an associative array which can take the values
     * quality (jpg quality) and method (the method for resizing)
     *
     * @param int $width
     * @param int $height
     * @param string $img
     * @param array $options
     * @return string $path
     */
    public static function thumb($width, $height, $img, $options = null)
    {
        if(!file_exists($img)){
            $img = str_replace('\\', '/', YiiBase::getPathOfAlias('webroot').$img);
            if(!file_exists($img)){
                return $img;
                //return "none";
            }
        }

        // Jpeg quality
        $quality = 100;
        // Method for resizing
        $method = 'adaptiveResize';

        if($options){
            extract($options, EXTR_IF_EXISTS);
        }

        $pathinfo = pathinfo($img);
        $thumb_name = "thumb_".$pathinfo['filename'].'_'.$method.'_'.$width.'_'.$height.'.'.$pathinfo['extension'];
        $thumb_path = $pathinfo['dirname'].'/'.self::THUMB_DIR.'/';
        if(!file_exists($thumb_path)){
            mkdir($thumb_path);
        }
        
        if(!file_exists($thumb_path.$thumb_name) || filemtime($thumb_path.$thumb_name) < filemtime($img)){
            
            Yii::import('ext.phpThumb.PhpThumbFactory');
            $options = array('jpegQuality' => $quality);
            $thumb = PhpThumbFactory::create($img, $options);
            $thumb->{$method}($width, $height);
            $thumb->save($thumb_path.$thumb_name);
        }
        
        $relative_path = str_replace(YiiBase::getPathOfAlias('webroot'), '', $thumb_path.$thumb_name);
        return $relative_path;
    }
    
    public static function cropAdaptive($x, $y, $w, $h, $img)
    {
        if(!file_exists($img)){
            $img = str_replace('\\', '/', YiiBase::getPathOfAlias('webroot').$img);
            if(!file_exists($img)){
                return $img;
                //return "none";
            }
        }
        
        //final thumb dimensions
        $width = 336;
        $height = 160;
        // Jpeg quality
        $quality = 100;
        // Method for resizing
        
        $method = 'adaptiveResize';

        $pathinfo = pathinfo($img);
        $thumb_name = "thumb_".$pathinfo['filename'].'_'.$method.'_'.$width.'_'.$height.'.'.$pathinfo['extension'];
        $thumb_path = $pathinfo['dirname'].'/'.self::THUMB_DIR.'/';
        if(!file_exists($thumb_path)){
            mkdir($thumb_path);
        }
        
        if(!file_exists($thumb_path.$thumb_name) || filemtime($thumb_path.$thumb_name) < filemtime($img)){
            
            Yii::import('ext.phpThumb.PhpThumbFactory');
            $options = array('jpegQuality' => $quality);
            $thumb = PhpThumbFactory::create($img, $options);
            $thumb->crop($x, $y, $w, $h);
            $thumb->{$method}($width, $height);
            $thumb->save($thumb_path.$thumb_name);            
        }
        
        $relative_path = str_replace(YiiBase::getPathOfAlias('webroot'), '', $thumb_path.$thumb_name);
        return $relative_path;
    }
    
//    public static function compress($img, $width = 500, $height = 700, $options = null)
//    {
//        if(!file_exists($img)){
//            $img = str_replace('\\', '/', YiiBase::getPathOfAlias('webroot').$img);
//            if(!file_exists($img)){
//                return $img;
//                //return "none";
//            }
//        }
//
//        // Jpeg quality
//        $quality = 80;
//        // Method for resizing
//        $method = 'adaptiveResize';
//
//        if($options){
//            extract($options, EXTR_IF_EXISTS);
//        }
//
//        $pathinfo = pathinfo($img);
//        $thumb_name = "orig_".$pathinfo['filename'].'_'.$method.'_'.$width.'_'.$height.'.'.$pathinfo['extension'];
//        $thumb_path = $pathinfo['dirname'].'/';
//        if(!file_exists($thumb_path)){
//            mkdir($thumb_path);
//        }
//        
//        if(!file_exists($thumb_path.$thumb_name) || filemtime($thumb_path.$thumb_name) < filemtime($img)){
//            
//            Yii::import('ext.phpThumb.PhpThumbFactory');
//            $options = array('jpegQuality' => $quality);
//            $thumb = PhpThumbFactory::create($img, $options);
//            $thumb->{$method}($width, $height);
//            $thumb->save($thumb_path.$thumb_name);            
//        }
//        
//        $relative_path = str_replace(YiiBase::getPathOfAlias('webroot'), '', $thumb_path.$thumb_name);
//        return $relative_path;
//    }
    
    public static function compress($img, $width = 500, $height = 700, $options = null)
    {
        if(!file_exists($img)){
            $img = str_replace('\\', '/', YiiBase::getPathOfAlias('webroot').$img);
            if(!file_exists($img)){
                return $img;
                //return "none";
            }
        }
        $width = 0;
        $height = 537;
        // Jpeg quality
        $quality = 100;
        // Method for resizing
        $method = 'resize';

        if($options){
            extract($options, EXTR_IF_EXISTS);
        }

        $pathinfo = pathinfo($img);
        $thumb_name = "orig_".$pathinfo['filename'].'_'.$method.'_'.$width.'_'.$height.'.'.$pathinfo['extension'];
        $thumb_path = $pathinfo['dirname'].'/';
        if(!file_exists($thumb_path)){
            mkdir($thumb_path);
        }
        
        if(!file_exists($thumb_path.$thumb_name) || filemtime($thumb_path.$thumb_name) < filemtime($img)){
            
            Yii::import('ext.phpThumb.PhpThumbFactory');
            $options = array('jpegQuality' => $quality, 'resizeUp' => true, 'autorotate' => false);
            $thumb = PhpThumbFactory::create($img, $options);
            $thumb->{$method}($width, $height);
            $thumb->save($thumb_path.$thumb_name);            
        }
        
        $relative_path = str_replace(YiiBase::getPathOfAlias('webroot'), '', $thumb_path.$thumb_name);
        return $relative_path;
    }
    
    /* signature по умолчанию пустая - для возможности ресайза оригинала, если это необходимо */
    public static function makeNewsThumb($img, $signature='', $re_width=336, $re_height=160)
    {
        if(!file_exists($img)){
            $img = str_replace('\\', '/', YiiBase::getPathOfAlias('webroot').$img);
            if(!file_exists($img)){
                return $img;
                //return "none";
            }
        }
        $options = null;
        $width = $re_width;
        $height = $re_height;
        // Jpeg quality
        $quality = 100;
        // Method for resizing
        //adaptiveResize
        //resize
        $method = 'adaptiveResize';

        if($options){
            extract($options, EXTR_IF_EXISTS);
        }

        $pathinfo = pathinfo($img);
        //$thumb_name = "news_".$pathinfo['filename'].'_'.$width.'_'.$height.'.'.$pathinfo['extension'];
        $thumb_name = $signature . $pathinfo['filename'].'.'.$pathinfo['extension']; // заменено, , было resized- . ...
        $thumb_path = $pathinfo['dirname'].'/';
        if(!file_exists($thumb_path)){
            mkdir($thumb_path);
        }
        
        if(!file_exists($thumb_path.$thumb_name) || filemtime($thumb_path.$thumb_name) < filemtime($img)){
            Yii::import('ext.phpThumb.PhpThumbFactory');
            $options = array('jpegQuality' => $quality, 'resizeUp' => true, 'autorotate' => false);
            $thumb = PhpThumbFactory::create($img, $options);
            $thumb->{$method}($width, $height);
            $thumb->save($thumb_path.$thumb_name);            
        }
        
        $relative_path = str_replace(YiiBase::getPathOfAlias('webroot'), '', $thumb_path.$thumb_name);
        return $relative_path;
    }
}