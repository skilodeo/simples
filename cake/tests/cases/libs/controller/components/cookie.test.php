<?php
/* SVN FILE: $Id: cookie.test.php 7715 2008-10-09 02:35:33Z mark_story $ */
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
 * @subpackage		cake.tests.cases.libs.controller.components
 * @since			CakePHP(tm) v 1.2.0.5435
 * @version			$Revision: 7715 $
 * @modifiedby		$LastChangedBy: mark_story $
 * @lastmodified	$Date: 2008-10-08 21:35:33 -0500 (Wed, 08 Oct 2008) $
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
App::import('Core', array('Component', 'Controller', 'Cookie'));
class CookieComponentTestController extends Controller {
	var $components = array('Cookie');

	function beforeFilter() {
		$this->Cookie->name = 'CakeTestCookie';
		$this->Cookie->time = 10;
		$this->Cookie->path = '/';
		$this->Cookie->domain = '';
		$this->Cookie->secure = false;
		$this->Cookie->key = 'somerandomhaskey';
	}
}
/**
 * Short description for class.
 *
 * @package    cake.tests
 * @subpackage cake.tests.cases.libs.controller.components
 */
class CookieComponentTest extends CakeTestCase {
	var $Controller;

	function __encrypt($value) {
		if (is_array($value)) {
			$value = $this->__implode($value);
		}
		return "Q2FrZQ==." .base64_encode(Security::cipher($value, $this->Controller->Cookie->key));
	}


