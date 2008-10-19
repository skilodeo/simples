<?php

	class ProductsController extends AppController {
		
		public $name = 'Products';
		public $uses = array('Page', 'Menu', 'Media');
		
		
		public function index() {
			$this->redirect('/');
			exit;
		}
		
		public function products_by() {
			if (!empty($this->params['by'])) {
				$slug = $this->params['by'];
				
				/* Get menu id and this pages first child */
				$menuId = $this->Menu->field('id', array('slug' => $slug));
				$firstChild = $this->Menu->field('slug', array('parent_id' => $menuId));
				
				if (!empty($firstChild)) {
					/* Set list param and proceed with product_list() */
					$this->params['list'] = $firstChild;
					$this->product_list();
				} else {
					/* Menu item does not have any children */
					$this->render('no_list');
				}
			} else {
				$this->redirect('/');
				exit;
			}
		}
		
		public function product_list() {
			$slug = $this->params['list'];
			
			/* Get menu data */
			$menuData = $this->Menu->find('first', array(
				'conditions' => array('slug' => $slug)
			));
			
			/* Get submenu */
			$submenu = $this->Menu->find('all', array(
				'fields' => array('slug', 'name'),
				'conditions' => array('parent_id' => $menuData['Menu']['parent_id'])
			));
			
			/* Get list of products */
			$productList = $this->Menu->getProductList($menuData['Menu']['id']);
			
			/* Set variables for view */
			$this->set('submenu', $submenu);
			$this->set('productList', $productList);
			
			$this->set('paramMain', $this->params['main']);
			$this->set('paramBy', $this->params['by']);
			$this->set('paramList', $this->params['list']);
			
			$this->render('product_list');
		}
		
		public function product_details() {
			$slug = $this->params['product'];
			
			/* Get page id */
			$pageId = $this->Menu->field('page_id', array('slug' => $slug));
			
			/* Get product data */
			$productData = $this->Page->find('first', array(
				'fields' => array('name', 'img_main', 'txt_full'),
				'conditions' => array('id' => $pageId)
			));
			
			/* Get image data */
			$imageIds = explode(',', $productData['Page']['img_main']);
			$imageData = $this->Media->find('all', array(
				'fields' => array('name'),
				'conditions' => array('id' => $imageIds)
			));
			
			/* Set variables for view */
			$this->set('productData', $productData);
			$this->set('imageData', $imageData);
			
			$this->set('paramMain', $this->params['main']);
			$this->set('paramBy', $this->params['by']);
			$this->set('paramList', $this->params['list']);
		}
		
	}

?>