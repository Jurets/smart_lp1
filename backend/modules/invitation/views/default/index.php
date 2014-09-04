<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'Invitation'),
);
?>
<h1><?php echo BaseModule::t('rec', 'Invitation'); ?></h1>

<?php $this->renderPartial('_copyer', array()); ?>
<?php $this->renderPartial('_form', array('model' => $model)); ?>