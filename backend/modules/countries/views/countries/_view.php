<?php
/* @var $this CountriesController */
/* @var $data Countries */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code_num')); ?>:</b>
	<?php echo CHtml::encode($data->code_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_code')); ?>:</b>
	<?php echo CHtml::encode($data->phone_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gmt_id')); ?>:</b>
	<?php echo CHtml::encode($data->gmt_id); ?>
	<br />


</div>