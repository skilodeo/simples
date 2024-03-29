<?php
/* SVN FILE: $Id: i18n.php 7754 2008-10-16 05:16:00Z phpnut $ */
/**
 * Short description for file.
 *
 * Long description for file
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
 * @since			CakePHP(tm) v 1.2.0.4116
 * @version			$Revision: 7754 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-10-16 00:16:00 -0500 (Thu, 16 Oct 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Included libraries.
 */
App::import('Core', 'l10n');
/**
 * Short description for file.
 *
 * Long description for file
 *
 * @package		cake
 * @subpackage	cake.cake.libs
 */
class I18n extends Object {
/**
 * Instance of the I10n class for localization
 *
 * @var object
 * @access public
 */
	var $l10n = null;
/**
 * Current domain of translation
 *
 * @var string
 * @access public
 */
	var $domain = null;
/**
 * Current category of translation
 *
 * @var string
 * @access public
 */
	var $category = 'LC_MESSAGES';
/**
 * Current language used for translations
 *
 * @var string
 * @access private;
 */
	var $__lang = null;
/**
 * Translation strings for a specific domain read from the .mo or .po files
 *
 * @var array
 * @access private
 */
	var $__domains = array();
/**
 * Set to true when I18N::__bindTextDomain() is called for the first time.
 * If a translation file is found it is set to false again
 *
 * @var boolean
 * @access private
 */
	var $__noLocale = false;
/**
 * Determine if $__domains cache should be wrote
 *
 * @var boolean
 * @access private
 */
	var $__cache = false;
/**
 * Set to true when I18N::__bindTextDomain() is called for the first time.
 * If a translation file is found it is set to false again
 *
 * @var array
 * @access private
 */
	var $__categories = array('LC_CTYPE', 'LC_NUMERIC', 'LC_TIME', 'LC_COLLATE', 'LC_MONETARY', 'LC_MESSAGES', 'LC_ALL');
/**
 * Return a static instance of the I18n class
 *
 * @return object I18n
 * @access public
 */
	function &getInstance() {
		static $instance = array();
		if (!$instance) {
			$instance[0] =& new I18n();
			$instance[0]->l10n =& new L10n();
		}
		return $instance[0];
	}
/**
 * Used by the translation functions in basics.php
 * Can also be used like I18n::translate(); but only if the uses('i18n'); has been used to load the class.
 *
 * @param string $singular String to translate
 * @param string $plural Plural string (if any)
 * @param string $domain Domain
 * @param string $category Category
 * @param integer $count Count
 * @return string translated strings.
 * @access public
 */
	function translate($singular, $plural = null, $domain = null, $category = null, $count = null) {
		$_this =& I18n::getInstance();

		if (is_numeric($category)) {
			$_this->category = $_this->__categories[$category];
		}
		$language = Configure::read('Config.language');

		if (!empty($_SESSION['Config']['language'])) {
			$language = $_SESSION['Config']['language'];
		}

		if (($_this->__lang && $_this->__lang !== $language) || !$_this->__lang) {
			$lang = $_this->l10n->get($language);
			$_this->__lang = $lang;
		}

		if (is_null($domain)) {
			$domain = 'default';
		}
		$_this->domain = $domain . '_' . $_this->l10n->locale;

		if (empty($_this->__domains)) {
			$_this->__domains = Cache::read($_this->domain, '_cake_core_');
		}

		if (!isset($_this->__domains[$_this->category][$_this->__lang][$domain])) {
			$_this->__bindTextDomain($domain);
			$_this->__cache = true;
		}

		if (!isset($count)) {
			$plurals = 0;
		} elseif (!empty($_this->__domains[$_this->category][$_this->__lang][$domain]["%plural-c"]) && $_this->__noLocale === false) {
			$header = $_this->__domains[$_this->category][$_this->__lang][$domain]["%plural-c"];
			$plurals = $_this->__pluralGuess($header, $count);
		} else {
			if ($count != 1) {
				$plurals = 1;
			} else {
				$plurals = 0;
			}
		}

		if (!empty($_this->__domains[$_this->category][$_this->__lang][$domain][$singular])) {
			if (($trans = $_this->__domains[$_this->category][$_this->__lang][$domain][$singular]) || ($plurals) && ($trans = $_this->__domains[$_this->category][$_this->__lang][$domain][$plural])) {
				if (is_array($trans)) {
					if (isset($trans[$plurals])) {
						$trans = $trans[$plurals];
					}
				}
				if (strlen($trans)) {
					$singular = $trans;
					return $singular;
				}
			}
		}

		if (!empty($plurals)) {
			return($plural);
		}
		return($singular);
	}
/**
 * Attempts to find the plural form of a string.
 *
 * @param string $header Type
 * @param integrer $n Number
 * @return integer plural match
 * @access private
 */
	function __pluralGuess($header, $n) {
		if (!is_string($header) || $header === "nplurals=1;plural=0;" || !isset($header[0])) {
			return 0;
		}

		if ($header === "nplurals=2;plural=n!=1;") {
			return $n != 1 ? 1 : 0;
		} elseif ($header === "nplurals=2;plural=n>1;") {
			return $n > 1 ? 1 : 0;
		}

		if (strpos($header, "plurals=3")) {
			if (strpos($header, "100!=11")) {
				if (strpos($header, "10<=4")) {
					return $n % 10 === 1 && $n % 100 !== 11 ? 0 : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? 1 : 2);
				} elseif (strpos($header, "100<10")) {
					return $n % 10 === 1 && $n % 100 !== 11 ? 0 : ($n % 10 >= 2 && ($n % 100 < 10 || $n % 100 >= 20) ? 1 : 2);
				}
				return $n % 10 == 1 && $n % 100 != 11 ? 0 : ($n != 0 ? 1 : 2);
			} elseif (strpos($header, "n==2")) {
				return $n === 1 ? 0 : ($n === 2 ? 1 : 2);
			} elseif (strpos($header, "n==0")) {
				return $n === 1 ? 0 : ($n === 0 || ($n % 100 > 0 && $n % 100 < 20) ? 1 : 2);
			} elseif (strpos($header, "n>=2")) {
				return $n === 1 ? 0 : ($n >= 2 && $n <= 4 ? 1 : 2);
			} elseif (strpos($header, "10>=2")) {
				return $n === 1 ? 0 : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? 1 : 2);
			}
			return $n % 10 === 1 ? 0 : ($n % 10 === 2 ? 1 : 2);
		} elseif (strpos($header, "plurals=4")) {
			if (strpos($header, "100==2")) {
				return $n % 100 === 1 ? 0 : ($n % 100 === 2 ? 1 : ($n % 100 === 3 || $n % 100 === 4 ? 2 : 3));
			} elseif (strpos($header, "n>=3")) {
				return $n === 1 ? 0 : ($n === 2 ? 1 : ($n == 0 || ($n >= 3 && $n <= 10) ? 2 : 3));
			} elseif (strpos($header, "100>=1")) {
				return $n === 1 ? 0 : ($n == 0 || ($n % 100 >= 1 && $n % 100 <= 10) ? 1 : ($n % 100 >= 11 && $n % 100 <= 20 ? 2 : 3));
			}
		} elseif (strpos($header, "plurals=5")) {
			return $n === 1 ? 0 : ($n === 2 ? 1 : ($n >= 3 && $n <= 6 ? 2 : ($n >= 7 && $n <= 10 ? 3 : 4)));
		}
	}
