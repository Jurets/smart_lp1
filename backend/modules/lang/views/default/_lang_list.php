<?php if(!empty($model->languages)) { ?>
<select id="select_lang" onchange="changeLang()">
            <option name="lang" value="en">english</option>
        <?php foreach($model->languages as $lang) { ?>
            <option name="lang" value="<?php echo $lang['lang']?>"><?php echo Yii::t('',$lang['name'])?></option>
        <?php } ?>
</select>
        <input type="button" id="lang_delete" style="margin-bottom:10px;" value="<?php echo Yii::t('rec', 'Delete')?>" onclick="deleteLang()">
        <?php }else{ ?>
        <!--<div><?php //echo Yii::t('rec','Missing Languages') ?></div>-->
        <select id="select_lang" onchange="changeLang()">
            <option name="lang" value="en">english</option>
        </select>
        <?php } ?>