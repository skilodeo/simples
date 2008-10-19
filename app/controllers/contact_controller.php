<?php

	class ContactController extends AppController {
		
		public $name = 'Contact';
		public $uses = array('Page', 'Menu');
		
		
		public function index() {
			$this->redirect('/');
			exit;
		}
		
		public function personal() {
			$this->render('placeholder');
		}
		
		public function formular() {
			$this->render('placeholder');
		}
		
		public function imprint() {
			$this->render('placeholder');
		}
		
	}

?>