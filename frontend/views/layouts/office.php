<?php
/* @var $this OfficeController */

//CSS-file for main page
Yii::app()->clientScript->registerCssFile('/css/style-office.css');

//components for main page
$this->beginContent('//layouts/common');
?>

<div class="page">
    <BGDivs id="BGDivs">
        <div id="topLineBG"> </div>
        <div id="contentUP"></div>
        <div id="contentDOWN7-1"></div>
    </BGDivs>
        <div id="wrapper">

            <div id="topLine">

                <ul id="nav">
                    <div id="bgIn"></div>
                    <li > <a href="#" class="flag">  </a> </li>
                    <li> <a href="#"> &nbsp;ВОЗМОЖНОСТИ </a> </li>
                    <li> <a href="#"> ПРАВИЛА </a> </li>
                    <li> <a href="#" > ВОПРОСЫ И ОТВЕТЫ  </a> </li>
                </ul>

            </div>

            <div id="content">

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
                            array('label'=>'ПОМОЩЬ', 'url'=>array('office/help'),'itemOptions'=>array('class'=>'btn-style7')),
                            array('label'=>'ПРАВИЛА', 'url'=>array('office/specification'),'itemOptions'=>array('class'=>'btn-style8'))

                        ,)
                    )); ?>
                </div>
                <div id="BottomOfficeLine"></div>

                <?php echo $content; ?>
            </div>

        </div>
</div>
<?php $this->endContent(); ?>