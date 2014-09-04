<?php
/* @var $this CountriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'Countries'),
);

$this->menu = array(
    array('label' => BaseModule::t('rec', 'Create Countries'), 'url' => array('create')),
    array('label' => BaseModule::t('rec', 'Manage Countries'), 'url' => array('admin')),
);
?>

<h1><?php echo BaseModule::t('rec', 'Countries') ?></h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
