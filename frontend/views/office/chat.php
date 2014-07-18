<?php
Yii::app()->clientScript->registerCssFile('/css/chat.css');
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/rangyinputs_jquery.min.js"></script>

<style type="text/css">
    .page {
        height: 840px !important;
    }

    .yiichat {
        overflow: hidden;
        /*height: 540px !important;*/
        top: 10px !important;
    }

    .yiichat .posts {
        height: 450px;
        width: 910px;
        border: none;
        margin-bottom: 3px;
    }

    .yiichat textarea {
        background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
        border: medium none;
        color: #000000;
        font-family: Tahoma,Geneva,sans-serif;
        font-size: 8pt;
        line-height: 13px;
        margin: 10px 0;
        outline: medium none;
        overflow: auto;
        padding: 0 0 0 10px;
        resize: none;
        width: 838px;
        height: 100px;
        float: left;
    }

    .you {
        width: 950px;
        height: 120px;
    }

    .you button {
        background: url("/images/chat-send-button-hover.png") no-repeat scroll 0 center rgba(0, 0, 0, 0);
        cursor: pointer;
        height: 75px;
        left: 1134px;
        opacity: 0;
        transition: all 1s ease 0s;
        width: 91px;        
        margin-left: 1px;
        margin-top: -2px;
        border: medium none;
    }        

    .you button:hover {
        opacity: 1;
        border: medium none;
    }

    .yiichat .posts .post {
        color: #2B2B2B;
        font-family: Tahoma,Geneva,sans-serif;
        font-size: 8pt;
        line-height: 16px;
        margin-bottom: 10px;
        /*width: 896px;        */
        background-color: #0;
        border: none;
    }

    .yiichat .posts .post .track {
        background-color: white;
        width: 120px;
        /*color: #333333;
        float: left;
        margin-right: 10px;
        overflow: auto;
        padding: 3px;*/
    }

    .yiichat .posts .post .track .owner {
        color: #0078CA;
        text-align: right;
        /*float: left;
        width: 145px;*/
    }

    .yiichat-post-myown {
        background-color: white !important;
    }    

    .chat-log-wrapper {
        position: relative;
        width: 940px;
        height: 590px;
        /*margin-left: 277px;
        margin-top: 7px;*/        
    }

    #content.add .text {
        overflow: hidden;
        padding: 0;/*padding: 28px 0 54px;*/
    }

    #chat-smilesbg-block {
        margin-left: 0;
        margin-top: 0;
        right: 0;
        /*left: 555px;
        top: 332px;        */
        left: -286px;
        top: -191px;
    }

    .time {
        text-align: right;
        color: #999999;
    }


    .chat-message {
        width: 894px;
    }    

    .chat-message.alert div.log-message {
        width: 537px;
    }


    .chat-message.alert {
        background: url("/images/chat-alert-bg.png") no-repeat scroll 160px 15px #E3FDFE !important;
        padding: 10px 0;
    }

    .chat-alert-button {
        top: 585px; 
        left: 1175px;
    }

    .chat-alert-button-enabled {
        left: 1131px;
        top: 585px;
    }    

    .chat-log-smile-wrapper > img {
        width: 20px;
        height: 20px;
    }

    #loader {
        width: 910px;
        height: 450px;
        background: url("../images/loader.gif") no-repeat center;
    }

</style>

