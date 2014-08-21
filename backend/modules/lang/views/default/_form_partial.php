<?php
foreach($model->translateList as $elem){
    echo '<input type="hidden" name="language[id][]" value="'.$elem['id'].'">';
    echo '<div>'.$elem['message'].'</div>';
    echo '<input type="text" name="language[translation][]" value="'.$elem['translation'].'" style="width:880px;"><br>';
}