/**
 * Binds the given domain to a file in the specified directory.
 *
 * @param string $domain Domain to bind
 * @return string Domain binded
 * @access private
 */
	function __bindTextDomain($domain) {
		$this->__noLocale = true;
		$core = true;
		$merge = array();
		$searchPaths = Configure::read('localePaths');
		$plugins = Configure::listObjects('plugin');

		if (!empty($plugins)) {
			$pluginPaths = Configure::read('pluginPaths');

			foreach ($plugins as $plugin) {
				$plugin = Inflector::underscore($plugin);
				if ($plugin === $domain) {
					foreach ($pluginPaths as $pluginPath) {
						$searchPaths[] = $pluginPath . DS . $plugin . DS . 'locale';
					}
					$searchPaths = array_reverse($searchPaths);
					break;
				}
			}
		}

		foreach ($searchPaths as $directory) {
			foreach ($this->l10n->languagePath as $lang) {
				$file = $directory . DS . $lang . DS . $this->category . DS . $domain;

				if ($core) {
					$app = $directory . DS . $lang . DS . $this->category . DS . 'core';
					if (file_exists($fn = "$app.mo")) {
						$this->__loadMo($fn, $domain);
						$this->__noLocale = false;
						$merge[$this->category][$this->__lang][$domain] = $this->__domains[$this->category][$this->__lang][$domain];
						$core = null;
					} elseif (file_exists($fn = "$app.po") && ($f = fopen($fn, "r"))) {
						$this->__loadPo($f, $domain);
						$this->__noLocale = false;
						$merge[$this->category][$this->__lang][$domain] = $this->__domains[$this->category][$this->__lang][$domain];
						$core = null;
					}
				}

				if (file_exists($fn = "$file.mo")) {
					$this->__loadMo($fn, $domain);
					$this->__noLocale = false;
					break 2;
				} elseif (file_exists($fn = "$file.po") && ($f = fopen($fn, "r"))) {
					$this->__loadPo($f, $domain);
					$this->__noLocale = false;
					break 2;
				}
			}
		}

		if (empty($this->__domains[$this->category][$this->__lang][$domain])) {
			$this->__domains[$this->category][$this->__lang][$domain] = array();
			return($domain);
		}

		if ($head = $this->__domains[$this->category][$this->__lang][$domain][""]) {
			foreach (explode("\n", $head) as $line) {
				$header = strtok($line,":");
				$line = trim(strtok("\n"));
				$this->__domains[$this->category][$this->__lang][$domain]["%po-header"][strtolower($header)] = $line;
			}

			if (isset($this->__domains[$this->category][$this->__lang][$domain]["%po-header"]["plural-forms"])) {
				$switch = preg_replace("/(?:[() {}\\[\\]^\\s*\\]]+)/", "", $this->__domains[$this->category][$this->__lang][$domain]["%po-header"]["plural-forms"]);
				$this->__domains[$this->category][$this->__lang][$domain]["%plural-c"] = $switch;
				unset($this->__domains[$this->category][$this->__lang][$domain]["%po-header"]);
			}
			$this->__domains = Set::pushDiff($this->__domains, $merge);

			if (isset($this->__domains[$this->category][$this->__lang][$domain][null])) {
				unset($this->__domains[$this->category][$this->__lang][$domain][null]);
			}
		}
		return($domain);
	}
