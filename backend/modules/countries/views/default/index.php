<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'Countries') => array('index'),
    BaseModule::t('rec', 'Manage Countries'),
);

$this->menu = array(
   // array('label' => BaseModule::t('rec', 'List Countries'), 'url' => array('admin')),
    array('label' => BaseModule::t('rec', 'Create Countries'), 'url' => array('create')),
);

/*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#countries-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h1><?php echo BaseModule::t('rec', 'Manage Countries') ?></h1>

<p><?php echo htmlspecialchars_decode(BaseModule::t('rec',  htmlspecialchars("You may optionally enter a comparison operator ( <, <=, >, >=, <> or = ) at the beginning of each of your search values to specify how the comparison should be done."))); ?></p>

<?php //echo CHtml::link(BaseModule::t('rec', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<!--<div class="search-form" style="display:none">
    <?php //$this->renderPartial('_search', array('model' => $model,)); ?>
</div>--><!-- search-form -->

<!--// $this->widget('zii.widgets.grid.CGridView', array(-->
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'countries-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'id',
            'filter' => TbHtml::activeTextField($model, 'id', array('style' => 'width: 40px')),
            'htmlOptions' => array('style' => 'width: 40px'),
        ),
        array(
            'name' => 'name',
            'filter' => TbHtml::activeTextField($model, 'name', array('style' => 'width: 500px')),
            'htmlOptions' => array('style' => 'width: 500px'),
        ),
        array(
            'name' => 'code',
            'filter' => TbHtml::activeTextField($model, 'code', array('style' => 'width: 40px')),
            'htmlOptions' => array('style' => 'width: 40px'),
        ),
        array(
            'name' => 'code_num',
            'filter' => TbHtml::activeTextField($model, 'code_num', array('style' => 'width: 40px')),
            'htmlOptions' => array('style' => 'width: 40px'),
        ),
        array(
            'name' => 'phone_code',
            'filter' => TbHtml::activeTextField($model, 'phone_code', array('style' => 'width: 40px')),
            'htmlOptions' => array('style' => 'width: 40px'),
        ),
        array(
            'name' => 'gmt_id',
            'filter' => TbHtml::activeTextField($model, 'gmt_id', array('style' => 'width: 40px')),
            'htmlOptions' => array('style' => 'width: 40px'),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{update} {delete}',
        ),
    ),
));
?>
