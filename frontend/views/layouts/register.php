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

        <h2 id="shag-1-1-h3" >РЕГИСТРАЦИЯ НОВОГО УЧАСТНИКА СИСТЕМЫ</h2>
        <div id="topShagLine"></div>
        <div  class="btn-style1"> ШАГ 1</div>
        <div class="btn-style2"> ШАГ 2</div>
        <div class="btn-style3"> ШАГ 3</div>
        <div class="btn-style4"> ШАГ 4</div>

        <?php echo $content; ?>
    </div>
</div>

<div class="wrap"></div>

<?php $this->endContent(); ?>


<style type="text/css">
    .btn-style1 {
        width: 249px; 
        height: 41px;
        position: absolute;
        top: 173px;
        background-color: #838383;
        text-align: center;
        padding-top: 6px;
        font-size: 25px;
        text-shadow: 1px 1px 1px #4d4d4d;
        font-weight: bold;
        color: #f2f2f2;
        border: 1px solid #bebebe;
    }

    .error {
        border-color: #FF0000;
        border-width: medium;
    }  

    .error-message {
        color: #FF0000;
        font-size: medium;
        font-weight: lighter;
        /*top: 411px;*/
        width: 400px;
        height: 22px;
        position: absolute;
    }  

    .em-1 { top: 318px; }  
    .em-2 { top: 411px; }  
    .em-3 { top: 501px; }  
    .em-4 { top: 594px; }  
    .em-5 { top: 680px; }  

    #shag-1-2-textArea {
        top: 228px;
        height: 357px;
        width: 952px;
    }
    
    #close-btn {
       right: 21px;
       top: 235px;
    }
</style>
