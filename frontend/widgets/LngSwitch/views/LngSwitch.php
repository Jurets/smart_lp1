<div class="lngflags">
    <ul>
        <li id="<?php echo Yii::app()->language?>"><?php echo '<img src="/images/flags/small/'.strtoupper(Yii::app()->language).'.png'.'">'?></li>
        <?php foreach($flags as $flag){
        if($flag == Yii::app()->language) continue;
        ?>
        <li class="anything_flags" id="<?php echo $flag?>"><?php echo '<img class="savehide" src="/images/flags/small/'.strtoupper($flag).'.png'.'">'?></li>
        <?php } ?>
    </ul>
    <div><img id="flag_switch" src="/images/flag_switch.png"></div>
    <div class="clearBoth"> </div>
</div>

<style>
    .lngflags {
        position: absolute;
        z-index: 200;
        top: 8px;
        left: 0px;
    }
    .lngflags ul {
        float: left;
        background: #1c1c1c;
    }
    .lngflags ul li :hover {
        cursor: pointer;
    }
    .clearBoth{
        clear: both;
    }
    #topLine{
       position: relative; 
    }
    .lngflags div {
        float: right;
    }
    .lngflags div :hover {
        cursor: pointer;
    }
    .savehide{
        display: none;
    }
</style>

<script type="text/javascript">
    $(function(){
       $('#flag_switch').click(function(){
           $('.anything_flags img').toggleClass('savehide');
       });
       $('.lngflags ul li').click(function(){
           document.cookie = "language="+this.id+';path=/';
           location.reload();
       });
    });
</script>

