<style>
    .pagination {
        margin-top: 200px;
        color: #007e97 !important;
    }
    .nextm a {
        color: #007e97 !important;
        border: 0 none !important;
        font-size: 18px;
    }
    .prevm a {
        color: #007e97 !important;
        border: 0 none !important;
        font-size: 18px;
    }
    
    .internalm a{
        color: #007e97 !important;
        font-size: 18px;
    }
    ul.yiiPager .selected a {
        background: none repeat scroll 0 0 #007e97;
        color: #FFFFFF;
        font-weight: bold;
        
    }
   
    ul.yiiPager .page a {
    font-weight: bold;
    font-size: 18px;
}
/*.attended {*/
    /*background: #f4dce3;*/
/*}*/
    
</style>


<div id="office3-content">
<div>

<?php foreach ($models as $ind=>$model) { ?>
    <a href="/office/news/<?php echo $model->id . $page?>">
   <div id="office-3-post<?php echo $ind + 1; ?>" class='<?=$model->attended?>'>
       
   <?php echo TbHtml::tag('div', array('style'=>'background-image: url('.UrlHelper::getImageUrl('resized-'.$model->image), 'id'=>'blogImg'.($ind+1)), '&nbsp;'); ?>
       <h4 class="office-3-miniZagolovok"><?php echo Yii::app()->dateFormatter->formatDateTime($model->created, 'medium', null) .', '. Yii::app()->dateFormatter->formatDayInWeek('EEEE', array('wday'=>date('N', strtotime($model->created))));?></h4>
    <a href="/office/news/<?php echo $model->id . $page?>" class="office-3-zagolovok"><span style="text-transform:uppercase;"><?php echo $model->title ?></span></a>
       <p class="office-3-text">
           <?php echo $model->getPrew(); ?>
       </p>         
        <hr width="421" size="1"  color="#838181" />
   </div>
</a>
<?php } ?>
    
</div>
    

 <?php
 if(isset($pages)){
     ?><div class="pagination"><?php
   $obj =  $this->widget('CLinkPager', array(
    'pages' => $pages,
    'nextPageCssClass' => 'nextm',
    'previousPageCssClass' => 'prevm',
    'prevPageLabel' => '<',
    'nextPageLabel'=>'>'
    ));
 }
 ?>
</div>
</div>
