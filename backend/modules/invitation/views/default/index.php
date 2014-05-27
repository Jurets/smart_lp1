<?php
    /* @var $this InvitationController */
    /* @var $model Invitation */

    $this->breadcrumbs=array(
        'Invitations'=>array('index'),
        'Manage',
    );

    $this->menu=array(
        array('label'=>Yii::t('common', 'Create'), 'url'=>array('create')),
        //array('label'=>Yii::t('common', 'Delete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    );

    Yii::app()->clientScript->registerScript('search', "
        $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
        });
        $('.search-form form').submit(function(){
        $('#invitation-grid').yiiGridView('update', {
        data: $(this).serialize()
        });
        return false;
        });
    ");
?>

<h1><?php echo InvitationModule::t('Manage Invitations'); ?></h1>

<?php     
    //вьюшка для сообщения об операторах сравнения
    echo $this->renderPartial('backend.views.site.comparison');
?>

<?php echo CHtml::link(Yii::t('common', 'Advanced Search'),'#',array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
            'model'=>$model,
        )); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'invitation-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'video_link',
        'file',
        'file_link',
        'created',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
    ),
    )); ?>
