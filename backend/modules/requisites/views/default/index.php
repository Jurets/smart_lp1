<?php
/* @var $this RequisitesController */
/* @var $model Requisites */

$this->breadcrumbs = array(
    BaseModule::t('common', 'Requisites') => array('index'),
    BaseModule::t('common', 'Manage'),
);

$this->menu = array(
    array('label' => BaseModule::t('common', 'List Requisites'), 'url' => array('admin')),
    //array('label' => BaseModule::t('common', 'Create Requisites'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#requisites-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo BaseModule::t('common', 'Manage Requisites') ?></h1>

<p>
    <?php
    echo BaseModule::t(
            'common', 'You may optionally enter a comparison operator ({signs}) at the beginning of each of your search values to specify how the comparison should be done', array(
        '{signs}' => '<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>')
    );
    ?>.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'requisites-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'details',
        'agreement',
        'marketing',
        'pw_supervisor',
        'pw_admin',
        'pw_moderator',
        'purse_activation',
        'purse_club',
        'purse_investor',
        'purse_fdl',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
