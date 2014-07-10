
<div id="infoBlok<?php echo $features['cssID'];?>">
        <p class="reg<?php echo $features['cssID'];?>"><?php echo $features['head'];?></p>
        <div id="numberDecor<?php echo $features['cssID'];?>"><p><?php echo $dataPull['numberField'];?></p> <div id="test<?php echo $features['cssID'];?>"></div></div>
        <p class="regB">ТЕКУЩИЕ <?php echo $operation; ?></p>
        <ul class="li">
            <?php
            foreach ($dataPull['userList'] as $user) {
                echo TbHtml::tag('li',array(
                    'id'=>$user['country'],
                    ), $user['content'],
                            'li');
            }
            ?>
        </ul>
</div>



