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
                <li> <a class="in" style="cursor: pointer;">  </a> </li>
                <li> <a href="#"> ВОЗМОЖНОСТИ </a> </li>
                <li> <a href="#"> ПРАВИЛА </a> </li>
                <li> <a href="#"> ВОПРОСЫ И ОТВЕТЫ  </a> </li>
                <li> <a class="moveRight1 open-login"> ЗАРЕГИСТРИРОВАТЬСЯ </a> </li>
                <li> <a class="moveRight2 open-login" style="cursor: pointer;"> ВОЙТИ </a> </li>
            </ul>
        </div>

        <div id="content">
            <?php 
            // вывести част. вьюшку для входа 
            $this->renderPartial('login', array(), false, true);
            // вывести основной контент
            echo $content; 
            ?>
        </div>

    </div>
<?php $this->endContent(); ?>