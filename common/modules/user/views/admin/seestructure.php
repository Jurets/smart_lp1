<?php
/* @var $this AdminController */

$this->breadcrumbs=array(
	UserModule::t('Users')=>array('/user'),
	UserModule::t("Participants structure", array(), 'participant'),
);

$this->menu=array(
);

?>

<h1><?php echo UserModule::t("Participants structure", array(), 'participant'); ?></h1>

<?php 
$this->renderPartial('_index', array('model'=>$model));
?>
