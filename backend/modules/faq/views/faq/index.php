<?php
/* @var $this FaqController */
/* @var $model Faq */

$this->breadcrumbs = array(
    'FAQ' => array('index'),
    Yii::t('common', 'Manage'),
);

$this->menu = array(
    array('label' => Yii::t('common', 'List FAQ'), 'url' => array('admin')),
    array('label' => Yii::t('common', 'Create FAQ'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#faq-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});


");
?>

<h1><?php echo Yii::t('common', 'Manage FAQ') ?></h1>





<p>
    <?php
    echo Yii::t(
            'common', 'You may optionally enter a comparison operator ({signs}) at the beginning of each of your search values to specify how the comparison should be done', array(
        '{signs}' => '<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>')
    );
    ?>.
</p>




<div class="search-form">
<?php
$this->renderPartial('_search', array(
    'model' => $model,
));
?>
</div><!-- search-form -->

<?php
$dateFilter = $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
    'name' => 'Faq[created]',
    'value' => $model->created,
    'pluginOptions' => array(
        'format' => 'yyyy-mm-dd',
    ),
    'htmlOptions' => array(
        'id' => 'created',
    ),
        ), true);
//$this->widget('zii.widgets.grid.CGridView', array(
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'faq-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'id',
            'filter' => TbHtml::activeTextField($model, 'id', array('style' => 'width: 40px')),
            'htmlOptions' => array('style' => 'width: 40px'),
        ),
        array(
            'name' => 'question',
            'filter' => TbHtml::activeTextField($model, 'question', array('style' => 'width: 200px')),
            'htmlOptions' => array('style' => 'width: 200px'),
        ),
        array(
            'name' => 'answer',
            'filter' => TbHtml::activeTelField($model, 'answer', array('style' => 'width: 200px')),
            'htmlOptions' => array('style' => 'width: 200px'),
        ),
        array(
            'name' => 'created',
            'filter' => $dateFilter,
//            'filterInputOptions' => array('style' => 'width: 150px'),
            'value' => '$data->created',
//            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
        array(
            'name' => 'category',
            'type' => 'raw',
            'filter' => array('finance' => 'финансы', 'offer' => 'предложения', 'site' => 'работа сайта'),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}{ban}',
            'buttons' => array
                (
                'ban' => array
                    (
                    'label' => 'Ban',
                    'icon' => 'lock',
                    'url' => 'Yii::app()->createUrl("users/ban", array("id"=>$data->id))',
                    'options' => array('class' => 'ICON_LOCK'),
                ),
            ),
        ),
    ),
));
?>
