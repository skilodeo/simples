<?php
/* SVN FILE: $Id: comment.php 7726 2008-10-10 02:14:57Z mark_story $ */
/**
 * Test App Comment Model
 *
 * 
 *
 * PHP versions 4 and 5
 *
 * CakePHP :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2006-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2006-2008, Cake Software Foundation, Inc.
 * @link			http://www.cakefoundation.org/projects/info/cakephp CakePHP Project
 * @package			cake
 * @subpackage		cake.cake.libs.
 * @since			CakePHP v 1.2.0.7726
 * @version			$Revision: 7726 $
 * @modifiedby		$LastChangedBy: mark_story $
 * @lastmodified	$Date: 2008-10-09 21:14:57 -0500 (Thu, 09 Oct 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class Comment extends AppModel {
	var $useTable = 'comments';
	var $name = 'Comment';
}
?>