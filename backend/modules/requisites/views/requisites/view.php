<?php
/* @var $this RequisitesController */
/* @var $model Requisites */

$this->breadcrumbs = array(
    Yii::t('common', 'Requisites') => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => Yii::t('common', 'List Requisites'), 'url' => array('index')),
   // array('label' => Yii::t('common', 'Create Requisites'), 'url' => array('create')),
    array('label' => Yii::t('common', 'Update Requisites'), 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('common', 'Delete Requisites'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('common', 'Manage Requisites'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('common', 'View Requisites') ?>#<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'details',
        'agreement',
        'marketing',
        'pw_supervisor',
        'pw_admin',
        'pw_moderator',
        'purse_activation',
        'purse_club',
        'purse_investor',
        'purse_fdl',
        'email_faq',
    ),
));
?>
