<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/commonstat.css'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/commonstat.js'); ?>

<h1><?php echo CommonstatModule::t('General statistics')?></h1>
<div class="commonstat">
    <div class="greedElem" id="Participiants">
        <div class="dataTbl">
        <?php echo CommonstatModule::t('Participants')?>
        <ul type="none">
            <li id="p1"><span><?php echo CommonstatModule::t('Total')?>:</span><span class="toright"><?php echo $model->CommonStatistic['p1']?></span></li>
            <li id="p2"><span><?php echo CommonstatModule::t('Today')?>:</span><span class="toright"><?php echo $model->CommonStatistic['p2']?></span></li>
            <li id="p3"><span><?php echo CommonstatModule::t('Entered')?>:</span><span class="toright"><?php echo $model->CommonStatistic['p3']?></span></li>
            <li id="p4"><span><?php echo CommonstatModule::t('Business Club')?>:</span><span class="toright"><?php echo $model->CommonStatistic['p4']?></span></li>
        </ul>
        </div>
        <div class="dataGraph">
            <span class="graph"> </span>
            <?php $this->renderPartial('_filter', array('timePickerId' => 1, 'model'=>$model)) ?>
        </div>
    </div>
    <div class="greedElem" id="MoneyTurnover">
        <div class="dataTbl">
        <?php echo CommonstatModule::t('Money Turnover')?>
        <ul type="none">
            <li id="mt1"><span><?php echo CommonstatModule::t('Activations total')?>:</span><span class="toright">0</span></li>
            <li id="mt2"><span><?php echo CommonstatModule::t('Activations today')?>:</span><span class="toright">0</span></li>
            <li id="mt3"><span><?php echo CommonstatModule::t('Capital total')?>:</span><span class="toright">0</span></li>
            <li id="mt4"><span><?php echo CommonstatModule::t('Capital today')?>:</span><span class="toright">0</span></li>
        </ul>
        </div>
        <div class="dataGraph">
            <span class="graph"> </span>
            <?php $this->renderPartial('_filter', array('timePickerId' => 2, 'model'=>$model)) ?>
        </div>
    </div>
    <div class="greedElem" id="Charity">
        <div class="dataTbl">
        <?php echo CommonstatModule::t('Charity')?>
        <ul type="none">
            <li id="ch1"><span><?php echo CommonstatModule::t('Today')?>:</span><span class="toright">0</span></li>
            <li id="ch2"><span><?php echo CommonstatModule::t('Total transferred')?>:</span><span class="toright">0</span></li>
        </ul>
        </div>
        <div class="dataGraph">
            <span class="graph"> </span>
            <?php $this->renderPartial('_filter', array('timePickerId' => 3, 'model'=>$model)) ?>
        </div>
    </div>
    <div style="border-bottom: 1px solid #777777;" class="greedElem" id="Visits">
        <div class="dataTbl">
        <?php echo CommonstatModule::t('Visits')?>
        <ul type="none">
            <li id="v1"><span><?php echo CommonstatModule::t('Today')?>:</span><span class="toright">0</span></li>
            <li id="v2"><span><?php echo CommonstatModule::t('Yesterday')?>:</span><span class="toright">0</span></li>
            <li id="v3"><span><?php echo CommonstatModule::t('Month') ?>:</span><span class="toright">0</span></li>
            <li id="v4"><span><?php echo CommonstatModule::t('Total')?>:</span><span class="toright">0</span></li>
        </ul>
        </div>
        <div class="dataGraph">
            <span class="graph"> </span>
            <?php $this->renderPartial('_filter', array('timePickerId' => 4, 'model'=>$model)) ?>
        </div>
    </div>
</div>

<div id="graph"></div>

<style type="text/css">
   .intervalls form input,select{
        width:150px;
    }
</style>
<script>    
    function createGraphics(data, renderingTarget){
        $.ajax({
          type: "POST",
             url: "<?php echo $this->createAbsoluteUrl('/commonstat/default/graph')?>",
             dataType: 'html',
             data: data,
             success: function(resource){
                 renderingTarget.html(resource);
             }
        });
    }
</script>