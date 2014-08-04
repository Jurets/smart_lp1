<h1><?php echo CommonstatModule::t('General statistics')?></h1>
<div class="commonstat">
    <div id="1"><?php echo CommonstatModule::t('Participants')?>
        <ul type="none">
            <li><span><?php echo CommonstatModule::t('Total')?>:</span><span class="toright">0</span></li>
            <li><span><?php echo CommonstatModule::t('Today')?>:</span><span class="toright">0</span></li>
            <li><span><?php echo CommonstatModule::t('Entered')?>:</span><span class="toright">0</span></li>
            <li><span><?php echo CommonstatModule::t('Business Club')?>:</span><span class="toright">0</span></li>
        </ul>
    </div>
    <div id="2"><?php echo CommonstatModule::t('Money Turnover')?>
        <ul type="none">
            <li><span><?php echo CommonstatModule::t('Activations total')?>:</span><span class="toright">0</span></li>
            <li><span><?php echo CommonstatModule::t('Activations today')?>:</span><span class="toright">0</span></li>
            <li><span><?php echo CommonstatModule::t('Capital total')?>:</span><span class="toright">0</span></li>
            <li><span><?php echo CommonstatModule::t('Capital today')?>:</span><span class="toright">0</span></li>
        </ul>
    </div>
    <div id="3"><?php echo CommonstatModule::t('Charity')?>
        <ul type="none">
            <li><span><?php echo CommonstatModule::t('Today')?>:</span><span class="toright">0</span></li>
            <li><span><?php echo CommonstatModule::t('Total transferred')?>:</span><span class="toright">0</span></li>
        </ul>
    </div>
    <div id="4" style="border-bottom: 1px solid #777777;"><?php echo CommonstatModule::t('Visits')?>
        <ul type="none">
            <li><span><?php echo CommonstatModule::t('Today')?>:</span><span class="toright">0</span></li>
            <li><span><?php echo CommonstatModule::t('Yesterday')?>:</span><span class="toright">0</span></li>
            <li><span><?php echo CommonstatModule::t('Month') ?>:</span><span class="toright">0</span></li>
            <li><span><?php echo CommonstatModule::t('Total')?>:</span><span class="toright">0</span></li>
        </ul>
    </div>
</div>

<div id="graph"></div>

<style type="text/css">
    .commonstat {
        width: 600px;
        padding: 10px 20px 10px 20px;
    }
    .commonstat div {
        border-top: 1px solid #777777;
        font-size: 15px;
        font-weight: bold;
        padding: 10px 0px 10px 0px;
        color: #777777;
    }
    .commonstat div ul  {
        /*border: 1px solid red;*/
        font-weight: normal;
        width: 200px;
    }
    .commonstat div ul li {
        border-bottom: 1px dotted #777777;
        padding-left: 10px;
    }
    .toright{
        float: right;
        padding-right: 10px;
    }
    .commonstat div:hover  {
        color: #FFFFFF;
        background: #777777;
    }
    .stat_choise{
        background: #00bbd9;
    }
</style>

<script>
    function St_choise(){
        var itemSelector = $(this).attr('id');
        $.ajax({
          type: "POST",
             url: "<?php echo $this->createAbsoluteUrl('/commonstat/default/graph')?>",
             dataType: 'html',
             data: {'graph_choise':itemSelector},
             success: function(resource){
                 $('#graph').html(resource);
             },
        });
        console.log(itemSelector);
    }
    $(function(){
        $('.commonstat div').click(St_choise);
    });
    
</script>