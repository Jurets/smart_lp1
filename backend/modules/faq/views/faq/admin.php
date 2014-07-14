<?php
/* @var $this FaqController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'FAQ',
);

$this->menu=array(
	array('label'=> Yii::t('common', 'Create Faq'), 'url'=>array('create')),
	array('label'=> Yii::t('common', 'Manage Faq'), 'url'=>array('admin')),
);
?>

<h1>Faqs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
