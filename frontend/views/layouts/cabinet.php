<?php
    /* @var $this Controller */ ?>
<?php 
    //CSS-file for main page
    Yii::app()->clientScript->registerCssFile('/css/style-shags.css');
    //Yii::app()->clientScript->registerCssFile('/css/login.css');

    //upper layout
    $this->beginContent('//layouts/common'); ?>

<!--<div style="height: 57px;">
<a id="logo" href="#" style="top: 46px; left: 0px;"></a>
</div>-->


<BGDivs id="BGDivs">
    <div id="topLineBG"> </div>
    <div id="contentUP"><div id="miniGlobe"></div></div>
    <div id="contentDOWN"></div>
</BGDivs>

<div id="wrapper">
    <div id="topLine">
        <ul id="nav">
            <li> <a href="#" class="flag">  </a> </li>
            <li> <a href="#" class="in">  </a> </li>
            <li> <a href="#"> <?php echo Yii::t('common', 'OPPORTUNITIES'); ?> </a> </li>
            <li> <a href="#"> <?php echo Yii::t('common', 'RULES'); ?> </a> </li>
            <li> <a href="#"> <?php echo Yii::t('common', 'QUESTIONS AND ANSWERS'); ?>  </a> </li>
            <li> <a  href="#" class="moveRight"> <?php echo Yii::t('common', 'LOGIN'); ?> </a> </li>
        </ul>
    </div>

    <div id="content">
        <?php echo $content; ?>
    </div>
</div>

<div class="wrap"></div>

<?php $this->endContent(); ?>
