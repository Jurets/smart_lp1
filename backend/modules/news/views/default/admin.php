<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    Yii::t('common', 'News') => array('index'),
    Yii::t('common', 'Manage'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'List News'), 'url' => array('index')),
    array('label' => Yii::t('common', 'Create News'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#news-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('common', 'Manage News') ?></h1>


<?php echo CHtml::link(Yii::t('common', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
// $this->widget('zii.widgets.grid.CGridView', array(
// 	'id'=>'news-grid',
// 	'dataProvider'=>$model->search(),
// 	'filter'=>$model,
// 	'columns'=>array(
// 		/*'id',*/
// 		'author',
// 		'created',
// 		'activated',
// 		'title',
// 		'announcement',
// 		'content',
// 		/*'image',*/
// 		'activity',
// 		array(
// 			'class'=>'CButtonColumn',
// 		),
// 	),
// )); 
?>
<?php
$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'id' => 'news-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id',
        //'author',
        'created',
        'activated',
        'title',
        /* 'announcement', */

        /* 'content', */
        /* 'image', */
        //'activity',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
