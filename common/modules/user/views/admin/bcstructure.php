<?php
/* @var $this AdminController */

$this->breadcrumbs=array(
	BaseModule::t('rec','Users')=>array('/user'),
	BaseModule::t('rec',"BusinessClub structure"),
);

$this->menu=array(
);

?>

<h1><?php echo BaseModule::t('rec',"BusinessClub structure"); ?></h1>

<?php 
$this->renderPartial('_index', array('model'=>$model));
?>
