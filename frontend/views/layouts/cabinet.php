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
            <li> <a href="#"> ВОЗМОЖНОСТИ </a> </li>
            <li> <a href="#"> ПРАВИЛА </a> </li>
            <li> <a href="#"> ВОПРОСЫ И ОТВЕТЫ  </a> </li>
            <li> <a href="#" class="moveRight"> ВОЙТИ </a> </li>
        </ul>
    </div>

    <div id="content">
        <?php echo $content; ?>
    </div>
</div>

<div class="wrap"></div>

<?php $this->endContent(); ?>
