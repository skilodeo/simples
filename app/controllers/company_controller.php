<?php

	class CompanyController extends AppController {
		
		public $name = 'Company';
		public $uses = array('Page', 'Menu');
		
		
		public function index() {
			$this->redirect('/');
			exit;
		}
		
		public function article() {
			if (!empty($this->params['article'])) {
				$slug = $this->params['article'];
				
				/* Get page id */
				$pageId = $this->Menu->field('page_id', array('slug' => $slug));
				
				/* Get page data */
				$pageData = $this->Page->find('first', array(
					'conditions' => array('id' => $pageId)
				));
				
				/* Set variables for view */
				$this->set('pageTitle', $pageData['Page']['name']);
				$this->set('pageText', $pageData['Page']['txt_full']);
			} else {
				$this->redirect('/');
				exit;
			}
		}
		
	}

?>