
<div id="office3-content">

<?php foreach ($models as $ind=>$model) { ?>
    <a href="/office/news<?php echo $model->id?>">
   <div id="office-3-post<?php echo $ind + 1; ?>" >
       
   <?php echo TbHtml::tag('div', array('style'=>'background-image: url(/admin/uploads/'.'resized-'.$model->image, 'id'=>'blogImg'.($ind+1)), '&nbsp;'); ?>
       <h4 class="office-3-miniZagolovok"><?php echo Yii::app()->dateFormatter->formatDateTime($model->created, 'medium', null) .', '. Yii::app()->dateFormatter->formatDayInWeek('EEEE', array('wday'=>date('N', strtotime($model->created))));?></h4>
    <a href="/office/news/<?php echo $model->id?>" class="office-3-zagolovok"><span style="text-transform:uppercase;"><?php echo $model->title ?></span></a>
       <p class="office-3-text">
           <?php echo $model->getPrew(); ?>
       </p>         
        <hr  width="421" size="1"  color="#838181" />
   </div>
</a>
<?php } ?>
    
    <?php 
//    $this->widget('CLinkPager', array(
//    'pages' => $pages,
//    )) 
    ?>
    
</div>


 <?php 
   $obj =  $this->widget('CLinkPager', array(
    'pages' => $pages,
    
    ))
 ?>