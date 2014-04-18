<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Cities'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Cities', 'url'=>array('admin')),
	array('label'=>'Create Cities', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cities-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cities</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'cities-grid',
    'type'=>TbHtml::GRID_TYPE_STRIPED,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

        array(
            'name'=>'id',
            'filter'=>TbHtml::activeTextField($model, 'id', array('style'=>'width: 50px')),
            'htmlOptions'=>array('style'=>'width: 50px'),
            ),

        array(
            'name'=>'country_id',
            'filter'=>TbHtml::activeTextField($model, 'country_id', array('style'=>'width: 50px')),
            'htmlOptions'=>array('style'=>'width: 50px'),
            ),

        array(
            'name'=>'name',
            'filter'=>TbHtml::activeTextField($model, 'name', array('style'=>'width: 150 px')),
            'htmlOptions'=>array('style'=>'width: 50px'),
            ),



		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
