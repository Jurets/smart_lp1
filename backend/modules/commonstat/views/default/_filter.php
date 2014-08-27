<div class="intervalls">
    <span><?php echo htmlspecialchars_decode(Yii::t('rec','from'))?></span>
                <span style="margin-left:130px;">&nbsp;</span>
                <span><?php echo htmlspecialchars_decode(Yii::t('rec','step'))?></span>
                <span style="margin-left:110px;">&nbsp;</span>
                <span><?php echo htmlspecialchars_decode(Yii::t('rec','to'))?></span>
                <form>
                <?php
               $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'id' => 'time-picker-begin-'. (isset($timePickerId) ? $timePickerId : ''),
                    'name' => 'begin',
                    'value' => $model->features['timeBegin'],
                    'options' => array(
                        'dateFormat'=>'dd.mm.yy',
                    ),
                    ));
                ?>
                    <select name="step">
                        <option value="day_step"><?php echo Yii::t('rec','day')?></option>
                        <option value="month_step"><?php echo Yii::t('rec','month')?></option>
                        <option value="hour_step"><?php echo Yii::t('rec','hour')?></option>
                    </select>
                <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                   'id' => 'time-picker-end-'. (isset($timePickerId) ? $timePickerId : ''),
                   'name' => 'end',
                   'value' => $model->features['timeEnd'],
                   'options' => array(
                   'dateFormat'=>'dd.mm.yy',
                    ),
                    ));
                ?>
                    <input name="send" type="button" value="<?php echo Yii::t('rec','send')?>" style="width:80px;margin-bottom:10px;">
                </form>
            </div>