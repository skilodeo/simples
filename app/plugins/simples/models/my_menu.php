<?php

	class MyMenu extends SimplesAppModel {
		
		public $name = 'MyMenu';
		public $useTable = 'menus';
		public $actsAs = array('Tree');
		
		
		public $validate = array(
			'name' => array(
				'rule' => array('minLength', 1),
				'message' => 'Dieses Feld ist ein Pflichtfeld.'
			),
			'slug' => array(
				'unique' => array(
					'rule' => array('isUniqueSlug'),
					'message' => 'Ein identischer Slug existiert bereits. Slugs müssen eindeutig sein.'
				),
				'chars' => array(
					'rule' => array('custom', '/[a-z0-9\-_]{1,}$/'),
					'message' => 'Dieses Feld darf weder Sonder- oder Leerzeichen, Umlaute oder Großbuchstaben beinhalten.'
				)
			)
		);
		
		public function isUniqueSlug($data) {
			$check = $this->find('count', array(
				'conditions' => array(
					'slug' => $data['slug'],
					'id <>' => $this->id
				)
			));
			
			if ($check > 0) {
				return false;
			} else {
				return true;
			}
		}
		
		public function beforeSave() {
			if (empty($this->id)) {
				/* Create slug for new menu item */
				$this->data['MyMenu']['slug'] = $this->getUniqueSlug($this->data['MyMenu']['name']);
				
				/* Set template id for new menu item */
				/* @todo improve template and rights management, to remove the next line */
				$this->data['MyMenu']['template_id'] = 'product';
			} else if (!empty($this->data['MyMenu']['slug'])) {
				/* @todo improve validation to not allow uppercase letters and this line is history */
				$this->data['MyMenu']['slug'] = $this->getSlug($this->data['MyMenu']['slug']);
			}
			
			if (!empty($this->data['MyMenu']['name'])) {
				/* Set lang id */
				$this->data['MyMenu']['lang_id'] = $this->pageLanguage;
				
				/* Set empty data to null */
				if (empty($this->data['MyMenu']['parent_id'])) { $this->data['MyMenu']['parent_id'] = null; }
				if (empty($this->data['MyMenu']['page_id'])) { $this->data['MyMenu']['page_id'] = null; }
				
				/* Additional data */ 
				$this->data['MyMenu']['modified_by'] = $this->userData['id'];
			}
			
			return true;
		}
		
		private function getUniqueSlug($slug) {
			$slug = $this->getSlug($slug);
			
			/* Check if the slug already exists */
			$check = $this->find('count', array(
				'conditions' => array('slug' => $slug)
			));
			
			/* Append a number if the slug already exists */
			$i = 2;
			while ($check > 0 && $i <= 5) {
				$newSlug = $slug.$i;
				$check = $this->find('count', array(
					'conditions' => array('slug' => $newSlug)
				));
				if ($check == 0) { $slug = $newSlug; }
				$i++;
			}
			
			/* Append timestamp if the slug still isn't unique */
			if ($check > 0) {
				$slug = $slug.time();
			}
			
			return $slug;
		}
		
		private function getSlug($slug) {
			$bad = array('Š','Ž','š','ž','Ÿ','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ',
			'Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','à','á','â','ã','ä','å','ç','è','é','ê',
			'ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ',
			'Þ','þ','Ð','ð','ß','Œ','œ','Æ','æ','µ',
			'-, ',' & ','- & ','»','«','"',"'",'„','“','”',"\n","\r");
			
			$good = array('S','Z','s','z','Y','A','A','A','A','Ae','A','C','E','E','E','E','I','I','I','I','N',
			'O','O','O','O','Oe','O','U','U','U','Ue','Y','a','a','a','a','ae','a','c','e','e','e',
			'e','i','i','i','i','n','o','o','o','o','oe','o','u','u','u','ue','y','y',
			'TH','th','DH','dh','ss','OE','oe','AE','ae','u',
			'-','-','-','','','','','','','','','');
			
			$slug = str_replace($bad, $good, $slug);
			$slug = trim($slug);
			
			$bad_reg = array('/\s+/','/[^A-Za-z0-9\-_]/');
			$good_reg = array('-','');
			$slug = preg_replace($bad_reg, $good_reg, $slug);
			
			$slug = strtolower($slug);
			
			return $slug;
		}
		
	}

?>