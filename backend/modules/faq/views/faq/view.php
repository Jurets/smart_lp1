<?php
/* @var $this FaqController */
/* @var $model Faq */

$this->breadcrumbs = array(
    BaseModule::t('rec','FAQ') => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => BaseModule::t('rec', 'List FAQ'), 'url' => array('index')),
    array('label' => BaseModule::t('rec', 'Create FAQ'), 'url' => array('create')),
    array('label' => BaseModule::t('rec', 'Update').' '.BaseModule::t('rec', 'FAQ'), 'url' => array('update', 'id' => $model->id)),
    array('label' => BaseModule::t('rec', 'Delete').' '.BaseModule::t('rec', 'FAQ'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => BaseModule::t('rec', 'Manage FAQ'), 'url' => array('admin')),
);
?>

<h1><?php echo BaseModule::t('rec', 'View').' '.BaseModule::t('rec', 'FAQ') ?> <?php echo BaseModule::t('rec','#')?><?php echo $model->id; ?></h1>

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
