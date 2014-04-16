<?php
/* @var $this TrainingController */
/* @var $data Training */
?>

<div class="view">

	<b><?php echo TbHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo TbHtml::link(TbHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo TbHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo TbHtml::encode($data->title); ?>
	<br />

	<b><?php echo TbHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo TbHtml::encode($data->description); ?>
	<br />

	<p><b><?php echo TbHtml::encode($data->getAttributeLabel('image')); ?>:</b></p>
	<?php echo TbHtml::image($data->image); ?>
	<br />

    <p><b><?php echo TbHtml::encode($data->getAttributeLabel('videolink')); ?>:</b></p>
	<?php echo $data->videolink; ?>
	<br />

	<b><?php echo TbHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo TbHtml::encode($data->date); ?>
	<br />

	<b><?php echo TbHtml::encode($data->getAttributeLabel('number')); ?>:</b>
	<?php echo TbHtml::encode($data->number); ?>
	<br /><hr>


</div>