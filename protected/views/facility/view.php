<?php
/* @var $this FacilityController */
/* @var $model Facility */

$this->menu=array(
	array('label'=>'Manage Facilities', 'url'=>array('index')),
	array('label'=>'Create Facility', 'url'=>array('create')),
	array('label'=>'Update Facility', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Facility', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Facility #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'type',
		'name',
		'state',
		'county',
		'address',
		'capacity',
	),
)); ?>
