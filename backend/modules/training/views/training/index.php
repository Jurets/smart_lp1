<?php
/* @var $this TrainingController */
/* @var $model Training */

$this->breadcrumbs = array(
    Yii::t('common', 'Training') => array('index'),
    Yii::t('common', 'Manage'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'List Training'), 'url' => array('admin')),
    array('label' => Yii::t('common', 'Create Training'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#training-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('common', 'Manage Trainings'); ?></h1>

<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
//$this->widget('zii.widgets.grid.CGridView', array(
//CHtml::image();
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'training-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
//		'id',
        array(
            'name' => 'number',
            'filter' => TbHtml::activeTextField($model, 'number', array('style' => 'width: 50px')),
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
        array(
            'name' => 'title',
            'filter' => TbHtml::activeTextField($model, 'title', array('style' => 'width: 90px')),
            'htmlOptions' => array('style' => 'width: 90px'),
        ),
        array(
            'name' => 'description',
            'filter' => TbHtml::activeTextField($model, 'description', array('style' => 'width: 110px')),
            'htmlOptions' => array('style' => 'width: 110px'),
        ),
        array(
            'name' => 'image',
            'filter' => TbHtml::activeTextField($model, 'image', array('style' => 'width: 90px')),
            'htmlOptions' => array('style' => 'width: 90px'),
        ),
//		'videolink',
        array(
            'name' => 'date',
            'filter' => TbHtml::activeTextField($model, 'date', array('style' => 'width: 90px')),
            'htmlOptions' => array('style' => 'width: 90px'),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
//			'class'=>'CButtonColumn',
        ),
    ),
));
?>

