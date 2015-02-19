<div id="infoBlok<?php echo $features['cssID']; ?>">
    <p class="reg<?php echo $features['cssID']; ?>"><?php echo $features['head']; ?></p>
    <div id="numberDecor<?php echo $features['cssID']; ?>"><p><?php echo $dataPull['numberField']; ?></p> <div id="test<?php echo $features['cssID']; ?>"></div></div>
    <p class="regB"><?php echo BaseModule::t('rec', 'CURRENT') . ' ' ?><?php echo $operation; ?></p>
    <ul class="li">
        <?php  foreach ($dataPull['userList'] as $user) { ?>
            <li style="position:relative;width: 280px;"> 
                <?php 
                    echo $user['content'] ;
                    if (!empty($user['country'])) { ?>
                        <img src="/images/flags/small/<?php echo $user['country'] ?>.png" style="position: absolute; right: 0; margin-top: 6px;">                       
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
</div>