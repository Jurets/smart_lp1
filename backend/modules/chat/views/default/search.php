<?php
/* @var $this ChatController */
/* @var $model Chatmessages */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
    'Чат'=>array('admin'),
    'Поиск'=>array('search'),
    $model->username,
);

$this->menu=array(
    array('label'=>'Сообщения', 'url'=>array('admin')),
    //array('label'=>'Поиск', 'url'=>array('search')),
);
?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true,
)); ?>

<h1>Найти и заблокировать участника</h1>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo TbHtml::label('Введите логин участника', 'username_id'); //echo $form->label($model, 'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255, 'id'=>'username_id')); ?>
	</div>

	<div class="row buttons">
		<?php echo TbHtml::submitButton('Найти', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->