<?php
/* SVN FILE: $Id: category_thread_fixture.php 7126 2008-06-05 15:20:45Z AD7six $ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <https://trac.cakephp.org/wiki/Developement/TestSuite>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package			cake.tests
 * @subpackage		cake.tests.fixtures
 * @since			CakePHP(tm) v 1.2.0.4667
 * @version			$Revision: 7126 $
 * @modifiedby		$LastChangedBy: AD7six $
 * @lastmodified	$Date: 2008-06-05 10:20:45 -0500 (Thu, 05 Jun 2008) $
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
/**
 * Short description for class.
 *
 * @package		cake.tests
 * @subpackage	cake.tests.fixtures
 */
class CategoryThreadFixture extends CakeTestFixture {
/**
 * name property
 * 
 * @var string 'CategoryThread'
 * @access public
 */
	var $name = 'CategoryThread';
/**
 * fields property
 * 
 * @var array
 * @access public
 */
	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => false),
		'name' => array('type' => 'string', 'null' => false),
		'created' => 'datetime',
		'updated' => 'datetime'
	);
/**
 * records property
 * 
 * @var array
 * @access public
 */
	var $records = array(
		array('parent_id' => 0, 'name' => 'Category 1', 'created' => '2007-03-18 15:30:23', 'updated' => '2007-03-18 15:32:31'),
		array('parent_id' => 1, 'name' => 'Category 1.1', 'created' => '2007-03-18 15:30:23', 'updated' => '2007-03-18 15:32:31'),
		array('parent_id' => 2, 'name' => 'Category 1.1.1', 'created' => '2007-03-18 15:30:23', 'updated' => '2007-03-18 15:32:31'),
		array('parent_id' => 3, 'name' => 'Category 1.1.2', 'created' => '2007-03-18 15:30:23', 'updated' => '2007-03-18 15:32:31'),
		array('parent_id' => 4, 'name' => 'Category 1.1.1.1', 'created' => '2007-03-18 15:30:23', 'updated' => '2007-03-18 15:32:31'),
		array('parent_id' => 5, 'name' => 'Category 2', 'created' => '2007-03-18 15:30:23', 'updated' => '2007-03-18 15:32:31'),
		array('parent_id' => 6, 'name' => 'Category 2.1', 'created' => '2007-03-18 15:30:23', 'updated' => '2007-03-18 15:32:31')
	);
}

?>
