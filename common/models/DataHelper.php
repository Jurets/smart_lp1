<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataHelper
 *
 * @author merlinoff
 */
class DataHelper {
    //put your code here

    const DATE_OFFSET = 2;
    const CONFIG_FILE = 'config.json';

    public static function calculate($mktime){
//        DebugBreak();
        $time = $mktime - self::serverTime();
//        $time = $mktime - time();

        $active = false;
        if ($time>0 and $time<60*15)
            $active = true;

        $days = (int)$time/(24*3600); //получили количество дней
        $time = $time - (int)$days*24*3600;
        $hours = (int)$time/3600;
        $time = $time - (int)$hours*3600;
        $minutes = (int)$time / 60;
        $seconds =  $time - (int)$minutes *60;

        return array(
            'active'=>$active,
            'days'=>sprintf("%02s",(int)$days),
            'hours'=>sprintf("%02s",(int)$hours),
            'minutes'=>sprintf("%02s",(int)$minutes),
            'seconds'=>sprintf("%02s",(int)$seconds)
        );

    }

    //get timestamp for current server's timezone
    public static function serverTime(){
        $offset = self::get_timezone_offset(Yii::app()->timeZone, 'Europe/Vilnius');
        return time() + $offset;
    }
    public static function get_timezone_offset($remote_tz, $origin_tz = null) {
        if($origin_tz === null) {
            if(!is_string($origin_tz = date_default_timezone_get())) {
                return false; // A UTC timestamp was returned -- bail out!
            }
        }
        $origin_dtz = new DateTimeZone($origin_tz);
        $remote_dtz = new DateTimeZone($remote_tz);
        $origin_dt = new DateTime("now", $origin_dtz);
        $remote_dt = new DateTime("now", $remote_dtz);
        $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
        return $offset;
    }
    public static function formattedDate($timestamp){
        return Yii::app()->dateFormatter->format('dd.MM.yy HH:mm', $timestamp);
    }

    public static function formattedDateEx($timestamp){
        return Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm:ss', $timestamp);
    }

    //смещение времени от gmt 0 в секундах
    public static function getOffset(){
        $date = new DateTime();
        $offset = $date->getOffset();
        return $offset;
    }
    //из текущей метки делаем метку с gmt 0
    public static function getGMTimestamp($timestamp){
        return $timestamp - self::getOffset();
    }
    public static function fromGMTtoLocalTimestamp($timestamp){
        return $timestamp + self::getOffset();
    }

    /**
     * Convert a shorthand byte value from a PHP configuration directive to an integer value
     * @param    string   $value
     * @return   int
     */
    public static function convertBytes( $value ) {
        if ( is_numeric( $value ) ) {
            return $value;
        } else {
            $value_length = strlen( $value );
            $qty = substr( $value, 0, $value_length - 1 );
            $unit = strtolower( substr( $value, $value_length - 1 ) );
            switch ( $unit ) {
                case 'k':
                    $qty *= 1024;
                    break;
                case 'm':
                    $qty *= 1048576;
                    break;
                case 'g':
                    $qty *= 1073741824;
                    break;
            }
            return $qty;
        }
    }

    /**
     * maxfilesize определяется из настроек php (php.ini)
     *
     *
     */
    public static function getMaxFileSize() {
        $post_max_size = ini_get('post_max_size');
        $upload_max_filesize = ini_get('upload_max_filesize');
        $post_max_size = self::convertBytes($post_max_size);
        $upload_max_filesize = self::convertBytes($upload_max_filesize);
        $maxfilesize = min(array($post_max_size, $upload_max_filesize));
        return $maxfilesize;
    }

    /**
     * return file full path for config
     *
     * @param mixed $configname
     */
    public static function getConfigFileName($configname) {
        return dirname(__FILE__)."/../config/$configname";
    }

    /**
     * get content of configuration file
     *
     * @param mixed $configname
     */
    public static function getConfigContent($configname) {
        $file = self::getConfigFileName($configname);
        if (!is_file($file))
            return false;
        $content = file_get_contents($file);
        if (isset($content)) {
            $arr = unserialize(json_decode($content));
            return $arr;
        } else
            return false;
    }

    /**
     * добавить схему к урлу, если её там нет
     *
     * @param mixed $url
     * @param mixed $scheme
     */
    public static function addScheme($url, $scheme = 'http://') {
        return parse_url($url, PHP_URL_SCHEME) === null ? $scheme . $url : $url;
    }
}

?>
