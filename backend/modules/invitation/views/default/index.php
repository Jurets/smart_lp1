<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
    $this->module->id,
);
?>
    <h1><?php echo InvitationModule::t('Invitation'); ?></h1>

<?php $this->renderPartial('_copyer', array()); ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>