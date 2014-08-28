<?php Yii::app()->clientScript->registerCorescript('jquery') ?>
<?php Yii::app()->clientScript->registerCorescript('jquery.ui') ?>
<?php
// test comment
/**
 *
 * main.php layout
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?= Yii::app()->createAbsoluteUrl('/') ?>/css/bootstrap.min.css">
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>

        <link rel="stylesheet" href="<?= Yii::app()->createAbsoluteUrl('/') ?>/css/main.css">

        <script src="<?= Yii::app()->createAbsoluteUrl('/') ?>/js/libs/modernizr-2.6.2-respond-1.1.0.min.js"></script>

        <script src="<?= Yii::app()->request->baseUrl; ?>/js/file-upload/jquery.ui.widget.js"></script>
        <script src="<?= Yii::app()->request->baseUrl; ?>/js/file-upload/jquery.iframe-transport.js"></script>
        <script src="<?= Yii::app()->request->baseUrl; ?>/js/file-upload/jquery.fileupload.js"></script>

    </head>
    <body>
        <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
        your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
        improve your experience.</p>
        <![endif]-->

        <?php
        $isGuest = Yii::app()->user->isGuest;

        $this->widget('bootstrap.widgets.TbNavbar', array(
            //'type'=>'inverse', // null or 'inverse'
            'brandLabel' => Yii::app()->name,
            'display' => TbHtml::NAVBAR_DISPLAY_FIXEDTOP, //'top',
            'brandUrl' => $this->createUrl('/'),
            //'htmlOptions'=>array('style'=>'width: 1700px;'),
            'fluid' => true,
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbNav',
                    //$this->widget('bootstrap.widgets.TbNav', array(
                    //'htmlOptions'=>array('class' => 'nav'),
                    'items' => array(
                        array('url' => Yii::app()->getModule('user')->loginUrl, 'label' => Yii::t('common', "Login"), 'visible' => $isGuest),
                        //array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 'visible'=>$isGuest),
                        array('label' => Yii::t('rec',"Participants"), 'url' => '#', 'visible' => !$isGuest, 'items' => array(
                                array('url' => Yii::app()->getModule('user')->indexUrl, 'label' => Yii::t('rec',"Unified database participants"), 'visible' => !$isGuest),
                                array('url' => Yii::app()->createAbsoluteUrl('user/admin/structure/'), 'label' => Yii::t('rec',"Participants structure"), 'visible' => !$isGuest),
                                array('url' => Yii::app()->createAbsoluteUrl('user/admin/bcstructure/'), 'label' => Yii::t('rec',"BusinessClub structure"), 'visible' => !$isGuest),
                                array('url' => Yii::app()->getModule('user')->sysusrUrl, 'label'=>Yii::t('rec','System Users')),
                            ),
                        ),
                        //array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>$isGuest),
                        array('url'=>Yii::app()->getModule('commonstat')->commonstatShow, 'label'=>Yii::t('rec','Common Statistics')),
                        array('url' => Yii::app()->getModule('news')->newsShow, 'label' => Yii::t('rec', "News"), 'visible' => !$isGuest),
                        array('url' => Yii::app()->getModule('training')->trainingShow, 'label' => Yii::t('rec', "Training"), 'visible' => !$isGuest),
                        array('url' => Yii::app()->getModule('faq')->faqShow, 'label' => Yii::t('rec', "FAQ"), 'visible' => !$isGuest),
                        array('url' => Yii::app()->getModule('invitation')->invitationShow, 'label' => Yii::t('rec', "Invitation"), 'visible' => !$isGuest),
                        array('url' => Yii::app()->getModule('chat')->show, 'label' => Yii::t('rec', "Chat"), 'visible' => !$isGuest),
                        array('label' => Yii::t('rec', 'Settings'), 'url' => '#', 'visible' => !$isGuest, 'items' => array(
                                array('url' => Yii::app()->getModule('countries')->countriesShow, 'label' => Yii::t('rec', "Countries"), 'visible' => !$isGuest),
                                array('url' => Yii::app()->getModule('cities')->citiesShow, 'label' => Yii::t('rec', "Cities"), 'visible' => !$isGuest),
                                array('url' => Yii::app()->getModule('requisites')->requisitesShow, 'label' => Yii::t('rec', "Requisites"), 'visible' => !$isGuest),
                                array('url' => Yii::app()->getModule('mp')->mpShow, 'label' => Yii::t('rec', 'Marketings Plan')),
                                array('url' => Yii::app()->getModule('im')->imShow, 'label' => Yii::t('rec', 'Index Management')),
                                array('url' => Yii::app()->getModule('faqm')->faqmShow, 'label' => Yii::t('rec', 'Faq Management')),
                                array('url' => Yii::app()->getModule('lang')->langShow, 'label'=> Yii::t('rec', 'Language Management')),
                            ),
                        ),
                        array('url' => Yii::app()->getModule('user')->logoutUrl, 'label' => /*Yii::app()->getModule('user')->t("Logout")*/Yii::t('rec', 'Logout') . ' (' . Yii::app()->user->name . ')', 'visible' => !$isGuest),
            ),
                ),
            ),
        ));
        ?>

        <div class="w-1000 m-center" style="width: 1700px;">
        <?php echo $content; ?>
        </div>
        <!--  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
        <!--  <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>  -->
        <script src="<?= Yii::app()->createAbsoluteUrl('/') ?>/js/libs/bootstrap.min.js"></script>
        <script src="<?= Yii::app()->createAbsoluteUrl('/') ?>/js/plugins.js"></script>
        <script src="<?= Yii::app()->createAbsoluteUrl('/') ?>/js/main.js"></script>
        <script>
            var _gaq = [
                ['_setAccount', 'UA-XXXXX-X'],
                ['_trackPageview']
            ];
            (function(d, t) {
                var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
                g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
                s.parentNode.insertBefore(g, s)
            }(document, 'script'));
        </script>
    </body>
</html>