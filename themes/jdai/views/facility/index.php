<?php
/* @var $this FacilityController */
/* @var $model Facility */
?>

<div class="row">
	<div class="col-lg-6">
		<?php
		$this->menu=array(
			array('label'=>'Add Facility', 'url'=>array('create'), 'linkOptions'=>array('class'=>'link')),
		);
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>''),
		));
		?>
	</div>
	
	<span class="state pull-right col-lg-3">
		<?php
		if(Yii::app()->user->checkAccess('state_admin')) { echo "State Administrator";}
		elseif(Yii::app()->user->checkAccess('account_admin')) { echo "Account Administrator";}
		?>
	</span>
</div>


<?php echo CHTML::form(); ?>

<div class="row">
	<div class="col-sm-12">
		<section class="panel">
		<header class="panel-heading">
			Manage facility
		</header>
		
		
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'facility-grid',
			'dataProvider'=>$model->search(),
			'itemsCssClass' => 'table  table-hover general-table',
			'selectableRows' => 2,
			'filter'=>$model,
			'summaryText' => '',
			'template' => '{items}{pager}',
			'pager'=>array(
				'header'=>'',
				'firstPageLabel'=>'First',
				'lastPageLabel'=>'Last',
				'nextPageLabel' => 'Next',
				'prevPageLabel' => 'Prev',
				'cssFile' => false,
				'htmlOptions' => array(
				 	'class' => 'my-pagination pagination pagination-sm pull-right'
				 ),
			),
			'columns'=>array(
				array(
					'class' => 'CCheckBoxColumn',
					'id' => 'checked'
				),
				'type' => array(
					'name' => 'type',
					'value' => '($data->type=="secure_detention"?"Secure Detention":"Alternative to Detention")',
					'filter' => array('secure_detention' => 'Secure Detention', 'atd' => 'Alternative to Detention'),
				),
				'name',
				'street1',
                'city',
				'state',
				'county',
				'capacity' => array(        
					'name'=>'capacity',
					'type'=>'html',
					'value' => '"<a class=\'editable-".$data->id."\'>".$data->capacity."</a>"',
					'htmlOptions'=>array('class'=>'field-capacity'),
					'headerHtmlOptions'=>array('width'=>'130px'),
				),
				array(
					'header' => 'Actions',
					'class'=>'CButtonColumn',
					'template'=>'{update}',
					'htmlOptions' => array(
						'width' => '40px',
					),
					'buttons' => array(
						'update' => array(
							'label'=>'Edit',
							'imageUrl'=> false,
							'options'=>array(
								'class' => 'update operation-btn',
							)
						),
					)
				),
			),
		)); 
		?>
		</section>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<?php
			$this->menu=array(
				array('label'=>'Add Facility', 'url'=>array('create'), 'linkOptions'=>array('class'=>'link')),
				//array('label'=>'Delete 2', 'url'=>array('delete','id'=>'8'), 'linkOptions'=>array('class'=>'btn btn-round btn-success pull-right')),
			);
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('style'=>'display:inline-block;'),
			));
		?>
		<?php echo CHTML::submitButton('Delete',array('name'=>'delete_checked', 'class'=>'link')); ?>
	</div>
</div>

<?php echo CHTML::endform(); ?>


<?php

Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.jeditable.js');
Yii::app()->clientScript->registerScript('capacity','

	$("a[class^=editable-]").live("hover", function(){
		$(this).editable("'.$this->createUrl('facility/changecapacity').'", {
			submitdata : function (value,settings){
							return {"Facility[id]":$(this).attr("class").substr("9"),};
						},
	        indicator : "Saving...",
	        tooltip   : "Click to edit...",
	        type : "number",
	        name : "Facility[capacity]",
	        min : "1",
	        style: "width: 10px"
	    });
	});

',CClientScript::POS_READY);