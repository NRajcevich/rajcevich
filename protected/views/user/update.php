<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>'Manage User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Edit User "<?php echo $model->username; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>