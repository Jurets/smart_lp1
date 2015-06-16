<?php /* @var $this Controller */ ?>
<?php
//CSS-file for main page

Yii::app()->clientScript->registerCssFile('/css/style.css');
Yii::app()->clientScript->registerCssFile('/css/style-shags.css');
Yii::app()->clientScript->registerCssFile('/css/login.css');


//upper layout
$this->beginContent('//layouts/common');

//выборка заголовков стат-страниц: вначале выбранного языка, затем того, что по умолчанию
$titles = Information::getAllTitles();

?>

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
            
                <li> <a href="/mp.pdf" target="_blank">  <?php echo mb_strtoupper($titles['possibilities'], 'utf8') ?>  </a> </li>
                <li> <a href="/vio.just" target="_blank"> <?php echo mb_strtoupper($titles['questions'], 'utf8') ?>  </a> </li>
                <li> <a href="/info/webinar"> <?php echo mb_strtoupper($titles['webinar'], 'utf8') ?> </a> </li>
            
            <li> <a href="#" class="moveRight open-login"> <?php echo BaseModule::t('rec', 'LOGIN'); ?> </a> </li>
        </ul>
        <?php //$this->widget('application.widgets.LngSwitch.LngSwitch')?>
    </div>
    <div id="content" style="height: auto !important;">
        <?php
//            //модель для авторизации юзера
//        $userLogin = New UserLogin();
//            // вывести част. вьюшку для входа 
//        $this->renderPartial('//layouts/login', array('userLogin' => $userLogin), false, false);
//            // вывести основной контент
//        echo $content;
        ?>
    </div>

    <div id="content">

        <h2 id="shag-1-1-h3" ><?php echo BaseModule::t('rec', 'NEW MEMBER REGISTRATION') ?></h2>
        <div id="topShagLine"></div>
        <div class="btn-style1 <?= ($this->step == 1) ? 'active-step' : '' ?>"> <?php echo BaseModule::t('rec', 'STEP').'1'; ?></div>
        <div class="btn-style2 <?= ($this->step == 2) ? 'active-step' : '' ?>"> <?php echo BaseModule::t('rec', 'STEP').'2'; ?></div>
        <div class="btn-style3 <?= ($this->step == 3) ? 'active-step' : '' ?>"> <?php echo BaseModule::t('rec', 'STEP').'3'; ?></div>
        <div class="btn-style4 <?= ($this->step == 4) ? 'active-step' : '' ?>"> <?php echo BaseModule::t('rec', 'STEP').'4'; ?></div>
        <?php
//            //модель для авторизации юзера
        $userLogin = New UserLogin();
//            // вывести част. вьюшку для входа 
        $this->renderPartial('//layouts/login', array('userLogin' => $userLogin), false, false);
        echo $content;
        ?>
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
        background-color: #d2d2d2;
        text-align: center;
        padding-top: 6px;
        font-size: 25px;
        text-shadow: 1px 1px 1px #e8e8e8;
        font-weight: bold;
        color: #b7b7b7;
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

    .active-step {
        width: 246px;
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
</style>
