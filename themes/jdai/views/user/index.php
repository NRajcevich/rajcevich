<?php
/* @var $this UserController */
/* @var $model User */
?>


<div class="row">
	<div class="col-lg-6">
		<?php
		$this->menu=array(
			array('label'=>'Add User', 'url'=>array('create'), 'linkOptions'=>array('class'=>'link')),
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
			Manage User
		</header>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'user-grid',
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
				'username',
                'email',
				'first_name',
				'last_name',
				'state',
				'county',
				array(
					'name' => 'block',
					'value' => '($data->block == 1)?"Active":"Inactive"',
					'filter' => array(0 => 'Inactive', 1 => 'Active')
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
				array('label'=>'Add User', 'url'=>array('create'), 'linkOptions'=>array('class'=>'link')),
			);
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('style'=>'display:inline-block;'),
			));
		?>
		<?php
            if(Yii::app()->user->checkAccess('state_admin')){
                echo CHTML::submitButton('Delete',array('name'=>'delete_checked', 'class'=>'link'));
            }
        ?>
	</div>
</div>

<?php echo CHTML::endform(); ?>