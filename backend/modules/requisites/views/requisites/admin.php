<?php
/* @var $this RequisitesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('common', 'Requisites'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'Create Requisites'), 'url' => array('create')),
    array('label' => Yii::t('common', 'Manage Requisites'), 'url' => array('index')),
);
?>

<h1><?php echo Yii::t('common', 'Requisites'); ?></h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
