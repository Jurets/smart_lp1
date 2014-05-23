<?php
$this->widget('ext.jqrelcopy.JQRelcopy',
                 array(
                       'id' => 'addSlider', // target to add-control
                       'options' => array(
                                           'copyClass' => 'slide_',
                                         ),
                       'jsAfterClone' => '
                    $(this).children().find("[name]").each(function(){
                        var re = new RegExp(/\[\d+\](?=\[)/);
                        var partName = $(this).attr("name").replace(re, "[" + counter + "]");
                        $(this).attr("name", partName);
                    });
                    $(this).show().focus();
               ',               
                       )
        );