<div id="chat-content" class="add chat main">

    <div class="chat-wrapper">

        <div id="online-counter"><?= count($onlineusers) ?></div>

        <div class="history-controls">
            показать сообщения:
            <ul class="history-buttons">
                <li id="mode1" value="1" class="mode active">вчера</li>
                <li>|</li>
                <li id="mode2" value="2" class="mode">7 дней</li>
                <li>|</li>
                <li id="mode3" value="3" class="mode">30 дней</li>
                <li>|</li>
                <li id="mode4" value="4" class="mode">3 месяца</li>
                <li>|</li>
                <li id="mode5" value="5" class="mode">6 месяцев</li>
                <li>|</li>
                <li id="mode6" value="6" class="mode">1 год</li>
                <li>|</li>
                <li id="mode7" value="7" class="mode">с самого начала</li>
            </ul>
        </div>


        <div class="buddy-wrapper">
            <div id="buddy-list" > 
                <?php
                $this->renderPartial('_buddies', array(
                    'onlineusers' => $onlineusers,
                    'interlocutor' => $interlocutor));
                ?>

            </div>
            <div id="hidden-user-info">
                <p> <span><?php echo Yii::t('common', 'Information') ?>:</span></p>
                <div id="for-avatar"></div>
                <p><span>phone:<span id="phone"></span></p>
                <p><span>skype:</span><span id="skype"></span></p>
                <p id="link-send-message"></p>
                <a href="#">
                    <img id="close-btn" src="/images/Х.png" width="22">
                </a>
            </div>
            <div id="div-hidden-alert"><p><span id="hidden-alert"></span></p></div>
        </div>




        <div id="chat-log-wrapper" class="chat-log-wrapper">
        </div>
<!--        <input type="text" class="search-users" placeholder="<?php // echo Yii::t('common', 'Find users')              ?>" >-->
        <?php
