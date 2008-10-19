<?php

	class MyPage extends SimplesAppModel {
		
		public $name = 'MyPage';
		public $useTable = 'pages';
		
		public $validate = array(
			'name' => array(
				'rule' => array('minLength', 1),
				'message' => 'Dieses Feld ist ein Pflichtfeld.'
			)
		);
		
		
		public function beforeSave() {
			/* Set langId */
			$this->data['MyPage']['lang_id'] = $this->pageLanguage;
			
			/* Additional data */ 
			$this->data['MyPage']['modified_by'] = $this->userData['id'];
			
			return true;
		}
		
	}

?>