<?php
/* SVN FILE: $Id: flash.ctp 7344 2008-07-17 17:07:42Z mark_story $ */
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
 * @link			http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package		cake
 * @subpackage		cake.cake.libs.view.templates.layouts
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version		$Revision: 7344 $
 * @modifiedby		$LastChangedBy: mark_story $
 * @lastmodified	$Date: 2008-07-17 12:07:42 -0500 (Thu, 17 Jul 2008) $
 * @license		http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $html->charset(); ?>
<title><?php echo $page_title; ?></title>

<?php if (Configure::read() == 0) { ?>
<meta http-equiv="Refresh" content="<?php echo $pause; ?>;url=<?php echo $url; ?>"/>
<?php } ?>
<style><!--
P { text-align:center; font:bold 1.1em sans-serif }
A { color:#444; text-decoration:none }
A:HOVER { text-decoration: underline; color:#44E }
--></style>
</head>
<body>
<p><a href="<?php echo $url; ?>"><?php echo $message; ?></a></p>
</body>
</html>