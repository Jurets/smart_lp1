<?php
class UploadFileWidget extends CWidget
{
    public $model;
  //run widget
    public function run() {
        $this->render('upload', array('model'=>$this->model));
    }
    
}
  
?>
