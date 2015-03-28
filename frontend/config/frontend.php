<?php
/**
 *
 * frontend.php configuration file
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
defined('APP_CONFIG_NAME') or define('APP_CONFIG_NAME', 'frontend');

// web application configuration
return array(
	'name' => '{APPLICATION NAME}',
	'basePath' => realPath(__DIR__ . '/..'),
	// path aliases
	'aliases' => array(
		'bootstrap' => dirname(__FILE__) . '/../..' . '/common/lib/vendor/2amigos/yiistrap',
		'yiiwheels' =>  dirname(__FILE__) . '/../..' . '/common/lib/vendor/2amigos/yiiwheels'
	),

	// application behaviors
	'behaviors' => array(),

	// controllers mappings
	'controllerMap' => array(),

	// application modules
	'modules' => array(),

    'import'=>array(
        'application.models.*',
        'application.components.*',
        'bootstrap.helpers.TbHtml',
        'common.modules.user.UserModule',
        
        'common.extensions.yiichat.*',
        
    ),
    
	// application components
	'components' => array(

		'bootstrap' => array(
			'class' => 'bootstrap.components.TbApi',
		),

		'clientScript' => array(
			'scriptMap' => array(
				'bootstrap.min.css' => false,
				'bootstrap.min.js' => false,
				'bootstrap-yii.css' => false
			)
		),
		'urlManager' => array(
			// uncomment the following if you have enabled Apache's Rewrite module.
			'urlFormat' => 'path',
			'showScriptName' => false,

			'rules' => array(
                'info/<id>' => 'site/info/id/<id>',
                
                'register/dynamiccities' => 'register/dynamiccities',
                'register/activate' => 'register/activate',
                'register/sendmail/<userid:\d+>' => 'register/sendmail/userid/<userid>',
                'register/<username:\w+>' => 'register/index/user/<username>',
                'register' => 'register/index',
                            /*   */
                'login' => 'site/login',
                
                'news' => 'office/news',
                'logout' => 'site/logout',

				// default rules
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                
			),
		),
        'request' => array(
            'baseUrl' => '',
        ),            
		'user' => array(
			'allowAutoLogin' => true,
		),
		'errorHandler' => array(
			'errorAction' => 'site/error',
		)
	),
);