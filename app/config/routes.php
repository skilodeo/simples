<?php
/* SVN FILE: $Id: routes.php 7690 2008-10-02 04:56:53Z nate $ */
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @subpackage		cake.app.config
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 7690 $
 * @modifiedby		$LastChangedBy: nate $
 * @lastmodified	$Date: 2008-10-02 00:56:53 -0400 (Thu, 02 Oct 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */

	/* Simples */
	Router::connect('/simples', array('plugin' => 'simples', 'controller' => 'myDashboard', 'action' => 'index'));
	Router::connect('/simples/:controller/:action/*', array('plugin' => 'simples'));
	
	/* Search */
	Router::connect('/search', array('controller' => 'search', 'action' => 'index'));
	
	/* Homepage */
	Router::connect('/', array('controller' => 'home', 'action' => 'index'));
	Router::connect('/:lang', array('controller' => 'home', 'action' => 'index'), array('lang' => '[a-z]{2}'));
	
	/* Products */
	$main = array('main' => 'produkte|products');
	Router::connect('/:main', array('controller' => 'products', 'action' => 'index'), $main);
	Router::connect('/:main/:by', array('controller' => 'products', 'action' => 'products_by'), $main);
	Router::connect('/:main/:by/:list', array('controller' => 'products', 'action' => 'product_list'), $main);
	Router::connect('/:main/:by/:list/:product', array('controller' => 'products', 'action' => 'product_details'), $main);
	
	/* Company */
	$main = array('main' => 'unternehmen|company');
	Router::connect('/:main', array('controller' => 'company', 'action' => 'index'), $main);
	Router::connect('/:main/:article', array('controller' => 'company', 'action' => 'article'), $main);
	
	/* Contact */
	$main = array('main' => 'kontakt|contact'); 
	Router::connect('/:main', array('controller' => 'contact', 'action' => 'index'), $main);
	Router::connect('/:main/:sub', array('controller' => 'contact', 'action' => 'personal'), array_merge($main, array('sub' => 'persoenlich|personal')));
	Router::connect('/:main/:sub', array('controller' => 'contact', 'action' => 'formular'), array_merge($main, array('sub' => 'formular|form')));
	Router::connect('/:main/:sub', array('controller' => 'contact', 'action' => 'imprint'), array_merge($main, array('sub' => 'impressum|imprint')));
	
//	Router::connect('/:main/:by/:list/:product',
//		array(
//			'controller' => 'products', 'action' => 'index',
//			'by' => null, 'list' => null, 'product' => null
//		),
//		array(
//			'main' => 'produkte|products'
//		)
//	);

/**
 * ...and connect the rest of 'Pages' controller's urls.
 */

//	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

?>