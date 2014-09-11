<?php
/* @var $this DefaultController */
/* @var $model Information */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'Information') => array('index'),
    BaseModule::t('rec', 'Manage'),
);

$this->menu = array(
    //array('label' => BaseModule::t('common', 'List Requisites'), 'url' => array('admin')),
    array('label' => BaseModule::t('rec', 'Create'), 'url' => array('create')),
);

?>

<h1><?php echo BaseModule::t('rec', 'Manage') ?></h1>

<p><?php echo BaseModule::t('rec',"You may optionally enter a comparison operator").' (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) '.BaseModule::t('rec', "at the beginning of each of your search values to specify how the comparison should be done."); ?></p>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'requisites-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'htmlOptions'=>array('style'=>'font-size: 12px'),
    'columns' => array(
        array(
            'name' => 'id',
            'type'=>'raw',
            'filterInputOptions'=>array('style'=>'width: 70px'),
            'htmlOptions'=>array('style'=>'width: 70px'),
        ),
        array(
            'name' => 'title',
            'type'=>'raw',
            'filterInputOptions'=>array('style'=>'width: 150px'),
            'htmlOptions'=>array('style'=>'width: 150px'),
        ),
        array(
            'name' => 'text',
            'type'=>'raw',
            'filterInputOptions'=>array('style'=>'width: 1000px'),
            'htmlOptions'=>array('style'=>'width: 1000px'),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
