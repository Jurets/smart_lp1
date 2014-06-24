<?php
/**
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
return array(
	'components' => array(
        'db' => array(
            // setup to suit your needs
            'connectionString' => 'mysql:host=localhost;dbname=justmoney',
            'username' => 'root',
            'password' => '',
            'enableProfiling' => true,
            'enableParamLogging' => true,
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ),
	),
	'params' => array(
		'yii.handleErrors' => true,
		'yii.debug' => false,
		'yii.traceLevel' => 0,
	)
);