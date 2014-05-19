<?php
/* @var $this ChatController */
/* @var $model Chatmessages */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
    'Chat'=>array('admin'),
    'Search'=>array('search'),
    $model->username,
);

$this->menu=array(
    array('label'=>'Chat Messages', 'url'=>array('admin')),
    array('label'=>'User search', 'url'=>array('search')),
);

?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->