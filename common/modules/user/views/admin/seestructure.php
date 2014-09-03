<?php
/* @var $this AdminController */
/* @var $model Participant */

$this->breadcrumbs=array(
	BaseModule::t('rec','Users')=>array('/user'),
	BaseModule::t('rec',"Participants structure", array(), 'participant'),
);

$this->menu=array(
);

?>

<h1><?php echo BaseModule::t('rec',"Participants structure", array(), 'participant') . ' '.BaseModule::t('rec', '#') . $participant->username ; ?></h1>

<?php 
$this->renderPartial('_index', array('model'=>$model));
?>
