<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('Marker/view', 'id'=>$data->id)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('data_type')); ?>:</b>
	<?php echo CHtml::encode($data->data_type); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('age')); ?>:</b>
	<?php echo CHtml::encode($data->age); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_available')); ?>:</b>
	<?php 
	if($data->is_available==1)
	{
		echo 'Yes';
	}
	else
	{
		echo 'No';
	}
	?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />
	
	<b><?php echo CHtml::encode('Location'); ?>:</b>
	<?php echo '('.CHtml::encode($data->lat).','.CHtml::encode($data->lng).')'; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->createUser->lastname).' '.CHtml::encode($data->createUser->firstname).'('.CHtml::encode($data->createUser->username).')', array('User/view', 'id'=>$data->create_user_id)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->createUser->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::mailto(CHtml::encode($data->createUser->email)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->createUser->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->createUser->phone); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->createUser->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->createUser->mobile); ?>
	<br />

</div>