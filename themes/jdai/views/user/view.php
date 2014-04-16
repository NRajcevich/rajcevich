<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
	array('label'=>'Manage User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);

switch($model->access){
    case 1: $model->access = "Account User";
    case 5: $model->access = "Account Administrator";
    case 9: $model->access = "State Administrator";
}

switch($model->block){
    case 0: $model->block = "Blocked";
    case 1: $model->block = "Active";
}

$modelCounty = State::model()->find('state_code=:state_code',array(':state_code' => $model->state));
$model->state = $modelCounty->attributes['state'];

?>

<h1>View User "<?php echo $model->username; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'email',
		'create_at',
		'first_name',
		'last_name',
		'phone',
        'access',
		'state',
		'county',
        'block',
	),
)); ?>
