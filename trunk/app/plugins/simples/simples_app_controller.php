<?php

	App::import('Core', 'Multibyte');
	App::import('Core', 'Sanitize');
	
	class SimplesAppController extends AppController {
		
		public $uses = array('Simples.Lang');
		public $helpers = array('Html', 'Ajax', 'Javascript', 'Form', 'Session', 'Flash');
		public $components = array('RequestHandler');
		
		public $pageLanguage;
		
		
		public function beforeFilter() {
			/* Set app language and domain for i18n */ 
			Configure::write('Config.language', 'de'); 
			$this->set('domain', 'simples');
			
			$this->authenticate();
			$this->getUserData();
			$this->getPageLanguage();
		}
		
		/**
		 * Basic user authentication
		 */
		private function authenticate()
		{
			if ($this->action != 'login' && $this->action != 'logout')
			{
				if (!$this->Session->check('User'))
				{
					$this->redirect('/simples/my_users/logout');
					exit;
				}
			}
		}
		
		/**
		 * Set user data in controller, model and view
		 */
		private function getUserData() {
			/* Get user data from session */
			$this->userData = $this->Session->read('User');
			
			/* Set user data in model and view */
			$this->{$this->modelClass}->userData = $this->userData;
			$this->set('userData', $this->userData);
		}
		
		/**
		 * Get page language for multilingual websites
		 */
		private function getPageLanguage() {
			if (!empty($this->params['form']['pageLanguage'])) {
				/* From formular */
				$this->pageLanguage = $this->params['form']['pageLanguage'];
			} else {
				if ($this->Session->check('Settings.pageLanguage')) {
					/* From session */
					$this->pageLanguage = $this->Session->read('Settings.pageLanguage');
				} else {
					/* From database */
					$this->pageLanguage = $this->Lang->field('id', false, 'id');
				}
			}
			
			/* Set page language in session, model and view */
			$this->Session->write('Settings.pageLanguage', $this->pageLanguage);
			$this->{$this->modelClass}->pageLanguage = $this->pageLanguage;
			$this->set('pageLanguage', $this->pageLanguage);
		}
		
	}

?>