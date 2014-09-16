<?php
/* @var $this MpversionsController */
/* @var $model Mpversions */


$this->breadcrumbs=array(
	BaseModule::t('rec','Mpversions')=>array('index'),
	BaseModule::t('rec','Manage'),
);

$this->menu=array(
//array('label'=>'List Mpversions', 'url'=>array('index')),
array('label'=>BaseModule::t('rec','Create Version'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$('#mpversions-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1><?php echo BaseModule::t('rec','Manage versions of marketings plan'); ?></h1>

<?php echo CHtml::link(BaseModule::t('rec','Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'mpversions-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'rowCssClassExpression'=>'$data->getColor()',
'columns'=>array(
		//'id',
		'description',
		'creationdate',
		'activity',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
'template'=>'{view} {choise} {update} {delete}',
'buttons'=>array(
    'choise'=>array(
        'url'=> 'Yii::app()->createUrl("mp/default/choise", array("id"=>$data->id))',
        'label'=>  TbHtml::icon(TbHtml::ICON_REPEAT),
        'options'=>array(
            'class'=>'set_current',
            'title'=>BaseModule::t('rec','set current'),
        ),
    ),
 ),
  ),
),

)); ?>