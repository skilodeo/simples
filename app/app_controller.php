<?php

	App::import('Core', 'Multibyte');
	App::import('Core', 'Sanitize');
	App::import('Vendor', 'Markdown');
	
	class AppController extends Controller {
		
		public $helpers = array('Html', 'Javascript', 'Form', 'List', 'Language');
		public $components = array('Session', 'PageLanguage', 'MenuStructure');
		
		
		/**
		 * Language and menu structure
		 */
		public function beforeFilter() {
			$this->pageLanguage();
			$this->menuStructure();
		}
		
		/**
		 * Handle current language
		 */
		private function pageLanguage() {
			$this->allLanguages = $this->PageLanguage->getAllLanguages();
			$this->lang = $this->PageLanguage->getPageLanguage();
			
			/* Write to session and model */
			$this->Session->write('Config.language', $this->lang);
			$this->{$this->modelClass}->lang = $this->lang;
			
			/* Set for view */
			$this->set('lang', $this->lang);
			$this->set('allLanguages', $this->allLanguages);
		}
		
		/**
		 * Get menu structure and pass it to view
		 */
		private function menuStructure() {
			$this->MenuStructure->lang = $this->lang;
			$this->set('menuStructure', $this->MenuStructure->getMenuStructure());
		}
		
	}

?>