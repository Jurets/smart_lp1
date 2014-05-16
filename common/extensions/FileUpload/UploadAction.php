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

    public $prefixOrigin = 'origin-';
    public $prefixResized = 'resized-';
    public $uploadDir = '/uploads/';
    public $uploadUrl = '/uploads/';

    public function run(){
        if ($_FILES['files']){DebugBreak();
            $ext = pathinfo($_FILES['files']['name'][0], PATHINFO_EXTENSION);
            $uniqid = substr(md5(uniqid()), 0, 8) . "." . $ext;
            $filename = $this->prefixOrigin . $uniqid;
            $file_path = Yii::app()->getBasePath() . $this->uploadDir . $filename;
            $file_url = $this->uploadUrl . $filename;
            $file_url_resized = $this->uploadUrl . $this->prefixResized . $uniqid;
            $result = move_uploaded_file($_FILES['files']['tmp_name'][0], $file_path);
            $resized = ImageHelper::makeNewsThumb($file_path);

            $json = array(
                "files"=>array(
                    array(
                        "name"=>$filename,
                        "original"=>$file_url,
                        "resized"=>$file_url_resized,
            )));

            if ($result)
                echo json_encode($json);
            else
                echo json_encode(array("error"=>"error"));
        }
    }
}
?>
