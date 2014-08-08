<?php
class ChartJsOnceInit extends ChartJs {
    public static function onceInit(){
        $obj = new ChartJsOnceInit;
        $obj->initWrapper();
    }
    public function init() {
        
    }
    private function initWrapper(){
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $jsFilename = YII_DEBUG ? 'Chart.js' : 'Chart.min.js';
        $cssFilename = YII_DEBUG ? 'styles.css' : 'styles.min.css';
        $cs->registerScriptFile($this->getAssetsUrl().'/js/'.$jsFilename, CClientScript::POS_HEAD);
        $cs->registerCssFile($this->getAssetsUrl() . "/css/".$cssFilename, '');
    }
}

