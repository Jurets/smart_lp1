<?php
/* @var $this SiteController */ 

//CSS-file for main page
Yii::app()->clientScript->registerCssFile('/css/style.css');

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
                <div id="bgIn"></div>
                <li> <a href="#" class="flag">  </a> </li>
                <?php if (Yii::app()->user->isGuest) { ?>
                    <li> <a class="in" style="cursor: pointer;">  </a> </li>
                <?php } ?>
                <li> <a href="#">  <?php echo BaseModule::t('rec', 'OPPORTUNITIES'); ?>  </a> </li>
                <li> <a href="#"> <?php echo BaseModule::t('rec', 'RULES'); ?> </a> </li>
                <li> <a href="#"> <?php echo BaseModule::t('rec', 'QUESTIONS AND ANSWERS'); ?>  </a> </li>

                <?php if (Yii::app()->user->isGuest) { ?>
                    <li> <a class="moveRight1" href="<?php echo Yii::app()->createAbsoluteUrl('register'); ?>"> <?php echo BaseModule::t('rec', 'SIGN UP'); ?> </a> </li>
                    <li> <a class="moveRight2 open-login" style="cursor: pointer;" href="#"> <?php echo BaseModule::t('rec', 'LOGIN'); ?> </a> </li>
                <?php } else { ?>
                    <style type="text/css">
                        .moveRight1 {
                            background-image: url("../images/profil.png");
                            background-position: 162px 3px;
                            background-repeat: no-repeat;
                            height: 27px;
                            padding-right: 30px;
                            padding-top: 4px;
                            position: absolute;
                            /*right: -347px;*/
                            left: 554px;
                            text-align: right;
                            top: -6px;
                            width: 151px;
                        }
                        .moveRight2 {
                            background-image: url("../images/settings.png");
                            background-position: 100px 0px;
                            background-repeat: no-repeat;
                            height: 27px;
                            left: 748px;
                            padding-top: 4px;
                            position: absolute;
                            top: -5px;
                            width: 124px;
                            text-decoration: none !important;
                            color: #ababab;
                        }
                        .moveRight3 {
                            background-image: url("../images/in.png");
                            background-position: 66px 2px;
                            background-repeat: no-repeat;
                            height: 56px;
                            left: 862px;
                            padding-top: 4px;
                            position: absolute;
                            top: -6px;
                            width: 80px;
                        }
                        #bgIn {
                            background-color: #383838;
                            height: 38px;
                            left: 555px;
                            position: absolute;
                            top: -9px;
                            width: 387px;
                        }
                    </style>                
                    <li> <a href="<?=Yii::app()->createAbsoluteUrl('office/index')?>"  class="moveRight1"> <?=Yii::app()->user->name?></a> </li>
                    <li> <a href="/office/settings"  class="moveRight2"> |&nbsp;&nbsp;Настройки </a> </li>
                    <li> <a href="<?=Yii::app()->createAbsoluteUrl('logout')?>"  class="moveRight3"> |&nbsp;&nbsp;&nbsp;&nbsp;<?php echo BaseModule::t('common', 'Exit'); ?></a> </li>
                <?php } ?>
            </ul>
            <?php //$this->widget('application.widgets.LngSwitch.LngSwitch')?>
        </div>

        <div id="content" style="height: auto !important;">
            <?php 
            //модель для авторизации юзера
            $userLogin = New UserLogin();
            // вывести част. вьюшку для входа 
            $this->renderPartial('//layouts/login', array('userLogin'=>$userLogin), false, false);
            // вывести основной контент
            echo $content; 
            ?>
        </div>

    </div>
<?php $this->endContent(); ?>