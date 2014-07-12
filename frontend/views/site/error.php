<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	Yii::t('common', 'Error'),
);
?>

<!--<div class="error alert alert-error">-->
<div class="error" style="color: #ffa3a1; margin-top: 50px; margin-bottom: 50px; font-size: 24px;">
    <h2>Ошибка <?php echo $code; ?></h2>
    <?php echo CHtml::encode($message); ?>
</div>