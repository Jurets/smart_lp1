<?php
/**
*  Action for File Upload:
*  to install it place follow code into need Controller
*      public function actions() {
        return array(
            'upload'=>array(
                'class'=>'<path to extensions>.FileUpload.UploadAction',
                'prefixOrigin'=>'...',
                'prefixResized'=>'...',
                'uploadDir'=>...,
                'uploadUrl'=>...,
            ),            
        );
    }

* 
*/
class UploadAction extends CAction {

    /* не используется, оставлено для совместимости */
    public $prefixOrigin = 'origin-';
    public $prefixResized = 'resized-';
    
    public $uploadDir = '/uploads/';
    public $uploadUrl = '/uploads/';
    public $resize = array('width'=>336, 'height'=>160);
    public $re_org = array('width'=>0, 'height'=>0); // по умолчанию - нули, - не надо ресайзить оригинал
    
    // выходные точки для дальнейшего использования в вызывающем файле
    public $images = array();

//    Backup относительно рабочий. Ведется рефракторинг с целью повторного использования этого кода
//    public function run(){
//        if ($_FILES['files']){DebugBreak();
//            $ext = pathinfo($_FILES['files']['name'][0], PATHINFO_EXTENSION);
//            $uniqid = substr(md5(uniqid()), 0, 8) . "." . $ext;
//            $filename = $this->prefixOrigin . $uniqid;
//            $file_path = Yii::app()->getBasePath() . $this->uploadDir . $filename;
//            $file_url = $this->uploadUrl . $filename;
//            $file_url_resized = $this->uploadUrl . $this->prefixResized . $uniqid;
//            $result = move_uploaded_file($_FILES['files']['tmp_name'][0], $file_path);
//            $resized = ImageHelper::makeNewsThumb($file_path);
//
//            $json = array(
//                "files"=>array(
//                    array(
//                        "name"=>$filename,
//                        "original"=>$file_url,
//                        "resized"=>$file_url_resized,
//            )));
//
//            if ($result)
//                echo json_encode($json);
//            else
//                echo json_encode(array("error"=>"error"));
//        }
//    }
  
    
    /* Результат рефракторинга.
     *  1. Добавлена возможность множественной загрузки файлов.
     *  2. Расширено восприятие служебных ключей массива $_FILES
     *     ('name', 'tmp_name') теперь видимы как в строке, так и в составе массива
     *  3. Возвращается массив с настройками доступа к загруженным файлам (PATH, URL RESIZED-URL)
     */
     public function run(){
         if(isset($_GET['w']) && isset($_GET['h']) && isset($_GET['org_w']) && isset($_GET['org_h'])){
            if(!is_null($_GET['w']) && !is_null($_GET['h'])){
                 $this->resize['width'] = $_GET['w'];
                 $this->resize['height'] = $_GET['h'];
            }
            if(!is_null($_GET['org_w']) && !is_null($_GET['org_h'])){
                 $this->re_org['width'] = $_GET['org_w'];
                 $this->re_org['height'] = $_GET['org_h'];
            }
         }
        if ($_FILES){
            //var_dump($_FILES);die;
        $look = $_FILES;
        reset($look);
        $target = key($look);
        //foreach($_FILES[$target]['name'] as $num=>$file){ // перебираем в цикле все подгружаемые файлы и для каждого из них найдется место
        for($num = key($_FILES[$target]['name']); $num < count($_FILES[$target]['name']); $num++){
            
            if (!isset($_FILES[$target]['name'][$num])){
                continue;
            }
            
            $ext = (is_array($_FILES[$target]['name'][$num])) ?
                    pathinfo($_FILES[$target]['name'][$num][key($_FILES[$target]['name'][$num])], PATHINFO_EXTENSION) 
                    : pathinfo($_FILES['files']['name'][$num], PATHINFO_EXTENSION);
            
            //$ext = pathinfo($_FILES[$target]['name'][$num][key($_FILES[$target]['name'][$num])], PATHINFO_EXTENSION);
            if(empty($ext))  continue;
            $uniqid = substr(md5(uniqid()), 0, 8) . "." . $ext;
            $filename = $this->prefixOrigin . $uniqid;
            $file_path = Yii::app()->getBasePath() .(strpos($this->uploadDir,'www') ? '' : '/www/'). $this->uploadDir . $filename;
            $file_url = $this->uploadUrl . $filename;
            $file_url_resized = $this->uploadUrl . $this->prefixResized . $uniqid;
                        
            $namesSource = (is_array($_FILES[$target]['tmp_name'][$num])) ?
                    $_FILES[$target]['tmp_name'][$num][key($_FILES[$target]['tmp_name'][$num])] : 
                    $_FILES['files']['tmp_name'][$num];
            
            $result = move_uploaded_file($namesSource, $file_path);
           // $result = move_uploaded_file($_FILES[$target]['tmp_name'][$num][key($_FILES[$target]['tmp_name'][$num])], $file_path);
            $resized = ImageHelper::makeNewsThumb($file_path, 'resized-',  $this->resize['width'], $this->resize['height']);
            if($this->re_org['width'] !=0 && $this->re_org['height'] !=0){
                $resized_org = ImageHelper::makeNewsThumb($file_path, 'origin-', $this->re_org['width'], $this->re_org['height']);
            }

            $json = array(
                $target=>array(
                    array(
                        "name"=>$filename,
                        "original"=>$file_url,
                        "resized"=>$file_url_resized,
            )));

            if(Yii::app()->request->isAjaxRequest){
            if ($result)
                echo json_encode($json);
            else
                echo json_encode(array("error"=>"error"));
            }
            $this->images[$num] = array(
                'name'=>$filename,
                'path'=>$file_path,
                'url'=>$file_url,
                'resized-url'=>$file_url_resized,
            );
        }
        return $this->images;
      } 
      
    }
}
?>
