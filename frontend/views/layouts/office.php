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
                <li> <a href="#"> &nbsp; <?php echo BaseModule::t('rec', 'OPPORTUNITIES'); ?>  </a> </li>
                <li> <a href="#">  <?php echo BaseModule::t('rec', 'RULES'); ?>  </a> </li>
                <li> <a href="#"> <?php echo BaseModule::t('rec', 'QUESTIONS AND ANSWERS'); ?> </a> </li>
                <li> <a href="<?php echo $this->createUrl('site/status'); ?>" class="mark"><?php echo strtoupper(BaseModule::t('rec', 'Raise status')); ?></a>
                <li> <a href="#"  class="moveRight1"> <?= Yii::app()->user->name ?></a> </li>
                <li> <a href="/office/settings"  class="moveRight2"> |&nbsp;&nbsp;&nbsp;&nbsp;<?php echo BaseModule::t('rec', 'Settings'); ?></a> </li>
                <li> <a href="<?= Yii::app()->createAbsoluteUrl('logout') ?>"  class="moveRight3"> |&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo BaseModule::t('common', 'Exit'); ?></a> </li>
            </ul>
            <?php //$this->widget('application.widgets.LngSwitch.LngSwitch')?>
        </div>

        <div id="content">
            <div><a  id="logo" href="<?= Yii::app()->createAbsoluteUrl('') ?>"> </a></div>
            <div id="divMenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'id' => 'nav2',
                    'activeCssClass' => 'myitem-active',
                    'items' => array(
                        array('label' => BaseModule::t('rec', 'STATISTICS'), 'url' => array('office/statistics'), 'itemOptions' => array('class' => 'btn-style btn-style1 ')),
                        array('label' => BaseModule::t('rec', 'STRUCTURE'), 'url' => array('office/structure'), 'itemOptions' => array('class' => 'btn-style btn-style2')),
                        array('label' => BaseModule::t('rec', 'NEWS'), 'url' => array('office/news'), 'itemOptions' => array('class' => 'btn-style btn-style3')),
                        array('label' => BaseModule::t('rec', 'CHAT'), 'url' => array('office/chat'), 'itemOptions' => array('class' => 'btn-style btn-style4')),
                        array('label' => BaseModule::t('rec', 'INVITATION'), 'url' => array('office/invitation'), 'itemOptions' => array('class' => 'btn-style btn-style5')),
                        array('label' => BaseModule::t('rec', 'SETTINGS'), 'url' => array('office/settings'), 'itemOptions' => array('class' => 'btn-style btn-style6')),
                        array('label' => BaseModule::t('rec', 'HELP'), 'url' => array('office/help'), 'itemOptions' => array('class' => 'btn-style btn-style7')),
                        array('label' => BaseModule::t('rec', 'RULES'), 'url' => array('office/specification'), 'itemOptions' => array('class' => 'btn-style btn-style8'))
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