	function __implode($array) {
		$string = '';
		foreach ($array as $key => $value) {
			$string .= ',' . $key . '|' . $value;
		}
		return substr($string, 1);
	}
/**
 * start
 *
 * @access public
 * @return void
 */
	function start() {
		$this->Controller = new CookieComponentTestController();
		$this->Controller->constructClasses();
		$this->Controller->Component->initialize($this->Controller);
		$this->Controller->beforeFilter();
		$this->Controller->Component->startup($this->Controller);
		$this->Controller->Cookie->destroy();
	}
/**
 * testCookieName
 *
 * @access public
 * @return void
 */
	function testCookieName() {
		$this->assertEqual($this->Controller->Cookie->name, 'CakeTestCookie');
	}
/**
 * testSettingEncryptedCookieData
 *
 * @access public
 * @return void
 */
	function testSettingEncryptedCookieData() {
		$this->Controller->Cookie->write('Encrytped_array', array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!'));
		$this->Controller->Cookie->write('Encrytped_multi_cookies.name', 'CakePHP');
		$this->Controller->Cookie->write('Encrytped_multi_cookies.version', '1.2.0.x');
		$this->Controller->Cookie->write('Encrytped_multi_cookies.tag', 'CakePHP Rocks!');
	}
/**
 * testReadEncryptedCookieData
 *
 * @access public
 * @return void
 */
	function testReadEncryptedCookieData() {
		$data = $this->Controller->Cookie->read('Encrytped_array');
		$expected = array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Encrytped_multi_cookies');
		$expected = array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);
	}
/**
 * testSettingPlainCookieData
 *
 * @access public
 * @return void
 */
	function testSettingPlainCookieData() {
		$this->Controller->Cookie->write('Plain_array', array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!'), false);
		$this->Controller->Cookie->write('Plain_multi_cookies.name', 'CakePHP', false);
		$this->Controller->Cookie->write('Plain_multi_cookies.version', '1.2.0.x', false);
		$this->Controller->Cookie->write('Plain_multi_cookies.tag', 'CakePHP Rocks!', false);
	}
/**
 * testReadPlainCookieData
 *
 * @access public
 * @return void
 */
	function testReadPlainCookieData() {
		$data = $this->Controller->Cookie->read('Plain_array');
		$expected = array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_multi_cookies');
		$expected = array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);
	}
/**
 * testWritePlainCookieArray
 *
 * @access public
 * @return void
 */
	function testWritePlainCookieArray() {
		$this->Controller->Cookie->write(array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' => 'CakePHP Rocks!'), null, false);

		$this->assertEqual($this->Controller->Cookie->read('name'), 'CakePHP');
		$this->assertEqual($this->Controller->Cookie->read('version'), '1.2.0.x');
		$this->assertEqual($this->Controller->Cookie->read('tag'), 'CakePHP Rocks!');

		$this->Controller->Cookie->del('name');
		$this->Controller->Cookie->del('version');
		$this->Controller->Cookie->del('tag');
	}
/**
 * testReadingCookieValue
 *
 * @access public
 * @return void
 */
	function testReadingCookieValue() {
		$data = $this->Controller->Cookie->read();
		$expected = array(
			'Encrytped_array' => array(
				'name' => 'CakePHP',
				'version' => '1.2.0.x',
				'tag' => 'CakePHP Rocks!'),
			'Encrytped_multi_cookies' => array(
				'name' => 'CakePHP',
				'version' => '1.2.0.x',
				'tag' => 'CakePHP Rocks!'),
			'Plain_array' => array(
				'name' => 'CakePHP',
				'version' => '1.2.0.x',
				'tag' => 'CakePHP Rocks!'),
			'Plain_multi_cookies' => array(
				'name' => 'CakePHP',
				'version' => '1.2.0.x',
				'tag' => 'CakePHP Rocks!'));
		$this->assertEqual($data, $expected);
	}
/**
 * testDeleteCookieValue
 *
 * @access public
 * @return void
 */
	function testDeleteCookieValue() {
		$this->Controller->Cookie->del('Encrytped_multi_cookies.name');
		$data = $this->Controller->Cookie->read('Encrytped_multi_cookies');
		$expected = array('version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);

		$this->Controller->Cookie->del('Encrytped_array');
		$data = $this->Controller->Cookie->read('Encrytped_array');
		$expected = array();
		$this->assertEqual($data, $expected);

		$this->Controller->Cookie->del('Plain_multi_cookies.name');
		$data = $this->Controller->Cookie->read('Plain_multi_cookies');
		$expected = array('version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);

		$this->Controller->Cookie->del('Plain_array');
		$data = $this->Controller->Cookie->read('Plain_array');
		$expected = array();
		$this->assertEqual($data, $expected);
	}
/**
 * testSettingCookiesWithArray
 *
 * @access public
 * @return void
 */
	function testSettingCookiesWithArray() {
		$this->Controller->Cookie->destroy();

		$this->Controller->Cookie->write(array('Encrytped_array' => array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!')));
		$this->Controller->Cookie->write(array('Encrytped_multi_cookies.name' => 'CakePHP'));
		$this->Controller->Cookie->write(array('Encrytped_multi_cookies.version' => '1.2.0.x'));
		$this->Controller->Cookie->write(array('Encrytped_multi_cookies.tag' => 'CakePHP Rocks!'));

		$this->Controller->Cookie->write(array('Plain_array' => array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!')), null, false);
		$this->Controller->Cookie->write(array('Plain_multi_cookies.name' => 'CakePHP'), null, false);
		$this->Controller->Cookie->write(array('Plain_multi_cookies.version' => '1.2.0.x'), null, false);
		$this->Controller->Cookie->write(array('Plain_multi_cookies.tag' => 'CakePHP Rocks!'), null, false);
	}
/**
 * testReadingCookieArray
 *
 * @access public
 * @return void
 */
	function testReadingCookieArray() {
		$data = $this->Controller->Cookie->read('Encrytped_array.name');
		$expected = 'CakePHP';
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Encrytped_array.version');
		$expected = '1.2.0.x';
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Encrytped_array.tag');
		$expected = 'CakePHP Rocks!';
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Encrytped_multi_cookies.name');
		$expected = 'CakePHP';
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Encrytped_multi_cookies.version');
		$expected = '1.2.0.x';
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Encrytped_multi_cookies.tag');
		$expected = 'CakePHP Rocks!';
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_array.name');
		$expected = 'CakePHP';
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_array.version');
		$expected = '1.2.0.x';
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_array.tag');
		$expected = 'CakePHP Rocks!';
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_multi_cookies.name');
		$expected = 'CakePHP';
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_multi_cookies.version');
		$expected = '1.2.0.x';
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_multi_cookies.tag');
		$expected = 'CakePHP Rocks!';
		$this->assertEqual($data, $expected);
	}
/**
 * testReadingCookieDataOnStartup
 *
 * @access public
 * @return void
 */
	function testReadingCookieDataOnStartup() {
		$this->Controller->Cookie->destroy();

		$data = $this->Controller->Cookie->read('Encrytped_array');
		$expected = array();
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Encrytped_multi_cookies');
		$expected = array();
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_array');
		$expected = array();
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_multi_cookies');
		$expected = array();
		$this->assertEqual($data, $expected);

		$_COOKIE['CakeTestCookie'] = array(
				'Encrytped_array' => $this->__encrypt(array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!')),
				'Encrytped_multi_cookies' => array(
						'name' => $this->__encrypt('CakePHP'),
						'version' => $this->__encrypt('1.2.0.x'),
						'tag' => $this->__encrypt('CakePHP Rocks!')),
				'Plain_array' => 'name|CakePHP,version|1.2.0.x,tag|CakePHP Rocks!',
				'Plain_multi_cookies' => array(
						'name' => 'CakePHP',
						'version' => '1.2.0.x',
						'tag' => 'CakePHP Rocks!'));
		$this->Controller->Cookie->startup();

		$data = $this->Controller->Cookie->read('Encrytped_array');
		$expected = array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Encrytped_multi_cookies');
		$expected = array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_array');
		$expected = array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_multi_cookies');
		$expected = array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);
		$this->Controller->Cookie->destroy();
		unset($_COOKIE['CakeTestCookie']);
	}
/**
 * testReadingCookieDataWithoutStartup
 *
 * @access public
 * @return void
 */
	function testReadingCookieDataWithoutStartup() {
		$data = $this->Controller->Cookie->read('Encrytped_array');
		$expected = array();
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Encrytped_multi_cookies');
		$expected = array();
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_array');
		$expected = array();
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_multi_cookies');
		$expected = array();
		$this->assertEqual($data, $expected);

		$_COOKIE['CakeTestCookie'] = array(
				'Encrytped_array' => $this->__encrypt(array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!')),
				'Encrytped_multi_cookies' => array(
						'name' => $this->__encrypt('CakePHP'),
						'version' => $this->__encrypt('1.2.0.x'),
						'tag' => $this->__encrypt('CakePHP Rocks!')),
				'Plain_array' => 'name|CakePHP,version|1.2.0.x,tag|CakePHP Rocks!',
				'Plain_multi_cookies' => array(
						'name' => 'CakePHP',
						'version' => '1.2.0.x',
						'tag' => 'CakePHP Rocks!'));

		$data = $this->Controller->Cookie->read('Encrytped_array');
		$expected = array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Encrytped_multi_cookies');
		$expected = array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_array');
		$expected = array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);

		$data = $this->Controller->Cookie->read('Plain_multi_cookies');
		$expected = array('name' => 'CakePHP', 'version' => '1.2.0.x', 'tag' =>'CakePHP Rocks!');
		$this->assertEqual($data, $expected);
		$this->Controller->Cookie->destroy();
		unset($_COOKIE['CakeTestCookie']);
	}
/**
 * end
 *
 * @access public
 * @return void
 */
	function end() {
		$this->Controller->Cookie->destroy();
	}
}
?>