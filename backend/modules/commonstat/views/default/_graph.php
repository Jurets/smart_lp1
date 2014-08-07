<?php
//$this->widget('commonstat.widgets.Chart.Chart');
$this->widget(
				'chartjs.widgets.ChLine', 
				array(
					'width' => 600,
					'height' => 300,
					'htmlOptions' => array(),
					'labels' => array("1","2","3","4","5","6"),
					'datasets' => array(
						array( // сущность
							"fillColor" => "rgba(255,255,255,0)",
							
							"strokeColor" => "rgba(244,17,17,1)",
							"pointColor" => "rgba(244,17,17,1)",
							
							"pointStrokeColor" => "#ffffff",
							"data" => array(10, 20, 25, 25, 50, 60)
						),
					),
					'options' => array()
				)
			); 