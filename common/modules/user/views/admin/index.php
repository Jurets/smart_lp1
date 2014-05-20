<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('/user'),
	UserModule::t('Manage'),
);

$this->menu=array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
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

<style type="text/css">
    .green{
        background-color: #DFF0D8;
    }
    .red{
        background-color: #F2DEDE;
    }
</style>

<h1><?php echo UserModule::t("Unified database participants", array(), 'participant'); ?></h1>


<!--<p><?php echo UserModule::t("You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done."); ?></p>-->
<?php //echo CHtml::link(UserModule::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
    'type' => array(TbHtml::GRID_TYPE_CONDENSED, TbHtml::GRID_TYPE_BORDERED/*, TbHtml::GRID_TYPE_STRIPED*/),
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    //'rowHtmlOptionsExpression'=>'$data->status == User::STATUS_NOACTIVE ? array("style"=>"background-color: red") : ""',
    'rowCssClassExpression'=>'$data->color',
	'columns'=>array(
		array(
			'name' => 'id',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
            //'filter'=>TbHtml::activeTextField($model, 'id', array('style'=>'width: 40px')),
            'filterInputOptions'=>array('style'=>'width: 40px'),
            //'headerHtmlOptions'=>array('style'=>'width: 50px'),
            //'filterHtmlOptions'=>array('style'=>'width: 50px'),
            'htmlOptions'=>array('style'=>'width: 40px'),
		),
        array(
            'name' => 'tariff_id',
            'type'=>'html',
            'filter'=>CHtml::activeDropDownList($model, 'tariff_id', TbHtml::listData(Tariff::model()->findAll(), 'id', 'shortname'), array(
                'style'=>'width: 90px',
                'displaySize'=>'1',
                'prompt'=>'<выбор>',
            )),
            'value' => '$data->tariffShortValue',
            'htmlOptions'=>array('style'=>'width: 90px'),
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
        array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
        array(
            'name'=>'structure',
            'header'=>UserModule::t("Structure", array(), 'participant'),
            'type'=>'raw',
            'value'=>null,
            'filter'=>false,
            'htmlOptions'=>array('style'=>'width: 70px'),
        ),
        array(
            'name'=>'business',
            'header'=>UserModule::t("Business Club", array(), 'participant'),
            'type'=>'raw',
            'value'=>null,
            'filter'=>false,
            'htmlOptions'=>array('style'=>'width: 70px'),
        ),
        array(
            'name' => 'refer_id',
            'type'=>'raw',
            'filter'=>false,
            'value' => '$data->referalName',
        ),
        array(
            'name'=>'checks',
            'header'=>UserModule::t("Checks", array(), 'participant'),
            'type'=>'raw',
            'value'=>null,
            'filter'=>false,
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
        array(
            'name'=>'fdl',
            'header'=>'fdl',
            'type'=>'raw',
            'value'=>null,
            'filter'=>false,
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
        array(
            'name'=>'time',
            'header'=>UserModule::t("Time", array(), 'participant'),
            'type'=>'raw',
            'value'=>null,
            'filter'=>false,
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
		//'lastvisit_at',
		/*array(
			'name'=>'superuser',
			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
			'filter'=>User::itemAlias("AdminStatus"),
		),*/
		/*array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
			'filter' => User::itemAlias("UserStatus"),
		),*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{on} {off} {ban} {delete}',
            'buttons' => array(
                'on' => array(
                        'url' => 'Yii::app()->controller->createUrl("status", array("id" => $data->id, "status" => User::STATUS_ACTIVE))',
                        'label'=>'',
                        'options' => array(
                            'class'=>'icon-ok',
                            'rel' => 'nofollow',
                            'title' => UserModule::t("Activate", array(), 'participant'),
                            'ajax' => array(
                                'type' => 'get',
                                'url'=>'js:$(this).attr("href")',
                                'beforeSend' => 'js: function() {return confirm("' . Yii::t('main', 'Are you sure to activate this user') . '?");}',
                                'success' => 'js:function(data) { $.fn.yiiGridView.update("user-grid")}'
                            ),
                        ),
                        'visible' => '$data->superuser != 1 && ($data->status == User::STATUS_NOACTIVE)',
                       ),
                'off' => array(
                        'url' => 'Yii::app()->controller->createUrl("status", array("id" => $data->id, "status" => User::STATUS_NOACTIVE))',
                        'label'=>'',
                        'options' => array(
                            'class'=>'icon-off',
                            'rel' => 'nofollow',
                            'title' => UserModule::t("Deactivate", array(), 'participant'),
                            'ajax' => array(
                                'type' => 'get',
                                'url'=>'js:$(this).attr("href")',
                                'beforeSend' => 'js: function() {return confirm("' . Yii::t('main', 'Are you sure to deactivate this user') . '?");}',
                                'success' => 'js:function(data) { $.fn.yiiGridView.update("user-grid")}'
                            ),
                        ),
                        'visible' => '($data->superuser != 1) && ($data->status == User::STATUS_ACTIVE)',
                       ),
                'ban' => array(
                        'url' => 'Yii::app()->controller->createUrl("status", array("id" => $data->id, "status" => User::STATUS_BANNED))',
                        'label'=>'',
                        'options' => array(
                            'class'=>'icon-ban-circle',
                            'rel' => 'nofollow',
                            'title' => UserModule::t("Blacklist", array(), 'participant'),
                            'ajax' => array(
                                'type' => 'get',
                                'url'=>'js:$(this).attr("href")',
                                'beforeSend' => 'js:
                                         function() {
                                                //$("#div-loading").addClass("grid-loading");
                                                isDel = confirm("' . Yii::t('main', 'Are you sure to ban this user') . '?");
                                                //if (!isDel)
                                                //    $("#div-loading").removeClass("grid-loading");
                                                return isDel;
                                         }',
                                'success' => 'js:function(data) { $.fn.yiiGridView.update("user-grid")}'
                            ),
                        ),
                        'visible' => '($data->superuser != 1) && ($data->status != User::STATUS_BANNED)',
                       ),
                'delete' => array(
                    'visible' => '($data->superuser != 1)',
                )
            )),            
	),
)); 
?>
