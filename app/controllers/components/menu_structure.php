<?php

	App::import('Model', 'Menu');
	
	class MenuStructureComponent extends Object {
		
		public $lang;
		
		
		/**
		 * Get menu structure
		 *
		 * @uses Menu
		 * @return array with menu structure
		 */
		public function getMenuStructure() {
			$this->Menu =& new Menu();
			
			return $this->Menu->find('threaded', array(
				'fields' => array('id', 'parent_id', 'slug', 'name'),
				'conditions' => array('lang_id' => $this->lang),
				'recursive' => 1
			));
		}
		
	}

?>