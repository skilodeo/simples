<?php
/* SVN FILE: $Id: sequencial_nocache.ctp 7702 2008-10-05 00:19:25Z phpnut $ */
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
 * @subpackage		cake.cake.libs.view.templates.pages
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 7702 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-10-04 19:19:25 -0500 (Sat, 04 Oct 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<h1>Content</h1>
<cake:nocache>
	<p>D. In View File</p>
	<?php $this->log('4. in view file') ?>
</cake:nocache>
