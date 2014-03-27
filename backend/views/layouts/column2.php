<?php
 /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
        //'Back' => '/',
        'Data',
    ),
)); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
	
	echo Yii::getPathOfAlias('zii');
	
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('bootstrap.widgets.TbNav', array(
		//$this->widget('bootstrap.widgets.TbListView', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>