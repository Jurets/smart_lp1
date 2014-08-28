<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
	'News' => array('index'),
);

$this->menu=array(
// 	array('label'=>'Create News', 'url'=>array('/news/news/create')),
// 	array('label'=>'Manage News', 'url'=>array('/news/news/admin')),
	array('label'=>Yii::t("rec","Create News"), 'url'=>array('create')),
	array('label'=>Yii::t('rec',"Manage News"), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('rec',"News") ?></h1>


<?php
	 $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));                          
?>
