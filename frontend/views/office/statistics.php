<style type="text/css">
#tg2 td span, #tg2 td #green {
    left: 220px;
}

</style>

<div id="content">
    
    <a href="https://perfectmoney.is/login.html" target="_blank"><input type="button" name="btn"  class="office-1-btn-style-green" value="<?php echo BaseModule::t('rec','WITHDROAW FUNDS')?>" /></a>
             
             
              <p class="office-1-text-1"><?php echo BaseModule::t('rec','INCOME')?></p>
              <p class="office-1-text-2"><?php echo BaseModule::t('rec','CHARITY')?></p>
              <p class="office-1-text-3"><?php echo BaseModule::t('rec','STRUCTURE');?></p>
              <p class="office-1-text-4"><?php echo BaseModule::t('rec','VISITS');?></p>
        
        
       <div id="table1">
        
<table class="tg1"  >
  <tr>
      <th  class="tg-st61" rowspan="7"><br><br><?php echo BaseModule::t('rec','checks today').':'?></th>
    <th class="tg-asav">
        <a href="#" id="callCalendar">
        <div id="callCalendar">
            <?php
            echo TbHtml::beginForm(NULL, 'post', array('id'=>'dateChanger'));
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'name'=>'date',
                'id'=>'dateToAct',
                'value'=>$model->date,
                'options'=>array(
                  'dateFormat'=>'dd.mm.yy'  
                ),
                'htmlOptions'=>array(
                    'style'=>'height:25px;width: 100px;margin-top:-6px;font-size:22px !important; font-weight:bold !important; color:#656565; border:none;'
                ),
                ));
             echo TbHtml::endForm();
            ?>
        </div>
         <img src="/images/calc.png" style="position: absolute; top: 11px;left: 366px;">
        </a>
    </th>
    <th class="tg-oyj1" colspan="2"><a href="#" id="showAllRec"><?php echo BaseModule::t('rec','Show all')?></a></th>
  </tr>
  <tr>
      <td colspan="3">
          <div class="scroll_window">
          <table height="160" class="tg22" id="tg22">
              <?php echo $model->statisticsStructure['Checks'] ?>
          </table>
          </div>
      </td>
  </tr>
  <tr class="last-rows">
      <td class="tg-auz7" colspan="3"><p><?php echo BaseModule::t('rec','Total in today').':'?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span><?php echo $model->statisticsStructure['IncomeToday'] ?> $</span></p></td>
  </tr>
  <tr class="last-rows">
    <td class="tg-auz7" colspan="3"><p id='last-value'><?php echo BaseModule::t('rec','Total income received').':'?> &nbsp;&nbsp;&nbsp; <span id="green"><?php echo $model->statisticsStructure['IncomeCommon'] ?> $</span></p></td>
  </tr>
</table>
        </div>
      
      <table id="tg2">
    <tr>
        <td class="tg-ll1" colspan="3"><?php echo BaseModule::t('rec','Today').':'?><span><?php echo $model->statisticsStructure['Charity']['today'] ?> $</span></td>
      </tr>
      <tr>
          <td class="tg-ll2" colspan="3"><?php echo BaseModule::t('rec','In this month').':'?> <span><?php echo $model->statisticsStructure['Charity']['permonth'] ?> $</span></td>
      </tr>
        <tr>
    <td class="tg-ll3" colspan="3"><?php echo BaseModule::t('rec','Total transferred').':'?><span id="green"><?php echo $model->statisticsStructure['Charity']['common'] ?> $</span></td>
      </tr>
    </table>  
        
        
        
        <table id="tg3">
    <tr>
    <td class="tg-ll1" colspan="3"><?php echo BaseModule::t('rec','private team today').':'?> <span style=" margin-left:-10px;"><?php echo $model->statisticsStructure['Staff']['privateStructure'] ?></span></td>
      </tr>
      <tr>
          <td class="tg-ll2" colspan="3"><?php echo BaseModule::t('rec','Business Club today').':'?> <span style=" margin-left:-10px;"><?php echo $model->statisticsStructure['Staff']['businessClub'] ?></span></td>
      </tr>
     
    </table> 
    
    <table id="tg4">
    <tr>
        <td class="tg-ll1" colspan="3"><?php echo BaseModule::t('rec', 'Today').':'?><span style=" margin-left:-90px;"><?php echo $model->statisticsStructure['Visitors']['today'] ?></span></td>
    </tr>
    <tr>
    <td class="tg-ll2" colspan="3"><?php echo BaseModule::t('rec', 'Yesterday').':'?><span style=" margin-left:-90px;"><?php echo $model->statisticsStructure['Visitors']['tomorrow'] ?></span></td>
     </tr>
     <tr>
         <td class="tg-ll3" colspan="3"><?php echo BaseModule::t('rec', 'Month').':'?><span style=" margin-left:-90px;"><?php echo $model->statisticsStructure['Visitors']['permonth'] ?></span></td>
     </tr>
    <tr>
    <td class="tg-ll4" colspan="3"><?php echo BaseModule::t('rec', 'Total').':'?><span style="color: #12be25; margin-left:-90px;" ><?php echo $model->statisticsStructure['Visitors']['common'] ?></span></td>
     </tr>
    </table>   
 </div>  
    <div class="wrap"></div>
    
    
 <style>
    .tg22 td {
      background-color: #F7FDFA;
      border-color: #C1C1C1;
      border-radius: 0px;
      border-style: solid;
      border-width: 1px;
      color: #000000;
      font-size: 18px;
      overflow: hidden;
      text-align: center;
      word-break: normal;
      padding-top: 7px;
}
.scroll_window{
    height: 160px;
    overflow: hidden;
}
.scrolle{
    overflow: auto;    
}
.strip td{
    background-color: #DFDFDF;
	font-weight: bold;
	
}
.nostrip td{
     background-color: #F0F0F0;
     color: #007E97;
	 font-weight: bold;
}
 </style>
 
 <script type="text/javascript">
   $(function(){
       $('#showAllRec').click(function(){
           $('.scroll_window').toggleClass('scrolle');
           if ($('.scroll_window').hasClass('scrolle')){
               $('#showAllRec').text('<?php echo BaseModule::t("rec","Show part")?>');
           }else{
               $('#showAllRec').text('<?php echo BaseModule::t("rec","Show all")?>');
           }
           return false;
       });
       
       $("#tg22 tr:nth-child(odd)").addClass('strip');
       $("#tg22 tr:nth-child(even)").addClass('nostrip');
       
       $('#callCalendar').click(function(){
            $('#dateToAct').datepicker( "show" );
            return false;
       });
       $('#dateToAct').change(function(){
           $("form").submit();
       });
   }); 
 </script>