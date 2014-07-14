<?php
/* @var $this TrainingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('common', 'Training'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'Create Training'), 'url' => array('create')),
    array('label' => Yii::t('common', 'Manage Training'), 'url' => array('index')),
);
?>

<h1><?php echo Yii::t('common', 'Training') ?></h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
