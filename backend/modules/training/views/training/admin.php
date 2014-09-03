<?php
/* @var $this TrainingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'Training'),
);

$this->menu = array(
    array('label' => BaseModule::t('rec', 'Create Training'), 'url' => array('create')),
    array('label' => BaseModule::t('rec', 'Manage Trainings'), 'url' => array('index')),
);
?>

<h1><?php echo BaseModule::t('rec', 'Training') ?></h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
