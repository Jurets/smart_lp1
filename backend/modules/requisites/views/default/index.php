<?php
/* @var $this RequisitesController */
/* @var $model Requisites */
?>

<h1><?php echo BaseModule::t('rec', 'Requisites') ?> <?php //echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>