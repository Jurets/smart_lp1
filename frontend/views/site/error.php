<?php
/* @var $this SiteController */
/* @var $error array */

Yii::app()->clientScript->registerCssFile('/css/style-office.css');

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	BaseModule::t('common', 'Error'),
);
?>

<!--<div class="error alert alert-error">-->
<!--<div class="error" style="color: #ffa3a1; margin-top: 50px; margin-bottom: 50px; font-size: 24px;">-->
<!--    <h2>Ошибка --><?php //echo $code; ?><!--</h2>-->
<!--    --><?php //echo CHtml::encode($message); ?>
<!--</div>-->

    <div class="error" style="background-color: #ffff5f; width: 700px; height: 500px"></div>

<style>
    .info{
        position: absolute;
        top:110px;
    }
    #main-div{
        position: absolute;
        top:150px;
    }

    #contentBG{
        min-width: 1080px;
        width: 100%;
        min-height: 1100px;
        height: 100%;
        background-image: url(../images/contentBG.jpg);
        position: absolute;
        top: 40px;
    }


    #globe{
        margin-left: auto;
        height: 487px;
        width: 782px;
        background-image: url(../images/globe.png);
        background-repeat: no-repeat;
        background-position:right;
        z-index: 0;
    }

    .moveRight2 {
        background-position: 80px;
    }

    .footer{
        position: relative;
        z-index: 100;
        margin-top: -2px;
    }

    div.blackDownFooter{
        background-color: #1e1e1e;
        height: 100px;
        width: 100%;
        position: absolute;
        z-index: 105;
        margin-top: -1px;
    }


</style>

<script>
    $("head link[href='/css/style.css']").attr('href', '');
    $(function(){
        $('div.footer').after('<div class="blackDownFooter"></div>');
    })
</script>