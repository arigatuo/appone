<?php
$this->breadcrumbs=array(
	'Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t('bg','List'), 'url'=>array('index')),
	array('label'=>Yii::t('bg','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create Type</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>