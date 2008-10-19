<?php

	class MyPagesController extends SimplesAppController {
		
		public $name = 'MyPages';
		
		public $uses = array('Simples.MyPage');
		public $helpers = array('List', 'Common');
		public $components = array('FileHandler');
		
		private $pageId, $pageName, $pageList, $pageData;
		
		
		/**
		 * Get list of pages.
		 * 
		 * @uses MyPage
		 */
		public function index() {
			/* Get and set pageList */
			$this->pageList = $this->MyPage->find('all', array(
				'fields' => array('id', 'name'),
				'conditions' => array('lang_id' => $this->pageLanguage),
				'order' => 'name'
			));
			$this->set('pageList', $this->pageList);
		}
		
		/**
		 * Add page and redirect to edit.
		 * 
		 * @uses MyPage
		 */
		public function add() {
			if (!empty($this->params['form']['add'])) {
				/* Set page name and data array */
				$this->pageName = Sanitize::escape($this->params['form']['add']);
				$this->pageData = array('MyPage' => array('name' => $this->pageName));
				
				/* Save new page */
				if ($this->MyPage->save($this->pageData)) {
					/* Get id of new page */
					$this->pageId = $this->MyPage->getInsertID();
					
					/* Redirect to edit */
					if (!empty($this->pageId)) {
						$this->redirect('/simples/my_pages/edit/'.$this->pageId);
						exit;
					}
				}
			}
			
			$this->redirect('/simples/my_pages');
			exit;
		}
		
		/**
		 * Edit page.
		 * 
		 * @uses MyPage
		 */
		public function edit() {
			/* Get and set pageId or redirect to index */
			if (!empty($this->params['pass'][0])) {
				$this->pageId = $this->MyPage->id = Sanitize::escape($this->params['pass'][0]);
				$this->set('pageId', $this->pageId);
			} else {
				$this->redirect('/simples/my_pages');
				exit;
			}
			
			/* Get page data */
			$this->data = $this->MyPage->read();
			
			/* Get data of preview image and merge with data array */
			$imgPreview = $this->getImage($this->data['MyPage']['img_preview']);
			$this->data = array_merge($this->data, array('ImgPreview' => $imgPreview));
			
			/* Get data of main image(s) and merge with data array */
			$imgMain = $this->getImage($this->data['MyPage']['img_main']);
			$this->data = array_merge($this->data, array('ImgMain' => $imgMain));
		}
		
		/**
		 * Get image(s) by id.
		 * 
		 * @uses MyMedia
		 * @param string $imgId
		 * @return array of images
		 */
		private function getImage($imgId) {
			if (!empty($imgId)) {
				/* Explode imgId in case it's an array */
				$imgId = explode(',', $imgId);
				
				/* Return list of images */
				$this->MyMedia = ClassRegistry::init('Simples.MyMedia');
				return $this->MyMedia->find('all', array(
					'conditions' => array('id' => $imgId)
				));
			} else {
				return null;
			}
		}
		
		/**
		 * Delete page and return list of pages.
		 * 
		 * @uses MyPage
		 */
		public function del() {
			/* Explode string with ids to array and clean */
			$items = explode(',', $this->params['form']['items']);
			$items = Sanitize::clean($items);
			
			/* Delete all pages by array of ids */
			$this->MyPage->deleteAll(array('id' => $items), $cascade = false);
			
			/* Get and set pageList */
			$this->pageList = $this->MyPage->find('all', array(
				'fields' => array('id', 'name'),
				'conditions' => array('lang_id' => $this->pageLanguage),
				'order' => 'name'
			));
			$this->set('pageList', $this->pageList);
			
			$this->render('list');
		}
		
		/**
		 * Search for and return list of pages.
		 * 
		 * @uses MyPage
		 */
		public function search() {
			/* Get query */
			$query = Sanitize::escape($this->params['form']['query']);
			
			/* Get and set pageList */
			$this->pageList = $this->MyPage->find('all', array(
				'fields' => array('id', 'name'),
				'conditions' => array('name LIKE' => '%'.$query.'%', 'lang_id' => $this->pageLanguage), 
				'order' => 'name')
			);
			$this->set('pageList', $this->pageList);
			
			$this->render('list');
		}
		
	}

?>