<div class="Table">
<div>
    <div class="langblock">
        <?php $this->renderPartial('_lang_list', array('model'=>$model))?>
    </div>
    <div class="createLanguage">
        <?php echo $locale_list ?>
        <input type="text" name="name" value="<?php echo Yii::t('rec', 'Language name')?>" onfocus="this.value=''">
        <input id="lang_create" style="margin-bottom:10px;" type="button" value="<?php echo Yii::t('rec', 'Create')?>"
    </div>
</div>
    <form id="mainform">
        <div class="translationBar">
           <?php $this->renderPartial('_form_partial', array('model'=>$model))?>       
        </div>
        <input id="lang" type="hidden" value="" name='lang'>
        <input id="save_1100" type="button" value="<?php echo Yii::t('rec', 'Create')?>">
    </form>
</div>
</div>
<style>
    .Table{
        padding: 5px;
        width: 940px;
        height: 1000px;
        /*border: 1px #003399 solid;*/
    }
    .langblock {
        width: 300px;
        height: 70px;
        /*border: 1px #003399 solid;*/
        margin: 5px;
        margin-top: 0px;
        float: left;
    }
    .createLanguage{
        width: 600px;
        height: 70px;
        /*border: 1px #003399 solid;*/
        margin-left: 320px;
        margin-top: 5px;
    }
    .translationBar{
        margin: 5px;
        margin-top: 60px;
       /* border: 1px #003399 solid;*/
        width: 920px;
        height: 800px;
        overflow: auto;
    }
</style>
<script>
    function changeLang(){
        var thisLang = $('#select_lang option:selected');
        if(thisLang.val() === '-') return 0;
        $.ajax({
            type: "POST",
            url: "<?php echo $this->createAbsoluteUrl('/lang/default/showTranslation')?>",
            dataType: "html",
            data: {'lang':thisLang.val()},
            success: function(resource){
                $('.translationBar').html(resource);
            }
        });
    }
    function deleteLang(){
            var thisLang = $('#select_lang option:selected');
            $.ajax({
                type: "POST",
                url: "<?php echo $this->createAbsoluteUrl('/lang/default/deleteLanguage')?>",
                dataType: "html",
                data: {'langName':thisLang.html(), 'lang':thisLang.val()},
                success: function(resource){
                    $('.langblock').html(resource);
                    $('.translationBar').html('&nbsp;');
                }
            });
        }
    
    $(function(){
        $('#lang_create').click(function(){
            var langSign = $(this).parent().find('option[name=lang]').filter(':selected');
            var langName = $(this).parent().find('input[name=name]');
            $.ajax({
             type: "POST",
             url: "<?php echo $this->createAbsoluteUrl('/lang/default/addLanguage')?>",
             dataType: 'html',
             data: {'lang':langSign.val(), 'name':langName.val()},
             success: function(resource){
                 $('.langblock').html(resource);
                 langName.val('<?php echo Yii::t('rec', 'Language name')?>');
             }
        });
        });
        
        $('#save_1100').click(function(){
            var lang = $('#select_lang option:selected').val();
            if(lang === '-'){return 0;}
            $('#lang').val(lang);
            $.ajax({
             type: "POST",
             url: "<?php echo $this->createAbsoluteUrl('/lang/default/createTranslation')?>",
             dataType: 'html',
             data: $('#mainform').serialize(),
             success: function(resource){
                 alert(resource);
             }
            });
        });
        
    });
</script>