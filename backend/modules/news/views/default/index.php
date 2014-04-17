<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
	'News' => array('index'),
);

$this->menu=array(
// 	array('label'=>'Create News', 'url'=>array('/news/news/create')),
// 	array('label'=>'Manage News', 'url'=>array('/news/news/admin')),
	array('label'=>Yii::app()->getModule('news')->t("Create News"), 'url'=>array('create')),
	array('label'=>Yii::app()->getModule('news')->t("Manage News"), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::app()->getModule('news')->t("News") ?></h1>


<?php
	 $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
?>