//        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'search-users',
            'source' => $this->createUrl('user/user/autocompleteTest'),
            // additional javascript options for the autocomplete plugin
            'options' => array(
                'showAnim' => 'fold',
            ),
            'htmlOptions' => array(
                'placeholder' => Yii::t('common', 'Find users'),
                'class' => 'search-users'
            ),
        ));
        ?>
        </br>
        <input id="add-user-to-chat" type="button" value="Добавить в список" name="add-user-to-chat" class="search-users add-user-to-chat">

        <?php
        if (isset($_GET['interlocutor'])) {
            $interlocutor = $_GET['interlocutor'];
        }
        if ($interlocutor == 0) {
            $isActivated = false;
        }
        $identity = is_object(Yii::app()->user->id) ? Yii::app()->user->id->id : Yii::app()->user->id;
        //$module = Yii::app()->getModule('chatmobile');
        //$messageBlock = $isWebinar ? $module->messageBlockWeb : $module->messageNonActive;
        $this->widget('YiiChatWidget', array(
            'chat_id' => $chat_id, // a chat identificator
            'identity' => $identity, // the user, Yii::app()->user->id ? YES
            'selector' => '#chat-log-wrapper', //'#chat',                // were it will be inserted
            'minPostLen' => 1, // min and
            'maxPostLen' => 0, // max string size for post
            //'model'=>new MyYiiChatHandler(),    // the class handler. **** FOR DEMO, READ MORE LATER IN THIS DOC ****
            'model' => new ChatHandler(), // the class handler. **** FOR DEMO, READ MORE LATER IN THIS DOC ****
            'data' => 'any data', // data passed to the handler
            // success and error handlers, both optionals.
            'onSuccess' => new CJavaScriptExpression(
                    "function(code, text, post_id){   }"),
            'onError' => new CJavaScriptExpression(
                    "function(errorcode, info){  }"),
            'sendButtonText' => '',
            //новая опция - режим чата "только просмотр"
            'modeOnlyView' => !$isActivated /* || $isWebinar */,
            'isActivated' => $isActivated,
            //'isWebinar'=>$isWebinar,
            //'messageWebinar'=>$module->messageBlockWeb,
            'messageNonActive' => 'Пользователь не активен',
        ));
        ?>
        <?php if ($isActivated) { ?>
            <div class="chat-smile-alert-block">
                <div class="chat-smilesbg-block" id="chat-smilesbg-block" style="display:none;"></div>
                <div class="chat-smile-button" id="chat-smile-button"></div>
            </div>  
            <?php if (Yii::app()->user->checkAccess('moderator')) { ?>
                <div class="chat-alert-button-enabled"></div>  
                <div class="chat-alert-button" id="chat-alert-button"></div>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<script type="text/javascript">
    var emoticons = {
        ':)': '01.png',
        ':(': '02.png',
        ':D': '03.png',
        '8-)': '04.png',
        ':O': '05.png',
        ';)': '06.png',
        ';(': '07.png',
        '(:|': '08.png',
        ':|': '09.png',
        ':*': '10.png',
        ':P': '11.png',
        ':$': '12.png',
        ':^)': '13.png',
        '|-)': '14.png',
        '|-(': '15.png',
        '(inlove)': '16.png',
        ']:)': '17.png',
        '(yn)': '18.png',
        '(yawn)': '19.png',
        '(puke)': '20.png',
        '(doh)': '21.png',
        '(angry)': '22.png',
        '(wasntme)': '23.png',
        '(party)': '24.png',
        '(worry)': '25.png',
        '(mm)': '26.png',
        '(nerd)': '27.png',
        ':x': '28.png',
        '(wave)': '29.png',
        '(facepalm)': '30.png',
        '(devil)': '31.png',
        '(angel)': '32.png',
        '(envy)': '33.png',
        '(wait)': '34.png',
        '(makeup)': '35.png',
        '(chuckle)': '36.png',
        '(clap)': '37.png',
        '(think)': '38.png',
        '(rofl)': '39.png',
        '(whew)': '40.png',
        '(happy)': '41.png',
        '(smirk)': '42.png',
        '(nod)': '43.png',
        '(shake)': '44.png',
        '(waiting)': '45.png',
        '(emo)': '46.png',
        '(malthe)': '47.png',
        '(oliver)': '48.png',
        '(call)': '49.png',
        '(highfive)': '50.png',
        '(rock)': '51.png',
        '(talk)': '52.png',
        '(tmi)': '53.png',
        '(fubar)': '54.png',
        '(swear)': '55.png',
        '(wtf)': '56.png',
        '(tauri)': '57.png',
        '(drunk)': '58.png',
        '(smoking)': '59.png',
        '(punch)': '60.png',
        '(sun)': '61.png',
        '(flex)': '62.png',
        '(y)': '63.png',
        '(n)': '64.png',
        '(handshake)': '65.png',
        '(*)': '66.png',
        '(hug)': '67.png',
        '(h)': '68.png',
        '(music)': '69.png',
        '(mooning)': '70.png',
        '(bow)': '71.png',
        '(F)': '72.png',
        '(coffee)': '73.png',
        '(pi)': '74.png',
        '(cash)': '75.png',
        '(^)': '76.png',
        '(beer)': '77.png',
        '(d)': '78.png',
        '\o/': '79.png',
        '(poolparty)': '80.png'
    };

//-------
    var smileys = '<?= $smileys; ?>';
    var $textBox;


    var getKeyByValue = function(obj, value) {
        for (var prop in obj) {
            if (obj.hasOwnProperty(prop)) {
                if (obj[prop] === value)
                    return prop;
            }
        }
    }

    /**
     *   
     */
    function buildSmilePopoverContent() {
        var wrap = $("<div class='smileys-popover' id='popover-content'></div>");
        var parsedSmileys = jQuery.parseJSON(smileys);

        $("#chat-smilesbg-block").empty().append(wrap);

        for (var i = 0; i < parsedSmileys.length; i++) {
            var code = getKeyByValue(emoticons, parsedSmileys[i]);
            var wrapSmile = $("<div class='wrap-smile'></div>");
            wrapSmile.hover(function() {
                $(this).addClass('hover');
            }, function() {
                $(this).removeClass('hover');
            });
            var el = $("<img src='/images/smiles/" + parsedSmileys[i] + "' alt='" + code + "' class='smile-thumb' width='20' height='20' />");

            el.on('click', function() {
                var code = $(this).attr('alt');
                insertText(" " + code + " ");
                //insertSmile();
                $("#chat-smilesbg-block").hide();
                $("#chat-smile-button").removeClass("highlighted");
            });

            wrapSmile.append(el);
            $("#popover-content").append(wrapSmile);
        }
    }

    function insertText(text) {
        var textBox = $(".you textarea");
        if (!textBox)
            return false;
        textBox.insertAtCaret(text);
        textBox.focus();
        return true;
    }

    //Процедура при загрузке страницы
    $(document).ready(function() {

        $("#add-user-to-chat").click(function() {
            $.ajax({
                url: '<?= Yii::app()->createAbsoluteUrl('site/addUserToList') ?>',
                dataType: 'json', //'text',
                type: 'POST',
                data: {
                    'id': <?php echo Yii::app()->user->id ?>,
                    'username': $("#search-users").val(),
                },
                success: function(data) {
                    if (data.description) {
                        $('#hidden-alert').text(data.description);
                        setTimeout(function(){
                            $('#hidden-alert').text('');
                        },5000);
                    }
                }
            });
        });

        $('.info-image').live('click', function() {
            // $('.info-image').click(function() {
//                $('#hidden-user-info').show();
//                return false;
//            });
            $('#close-btn').click(function() {
                $('#hidden-user-info').hide();
                return false;
            });




            var id = $(this).parent().attr('data');
            $.ajax({
                url: '<?= Yii::app()->createAbsoluteUrl('site/GetUserInfo') ?>',
                dataType: 'json', //'text',
                type: 'POST',
                data: {'id': id},
                success: function(data) {
                    $('#for-avatar').empty();
                    $('#phone').empty();
                    $('#skype').empty();
                    $('#link-send-message').empty();
                    if (data && data.photo) {
                        $('#for-avatar').append('<img src="/admin/uploads/' + data.photo + '" alt="" width="67px" height="67px">');
                    }
                    if (data && data.phone) {
                        $('#phone').text(data.phone);
                    }
                    if (data && data.skype) {
                        $('#skype').text(data.skype);
                    }
//                    $('#link-send-message').append
//                            ('<a href="<?php // echo Yii::app()->createAbsoluteUrl('office/chat/')                   ?>' + '?interlocutor=' + id + ' "><?php // echo Yii::t('common', 'Send message')                   ?></a>');
                    $('#hidden-user-info').show();
                    return false;
                }
            });


        });

//        $('#close-btn').live('click', function() {
//            $('#sogloshenie').hide();
//            return false;
//        };
        buildSmilePopoverContent();

        //событие при нажатии кнопка показа панели со смайликами
        $("#chat-smile-button").click(function() {
            $("#chat-smilesbg-block").toggle();
            var isVisible = $('#chat-smilesbg-block').is(':visible');
            if (isVisible) {
                $("#chat-smile-button").addClass("highlighted");
            } else {
                $("#chat-smile-button").removeClass("highlighted");
            }
        });

        //расширение функционала jQuery - вставка текста в textarea в позицию курсора
        jQuery.fn.extend({
            insertAtCaret: function(myValue) {
                return this.each(function(i) {
                    if (document.selection) {
                        //For browsers like Internet Explorer
                        this.focus();
                        sel = document.selection.createRange();
                        sel.text = myValue;
                        this.focus();
                    }
                    else if (this.selectionStart || this.selectionStart == '0') {
                        //For browsers like Firefox and Webkit based
                        var startPos = this.selectionStart;
                        var endPos = this.selectionEnd;
                        var scrollTop = this.scrollTop;
                        this.value = this.value.substring(0, startPos) + myValue + this.value.substring(endPos, this.value.length);
                        this.focus();
                        this.selectionStart = startPos + myValue.length;
                        this.selectionEnd = startPos + myValue.length;
                        this.scrollTop = scrollTop;
                    } else {
                        this.value += myValue;
                        this.focus();
                    }
                })
            }
        });

        //обновление по таймеру: список и кол-во онлайн-юзеров
        var launchTimer = function() {
            setTimeout(function() {
                $.ajax({
                    url: '<?=
        Yii::app()->createAbsoluteUrl('site/getTeamUsers', array(
            'interlocutor' => $interlocutor
        ))
        ?>',
                    dataType: 'json', //'text',
                    type: 'get',
                    success: function(data) {
                        if (data && !data.error) {
                            $("#online-counter").text(data.onlinecount);
                            $("#buddy-list").empty();
                            if (data.html) {
                                $("#buddy-list").append(data.html);
                            }
                        }
                    }
                });
                launchTimer();
            }, 5000);
        }
        launchTimer();


    });
    //launchTimer();

</script>
