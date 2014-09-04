
<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
    //'Чат'=>array('admin'),
    BaseModule::t('rec', 'Chat messages')=>array('admin'),
    BaseModule::t('rec', 'Edit'),
);

$this->menu=array(
    //array('label'=>'Создать', 'url'=>array('create')),
    array('label'=>BaseModule::t('rec', 'Chat') . ' ' . BaseModule::t('rec', 'Blocking'), 'url'=>array('search')),
);
?>

<h1><?php echo BaseModule::t('rec', 'Edit')//echo '# '. $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?> 