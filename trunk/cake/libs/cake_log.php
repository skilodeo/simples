<?php
/* SVN FILE: $Id: cake_log.php 7662 2008-09-25 16:49:56Z mark_story $ */
/**
 * Logging.
 *
 * Log messages to text files.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 7662 $
 * @modifiedby		$LastChangedBy: mark_story $
 * @lastmodified	$Date: 2008-09-25 11:49:56 -0500 (Thu, 25 Sep 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Included libraries.
 *
 */
	if (!class_exists('File')) {
		require LIBS . 'file.php';
	}
/**
 * Set up error level constants to be used within the framework if they are not defined within the
 * system.
 *
 */
	if (!defined('LOG_WARNING')) {
		define('LOG_WARNING', 3);
	}
	if (!defined('LOG_NOTICE')) {
		define('LOG_NOTICE', 4);
	}
	if (!defined('LOG_DEBUG')) {
		define('LOG_DEBUG', 5);
	}
	if (!defined('LOG_INFO')) {
		define('LOG_INFO', 6);
	}
/**
 * Logs messages to text files
 *
 * @package		cake
 * @subpackage	cake.cake.libs
 */
class CakeLog {
/**
 * Writes given message to a log file in the logs directory.
 *
 * @param string $type Type of log, becomes part of the log's filename
 * @param string $msg  Message to log
 * @return boolean Success
 * @access public
 * @static
 */
	function write($type, $msg) {
		if (!defined('LOG_ERROR')) {
			define('LOG_ERROR', 2);
		}
		if (!defined('LOG_ERR')) {
			define('LOG_ERR', LOG_ERROR);
		}
		$levels = array(
			LOG_WARNING => 'warning',
			LOG_NOTICE => 'notice',
			LOG_INFO => 'info',
			LOG_DEBUG => 'debug',
			LOG_ERR => 'error',
			LOG_ERROR => 'error'
		);

		if (is_int($type) && isset($levels[$type])) {
			$type = $levels[$type];
		}

		if ($type == 'error' || $type == 'warning') {
			$filename = LOGS . 'error.log';
		} elseif (in_array($type, $levels)) {
			$filename = LOGS . 'debug.log';
		} else {
			$filename = LOGS . $type . '.log';
		}
		$output = date('Y-m-d H:i:s') . ' ' . ucfirst($type) . ': ' . $msg . "\n";
		$log = new File($filename, true);
		if ($log->writable()) {
			return $log->append($output);
		}
	}
}
?>