<?php
/* @var $this CountriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('common', 'Countries'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'Create Countries'), 'url' => array('create')),
    array('label' => Yii::t('common', 'Manage Countries'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('common', Countries) ?></h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
