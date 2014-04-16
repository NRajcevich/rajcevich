<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">



    <h3>
    <?php
        if(Yii::app()->user->checkAccess('9')) { echo "State Administrator";}
        elseif(Yii::app()->user->checkAccess('5')) { echo "Account Administrator";}
        elseif(Yii::app()->user->checkAccess('1')) { echo "Account User";}
    ?>
    </h3>

    <?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>