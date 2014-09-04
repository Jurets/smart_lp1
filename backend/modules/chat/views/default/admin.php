<?php
/* @var $this ChatController */
/* @var $model Chatmessage */

$this->breadcrumbs=array(
    //'Чат'=>array('admin'),
    BaseModule::t('rec', 'Chat messages')//=>array('admin'),
    //'Сообщения',
);

$this->menu=array(
	//array('label'=>'Создать', 'url'=>array('create')),
    array('label' => BaseModule::t('rec', 'Chat') . ' ' . BaseModule::t('dic', 'Blocking'), 'url'=>array('search')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#chat-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo BaseModule::t('dic', 'Chat messages'); ?></h1>

<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php  

$date = empty($model->filterDate) ? null : Yii::app()->dateFormatter->format("dd.MM.yyyy", $model->filterDate);

$dateFilter = $this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'name'=>'Chatmessage[filterDate]',
    'value'=>$date, 
    'language'=>Yii::app()->language,
    'options'=>array(
        'showAnim'=>'fold',
        'dateFormat'=>'yy-mm-dd',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
        //'value'=>Yii::app()->dateFormatter->format("dd.MM.yyyy", $model->filterDate),
    ),
), true);
                
//$this->widget('yiiwheels.widgets.grid.WhGridView', array(
$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'chat-grid',
    'type' => array(TbHtml::GRID_TYPE_CONDENSED, TbHtml::GRID_TYPE_BORDERED, TbHtml::GRID_TYPE_STRIPED),
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'afterAjaxUpdate' => 'reinstallDatePicker',
	'columns'=>array(
		//'id',
        array(
            'name' => 'created',
            'type'=>'date',
            //'type' => 'raw',
            //'value' => 'DataHelper::formattedDate($data->created)',
            'filter' => $dateFilter, //CHtml::listData(ActivcationTypes::model()->findAll(), 'id', 'name'),
            //'headerHtmlOptions'=>array('width'=>'70px'),
            'htmlOptions'=>array(
                //'nowrap'=>'nowrap',
                'width'=>'70px',
            ),
            'filterInputOptions'=>array('style'=>'width: 70px'),
        ),
        array(
            'name' => 'text',
        ),
        array(
            'name' => 'post_identity',
            'headerHtmlOptions'=>array(
                'width'=>'50px',
            ),
            'htmlOptions'=>array(
                'nowrap'=>'nowrap',
                'width'=>'50px',
            ),
        ),
        array(
            'name' => 'owner',
            'type' => 'raw',
            'htmlOptions'=>array(
                'nowrap'=>'nowrap', 
                'width'=>'150px',
            ),
        ),
        array(
            'name' => 'is_alert',
            'value' => '$data->is_alert ? BaseModule::t("dic", "Yes") : ""',
            'htmlOptions'=>array(
                'nowrap'=>'nowrap', 
                'width'=>'40px',
            ),
        ), 
        array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array(
                'nowrap'=>'nowrap', 
                'width'=>'50px',
            ),
            'template'=>'{update}{delete}',
		),
	),
)); 

    Yii::app()->clientScript->registerScript('re-install-date-picker', "
        function reinstallDatePicker(id, data) {
            $('#Chatmessage_filterDate').datepicker($.datepicker.regional['ru']);
        }
    "); 
    
?>
