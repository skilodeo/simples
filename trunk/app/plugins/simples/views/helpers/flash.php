<?php

	class FlashHelper extends Helper {
		
		public $helpers = array('Session');
		
		
		public function createFlashMessage() {
			$output = '';
			$type = null;
			
			if ($this->Session->check('Message.error')) {
				$type = 'error';
				$message = $this->Session->read('Message.error.message');
			} else if ($this->Session->check('Message.msg')) {
				$type = 'msg';
				$message = $this->Session->read('Message.msg.message');
			}
			
			if (!empty($type)) {
				$output .= '<div id="infobox" class="'.$type.'">';
					$output .= $message;
				$output .= '</div>';
			}
			
			return $output;
		}
		
	}

?>