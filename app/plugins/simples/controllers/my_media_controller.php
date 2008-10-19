<?php

	class MyMediaController extends SimplesAppController {
		
		public $name = 'MyMedia';
		
		public $uses = array('Simples.MyMedia');
		
		private $pageId, $imageType;
		
		
		/**
		 * Get and set page id and image type and continue with upload.
		 */
		public function upload_for_page() {
			/* Get page id and image type */
			$this->pageId = Sanitize::escape($this->params['pass'][0]);
			$this->imageType = Sanitize::escape($this->params['pass'][1]);
			
			$this->upload();
		}
		
		/**
		 * Upload a file to the server.
		 * 
		 * @uses MyMedia
		 */
		public function upload() {
			
			
			$this->render('upload');
		}
		
	}

?>