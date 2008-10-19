<?php

	class Search extends AppModel {
		
		public $name = 'Search';
		public $useTable = false;
		
		
		/**
		 * Find products by search term
		 *
		 * @param string $needle
		 * @param int $maxResults
		 * @return array of search results
		 */
		public function findProducts($needle,$maxResults) {
			return $this->query
			("
				SELECT
					Page.name, Page.txt_short,
					Media.name
				FROM
					pages AS Page
				LEFT JOIN
					menus AS Menu ON (Menu.page_id = Page.id)
				LEFT JOIN
					media AS Media ON (Media.id = Page.img_preview)
				WHERE
					Menu.template_id = 'product'
				AND
					Page.lang_id = '".$this->lang."'
				AND
					(
							Menu.name LIKE '%".$needle."%'
						OR	Page.name LIKE '%".$needle."%'
						OR	MATCH (Page.txt_full) AGAINST ('".$needle."')
					)
				LIMIT
					".$maxResults."
			");
		}
		
	}

?>