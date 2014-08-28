<?php
/* @var $this TrainingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('rec', 'Training'),
);

$this->menu = array(
    array('label' => Yii::t('rec', 'Create Training'), 'url' => array('create')),
    array('label' => Yii::t('rec', 'Manage Trainings'), 'url' => array('index')),
);
?>

<h1><?php echo Yii::t('rec', 'Training') ?></h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
