<?php
$this->widget(
            'chartjs.widgets.ChLine', 
            array(
                'width' => 1420,
                'height' => 300,
                'htmlOptions' => array(),
                'labels' => $x,
                'datasets' => array(
                    $dataset,
                ),
                'options' => array()
            )
        );