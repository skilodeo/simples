<?php
/* SVN FILE: $Id: vendors.php 7693 2008-10-02 14:32:54Z nate $ */
/**
 * Short description for file.
 *
 * This file includes js vendor-files from /vendor/ directory if they need to
 * be accessible to the public.
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
 * @subpackage		cake.app.webroot.js
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 7693 $
 * @modifiedby		$LastChangedBy: nate $
 * @lastmodified	$Date: 2008-10-02 09:32:54 -0500 (Thu, 02 Oct 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Enter description here...
 */
if (isset($_GET['file'])) {
	$file = $_GET['file'];
	$pos = strpos($file, '..');
	if ($pos === false) {
		if (is_file('../../vendors/javascript/'.$file) && (preg_match('/(\/.+)\\.js/', $file))) {
			readfile('../../vendors/javascript/'.$file);
			return;
		}
	}
}
header('HTTP/1.1 404 Not Found');
?>