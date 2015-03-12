<?php
// patch test
mail('pernalsky@gmail.com', 'test mail automatic delivery', 'если письмо пришло - проблемы на продакшене получились с отправкой подтверждения');
/**
 *
 * Bootstrap index file
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
require('./../../common/lib/vendor/autoload.php');

use Yiinitializr\Helpers\Initializer;

Initializer::create('./../', 'frontend', array(
	__DIR__ .'/../../common/config/main.php',
	__DIR__ .'/../../common/config/env.php',
	__DIR__ .'/../../common/config/local.php',
	'main',
	'env',
	'local'
))->run();