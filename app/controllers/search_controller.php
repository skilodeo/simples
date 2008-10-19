<?php

	class SearchController extends AppController {
		
		public $name = 'Search';
		
		
    	public function index() {
			$this->set('pageKey', 'search');
			$whitelist = array('Suche …', 'Search …');
			
			if (!empty($this->params['form']['search'])) {
				$needle = Sanitize::paranoid($this->params['form']['search'], array(' '));
				
				$this->set('needle', $needle);
				$this->set('results', $this->Search->findProducts($needle,20));
			} else {
				$this->redirect('/');
				exit;
			}
    	}
		
	}

?>