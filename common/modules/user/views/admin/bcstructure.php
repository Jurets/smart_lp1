<?php
/* @var $this AdminController */

$this->breadcrumbs=array(
	UserModule::t('Users')=>array('/user'),
	UserModule::t("BusinessClub structure", array(), 'participant'),
);

$this->menu=array(
);

?>

<h1><?php echo UserModule::t("BusinessClub structure", array(), 'participant'); ?></h1>

<?php 
$this->renderPartial('_index', array('model'=>$model));
?>
