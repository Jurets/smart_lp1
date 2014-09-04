<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    BaseModule::t('rec', 'News') => array('index'),
    BaseModule::t('rec', 'Create'),
);

$this->menu = array(
    array('label' => BaseModule::t('rec', 'List News'), 'url' => array('index')),
    array('label' => BaseModule::t('rec', 'Manage News'), 'url' => array('admin')),
);
?>
</div>
<h1><?php echo BaseModule::t('rec','Create News') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>