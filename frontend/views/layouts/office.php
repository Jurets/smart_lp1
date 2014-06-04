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

        <div id="office-5-content">
            <div><a  id="logo" href="index.html"> </a></div>

            <div id="content">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>