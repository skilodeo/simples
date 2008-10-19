<?php

	class Menu extends AppModel {
		
		public $name = 'Menu';
		
		
		public function getProductList($id) {
			return $this->query('
				SELECT
					Menu.name, Menu.slug,
					Page.txt_short,
					Media.name
				FROM
					menus AS Menu
				LEFT JOIN
					pages AS Page ON (Menu.page_id = Page.id)
				LEFT JOIN
					media AS Media ON (Page.img_preview = Media.id)
				WHERE
					Menu.parent_id = "'.$id.'"
			');
		}
		
	}

?>