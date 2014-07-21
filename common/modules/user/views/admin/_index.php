<?php
/* @var $model Participant */

//строим выпад. список из значений тарифов
$criteria = New CDbCriteria();
if ($model->scenario == 'bcstructure')
    $criteria->addInCondition('id', $model->businessclubIDs);
    
$listData = TbHtml::listData(Tariff::model()->findAll($criteria), 'id', 'shortname');

$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
    'type' => array(TbHtml::GRID_TYPE_CONDENSED, TbHtml::GRID_TYPE_BORDERED/*, TbHtml::GRID_TYPE_STRIPED*/),
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'rowCssClassExpression'=>'$data->color',
	'columns'=>array(
		array(
			'name' => 'id',
			'type'=>'raw',
			'value' => 'TbHtml::link(TbHtml::encode($data->id),array("admin/update","id"=>$data->id))',
            //'filter'=>TbHtml::activeTextField($model, 'id', array('style'=>'width: 40px')),
            'filterInputOptions'=>array('style'=>'width: 40px'),
            'htmlOptions'=>array('style'=>'width: 40px'),
		),
        array(
            'name' => 'tariff_id',
            'type'=>'html',
            'filter'=>TbHtml::activeDropDownList($model, 'tariff_id', $listData, array(
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
            'filterInputOptions'=>array('style'=>'width: 70px'),
        ),
		array(
			'name' => 'username',
			'type'=>'raw',
            'filter'=>TbHtml::activeTextField($model, 'username', array('style'=>'width: 100px')),
			'value' => 'TbHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
		),
        array(
            'name' => 'first_name',
            'type'=>'raw',
            'filterInputOptions'=>array('style'=>'width: 80px'),
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
            'filterInputOptions'=>array('style'=>'width: 100px'),
            'value' => '$data->cityName',
            'htmlOptions'=>array('style'=>'width: 100px'),
        ),
        array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'TbHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
      /*  array(
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
        ),*/
        array(
            'name' => 'refer_id',
            'type'=>'raw',
            'filter'=>false,
            //'value' => 'TbHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->referalId))',
            'value' => 'TbHtml::link($data->referalName, array("admin/view","id"=>$data->referalId))',
        ),
      /*  array(
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
        ),*/
        //кнопки
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{on} {off} {ban} {update} {delete}',
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
