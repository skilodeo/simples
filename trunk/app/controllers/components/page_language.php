<?php

	App::import('Model', 'Lang');
	
	class PageLanguageComponent extends Object {
		
		public $components = array('Session');
		
		public $lang;
		public $allLanguages;
		
		
		function initialize(&$controller) {
			$this->controller =& $controller;
		}
		
		/**
		 * Get all languages from db
		 * 
		 * @uses Lang
		 * @return array of all languages
		 */
		public function getAllLanguages() {
			if (!$this->Session->check('Page.Languages')) {
				/* Get from db and storen in session */
				$this->Lang =& new Lang();
				
				$dbLanguages = $this->Lang->find('all');
				
				$allLanguages = array();
				foreach ($dbLanguages AS $item) {
					$allLanguages[$item['Lang']['id']] = array(
						'name' => $item['Lang']['name'],
						'desc' => $item['Lang']['desc']
					);
				}
				
				$this->Session->write('Page.Languages', $allLanguages);
			} else {
				/* Retrieve from session */
				$allLanguages = $this->Session->read('Page.Languages');
			}
			
			return $allLanguages;
		}
		
		/**
		 * Get page language
		 * 
		 * @return string with page language
		 */
		public function getPageLanguage() {
			/* Get all languages */
			$this->allLanguages = $this->getAllLanguages();
			
			/* Get language */
			if (!empty($this->controller->params['lang'])) {
				/* From url */
				$this->lang = Sanitize::paranoid($this->controller->params['lang']);
			} else if ($this->Session->check('Config.language')) {
				/* From session */
				$this->lang = $this->Session->read('Config.language');
			}
			
			/* Validate language */
			if (!empty($this->lang)) {
				$valid = false;
				
				foreach ($this->allLanguages AS $key => $val) {
					if ($key == $this->lang) {
						$valid = true;
						break;
					}
				}
				
				if ($valid == false) {
					reset($this->allLanguages);
					$this->lang = key($this->allLanguages);
				}
			} else {
				reset($this->allLanguages);
				$this->lang = key($this->allLanguages);
			}
			
			return $this->lang;
		}
		
	}

?>