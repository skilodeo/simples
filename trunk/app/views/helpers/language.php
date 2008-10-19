<?php

	class LanguageHelper extends Helper {
		
		public $helpers = array('Html');
		
		
		public function createLangLink($lang,$allLanguages) {
			/* Go through all languages and find one that's not the current one */
			foreach ($allLanguages AS $key => $val) {
				if ($key != $lang) {
					return $this->Html->link($val['name'], '/'.$key, array('title' => $val['desc'], 'class' => 'lang'));
				}
			}
		}
		
	}

?>