<? foreach($onlineusers as $item) { ?>
    <div id="onlineuser_<?=$item['userid']?>" class="buddy">
        <div class="flag">
            <? if (!empty($item['country_code'])) { ?>
                <img src="/images/flags/small/<?=$item['country_code']?>.png">
            <? } ?>
        </div>
        <div class="username"><?=$item['username']?></div>
        <div class="clearfix"></div>
    </div>
<? } ?>