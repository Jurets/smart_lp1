<?php
/* @var $this ChatController */
/* @var $model Chatmessages */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
//    'Чат'=>array('admin'),
//    'Поиск'=>array('search'),
//    $model->username,
    BaseModule::t('rec', 'Chat') . ' ' . BaseModule::t('rec', 'Blocking')// => array('search'),
);

$this->menu=array(
    array('label'=>BaseModule::t('rec', 'Chat messages'), 'url'=>array('admin')),
    //array('label'=>'Поиск', 'url'=>array('search')),
);
?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true,
)); ?>

<h1><?php echo BaseModule::t('rec', 'Find and block participant');?></h1>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); 
    echo $form->errorSummary($model);
?>

	<div class="row">
		<?php echo TbHtml::label(BaseModule::t('rec', 'Enter participant login'), 'username_id'); //echo $form->label($model, 'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255, 'id'=>'username_id')); ?>
	</div>

	<div class="row buttons">
		<?php echo TbHtml::submitButton(BaseModule::t('rec', 'Search'), array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->