/**
 * Loads the binary .mo file for translation and sets the values for this translation in the var I18n::__domains
 *
 * @param resource $file Binary .mo file to load
 * @param string $domain Domain where to load file in
 * @access private
 */
	function __loadMo($file, $domain) {
		$data = file_get_contents($file);

		if ($data) {
			$header = substr($data, 0, 20);
			$header = unpack("L1magic/L1version/L1count/L1o_msg/L1o_trn", $header);
			extract($header);

			if ((dechex($magic) == '950412de' || dechex($magic) == 'ffffffff950412de') && $version == 0) {
				for ($n = 0; $n < $count; $n++) {
					$r = unpack("L1len/L1offs", substr($data, $o_msg + $n * 8, 8));
					$msgid = substr($data, $r["offs"], $r["len"]);
					unset($msgid_plural);

					if (strpos($msgid, "\000")) {
						list($msgid, $msgid_plural) = explode("\000", $msgid);
					}
					$r = unpack("L1len/L1offs", substr($data, $o_trn + $n * 8, 8));
					$msgstr = substr($data, $r["offs"], $r["len"]);

					if (strpos($msgstr, "\000")) {
						$msgstr = explode("\000", $msgstr);
					}
					$this->__domains[$this->category][$this->__lang][$domain][$msgid] = $msgstr;

					if (isset($msgid_plural)) {
						$this->__domains[$this->category][$this->__lang][$domain][$msgid_plural] =& $this->__domains[$this->category][$this->__lang][$domain][$msgid];
					}
				}
			}
		}
	}
