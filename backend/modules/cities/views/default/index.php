<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'Cities') => array('index'),
    BaseModule::t('rec', 'Manage'),
);

$this->menu = array(
    array('label' => BaseModule::t('rec', 'Create Cities'), 'url' => array('create')),
);

?>

<h1><?php echo BaseModule::t('rec', 'Manage Cities') ?></h1>

<p><?php echo htmlspecialchars_decode(BaseModule::t('rec',  htmlspecialchars("You may optionally enter a comparison operator ( <, <=, >, >=, <> or = ) at the beginning of each of your search values to specify how the comparison should be done.")));?>.</p>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'cities-grid',
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'dataProvider' => $model->search(),
    'filter' => $model,
    'htmlOptions'=>array('style'=>'font-size: 12px'),
    'columns' => array(
        array(
            'name' => 'id',
            'filter' => TbHtml::activeTextField($model, 'id', array('style' => 'width: 50px')),
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
        array(
            'name' => 'country_id',
            'filter' => TbHtml::activeTextField($model, 'country_id', array('style' => 'width: 250px')),
            'value' => '$data->country->name',
            'htmlOptions' => array('style' => 'width: 250px'),
        ),
        array(
            'name' => 'name',
            'filter' => TbHtml::activeTextField($model, 'name', array('style' => 'width: 150 px')),
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{update} {delete}',
        ),
    ),
));
?>
