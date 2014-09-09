<?php
/* @var $this DefaultController */
/* @var $model Information */

$this->breadcrumbs = array(
    BaseModule::t('common', 'Information') => array('index'),
    BaseModule::t('common', 'Manage'),
);

$this->menu = array(
    //array('label' => BaseModule::t('common', 'List Requisites'), 'url' => array('admin')),
    array('label' => BaseModule::t('common', 'Create'), 'url' => array('create')),
);

?>

<h1><?php echo BaseModule::t('common', 'Manage') ?></h1>

<p><?php echo BaseModule::t(
        'common', 'You may optionally enter a comparison operator ({signs}) at the beginning of each of your search values to specify how the comparison should be done', array(
        '{signs}' => '<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>')); ?>.
</p>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'requisites-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'title',
        'text',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
