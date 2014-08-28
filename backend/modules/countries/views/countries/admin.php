<?php
/* @var $this CountriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('rec', 'Countries'),
);

$this->menu = array(
    array('label' => Yii::t('rec', 'Create Countries'), 'url' => array('create')),
    array('label' => Yii::t('rec', 'Manage Countries'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('rec', 'Countries') ?></h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
