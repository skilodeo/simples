<?php
/* SVN FILE: $Id: missing_connection.ctp 7728 2008-10-10 16:12:15Z AD7six $ */
/**
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
 * @subpackage		cake.cake.libs.view.templates.errors
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 7728 $
 * @modifiedby		$LastChangedBy: AD7six $
 * @lastmodified	$Date: 2008-10-10 11:12:15 -0500 (Fri, 10 Oct 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<h2><?php __('Missing Database Connection'); ?></h2>
<p class="error">
	<strong><?php __('Error'); ?>: </strong>
	<?php echo sprintf(__('%s requires a database connection', true), $model);?>
</p>
<p class="error">
	<strong><?php __('Error'); ?>: </strong>
	<?php echo sprintf(__('Confirm you have created the file : %s.', true), APP_DIR.DS.'config'.DS.'database.php');?>
</p>
<p class="notice">
	<strong><?php __('Notice'); ?>: </strong>
	<?php echo sprintf(__('If you want to customize this error message, create %s.', true), APP_DIR.DS.'views'.DS.'errors'.DS.basename(__FILE__));?>
</p>