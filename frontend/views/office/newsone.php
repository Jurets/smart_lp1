<div id="office3-content">
<a href="office-3.html"><input type="button" name="btn"  class="btn-style-green" value="НАЗАД" /></a>
         
        <div id="office-3-1post1">
            <?php echo TbHtml::tag('div', array('style'=>'background-image: url(/admin/uploads/'.'origin-'.$model->image, 'id'=>'blogImg1'), '&nbsp;'); ?>
            <h4 class="office-3-miniZagolovok"><?php echo Yii::app()->dateFormatter->formatDateTime($model->created, 'medium', null) .', '. Yii::app()->dateFormatter->formatDayInWeek('EEEE', array('wday'=>date('N', strtotime($model->created))));?></h4>
            <p class="office-3-zagolovok"><span style="text-transform:uppercase;"><?php echo $model->title ?></span></p>
            <p class="office-3-text">
                <?php echo $model->content ?>
            </p>   
      </div>
</div>
