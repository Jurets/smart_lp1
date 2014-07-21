<?php
/* @var $this AdminController */

$this->breadcrumbs=array(
	//UserModule::t('Users')=>array('/user'),
    //UserModule::t('Participants') . ' /',
	UserModule::t('Unified database participants', array(), 'participant'),
);

$this->menu=array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('Participants structure',array(), 'participant'), 'url'=>array('admin/structure/')),
    array('label'=>UserModule::t('BusinessClub structure',array(), 'participant'), 'url'=>array('admin/bcstructure/')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});	
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>

<h1><?php echo UserModule::t("Unified database participants", array(), 'participant'); ?></h1>

<!--<p><?php echo UserModule::t("You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done."); ?></p>-->
<?php //echo TbHtml::link(UserModule::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
    /*echo TbHtml::link(UserModule::t('New Participant', array(), 'participant'), $this->createAbsoluteUrl('create'), array(
        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
        //'href' => $this->createAbsoluteUrl('create'),
    ));
    echo '<br>';
    echo '<br>';*/
    
    $this->renderPartial('_index', array('model'=>$model));
?>
