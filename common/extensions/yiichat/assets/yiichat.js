var YiiChat = function(options){
    
    this.run = function(){
        
        /** 
        * Конструирование плагина из частей 
        */
        var chat = jQuery(options.selector);
        chat.addClass('yiichat');
        chat.html("<div class='posts'>posts</div><div class='you'>you</div><div class='log'></div>");

        var you = chat.find('div.you');
        you.html("<div class='messageblock'>" + options.messageBlock + "</div><textarea></textarea>");
        you.append("<button>" + options.sendButtonText + "</button>");
        var buttons = chat.find('div.you button');
        
        var messageblock = chat.find('div.messageblock');
        messageblock.hide();
        
        var posts = chat.find('div.posts');
        posts.html("");

        var send = you.find('button');
        var msg = you.find('textarea');

        var log = chat.find('div.log');

        /**
        * Методы - функции
        * 
        */
        var clear = function(){
            send.attr('disabled',null);
            if (!options.modeOnlyView) {
                msg.attr('disabled',null);
            }
            flagBusy = false; //сбросить флаг занятости
        }

        //функция, выставляющая режим для чата "занят" 
        //(для предотвращения повторной отправки или приёма сообщений)
        var flagBusy = false;  //спец флаг "занят"
        var busy = function(){
            flagBusy = true;  //установить флаг занятости
            send.attr('disabled','disabled');
            msg.attr('disabled','disabled');
        }

        var actionPost = function(text, callback) {
            busy();
            jQuery.ajax({ cache: false, type: 'post', 
                url: options.action+'&action=sendpost&data=not_used',
                data: { 
                    chat_id: options.chat_id, 
                    identity: options.identity, 
                    text: text, 
                    is_alert : isAlert
                },
                success: function(post){
                    if(post == null || post == ""){
                        options.onError('post_empty','');
                    }else    
                    if(post == 'REJECTED'){
                        options.onError('post_rejected',text);
                        callback(false);
                    }else{
                        //добавляем замену для иконок смайликов
                        post['text'] = urlify(post['text']);
                        post['text'] = replaceEmoticons(post['text']);  
                        post['text'] = post['text'].replace(/\n/g, "</br>");
                        add(post);
                        callback(true);
                        options.onSuccess('post',text,post);
                    }
                    clear();
                    disableAlertMode();   //выключить режим важного сообщения
                },
                error: function(e){
                    clear();
                    options.onError('send_post_error',e.responseText,e);
                    callback(false);
                }
            });
        }

        //Иконки-смайлики
        //var emoticons = {
//                ':)': '01.png',
//                ':(': '02.png',
//                ':D': '03.png',
//                '8-)': '04.png',
//                ':O': '05.png',
//                ';)': '06.png',
//                ';(': '07.png',
//                '(:|': '08.png',
//                ':|': '09.png',
//                ':*': '10.png',
//                ':P': '11.png',
//                ':$': '12.png',
//                ':^)': '13.png',
//                '|-)': '14.png',
//                '|-(': '15.png',
//                '(inlove)': '16.png',
//                ']:)': '17.png',
//                '(yn)': '18.png',
//                '(yawn)': '19.png',
//                '(puke)': '20.png',
//                '(doh)': '21.png',
//                '(angry)': '22.png',
//                '(wasntme)': '23.png',
//                '(party)': '24.png',
//                '(worry)': '25.png',
//                '(mm)': '26.png',
//                '(nerd)': '27.png',
//                ':x': '28.png',
//                '(wave)': '29.png',
//                '(facepalm)': '30.png',
//                '(devil)': '31.png',
//                '(angel)': '32.png',
//                '(envy)': '33.png',
//                '(wait)': '34.png',
//                '(makeup)': '35.png',
//                '(chuckle)': '36.png',
//                '(clap)': '37.png',
//                '(think)': '38.png',
//                '(rofl)': '39.png',
//                '(whew)': '40.png',
//                '(happy)': '41.png',
//                '(smirk)': '42.png',
//                '(nod)': '43.png',
//                '(shake)': '44.png',
//                '(waiting)': '45.png',
//                '(emo)': '46.png',
//                '(malthe)': '47.png',
//                '(oliver)': '48.png',
//                '(call)': '49.png',
//                '(highfive)': '50.png',
//                '(rock)': '51.png',
//                '(talk)': '52.png',
//                '(tmi)': '53.png',
//                '(fubar)': '54.png',
//                '(swear)': '55.png',
//                '(wtf)': '56.png',
//                '(tauri)': '57.png',
//                '(drunk)': '58.png',
//                '(smoking)': '59.png',
//                '(punch)': '60.png',
//                '(sun)': '61.png',
//                '(flex)': '62.png',
//                '(y)': '63.png',
//                '(n)': '64.png',
//                '(handshake)': '65.png',
//                '(*)': '66.png',
//                '(hug)': '67.png',
//                '(h)': '68.png',
//                '(music)': '69.png',
//                '(mooning)': '70.png',
//                '(bow)': '71.png',
//                '(F)': '72.png',
//                '(coffee)': '73.png',
//                '(pi)': '74.png',
//                '(cash)': '75.png',
//                '(^)': '76.png',
//                '(beer)': '77.png',
//                '(d)': '78.png',
//                '\o/': '79.png',
//                '(poolparty)': '80.png'
//              };        
        
        //Функция ищет в тексте ссылки и преобразует их в html-ссылки <a href={url}>{url}</a>
        var urlify = function (text) {
            var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
            return text.replace(exp,"<a href='$1' target='_blank' style='color: #0078ca;'>$1</a>");
        }

        //функция замены текста для иконок смайликов (emoticons)
        var replaceEmoticons = function (text) {
                var url = "/images/smiles/", //uri картинок смайлов
                        patterns = [], //массив для регэкспов
                        metachars = /[[\]{}()*+?.\\|^$\-,&#\s]/g; //символы которые надо экранировать

                //собираем регэксп для каждого кода смайла
                for (var i in emoticons) {
                  if (emoticons.hasOwnProperty(i)){ // escape metacharacters
                    patterns.push('('+i.replace(metachars, "\\$&")+')');
                  }
                }

                //заменяем код смайла на картинку, используя регэкспы
                return text.replace(new RegExp(patterns.join('|'),'g'), function (match) {
                  return typeof emoticons[match] != 'undefined' ?
                         '<span class="chat-log-smile-wrapper"><img src="'+url+emoticons[match]+'"/></span>' :
                         match;
                });
              }
        
        var actionInit = function(callback){
            busy();
            loaderShow(true);
            jQuery.ajax({ cache: false, type: 'post', 
                url: options.action+'&action=init&data=not_used',
                data: { "chat_id": options.chat_id, "identity": options.identity, "mode": mode },
                success: function(_posts){
                    loaderShow(false);
                    if(_posts == null || _posts == ""){
                        options.onError('init_empty','');
                    } else if (posts == 'REJECTED') {
                        options.onError('init_rejected',text);
                    } else {
                        // _posts.chat_id, _posts.identity, _posts.posts
                        jQuery.each(_posts.posts, function(k,post){
                            //добавляем замену для иконок смайликов
                            post['text'] = urlify(post['text']);
                            post['text'] = replaceEmoticons(post['text']);  
                            post['text'] = post['text'].replace(/\n/g, "</br>");
                            add(post);
                        });    
                        options.onSuccess('init','');
                        callback();
                    }
                    clear();
                },
                error: function(e){
                    loaderShow(false);
                    clear();
                    options.onError('init_error',e.responseText,e);
                }
            });
        }

        //функция установки режима: блокировать ли отправку сообщений (+показ предупреждения)
        var setMode = function(iswebinar, isactivated){
            modeOnlyView = iswebinar || !isactivated;
            //if (modeOnlyView && !options.modeOnlyView) {
            if (modeOnlyView) {
                buttons.hide();
                msg.attr('disabled', 'disabled');
                //msg.before("<div class='messageblock'>" + options.messageBlock + "</div><textarea></textarea>");
                if (iswebinar) {
                    messageblock.html(options.messageWebinar);
                } else {
                    messageblock.html(options.messageNonActive);
                }
                messageblock.show();
            } else 
            //if (!modeOnlyView && options.modeOnlyView) 
            {
                buttons.show();
                msg.attr('disabled', null);
                messageblock.hide();
            }
            options.modeOnlyView = modeOnlyView;
        }
            
        //функция приема (чтения) новых сообщений, выполняющайся по таймеру
        var actionTimer = function(){
            //выход если флаг "занят"
            if (flagBusy) { 
                return;
            }
            
            var last_id = '';
            //var lastPost = posts.find('.post:not(.yiichat-post-myown):last');
            var lastPost = posts.find('.chat-message:not(.yiichat-post-myown):last');
            var data = lastPost.data('post'); //data setted in add method
            if(data != null) {
                last_id = data.id;
                if (window.currDisplay == 'yiichat') {   //проверка - является ли текущее окно YII-чатом
                    setCookie("lastYiiChatMsgId", last_id, 365); //записать ИД последнего в куки
                }
            }
            //log.html('last_id='+last_id);
            jQuery.ajax({ cache: false, type: 'post', 
                url: options.action+'&action=timer&data=not_used',
                data: { chat_id: options.chat_id, identity: options.identity, 
                    last_id: last_id },
                success: function(_posts){
                    if (_posts == null || _posts == ""){
                        options.onError('timer_empty','');
                    } else if (posts == 'REJECTED') {
                        options.onError('timer_rejected',text);
                    } else {
                        //проверка на активность и текущий вебинар
//                        setMode(_posts.iswebinar, _posts.isactivated);

                        // _posts.chat_id, _posts.identity, _posts.posts
                        var hasPosts=false;
                        jQuery.each(_posts.posts, function(k,post){
                            //добавляем замену для иконок смайликов
                            post['text'] = replaceEmoticons(post['text']);
                            post['text'] = post['text'].replace(/\n/g, "</br>");
                            add(post);
                            hasPosts=true;
                        });    
                        options.onSuccess('timer','');
                        if(hasPosts==true)
                            scroll();
                    }
                },
                error: function(e){
                    options.onError('timer_error',e.responseText,e);
                }
            });
        }

        //функция форматирования даты/времени
        var formatDateTime = function (date) {
          var dd = date.getDate()
          if (dd < 10) dd = '0' + dd;
          var mm = date.getMonth()+1
          if (mm < 10) mm = '0' + mm;
          var yy = date.getFullYear() % 100;  //убираем из года первые 2 цифири
          if (yy < 10) yy = '0' + yy;
          
          var h = date.getHours();
          if (h < 10 ) h = '0' + h;
          var i = date.getMinutes();
          if (i < 10 ) i = '0' + i;
          //var s = date.getSeconds();   //убираем секунды из даты
          //if (s < 10 ) s = '0' + s;
          return dd + '.' + mm + '.' + yy + '  ' + h + ':' + i;
          //return dd + '.' + mm + '.' + yy + ' ' + h + ':' + i + ':' + s;
        }
        

        
        // fields: 
        //    id: postid, owner: 'i am', time: 'the time stamp', text: 'the post'
        //  chat_id: the_chat_id, identity: whoami_id    
        var add = function(post){
            
            datevalue = Date.parse(post.time);
            datevalue = new Date(datevalue);
            strDateTime = formatDateTime(datevalue);
            post.time = strDateTime;
            
            if (post.is_alert == '1') {
                message = '<div id="' + post.id + '" class="chat-message alert">' +
                                '<div class="log-name">' + post.owner + '</div>' +
                                '<div class="log-message">' +
                                    '<span>' + post.text + '</span>' +
                                    '<br>' +
                                '</div>' +
                                '<div class="log-time">' + post.time + '</div>' + 
                                '<div class="clearfix"></div>' +
                          '</div>'
            } else {
                message = "<div id='" + post.id + "' class='chat-message'>" +
                                "<div class='log-name'>" + post.owner + "</div>" +
                                "<div class='log-message'>" +
                                    "<span>" + post.text + "</span>" +
                                    "<br>" +
                                "</div>" +
                                "<div class='log-time'>" + post.time + "</div>" +
                                "<div class='clearfix'></div>" +
                            "</div>";
            }
            
            posts.append(message);
            
            var p = posts.find(".chat-message[id='"+post.id+"']");
            p.data('post',post);
            
            var flag=false;
            if(options.identity == post.post_identity)
                { p.addClass('yiichat-post-myown'); flag=true; }
        }

        var scroll = function(){
            //window.location = '#'+posts.find('.post:last').attr('id');
            var h=0;
            posts.find('.chat-message').each(function(k){
                h += $(this).outerHeight(true);
            });
            posts.scrollTop(h);
        }

       
        send.click(function(){
            var text = jQuery.trim(msg.val());
            if(text.length < options.minPostLen){
                options.onError('very_short_text',text);
            }else
            if(options.maxPostLen && text.length > options.maxPostLen){
                options.onError('very_large_text',text);
            }
            else
            actionPost(text, function(ok){
                if(ok==true){
                    msg.val("");
                    scroll();
                    setTimeout(function(){ msg.focus(); },100);
                }
            });
        });
        
        //события нажатия клавиш на поле ввода
        msg.keyup(function(e){
            var text = jQuery.trim(msg.val());
            //перед проверкой длины сообщения добавляем проверку: если maxPostLen = 0, то не проверяем длину
            if(options.maxPostLen && text.length > options.maxPostLen){
                msg.css({ color: 'red' });
                msg.parent().find(".exceded").text("size exceded");
            }else{
                msg.css({ color: 'black' });
                msg.parent().find(".exceded").text("");
            }
        });
        
        msg.keydown(function(e) {
            if (e.keyCode === 13 && (e.ctrlKey || e.metaKey)) {
                $(this).val(function(i, val) {
                    return val + "\n";
                });
                breakedLine = true;
            }
        }).keypress(function(e){
            if (e.keyCode === 13 && !e.ctrlKey && !e.metaKey) {
                    $(".you button").click();
                    breakedLine = false;
                return false;
            }
        }    //onKeypress
        ).keyup(function(e) {
            if (e.keyCode === 17) {
                ctrlKeyDown = false;
            }
        });
        
        
        var launchTimer = function(){
            setTimeout(function(){
                try{
                    actionTimer();
                } catch(e){}
                launchTimer();        
            }, options.timerMs);    
        }
    
        /*
        * Дополнительные функции для работы с интерфейсом
        */
        var isAlert = false; //режим алерт-сообщения
        
        //Выключаем режим алерт-сообщения
        var disableAlertMode = function() {
            var target = $("#chat-alert-button");
            if (target.hasClass('highlighted'))
                target.removeClass('highlighted');
            isAlert = false;
        }
        
        //Переключаем режимы алерт/обычное сообщение
        var toggleChatAlertMode = function() {
            var target = $("#chat-alert-button");
            if (target.hasClass('highlighted')) {
                target.removeClass('highlighted');
                isAlert = false;
            } else {
                target.addClass('highlighted');
                isAlert = true;
            }
        }
        
        var alertbutton = $("#chat-alert-button")
        
        //событие при нажатии кнопки "важное сообщение"
        alertbutton.click(function() {
            toggleChatAlertMode();
        });
        
        //вывод лоадера (процесс при загрузке сообщений)
        var loader = "<div id='loader'></div>";
        var loaderShow = function(isShow) {
            if (isShow)
                posts.html(loader);
            else 
                $("#loader").remove();
        }
        
        //управление отображением списка писем (выбор периода)
        var mode = 1;   //по умолчанию режим "Вчера" для интервала выборки сообщений
        //var mode = 7;   //временно по умолчанию режим "ЗА ВСЁ ВРЕМЯ"
        $(".mode").click(function() {
            busy();
            mode = $(this).attr("value");
            $("li.mode.active").removeClass("active");
            $(this).toggleClass("active");
            posts.html("");
            actionInit(scroll);
        })
        
        /*
        *  Первоначальная инициализация плагина
        */
        actionInit(scroll);
        setMode(options.isWebinar, options.isActivated);
        launchTimer();
    
    };
    
} //end