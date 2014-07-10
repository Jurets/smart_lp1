<?php foreach ($onlineusers as $item) { ?>
    <div id="onlineuser_<?php echo $item['userid'] ?>" class="buddy" data="<?php echo $item['userid'] ?>">
        <div class="flag">
            <?php if (!empty($item['country_code'])) { ?>
                <img src="/images/flags/small/<?php echo $item['country_code'] ?>.png">
            <?php } ?>
        </div>
        <div class="username"><?= $item['username'] ?></div>
        <div class="clearfix"></div>
    </div>

<?php } ?>
