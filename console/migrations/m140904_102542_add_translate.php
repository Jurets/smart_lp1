<?php

class m140904_102542_add_translate extends ProjectMigration
{
    private $list = array(
        'Registration payment'=>'Оплата регистрации',
        'Activation in system'=>'Активация в системе',
        'Entry into the business club'=>'Вступление в бизнес-клуб',
        'You have become a business participant'=>'Вы стали бизнес-участником',
        'Changing the status of a business club'=>'Изменение статуса в бизнес клубе',
        'ban period (in seconds)'=>'период бана (в секундах)',
        'User ID'=>'ИД юзера',
        'Ban type'=>'Тип бана',
        'Reason'=>'Причина',
        'Author'=>'Автор',
        'Importance'=>'Важность',
        'From User'=>'От кого',
        'From Purse'=>'Кошелек отправителя',
        'To User'=>'Кому',
        'To Purse'=>'Кошелек получателя',
        'Notation'=>'Примечание',
        'Amount'=>'Сумма',
        'Currency'=>'Валюта',
        'Tr Kind'=>'Тип транзакции',
        'Tr Err Code'=>'Код ошибки',
        'Shortname'=>'Короткое имя',
        
        'An error occurred while blocking user'=>'Ошибка при блокировании юзера',
        'Participant successfully blocked in chat'=>'Участник успешно заблокирован в чате',
        'The participant is successfully unlocked'=>'Участник успешно разблокирован',

        'select'=>'выбрать',
        
        'Blocking'=>'Блокировка',
        'Chat messages'=>'Сообщения чата',
        'Participant is blocked'=>'Участник заблокирован',
        'Block participant'=>'Заблокировать участника',
        'Block'=>'Заблокировать',
        'Unlock'=>'Разблокировать',
        'Enter participant login'=>'Введите логин участника',
        'Find and block participant'=>'Найти и заблокировать участника',
        
        'Source language (English) is absent'=>'Исходный язык (English) отсутствует',
        'There is no russian message in message table! If it is need, you will switch off method RussianPatch in model LanguageInterphace->showTranslation'=>'В таблице Message нет аналога матрицы на русском языке! Если это не нужно, выключите в модели LanguageInterphace->showTranslation метод RussianPatch',
        
        'No Versions'=>'Нет версий',
        'Current version'=>'Текущая версия',
        
        'Period is set successfully'=>'Период задан успешно',
        'Period begin'=>'Начало периода',
        'Period end'=>'Конец периода',
        'begin period for one week'=>'начало периода для одной недели',
        
        'Loading image. Please wait'=>'Загружается изображение. Пожалуйста, подождите',
        'Image uploaded successfully'=>'Изображение успешно загружено',
        
        'Registration is allowed only with a personal referral page'=>'Регистрация разрешена только с личной страницы реферала',
        'Referral with the same name can not be found'=>'Не найден реферал с именем',
        'Confirmation of registration'=>'Подтверждение регистрации',
        'Unable to confirm your registration! The activation code is not found. Contact the site administrator'=>'Не удается подтвердить регистрацию! Код активации не найден. Обратитесь к администратору сайта',
        'Can not log in! Activation code is not valid. Contact the site administrator'=>'Не удается авторизоваться! Код активации не правильный. Обратитесь к администратору сайта',
        
        'Your payment was successful'=>'Ваша оплата прошла успешно',
        'Payment was successful'=>'Оплата произведена успешно',
        'An error occurred during the payment process. For details, contact the site administrator'=>'Произошла ошибка в процессе оплаты. Для подробностей обратитесь к администратору сайта',
        'Question from FAQ'=>'Вопрос от ЧАВО',
        'Mail confirmation'=>'Подтверждение почты',
        'Business Club purse not set'=>'Не задан кошелек Бизнес Клуба',
        'Failed to pay. Try again later'=>'Оплата не прошла. Повторите операцию позже',
        
        'Purse must have dollar prefix'=>'Кошелек должен иметь долларовый префикс',
        
        'Sending mail error'=>'Ошибка при отправке почты',
        'Code for login'=>'Код для входа',
        'Your code for login'=>'Ваш код для входа',
        
        'Perfect Money service not available'=>'Сервис Perfect Money не доступен',
        'API Connection Wrong'=>'Неверное соединение API',
        'Perfect Money(...) Parameter choise not exists'=>'Perfect Money(...) Выбранный параметр не существует',
        'PerfectMoney(...) API in data must be an array and not empty'=>'PerfectMoney(...) входные данные API должны быть не пустым массивом',
        'Enter your Perfect Money data'=>'Введите данные из Perfect Money',
        
        'Raise status'=>'Поднять статус',
        'Click this button to login to the PerfectMoney site'=>'Нажмите эту кнопку для авторизации на сайте PerfectMoney',
        'Account'=>'Аккаунт',
        'In order to be able to receive funds and make deposits, you must have a Perfect Money purse'=>'Для того чтобы иметь возможность получать средства и пополнять счет вам необходимо иметь кошелек Perfect Money',
        'Enter your PM purse'=>'Введите свой PM кошелек',
        'After you create your purse, put a number on this page'=>'После того как вы создадите свой кошелек, введите его номер на этой странице',
        'Create purse'=>'Создать кошелек',
        
        //''=>'',
    );
    
	// Use safeUp/safeDown to do migration with transaction
    //public function safeUp()
	public function up()
	{
        //$this->safeDown(); //вначале удаляем таблицы
        $this->importSqlDump(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lang_ver2.sql'); //затем запускаем скрипт
	}

    //public function safeDown()
	public function down()
	{
        $this->dropTable('Message');
        $this->dropTable('SourceMessage');
        $this->dropTable('Languages');
        //echo "m140904_102542_add_translate does not support migration down.\n";
        //return false;
	}
	
}