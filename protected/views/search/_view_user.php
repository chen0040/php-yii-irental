<div class="view">
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->username), array('User/view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstname')); ?>:</b>
	<?php echo CHtml::encode($data->firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastname')); ?>:</b>
	<?php echo CHtml::encode($data->lastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('addressline1')); ?>:</b>
	<?php echo CHtml::encode($data->addressline1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addressline2')); ?>:</b>
	<?php echo CHtml::encode($data->addressline2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addressline3')); ?>:</b>
	<?php echo CHtml::encode($data->addressline3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addressline4')); ?>:</b>
	<?php echo CHtml::encode($data->addressline4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login_time')); ?>:</b>
	<?php echo CHtml::encode($data->last_login_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->create_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_id); ?>
	<br />

	*/ ?>

</div>