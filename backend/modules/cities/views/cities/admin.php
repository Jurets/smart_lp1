<?php
/* @var $this CitiesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('common', 'Cities'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'Create Cities'), 'url' => array('create')),
    array('label' => Yii::t('common', 'Manage Cities'), 'url' => array('index')),
);
?>

<h1>Cities</h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
