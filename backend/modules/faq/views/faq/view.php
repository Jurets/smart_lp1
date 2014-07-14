<?php
/* @var $this FaqController */
/* @var $model Faq */

$this->breadcrumbs = array(
    "FAQ" => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => Yii::t('common', 'List FAQ'), 'url' => array('index')),
    array('label' => Yii::t('common', 'Create FAQ'), 'url' => array('create')),
    array('label' => Yii::t('common', 'Update FAQ'), 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('common', 'Delete FAQ'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('common', 'Manage FAQ'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('common', 'View FAQ') ?> #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'question',
        'answer',
        'created',
        //'id_user',
        'category',
    ),
));
?>
