<?php
 /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array('links' => $this->breadcrumbs)); ?>

<div class="span-19">
	<div id="content" style="width: 1420px;">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php if (isset($this->menu) && !empty($this->menu)) { ?>
<div class="span-5 well" style="float: right; width: 200px; max-width: 200px; margin-top: 40px;">
	<div id="sidebar">
	<?php	
		if (isset($this->menu)) {
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>BaseModule::t('rec','Operations'),
            ));
            $this->widget('bootstrap.widgets.TbNav', array(
		    //$this->widget('bootstrap.widgets.TbListView', array(
			    'items'=>$this->menu,
			    'htmlOptions'=>array('class'=>'operations'),
		    ));
            $this->endWidget();
        }
	?>
	</div><!-- sidebar -->
</div>
<?php } ?>
<?php $this->endContent(); ?>
