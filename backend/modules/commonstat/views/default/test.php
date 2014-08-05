<?php
$this->widget(
            'chartjs.widgets.ChLine', 
            array(
                'width' => 600,
                'height' => 300,
                'htmlOptions' => array(),
                'labels' => array('01.05.2014', '02.05.2014', '03.05.2014', '01.05.2014', '05.05.2014', '06.05.2014', '07.05.2014'),
                'datasets' => array(
                    array( // сущность
                        "fillColor" => "rgba(255,255,255,0)",
                        
                        "strokeColor" => "rgba(244,17,17,1)",
                        "pointColor" => "rgba(244,17,17,1)",
                        
                        "pointStrokeColor" => "#ffffff",
                        "data" => array(10, 20, 30, 15, 10, 5, 30)
                    ),
                ),
                'options' => array()
            )
        ); 