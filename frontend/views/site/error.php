<?php
/* @var $this SiteController */
/* @var $error array */

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
    div#darkBGG{
        display: none;
    }

    div#whiteBG{
        display: none;
    }

    div.footer{
        margin-top: 0px;
    }

    div#contentBG{
        height: 930px;
    }
</style>