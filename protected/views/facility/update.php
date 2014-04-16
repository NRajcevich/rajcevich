<?php
/* @var $this FacilityController */
/* @var $model Facility */

$this->menu=array(
	array('label'=>'Manage Facilities', 'url'=>array('index')),
	array('label'=>'Create Facility', 'url'=>array('create')),
	array('label'=>'View Facility', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update Facility <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>