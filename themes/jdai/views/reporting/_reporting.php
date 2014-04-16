<?php
$this_user = User::model()->findByPk(Yii::app()->user->id);
$modelD = Detention::model()->findAll();
$modelF = Facility::model()->findAll();
?>

<?php $this->renderPartial('_table1', array('modelD' => $modelD, 'modelF' => $modelF)); ?>
<?php $this->renderPartial('_table2', array('modelD' => $modelD, 'modelF' => $modelF)); ?>