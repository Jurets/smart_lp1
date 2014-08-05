<h1><?php echo CommonstatModule::t('General statistics')?></h1>
<div class="commonstat">
    <div class="greedElem" id="Participiants">
        <div class="dataTbl">
        <?php echo CommonstatModule::t('Participants')?>
        <ul type="none">
            <li id="p1"><span><?php echo CommonstatModule::t('Total')?>:</span><span class="toright">0</span></li>
            <li id="p2"><span><?php echo CommonstatModule::t('Today')?>:</span><span class="toright">0</span></li>
            <li id="p3"><span><?php echo CommonstatModule::t('Entered')?>:</span><span class="toright">0</span></li>
            <li id="p4"><span><?php echo CommonstatModule::t('Business Club')?>:</span><span class="toright">0</span></li>
        </ul>
        </div>
        <div class="dataGraph">&nbsp;</div>
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
        <div class="dataGraph">&nbsp;</div>
    </div>
    <div class="greedElem" id="Charity">
        <div class="dataTbl">
        <?php echo CommonstatModule::t('Charity')?>
        <ul type="none">
            <li id="ch1"><span><?php echo CommonstatModule::t('Today')?>:</span><span class="toright">0</span></li>
            <li id="ch2"><span><?php echo CommonstatModule::t('Total transferred')?>:</span><span class="toright">0</span></li>
        </ul>
        </div>
        <div class="dataGraph">&nbsp;</div>
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
            <span class="graph">
            <?php $this->widget('chartjs.widgets.ChLine',array('width' => 600,'height' => 300,'htmlOptions' => array(),'labels' => array("1","2","3","4","5","6"),'datasets' => array(array("fillColor" => "rgba(255,255,255,0)","strokeColor" => "rgba(244,17,17,1)","pointColor" => "rgba(244,17,17,1)","pointStrokeColor" => "#ffffff","data" => array(10, 20, 25, 25, 50, 60)),),'options' => array()));?>
            </span>
            <div class="intervalls">
                <form>
                    <input type="text" value="">
                    <input type="text" value="">
                    <input type="text" value="">
                    <input type="button" value="test" style="width:80px;margin-bottom:10px;">
                </form>
            </div>
        </div>
    </div>
</div>

<div id="graph"></div>

<style type="text/css">
    .commonstat {
        width: 900px;
        padding: 10px 20px 10px 20px;
    }
    .commonstat div {
        border-top: 1px solid #777777;
        font-size: 15px;
        font-weight: bold;
        padding: 10px 0px 10px 0px;
        color: #777777;
        position: relative;
    }
    .increase_H{
        height: 320px;
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
    .commonstat div ul li:hover  {
        color: #FFFFFF;
        background: #777777;
    }
    #v:hover{
        color: #FFFFFF;
        background: #777777;
    }
    .dataTbl{
        border:none !important;
        width:230px;
        float:left;
    }
    .dataGraph{
        border:1px solid #777777;
        float:left;
        width:630px;
        height:370px;
        margin-left:20px;
    }
    .greedElem{
        overflow: hidden;
    }
    .intervalls{
        border: none !important;
        margin-left: 20px;
    }
    .intervalls form input{
        width:150px;
    }
    
</style>

<script>   
    $(function(){
       $('.commonstat div div ul li').click(function(){
           ciel = $(this).parent().parent().parent();
           ciel.find('.graph').html('Renderer');
       })
    });
    
    function commonViewer(){
        
    }
    function createGraphics(data, renderingTarget){
        $.ajax({
          type: "POST",
             url: "<?php echo $this->createAbsoluteUrl('/commonstat/default/graph')?>",
             dataType: 'html',
             data: data,//{'graph_choise':itemSelector},
             success: function(resource){
                 renderingTarget.html(resource);
             }
        });
    }
</script>