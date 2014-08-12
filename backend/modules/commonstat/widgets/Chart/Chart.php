<?php
class Chart extends CWidget {
    public $features;
    public $model;    
    public function run(){
        $this->model->graphix['x'][] = '.';
        $this->model->graphix['y'][] = 0;
        $this->features = $this->model->graphix;
        $x = $this->features['x'];
        if(!empty($this->features['y'])){
            $dataset = array_merge($this->features['colors'], array('data'=>$this->features['y']));
            $this->render('chart', array('x'=>$x, 'dataset'=>$dataset));
        }else{
            $this->render('emptyChart');
        }
    }
}

