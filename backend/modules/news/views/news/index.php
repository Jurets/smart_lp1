<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
	'News',
);

$this->menu=array(
	array('label'=>'Create News', 'url'=>array('/news/news/create')),
	array('label'=>'Manage News', 'url'=>array('/news/news/admin')),
);
?>

<h1><?php echo Yii::app()->getModule('news')->t("News") ?></h1>

<?php
	 $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
?>
