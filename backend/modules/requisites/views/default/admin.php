<?php
/* @var $this RequisitesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    BaseModule::t('common', 'Requisites'),
);

$this->menu = array(
//    array('label' => BaseModule::t('common', 'Create Requisites'), 'url' => array('create')),
    array('label' => BaseModule::t('common', 'Manage Requisites'), 'url' => array('index')),
);
?>

<h1><?php echo BaseModule::t('common', 'Requisites'); ?></h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
