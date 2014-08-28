<?php
/* @var $this AdminController */

$this->breadcrumbs=array(
	Yii::t('rec','Users')=>array('/user'),
	Yii::t('rec',"BusinessClub structure"),
);

$this->menu=array(
);

?>

<h1><?php echo Yii::t('rec',"BusinessClub structure"); ?></h1>

<?php 
$this->renderPartial('_index', array('model'=>$model));
?>
