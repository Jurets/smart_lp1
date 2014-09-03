<?php 
if(!empty($model->languages)) {
//    if(isset($_COOKIE['language'])){
//        $langsamm =  Yii::app()->language = (string)Yii::app()->request->cookies['language'];
//    }else{
//        $langsamm = 'ru';
//    }
    $langsamm = Yii::app()->language;
    ?>
<select id="select_lang" onchange="changeLang()">
            
        <?php foreach($model->languages as $lang) { var_dump($lang['lang']) ?>
            <option <?php echo ($lang['lang']==$langsamm) ?'selected' : ''?> name="lang" value="<?php echo $lang['lang']?>"><?php echo BaseModule::t('rec',$lang['name'])?></option>
        <?php } ?>
</select>
        <input type="button" id="lang_delete" style="margin-bottom:10px;" value="<?php echo BaseModule::t('rec', 'Delete')?>" onclick="deleteLang()">
        <?php }else{ ?>
        <!--<div><?php //echo BaseModule::t('rec','Missing Languages') ?></div>-->
        <select id="select_lang" onchange="changeLang()">
            
        </select>
        <?php } ?>