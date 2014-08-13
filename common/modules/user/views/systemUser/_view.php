<?php
/* @var $this SystemUserController */
/* @var $data SystemUser */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activkey')); ?>:</b>
	<?php echo CHtml::encode($data->activkey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('superuser')); ?>:</b>
	<?php echo CHtml::encode($data->superuser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('roles')); ?>:</b>
	<?php echo CHtml::encode($data->roles); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_at')); ?>:</b>
	<?php echo CHtml::encode($data->create_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastvisit_at')); ?>:</b>
	<?php echo CHtml::encode($data->lastvisit_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logincode')); ?>:</b>
	<?php echo CHtml::encode($data->logincode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tariff_id')); ?>:</b>
	<?php echo CHtml::encode($data->tariff_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refer_id')); ?>:</b>
	<?php echo CHtml::encode($data->refer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inviter_id')); ?>:</b>
	<?php echo CHtml::encode($data->inviter_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invite_num')); ?>:</b>
	<?php echo CHtml::encode($data->invite_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('busy_date')); ?>:</b>
	<?php echo CHtml::encode($data->busy_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('club_date')); ?>:</b>
	<?php echo CHtml::encode($data->club_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('balance')); ?>:</b>
	<?php echo CHtml::encode($data->balance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dob')); ?>:</b>
	<?php echo CHtml::encode($data->dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city_id')); ?>:</b>
	<?php echo CHtml::encode($data->city_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gmt_id')); ?>:</b>
	<?php echo CHtml::encode($data->gmt_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('skype')); ?>:</b>
	<?php echo CHtml::encode($data->skype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo')); ?>:</b>
	<?php echo CHtml::encode($data->photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purse')); ?>:</b>
	<?php echo CHtml::encode($data->purse); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('income')); ?>:</b>
	<?php echo CHtml::encode($data->income); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transfer_fund')); ?>:</b>
	<?php echo CHtml::encode($data->transfer_fund); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activated')); ?>:</b>
	<?php echo CHtml::encode($data->activated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sys_lang')); ?>:</b>
	<?php echo CHtml::encode($data->sys_lang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_access')); ?>:</b>
	<?php echo CHtml::encode($data->country_access); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city_access')); ?>:</b>
	<?php echo CHtml::encode($data->city_access); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('skype_access')); ?>:</b>
	<?php echo CHtml::encode($data->skype_access); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_access')); ?>:</b>
	<?php echo CHtml::encode($data->email_access); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('new_email')); ?>:</b>
	<?php echo CHtml::encode($data->new_email); ?>
	<br />

	*/ ?>

</div>