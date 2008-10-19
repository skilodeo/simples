<?php

	class HomeController extends AppController {
		
		public $name = 'Home';
		public $uses = null;
		
		function index() {
			$this->pageTitle = '';
		}
		
	}

?>