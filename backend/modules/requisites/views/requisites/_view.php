<?php
/* @var $this RequisitesController */
/* @var $data Requisites */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('details')); ?>:</b>
	<?php echo CHtml::encode($data->details); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agreement')); ?>:</b>
	<?php echo CHtml::encode($data->agreement); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marketing')); ?>:</b>
	<?php echo CHtml::encode($data->marketing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pw_supervisor')); ?>:</b>
	<?php echo CHtml::encode($data->pw_supervisor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pw_admin')); ?>:</b>
	<?php echo CHtml::encode($data->pw_admin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pw_moderator')); ?>:</b>
	<?php echo CHtml::encode($data->pw_moderator); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('purse_activation')); ?>:</b>
	<?php echo CHtml::encode($data->purse_activation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purse_club')); ?>:</b>
	<?php echo CHtml::encode($data->purse_club); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purse_investor')); ?>:</b>
	<?php echo CHtml::encode($data->purse_investor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purse_fdl')); ?>:</b>
	<?php echo CHtml::encode($data->purse_fdl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_faq')); ?>:</b>
	<?php echo CHtml::encode($data->email_faq); ?>
	<br />

	*/ ?>

</div>