<?php
class UploadFileWidget extends CWidget
{
    public $model;
    public $params = array(
        'width' => 336,
        'height' => 160
    );
    public $re_org = array(
        'width' => 0,
        'height' => 0
    );
  //run widget
    public function run() {
        $this->render('upload', array('model'=>$this->model, 'params'=>$this->params, 're_org'=>$this->re_org));
    }
    
}
  
?>
