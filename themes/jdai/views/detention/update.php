<?php
/* @var $this DetentionController */
/* @var $model Detention */
?>

<div class="panel">
    <div class="panel-heading">
        <?php if($model->attributes['detention_type'] == 'Alternative'){ ?>
       		<h1>Alternative Detention Form</h1>
       	<?php } ?> 
       	<?php if($model->attributes['detention_type'] == 'Secure'){  ?>
       		<h1>Secure Detention Form</h1>
       	<?php } ?> 
    </div>
    <div class="panel-body">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>