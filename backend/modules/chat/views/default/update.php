
<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
    'Чат'=>array('admin'),
    'Изменить',
);

$this->menu=array(
    //array('label'=>'Создать', 'url'=>array('create')),
    array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<h1>Изменить #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?> 