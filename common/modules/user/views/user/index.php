<?php
$this->breadcrumbs=array(
	Yii::t('rec',"Users"),
);
if(UserModule::isAdmin()) {
	//$this->layout='//layouts/column2';
	$this->menu=array(
	    array('label'=>Yii::t('rec','Manage Users'), 'url'=>array('/user/admin')),
	    array('label'=>Yii::t('rec','Manage Profile Field'), 'url'=>array('profileField/admin')),
	);
}
?>

<h1><?php echo Yii::t('rec',"List User"); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("user/view","id"=>$data->id))',
		),
		'create_at',
		'lastvisit_at',
	),
)); ?>
