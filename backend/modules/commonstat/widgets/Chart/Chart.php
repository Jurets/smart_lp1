<?php
class Chart extends CWidget {
    public $features;
    public $model;    
    public function run(){
        $this->features = $this->model->graphix;
        $x = $this->features['x'];

        $dataset = array_merge($this->features['colors'], array('data'=>$this->features['y']));
        $this->render('chart', array('x'=>$x, 'dataset'=>$dataset));
    }
}

