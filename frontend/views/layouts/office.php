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
                <li> <a href="#"> &nbsp; <?php echo Yii::t('common', 'OPPORTUNITIES'); ?>  </a> </li>
                <li> <a href="#">  <?php echo Yii::t('common', 'RULES'); ?>  </a> </li>
                <li> <a href="#"> <?php echo Yii::t('common', 'QUESTIONS AND ANSWERS'); ?> </a> </li>
                <li> <a href="<?php $this->createUrl('site/status'); ?>" class="mark">ПОДНЯТЬ СТАТУС</a>
                <li> <a href="#"  class="moveRight1"> <?= Yii::app()->user->name ?></a> </li>
                <li> <a href="#"  class="moveRight2"> |&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Yii::t('common', 'Settings'); ?></a> </li>
                <li> <a href="<?= Yii::app()->createAbsoluteUrl('site/logout') ?>"  class="moveRight3"> |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Yii::t('common', 'Exit'); ?></a> </li>
            </ul>
        </div>

        <div id="content">
            <div><a  id="logo" href="index.html"> </a></div>
            <div id="divMenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'id' => 'nav2',
                    'activeCssClass' => 'myitem-active',
                    'items' => array(
                        array('label' => Yii::t('common', 'STATISTICS'), 'url' => array('office/statistics'), 'itemOptions' => array('class' => 'btn-style btn-style1 ')),
                        array('label' => Yii::t('common', 'STRUCTURE'), 'url' => array('office/structure'), 'itemOptions' => array('class' => 'btn-style btn-style2')),
                        array('label' => Yii::t('common', 'NEWS'), 'url' => array('news'), 'itemOptions' => array('class' => 'btn-style btn-style3')),
                        array('label' => Yii::t('common', 'CHAT'), 'url' => array('office/chat'), 'itemOptions' => array('class' => 'btn-style btn-style4')),
                        array('label' => Yii::t('common', 'INVITATION'), 'url' => array('office/invitation'), 'itemOptions' => array('class' => 'btn-style btn-style5')),
                        array('label' => Yii::t('common', 'SETTINGS'), 'url' => array('office/settings'), 'itemOptions' => array('class' => 'btn-style btn-style6')),
                        array('label' => Yii::t('common', 'HELP'), 'url' => array('office/help'), 'itemOptions' => array('class' => 'btn-style btn-style7')),
                        array('label' => Yii::t('common', 'RULES'), 'url' => array('office/specification'), 'itemOptions' => array('class' => 'btn-style btn-style8'))
                    ,)
                ));
                ?>
            </div>
            <div id="BottomOfficeLine"></div>

<?php echo $content; ?>
        </div>

    </div>
</div>
<?php $this->endContent(); ?>

