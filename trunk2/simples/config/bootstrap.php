<?php
/**
 * Simples bootstrap file
 * 
 * This file should be included in app/bootsrap.php.
 * It connects Simples with your application.
 *
 * @package simples
 */

// Simples MVC paths
define('SIMPLES_DIR', ROOT . DS . 'simples');
define('SETTINGS_CACHE_FILE', TMP . 'settings' . DS . 'cache');

$modelPaths = array(SIMPLES_DIR . DS . 'models' . DS);
$viewPaths = array(SIMPLES_DIR . DS . 'views' . DS);
$controllerPaths = array(SIMPLES_DIR . DS . 'controllers' . DS);
$behaviorPaths = array(SIMPLES_DIR . DS . 'models' . DS . 'behaviors' . DS);
$helperPaths = array(SIMPLES_DIR . DS . 'views' . DS . 'helpers' . DS);
$componentPaths = array(SIMPLES_DIR . DS . 'controllers' . DS . 'components' . DS);

// Include Simples config
require_once(dirname(__FILE__) . DS . 'core.php');

/**
 * Dynamic class include
 *
 * @param string $className
 * @package simples
 */
function __autoload($className) {
	$simplesClasses = array(
	   'SimplesModel' => 'simples_model', 
	   'SimplesController' => 'simples_controller', 
	   'SimplesHelper' => 'simples_helper'
	);
	
	if (array_key_exists($className, $simplesClasses)) {
		require_once(SIMPLES_DIR . DS . $simplesClasses[$className] . '.php');
	}
	
	if ($className == 'ConnectionManager') {
		require_once LIBS . 'model' . DS . 'connection_manager.php';
	} else if ($className == 'DATABASE_CONFIG') {
		require_once CONFIGS . 'database.php';
	}
}

/**
 * Wrapper for application encoding respecting htmlspecialchars
 * 
 * @param string $string
 * @return string Text safe to display in HTML
 * @package simples
 */
function hsc($string) {
	return htmlspecialchars($string, ENT_QUOTES, Configure::read('App.encoding'));
}
