<?php
/**
*
* main.php configuration file
*
* @author Antonio Ramirez <amigo.cobos@gmail.com>
* @link http://www.ramirezcobos.com/
* @link http://www.2amigos.us/
* @copyright 2013 2amigOS! Consultation Group LLC
* @license http://www.opensource.org/licenses/bsd-license.php New BSD License
*/
return array(
    //'language'=> 'ru',
    'preload' => array('log'),
    'aliases' => array(
        'frontend' => dirname(__FILE__) . '/../..' . '/frontend',
        'common' => dirname(__FILE__) . '/../..' . '/common',
        'backend' => dirname(__FILE__) . '/../..' . '/backend',
        'vendor' => dirname(__FILE__) . '/../..' . '/common/lib/vendor'
    ),
    'import' => array(
        'common.extensions.components.*',
        'common.components.*',
        'common.helpers.*',
        'common.models.*',
        'application.controllers.*',
        'application.extensions.*',
        'application.helpers.*',
        'application.models.*',

        'common.extensions.yii-mail.YiiMailMessage',
        
        'common.modules.user.models.*',
        'common.modules.user.components.*',
    ),
    'components' => array(
        'db' => array(
            // setup to suit your needs
            'connectionString' => 'mysql:host=localhost;dbname=justmoney',
            'username' => 'root',
            'password' => '',
            'enableProfiling' => false,
            'enableParamLogging' => false,
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class'        => 'CDbLogRoute',
                    'connectionID' => 'db',
                    'levels'       => 'error, warning',
                ),
            ),
        ),
        'user'=>array(
            // enable cookie-based authentication
            'class' => 'WebUser',
            'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login'),
        ),
        'dateFormatter' => array(
            'class' => 'common.components.EDateFormatter',
            //'locale' => 'en_US',
        ),
        'mail' => array(
            'class' => 'common.extensions.yii-mail.YiiMail',
            'transportType' => 'php',
            'viewPath' => 'common.views.mail',
            'logging' => true,
            'dryRun' => false,
        ),
    ),
    'params' => array(
        // php configuration
        'php.defaultCharset' => 'utf-8',
        'php.timezone'       => 'UTC',
        'upload.path' => DIRECTORY_SEPARATOR .'www'.DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR,
        'upload.url' => '/uploads/',
    ),

    // application modules
    'modules' => array(
        'user'=>array(
            'class' => 'common.modules.user.UserModule',
            # encrypting method (php hash function)
            'hash' => 'md5',

            # send activation email
            'sendActivationMail' => true,

            # allow access for non-activated users
            'loginNotActiv' => false,

            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,

            # automatically login from registration
            'autoLogin' => true,

            # registration path
            'registrationUrl' => array('/user/registration'),

            # recovery password path
            'recoveryUrl' => array('/user/recovery'),

            # login form path
            'loginUrl' => array('/user/login'),

            # page after login
            'returnUrl' => array('/user/profile'),

            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
    ),
    'language'=>'ru',
    'timeZone'=>'Europe/Kiev',
);