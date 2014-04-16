<?php
/* @var $this FacilityController */
/* @var $model Facility */


$this->menu=array(
	array('label'=>'Manage Facilities', 'url'=>array('index')),
);
?>

<h1>Create Facility</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>