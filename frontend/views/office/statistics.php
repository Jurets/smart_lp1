<div id="content">
    
               <a href="#"><input type="button" name="btn"  class="office-1-btn-style-green" value="ВЫВЕСТИ СРЕДСТВА" /></a>
             
             
              <p class="office-1-text-1">ДОХОД</p>
              <p class="office-1-text-2">БЛАГОТВОРИТЕЛЬНОСТЬ</p>
              <p class="office-1-text-3">СТРУКТУРА</p>
              <p class="office-1-text-4">ПОСЕЩЕНИЯ</p>
        
        
       <div id="table1">
        
<table class="tg1"  >
  <tr>
    <th  class="tg-st61" rowspan="7"><br><br>Чеки за сегодня:</th>
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
                  'dateFormat'=>'dd.mm.y'  
                ),
                'htmlOptions'=>array(
                    'style'=>'height:25px;width: 86px;margin-top:-6px;font-size:22px !important; font-weight:bold !important; color:#656565; border:none;'
                ),
                ));
             echo TbHtml::endForm();
            ?>
        </div>
         <img src="/images/calc.png" style="position: absolute; top: 11px;left: 366px;">
        </a>
    </th>
    <th class="tg-oyj1" colspan="2"><a href="#" id="showAllRec">Показать все</a></th>
  </tr>
  <tr>
      <td colspan="3">
          <div class="scroll_window">
          <table height="160" class="tg22" id="tg22">
              <tr>
                  <td width="234">1</td>
                  <td width="308">2</td>
                  <td width="293">3</td>
              </tr>
              <tr>
                  <td width="234">1</td>
                  <td width="308">2</td>
                  <td width="293">3</td>
              </tr>
              <tr>
                  <td width="234">1</td>
                  <td width="308">2</td>
                  <td width="293">3</td>
              </tr>
              <tr>
                  <td width="234">1</td>
                  <td width="308">2</td>
                  <td width="293">3</td>
              </tr>
              <tr>
                  <td width="">1</td>
                  <td width="">2</td>
                  <td width="">3</td>
              </tr>
              <tr>
                  <td width="">1</td>
                  <td width="">2</td>
                  <td width="">3</td>
              </tr>
              <tr>
                  <td width="">1</td>
                  <td width="">2</td>
                  <td width="">3</td>
              </tr>
              <tr>
                  <td width="">1</td>
                  <td width="">2</td>
                  <td width="">3</td>
              </tr>

          </table>
          </div>
      </td>
  </tr>
<!--  <tr>
    <td class="tg-k776">24.02.14 18:57</td>
    <td class="tg-amld">+50$</td>
    <td class="tg-f6s0">Новый чужой в команде</td>
  </tr>
  <tr>
    <td class="tg-s6l6">24.02.14 18:57</td>
    <td class="tg-2n7d">+50$</td>
    <td class="tg-84pk">Новый личный в команде</td>
  </tr>
  <tr >
    <td class="tg-k776">24.02.14 18:57</td>
    <td class="tg-amld">+50$</td>
    <td class="tg-f6s0">Новый чужой в команде</td>
  </tr>
  -->
  <tr class="last-rows">
    <td class="tg-auz7" colspan="3"><p>Всего за сегодня: <span>200 $</span></p></td>
  </tr>
  <tr class="last-rows">
    <td class="tg-auz7" colspan="3"><p id='last-value'>Всего получен доход: <span id="green">9450 $</span></p></td>
  </tr>
</table>
        </div>
        
      <table id="tg2">
    <tr>
    <td class="tg-ll1" colspan="3">Сегодня: <span>&nbsp;&nbsp;14 $</span></td>
      </tr>
      <tr>
    <td class="tg-ll2" colspan="3">В этом месяце: <span>245 $</span></td>
      </tr>
        <tr>
    <td class="tg-ll3" colspan="3">Всего передано: <span id="green">962 $</span></td>
      </tr>
    </table>  
        
        
        
        <table id="tg3">
    <tr>
    <td class="tg-ll1" colspan="3">Личная команда сегодня: <span>&nbsp;&nbsp;14 $</span></td>
      </tr>
      <tr>
    <td class="tg-ll2" colspan="3">БизнесКлуб сегодня: <span>245 $</span></td>
      </tr>
     
    </table> 
    
    <table id="tg4">
    <tr>
    <td class="tg-ll1" colspan="3">Сегодня:<span>&nbsp;&nbsp;+85</span></td>
    </tr>
    <tr>
    <td class="tg-ll2" colspan="3">Вчера: <span>&nbsp;&nbsp;&nbsp;&nbsp;77</span></td>
     </tr>
     <tr>
    <td class="tg-ll3" colspan="3">Месяц: <span>2214</span></td>
     </tr>
    <tr>
    <td class="tg-ll4" colspan="3">Всего: <span  style="color: #12be25;" >8840</span></td>
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
}
.nostrip td{
     background-color: #F0F0F0;
     color: #007E97;
}
 </style>
 
 <script type="text/javascript">
   $(function(){
       $('#showAllRec').click(function(){
           $('.scroll_window').toggleClass('scrolle');
           if ($('.scroll_window').hasClass('scrolle')){
               $('#showAllRec').text('Показать 4');
           }else{
               $('#showAllRec').text('Показать все');
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