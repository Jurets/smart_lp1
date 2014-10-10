<?php foreach ($onlineusers as $item) { ?>
    <div id="onlineuser_<?php
    if (isset($item['id']) && empty($item['id']) === false) {
        echo (int) $item['id'];
    }
    ?>" class="buddy buddy-bold <?php
         if (isset($_GET['interlocutor'])) {
             $interlocutor = $_GET['interlocutor'];
         }
         if (isset($interlocutor) && $interlocutor == $item['id']) {
             echo "buddy-highlighted";
         }
         ?>" data="<?php
         if (isset($item['id']) && empty($item['id']) === false) {
             echo (int) $item['id'];
         }
         ?>">
        <div class="flag">
            <?php if (!empty($item['country_code'])) { ?>
                <img src="/images/flags/small/<?php echo $item['country_code'] ?>.png">
            <?php } ?>
        </div>
        <div class="username">
            <a href="<?php
            if(Yii::app()->user->id !== $item['id']){
               echo Yii::app()->createAbsoluteUrl('office/chat/', array(
                'interlocutor' => $item['id']
            ));
            }else{
                echo "#";
            }
            
            ?> "style='width:150px;height:25px;display: block;'><?php 
            $_username = $item['username'];
            $start = 17;
            if($_username === null || empty($_username) || $_username = ' '){
                $_username = $item['erzats'];
            }
            if(mb_strlen($_username) > $start){
               $_username = mb_substr($_username, 0, $start, 'UTF-8');
            }
            
            echo $_username;
            
                    ?></a>

        </div>
        <div class="info-image"> 
            <img src="/images/info.gif" width="20px" height="20px">
        </div>
        <div class="clearfix"></div>
    </div>

<?php } ?>
