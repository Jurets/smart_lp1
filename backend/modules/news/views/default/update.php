<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    BaseModule::t('rec','News') => array('index'),
    $model->title => array('view', 'id' => $model->id),
    BaseModule::t('rec','Update News'),
);

$this->menu = array(
    array('label' => BaseModule::t('rec', 'List News'), 'url' => array('index')),
    array('label' => BaseModule::t('rec', 'Create News'), 'url' => array('create')),
    array('label' => BaseModule::t('rec', 'View News'), 'url' => array('view', 'id' => $model->id)),
    array('label' => BaseModule::t('rec', 'Manage News'), 'url' => array('admin')),
);
?>

<h1><?php echo BaseModule::t('rec','Update News')?> <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>