<?php

	class MyMenusController extends SimplesAppController {
		
		public $name = 'MyMenus';
		
		public $uses = array('Simples.MyMenu');
		public $helpers = array('List', 'Common');
		
		private $menuId, $menuName, $menuList, $menuData;
		private $pageList;
		
		
		/**
		 * Get list of menu items.
		 */
		public function index() {
			/* Get list of menu items */
			$this->menuList = $this->getThreadedList();
			$this->set('menuList', $this->menuList);
		}
		
		/**
		 * Add menu item.
		 */
		public function add() {
			if (!empty($this->params['form']['add'])) {
				/* Get menu item name and data */
				$this->menuName = Sanitize::escape($this->params['form']['add']);
				$this->menuData = array('MyMenu' => array('name' => $this->menuName));
				
				/* Save new menu item */
				if ($this->MyMenu->save($this->menuData)) {
					/* Get id of new menu item */
					$this->menuId = $this->MyMenu->getInsertID();
					
					/* Redirect to edit */
					if (!empty($this->menuId)) {
						$this->redirect('/simples/my_menus/edit/'.$this->menuId);
						exit;
					}
				}
			}
			
			$this->redirect('/simples/my_menus');
			exit;
		}
		
		/**
		 * Edit menu item.
		 */
		public function edit() {
			/* Get id of menu item */
			if (!empty($this->params['pass'][0])) {
				$this->menuId = $this->MyMenu->id = Sanitize::escape($this->params['pass'][0]);
				$this->set('menuId', $this->menuId);
			} else {
				$this->redirect('/simples/my_menus');
				exit;
			}
			
			/* Get list of menu items */
			$this->menuList = $this->MyMenu->generatetreelist(
				array('lang_id' => $this->pageLanguage, 'id <>' => $this->menuId), null, null, '&nbsp;&nbsp;&nbsp;&nbsp;'
			);
			$this->set('menuList', $this->menuList);
			
			/* Get list of pages */
			$this->MyPage = ClassRegistry::init('Simples.MyPage');
			$this->pageList = $this->MyPage->find('list', array(
				'fields' => array('id', 'name'),
				'conditions' => array('lang_id' => $this->pageLanguage)
			));
			$this->set('pageList', $this->pageList);
			
			/* Get list of templates */
			$this->MyTemplate = ClassRegistry::init('Simples.MyTemplate');
			$this->templateList = $this->MyTemplate->find('list', array(
				'fields' => array('id', 'name')
			));
			$this->set('templateList', $this->templateList);
			
			if (empty($this->data)) {
				/* Get data */
				$this->data = $this->MyMenu->read();
			} else {
				/* Save data */
				if ($this->MyMenu->save($this->data)) {
					$this->data = $this->MyMenu->read();
				}
			}
		}
		
		/**
		 * Remove menu item(s) from tree (ajax).
		 */
		public function del() {
			if (!empty($this->params['form']['items'])) {
				/* Convert string with ids to array */
				$allIds = explode(',', $this->params['form']['items']);
				$allIds = Sanitize::clean($allIds);
				
				/* Remove menu item(s) from tree */
				/* @todo Check if this could be done with a single method call/db request instead */
				foreach ($allIds AS $id) {
					$this->MyMenu->removefromtree($id, true);
				}
			}
			
			/* Get list of menu items */
			$this->menuList = $this->getThreadedList();
			$this->set('menuList', $this->menuList);
			
			$this->render('list');
		}
		
		/**.
		 * Move menu item up or down (ajax).
		 */
		public function move() {
			if (!empty($this->params['pass'][0]) && !empty($this->params['pass'][1])) {
				/* Get move direction and id of menu item */
				$moveDir = Sanitize::escape($this->params['pass'][0]);
				$this->menuId = Sanitize::escape($this->params['pass'][1]);
				
				/* Move menu item up oder down */
				if ($moveDir == 'up') {
					$this->MyMenu->moveup($this->menuId, 1);
				} else if ($moveDir == 'down') {
					$this->MyMenu->movedown($this->menuId, 1);
				}
			}
			
			/* Get list of menu items */
			$this->menuList = $this->getThreadedList();
			$this->set('menuList', $this->menuList);
			
			$this->render('list');
		}
		
		/**
		 * Toggle publish shatus (ajax).
		 */
		public function publish() {
			if (!empty($this->params['pass'][0])) {
				/* Get id of menu item */
				$this->menuId = $this->MyMenu->id = Sanitize::escape($this->params['pass'][0]);
				
				/* Get current publish status */
				$publish = $this->MyMenu->field('publish', array('id' => $this->menuId));
				
				/* Set new publish status */
				if ($publish == 0) {
					$togglePublish = array('MyMenu' => array('publish' => 1));
				} else if ($publish == 1) {
					$togglePublish = array('MyMenu' => array('publish' => 0));
				}
				$this->MyMenu->save($togglePublish);
			}
			
			/* Get list of menu items */
			$this->menuList = $this->getThreadedList();
			$this->set('menuList', $this->menuList);
			
			$this->render('list');
		}
		
		/**
		 * Search for menu item(s) (ajax).
		 */
		public function search() {
			if (!empty($this->params['form']['query'])) {
				/* Get query */
				$query = Sanitize::escape($this->params['form']['query']);
			
				/* Get list of menu items filtered by query */
				$this->menuList = $this->getThreadedList($query);
			} else {
				/* Get list of menu items */
				$this->menuList = $this->getThreadedList();
			}
			$this->set('menuList', $this->menuList);
			
			$this->render('list');
		}
		
		/**
		 * Get threaded list of menu items.
		 * Optionally filtered by search query.
		 */
		public function getThreadedList($query=null) {
			if (!empty($query)) {
				$search = array('name LIKE' => '%'.$query.'%');
			} else {
				$search = array();
			}
			
			return $this->MyMenu->find('threaded', array(
				'fields' => array('id', 'parent_id', 'name', 'publish'),
				'conditions' => array_merge(array('lang_id' => $this->pageLanguage), $search),
				'order' => 'lft'
			));
		}
		
	}

?>