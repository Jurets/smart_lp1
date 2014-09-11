<?php
foreach($model->translateList as $index => $elem){
    echo '<input type="hidden" name="language[id][]" value="'.$elem['id'].'">';
if(isset(Yii::app()->params['email_verify_code_enabled']) && Yii::app()->params['email_verify_code_enabled'] == FALSE ){
echo '<div style="color:navy;">'.$elem['message'].'</div>';}
    //echo '<div>'./*$elem['message']*/$elem['translation'].'</div>';
    if(isset($model->russian[$index])){
    echo '<div>'.$model->russian[$index].'</div>';
    }
    echo '<input type="text" name="language[translation][]" value="'.$elem['translation'].'" style="width:880px;"><br>';
}