/**
 * Loads the text .po file for translation and sets the values for this translation in the var I18n::__domains
 *
 * @param resource $file Text .po file to load
 * @param string $domain Domain to load file in
 * @return array Binded domain elements
 * @access private
 */
	function __loadPo($file, $domain) {
		$type = 0;
		$translations = array();
		$translationKey = "";
		$plural = 0;
		$header = "";

		do {
			$line = trim(fgets($file, 1024));
			if ($line == "" || $line[0] == "#") {
				continue;
			}
			if (preg_match("/msgid[[:space:]]+\"(.+)\"$/i", $line, $regs)) {
				$type = 1;
				$translationKey = stripcslashes($regs[1]);
			} elseif (preg_match("/msgid[[:space:]]+\"\"$/i", $line, $regs)) {
				$type = 2;
				$translationKey = "";
			} elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && ($type == 1 || $type == 2 || $type == 3)) {
				$type = 3;
				$translationKey .= stripcslashes($regs[1]);
			} elseif (preg_match("/msgstr[[:space:]]+\"(.+)\"$/i", $line, $regs) && ($type == 1 || $type == 3) && $translationKey) {
				$translations[$translationKey] = stripcslashes($regs[1]);
				$type = 4;
			} elseif (preg_match("/msgstr[[:space:]]+\"\"$/i", $line, $regs) && ($type == 1 || $type == 3) && $translationKey) {
				$type = 4;
				$translations[$translationKey] = "";
			} elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && $type == 4 && $translationKey) {
				$translations[$translationKey] .= stripcslashes($regs[1]);
			} elseif (preg_match("/msgid_plural[[:space:]]+\".*\"$/i", $line, $regs)) {
				$type = 6;
			} elseif (preg_match("/msgstr\[(\d+)\][[:space:]]+\"(.+)\"$/i", $line, $regs) && ($type == 6) && $translationKey) {
				$plural = $regs[1];
				$translations[$translationKey][$plural] = stripcslashes($regs[2]);
				$type = 6;
			} elseif (preg_match("/msgstr\[(\d+)\][[:space:]]+\"\"$/i", $line, $regs) && ($type == 6) && $translationKey) {
				$plural = $regs[1];
				$translations[$translationKey][$plural] = "";
				$type = 6;
			} elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && $type == 6 && $translationKey) {
				unset($translations[$translationKey]);
				$type = 0;
				$translationKey = "";
				$plural = 0;
			} elseif (preg_match("/msgstr[[:space:]]+\"(.+)\"$/i", $line, $regs) && $type == 2 && !$translationKey) {
				$header .= stripcslashes($regs[1]);
				$type = 5;
			} elseif (preg_match("/msgstr[[:space:]]+\"\"$/i", $line, $regs) && !$translationKey) {
				$header = "";
				$type = 5;
			} elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && $type == 5) {
				$header .= stripcslashes($regs[1]);
			} else {
				unset($translations[$translationKey]);
				$type = 0;
				$translationKey = "";
				$plural = 0;
			}
		} while (!feof($file));
		fclose($file);
		$merge[""] = $header;
		return $this->__domains[$this->category][$this->__lang][$domain] = array_merge($merge ,$translations);
	}
/**
 * Object destructor
 *
 * Write cache file if changes have been made to the $__map or $__paths
 * @access private
 */
	function __destruct() {
		if ($this->__cache) {
			Cache::write($this->domain, array_filter($this->__domains), '_cake_core_');
		}
	}
}
?>