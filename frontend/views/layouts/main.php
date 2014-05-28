<?php
/* @var $this SiteController */ 

//CSS-file for main page
Yii::app()->clientScript->registerCssFile('css/style.css');

//components for main page
$this->beginContent('//layouts/common'); 
?>

    <BGDivs id="BGDivs">
        <div id="topLineBG"> </div>
        <div id="contentBG">
            <div id="globe"></div>
        </div>
        <div id="whiteBG"></div>
        <div id="darkBGG"></div>
    </BGDivs>

    <div id="wrapper">

        <div id="topLine">
            <ul id="nav">
                <li> <a href="#" class="flag">  </a> </li>
                <li> <a href="#" class="in">  </a> </li>
                <li> <a href="#"> ВОЗМОЖНОСТИ </a> </li>
                <li> <a href="#"> ПРАВИЛА </a> </li>
                <li> <a href="#"> ВОПРОСЫ И ОТВЕТЫ  </a> </li>
                <li> <a href="#" class="moveRight1 open-login"> ЗАРЕГИСТРИРОВАТЬСЯ </a> </li>
                <li> <a href="#" class="moveRight2 open-login"> ВОЙТИ </a> </li>
            </ul>
        </div>

        <div id="content">
            <div style="height: 57px;">
                <a id="logo" href="#"></a>
            </div>

            <div id="videoBG"></div>

            <?php echo $content; ?>
        </div>

    </div>
<?php $this->endContent(); ?>