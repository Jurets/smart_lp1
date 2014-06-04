<?php
/* @var $message */
Yii::app()->clientScript->registerCssFile('/css/style-office.css');
?>
<div id="divMenu">
    <?php $this->widget('zii.widgets.CMenu',array(
        'id'=>'nav2',
        'activeCssClass'=>'myitem-active',
        'items'=>array(
            array('label'=>'СТАТИСТИКА', 'url'=>array(''),'itemOptions'=>array('class'=>'btn-style1')),
            array('label'=>'СТРУКТУРА', 'url'=>array(''),'itemOptions'=>array('class'=>'btn-style2')),
            array('label'=>'НОВОСТИ', 'url'=>array(''),'itemOptions'=>array('class'=>'btn-style3')),
            array('label'=>'ЧАТ', 'url'=>array(''),'itemOptions'=>array('class'=>'btn-style4')),
            array('label'=>'ПРИГЛАШЕНИЕ', 'url'=>array(''),'itemOptions'=>array('class'=>'btn-style5')),
            array('label'=>'НАСТРОЙКИ', 'url'=>array(''),'itemOptions'=>array('class'=>'btn-style6')),
            array('label'=>'ПОМОЩЬ', 'url'=>array(''),'itemOptions'=>array('class'=>'btn-style7')),
            array('label'=>'ПРАВИЛА', 'url'=>array('office/specification'),'itemOptions'=>array('class'=>'btn-style8'))

        ,)
    )); ?>

</div>
<div id="BottomOfficeLine"></div>
<div id="office-5-post1">
    <?php echo $message; ?>
</div>

