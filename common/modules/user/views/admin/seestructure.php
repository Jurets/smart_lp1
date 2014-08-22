<?php
/* @var $this AdminController */
/* @var $model Participant */

$this->breadcrumbs=array(
	Yii::t('rec','Users')=>array('/user'),
	Yii::t('rec',"Participants structure", array(), 'participant'),
);

$this->menu=array(
);

?>

<h1><?php echo Yii::t('rec',"Participants structure", array(), 'participant') . ' '.Yii::t('rec', '#') . $participant->username ; ?></h1>

<?php 
$this->renderPartial('_index', array('model'=>$model));
?>
