<?php
$this->breadcrumbs=array(
	BaseModule::t('rec','Users')=>array('/user'),
	BaseModule::t('rec', 'Manage'),
);

$this->menu=array(
    /*array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),*/
    array('label'=>BaseModule::t('rec','Create User'), 'url'=>array('create')),
    array('label'=>BaseModule::t('rec','Participants structure'), 'url'=>array('admin/structure/')),
    array('label'=>BaseModule::t('rec','BusinessClub structure'), 'url'=>array('admin/bcstructure/')),
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

<h1><?php echo BaseModule::t('rec',"Participants structure"); ?></h1>


<p><?php echo htmlspecialchars_decode(BaseModule::t('rec',  htmlspecialchars("You may optionally enter a comparison operator ( <, <=, >, >=, <> or = ) at the beginning of each of your search values to specify how the comparison should be done."))); ?></p>
<?php //echo CHtml::link(UserModule::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display: block;">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
    'type' => array(TbHtml::GRID_TYPE_CONDENSED, TbHtml::GRID_TYPE_BORDERED/*, TbHtml::GRID_TYPE_STRIPED*/),
	'dataProvider'=>$model->search(),
	'filter'=>null,
    //'rowHtmlOptionsExpression'=>'$data->status == User::STATUS_NOACTIVE ? array("style"=>"background-color: red") : ""',
    'rowCssClassExpression'=>'$data->color',
	'columns'=>array(
		array(
			'name' => 'id',
			'type'=>'raw',
			'value' => 'TbHtml::link(TbHtml::encode($data->id),array("admin/update","id"=>$data->id))',
            'filterInputOptions'=>array('style'=>'width: 40px'),
            'htmlOptions'=>array('style'=>'width: 40px'),
		),
        array(
            'name' => 'create_at',
            'type'=>'date',
            'filterInputOptions'=>array('style'=>'width: 80px'),
        ),
		array(
			'name' => 'username',
			'type'=>'raw',
            'filter'=>TbHtml::activeTextField($model, 'username', array('style'=>'width: 100px')),
			'value' => 'CHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
		),
        array(
            'name' => 'first_name',
            'type'=>'raw',
            'filterInputOptions'=>array('style'=>'width: 100px'),
            'htmlOptions'=>array('style'=>'width: 100px'),
        ),
		
        array(
            'name' => 'last_name',
            'type'=>'raw',
            'filterInputOptions'=>array('style'=>'width: 150px'),
            'htmlOptions'=>array('style'=>'width: 150px'),
        ),
        array(
            'name' => 'country_id',
            'type'=>'raw',
            'filterInputOptions'=>array('style'=>'width: 100px'),
            'value' => '$data->countryName',
            'htmlOptions'=>array('style'=>'width: 100px'),
        ),
        array(
            'name' => 'city_id',
            'type'=>'raw',
            //'filter'=>TbHtml::activeTextField($model, 'city_id', array('style'=>'width: 100px')),
            'filterInputOptions'=>array('style'=>'width: 100px'),
            'value' => '$data->cityName',
            'htmlOptions'=>array('style'=>'width: 100px'),
        ),
        'phone',
        'skype',
        array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'TbHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
        array(
            'name' => 'refer_id',
            'type'=>'raw',
            'filter'=>false,
            'value' => '$data->referalName',
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{structure}',
            'buttons' => array(
                'structure' => array(
                    'url' => 'Yii::app()->controller->createUrl("seestructure", array("id" => $data->id))',
                    'label'=>'',
                    'options' => array(
                        'class'=>'icon-th-list',
                        'rel' => 'nofollow',
                        'title' => BaseModule::t('rec',"See structure", array(), 'participant'),
                    ),
                    'visible' => '($data->superuser != 1) && ($data->subCount > 0)',
                ),
            )),            
	),
)); 
?>
