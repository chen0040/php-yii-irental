<?php
$this->breadcrumbs=array(
	'Markers'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Marker', 'url'=>array('index')),
	array('label'=>'Create Marker', 'url'=>array('create')),
	array('label'=>'Update Marker', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Marker', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Marker', 'url'=>array('admin')),
);
?>

<h1>View Marker #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
		'name',
		'address',
		'lat',
		'lng',
		'image_link1',
		'image_link2',
		'image_link3',
		'image_link4',
		'video_link',
		'data_type',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
