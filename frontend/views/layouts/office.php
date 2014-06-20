<?php
/* @var $this OfficeController */

//CSS-file for main page
Yii::app()->clientScript->registerCssFile('/css/style-office.css');

//components for main page
$this->beginContent('//layouts/common');
?>

<style type="text/css">
    .moveRight1 {
        background-image: url("../images/profil.png");
        background-position: 162px 4px;
        background-repeat: no-repeat;
        height: 27px;
        padding-right: 30px;
        padding-top: 4px;
        position: absolute;
        right: 0;
        left: 554px;
        text-align: right;
        top: -6px;
        width: 151px;
    }
</style>

<div class="page">
    <BGDivs id="BGDivs">
        <div id="topLineBG"> </div>
        <div id="contentUP"></div>
        <!-- <div id="contentDOWN7-1"></div> !-->
    </BGDivs>
        <div id="wrapper">
            <div id="topLine">
                
                <ul id="nav">
                    <div id="bgIn"></div>
                    <li> <a href="#" class="flag">  </a> </li>
                    <li> <a class="in" style="cursor: pointer;">  </a> </li>
                    <li> <a href="#"> &nbsp;ВОЗМОЖНОСТИ </a> </li>
                    <li> <a href="#"> ПРАВИЛА </a> </li>
                    <li> <a href="#"> ВОПРОСЫ И ОТВЕТЫ  </a> </li>

                    <li> <a href="#"  class="moveRight1"> <?=Yii::app()->user->name?></a> </li>
                    <li> <a href="#"  class="moveRight2"> |&nbsp;&nbsp;&nbsp;&nbsp;Настройки </a> </li>
                    <li> <a href="<?=Yii::app()->createAbsoluteUrl('site/logout')?>"  class="moveRight3"> |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Выход</a> </li>
                </ul>
            </div>

            <div id="content">
                <div><a  id="logo" href="index.html"> </a></div>
                <div id="divMenu">
                    <?php $this->widget('zii.widgets.CMenu',array(
                        'id'=>'nav2',
                        'activeCssClass'=>'myitem-active',
                        'items'=>array(
                            array('label'=>'СТАТИСТИКА', 'url'=>array(''),'itemOptions'=>array('class'=>'btn-style btn-style1 ')),
                            array('label'=>'СТРУКТУРА', 'url'=>array(''),'itemOptions'=>array('class'=>'btn-style btn-style2')),
                            array('label'=>'НОВОСТИ', 'url'=>array('news'),'itemOptions'=>array('class'=>'btn-style btn-style3')),
                            array('label'=>'ЧАТ', 'url'=>array(''),'itemOptions'=>array('class'=>'btn-style btn-style4')),
                            array('label'=>'ПРИГЛАШЕНИЕ', 'url'=>array('office/invitation'),'itemOptions'=>array('class'=>'btn-style btn-style5')),
                            array('label'=>'НАСТРОЙКИ', 'url'=>array('office/settings'),'itemOptions'=>array('class'=>'btn-style btn-style6')),
                            array('label'=>'ПОМОЩЬ', 'url'=>array('office/help'),'itemOptions'=>array('class'=>'btn-style btn-style7')),
                            array('label'=>'ПРАВИЛА', 'url'=>array('office/specification'),'itemOptions'=>array('class'=>'btn-style btn-style8'))

                        ,)
                    )); ?>
                </div>
                <div id="BottomOfficeLine"></div>

                <?php echo $content; ?>
            </div>

        </div>
</div>
<?php $this->endContent(); ?>

