<?php
/**
 *
 * console.php configuration file
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
defined('APP_CONFIG_NAME') or define('APP_CONFIG_NAME', 'console');

return array(
        
        //path aliases
        
        'aliases' => array(
		'backend' => dirname(__FILE__) . '/../..' . '/backend',
	),
        'modules' => array(
            'siap' => array(
                'class' => 'backend.modules.siap.SiapModule',
             ),
        ),
	'basePath' => realPath(__DIR__ . '/..'),
	'commandMap' => array(
		'migrate' => array(
			'class' => 'system.cli.commands.MigrateCommand',
			'migrationPath' => 'application.migrations'
		)
	),
    'import' => array(
        'application.migrations.ProjectMigration',
        'backend.modules.siap.models.*'
    ),
);