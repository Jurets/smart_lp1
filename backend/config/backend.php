<?php
/**
 *
 * backend.php configuration file
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
defined('APP_CONFIG_NAME') or define('APP_CONFIG_NAME', 'backend');

// web application configuration
return array(
	'name' => 'JustMoney.CMS',
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
	'modules' => array(
        'news' => array(
            'class' => 'backend.modules.news.NewsModule',
        ),
        'faq' => array(
            'class' => 'backend.modules.faq.FaqModule',
        ),
        'faqm' => array(
            'class' => 'backend.modules.faqm.FaqmModule',
        ),
        'countries' => array(
            'class' => 'backend.modules.countries.CountriesModule',
        ),
        'training' => array(
            'class' => 'backend.modules.training.TrainingModule',
        ),
        'cities' => array(
            'class' => 'backend.modules.cities.CitiesModule',
        ),
        'invitation' => array(
            'class' => 'backend.modules.invitation.InvitationModule',
        ),
        'requisites' => array(
            'class' => 'backend.modules.requisites.RequisitesModule',
        ),
        'chat' => array(
            'class' => 'backend.modules.chat.ChatModule',
        ),
        'mp' => array(
            'class' => 'backend.modules.mp.MpModule',
        ),
        'im' => array(
            'class' => 'backend.modules.im.ImModule',
        ),
        'siap' => array(
            'class' => 'backend.modules.siap.SiapModule',
        ),
        'commonstat' =>array(
            'class' => 'backend.modules.commonstat.CommonstatModule',
        ),
        'lang' => array(
            'class' => 'backend.modules.lang.LangModule',
        ),
        'info' => array(
            'class' => 'backend.modules.info.InfoModule',
        ),
    ),
    
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'bootstrap.helpers.TbHtml'
    ),

	// application components
	'components' => array(

		'bootstrap' => array(
			'class' => 'bootstrap.components.TbApi',
		),
		'yiiwheels' => array(
			'class' => 'yiiwheels.YiiWheels',
		),
		'clientScript' => array(
			'scriptMap' => array(
				'bootstrap.min.css' => false,
				'bootstrap.min.js' => false,
				'bootstrap-yii.css' => false,
// 				'jquery' => false
			)
		),
		'urlManager' => array(
			// uncomment the following if you have enabled Apache's Rewrite module.
			'urlFormat' => 'path',
			'showScriptName' => false,

			'rules' => array(
				// default rules
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
        'request' => array(
            'baseUrl' => '/superjust',
        ),
        'user'=>array(
            // enable cookie-based authentication
            'class' => 'WebUser',
        ),
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
        
        'format'=>array(
             'dateFormat'=>'d.m.Y',   //формат по умолчанию для форматтера дат
        ),
	),
        'params'=>array(
            'email_verify_code_enabled' => TRUE,
            'backendIs' => '',
        ),
);
