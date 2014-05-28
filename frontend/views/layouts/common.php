<?php
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
        <title>JWMS</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!--<link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
        body {
        padding-top: 60px;
        padding-bottom: 40px;
        }
        </style>-->
        <!--<link rel="stylesheet" href="css/main.css">-->

        <!--<link rel="stylesheet" href="css/style-shags.css" >-->

        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

        <?php
                //CSS-file for main page
                //Yii::app()->clientScript->registerCssFile('/css/style.css');
        ?>
        
        <!--<script src="js/libs/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
    </head>
    <body>
        <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
        your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
        improve your experience.</p>
        <![endif]-->

        <div class="page">
        
            <div id="login" style="left: 1208px; top: 40px;font-family: 'Open Sans Condensed','sans-serif';">
                <p class="sub1">ИМЯ ПОЛЬЗОВАТЕЛЯ:</p>
                <input class="textbox1" type="text"> 
                <p class="sub2">ПАРОЛЬ:</p>
                <input class="textbox2" type="text">
                <a href="#" id="captcha"></a>
                <a href="#" id="refresh" > </a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <p class="sub3">ВВЕДИТЕ КОД С КАРТИНКИ:</p> 
                <input class="textbox3" type="text"> 
                <a href="#"><input type="button" name="btn"  class="btn-style" value="ВОЙТИ" ></a>
                <a href="#" id="sub4">ЗАБЫЛИ ПАРОЛЬ?</a>
            </div>
        
            <!-- --- CONTENT --- -->
            <?php echo $content; ?>

        </div>
        
        <!-- --- FOOTER --- -->
        <?php $this->renderPartial('footer');  ?>


        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
        <!--<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>-->

        <!--<script src="js/libs/bootstrap.min.js"></script>-->
        <!--<script src="js/plugins.js"></script>-->
        <!--<script src="js/main.js"></script>-->
        <!--<script>
        var _gaq = [
        ['_setAccount', 'UA-XXXXX-X'],
        ['_trackPageview']
        ];
        (function (d, t) {
        var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
        g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g, s)
        }(document, 'script'));
        </script>-->
        
        <script>
            $('#login').hide();
            $(document).ready(function() {
                $('.open-login').on("click",function (){
                    if($('#login').css('display')!='none'){
                        $('#login').hide()
                    } else {
                        $('#login').show();
                    }
                })
            });
        </script>
        
    </body>
</html>