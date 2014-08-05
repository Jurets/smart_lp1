<?php
class CommonStatistics extends CModel {
public function attributeNames(){}

private $choiseMode; // режим формирования данных для построения графиков - входной параметр статистического анализа
private $colourStandard; // стандартные цветовые решения для отображения графиков
private $graphix; // контейнер инструкций для построения графика: 1 инструкция описывает один график


public function __construct($choiseMode=NULL){
    $this->choiseMode = $choiseMode;
    $this->colourStandard = array(
        'a'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(244,17,17,1)','pointColor'=>'rgba(244,17,17,1)',"pointStrokeColor" => "#ffffff"),
        'b'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(236,93,82,1)','pointColor'=>'rgba(236,93,82,1)',"pointStrokeColor" => "#ffffff"),
        'c'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(255,255,0,1)','pointColor'=>'rgba(255,255,0,1)',"pointStrokeColor" => "#ffffff"),
        'd'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(181,179,26,1)','pointColor'=>'rgba(181,179,26,1)',"pointStrokeColor" => "#ffffff"),
        'e'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(0,255,0,1)','pointColor'=>'rgba(0,255,0,1)',"pointStrokeColor" => "#ffffff"),
        'f'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(63,152,63,1)','pointColor'=>'rgba(63,152,63,1)',"pointStrokeColor" => "#ffffff"),
        'g'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(0,0,255,1)','pointColor'=>'rgba(0,0,255,1)',"pointStrokeColor" => "#ffffff"),
        'h'=>array('fillColor'=>'rgba(255,255,255,0)','strokeColor'=>'rgba(69,69,145,1)','pointColor'=>'rgba(69,69,145,1)',"pointStrokeColor" => "#ffffff"),
    );
}


}
