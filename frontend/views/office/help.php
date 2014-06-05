<?php
/**
 * $this OfficeController
 * @var $categories
 */
Yii::app()->clientScript->registerCssFile('/css/style-office.css');
?>
<div id="office7-1-content">
    <div><a  id="logo" href="index.html"> </a></div>
    <a href="#" id='popupbtn' ><input type="button" name="btn"  class="btn-style-green-7-1" value="ЗАДАТЬ ВОПРОС" /></a>
</div>
    <div id ="ownAccordion">
    <?php
        $this->widget('zii.widgets.jui.CJuiAccordion',array(
        'id' =>'insideAccordion',
        'panels'=>array(
        'Финансы'=>$categories[0],
        'Предложения'=>$categories[1],
        'Работа сайта'=>'content for panel 3',
        // panel 3 contains the content rendered by a partial view
        //'panel 3'=>$this->renderPartial('_partial',null,true),
        ),
        // additional javascript options for the accordion plugin
        'options'=>array('active'=>0,'animated'=>'bounceslide',
                         'autoHeight'=>true,
        ),
        'htmlOptions'=>array('class'=>'accordion'),
        ));
    ?>
</div>