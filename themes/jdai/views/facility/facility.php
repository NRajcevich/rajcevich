<?php
/* @var $this FacilityController */
/* @var $model Facility */

$this->menu=array(
	array('label'=>'Manage Facilities', 'url'=>array('index')),
	array('label'=>'Create Facility', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#facility-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Facilities</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<div class="panel">
	<div class="panel-heading">
		<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
		<span class="tools pull-right">
			<a class="search-button fa fa-chevron-down" href="javascript:;"></a>
		</span>
	</div>
	<div class="search-form panel-body" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div><!-- search-form -->
</div>

<div class="col-sm-12">
	<div class="panel">
		<div class="panel-body">
			<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'facility-grid',
				'htmlOptions'=>array(
					'class'=>'table  table-hover general-table',
				),
				'dataProvider'=>$model->search(),
				'filter'=>$model,
				'columns'=>array(
					'type',
					'name',
					'address',
					'state',
					'county',
					'capacity',
					array(
						'class'=>'CButtonColumn',
					),
				),
			)); ?>
		</div>
	</div>
</div>