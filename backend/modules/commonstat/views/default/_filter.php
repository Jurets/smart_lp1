<div class="intervalls">
                <span><?php echo CommonstatModule::t('from')?></span>
                <span style="margin-left:130px;">&nbsp;</span>
                <span><?php echo CommonstatModule::t('step')?></span>
                <span style="margin-left:110px;">&nbsp;</span>
                <span><?php echo CommonstatModule::t('to')?></span>
                <form>
                    <!--<input name="begin" type="text" value="0000-00-00 00:00:00">-->
                <?php
               $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'id' => 'time-picker-begin-'. (isset($timePickerId) ? $timePickerId : ''),
                    'name' => 'begin',
                    'value' => '',
                    'options' => array(
                        'dateFormat'=>'dd.mm.yy',
                    ),
                    ));
                ?>
                    <select name="step">
                        <option value="day_step"><?php echo CommonstatModule::t('day')?></option>
                        <option value="month_step"><?php echo CommonstatModule::t('month')?></option>
                        <option value="hour_step"><?php echo CommonstatModule::t('hour')?></option>
                    </select>
                    <!--<input name="end" type="text" value="0000-00-00 00:00:00">-->
                <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'id' => 'time-picker-end-'. (isset($timePickerId) ? $timePickerId : ''),
                   'name' => 'end',
                   'value' => '',
                   'options' => array(
                   'dateFormat'=>'dd.mm.yy',
                    ),
                    ));
                ?>
                    <input name="send" type="button" value="<?php echo CommonstatModule::t('send')?>" style="width:80px;margin-bottom:10px;">
                </form>
            </div>