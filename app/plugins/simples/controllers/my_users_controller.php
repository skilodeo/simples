<?php

	class MyUsersController extends SimplesAppController {
		
		public $name = 'MyUsers';
		
		public $uses = array('Simples.MyUser');
		
		
		/**
		 * Authenticate user login.
		 * 
		 * @uses MyUser
		 */
		public function login() {
			if (!empty($this->data)) {
				/* Clean data, then prepend salt to password and crypt using sha1 */
				$this->data['MyUser'] = Sanitize::clean($this->data['MyUser']);
				$this->data['MyUser']['password'] = sha1(Configure::read('Security.salt').$this->data['MyUser']['password']);
				
				$user = $this->MyUser->find(array(
					'username' => $this->data['MyUser']['username'],
					'password' => $this->data['MyUser']['password']
				));
				
				/* Check if authentication was succesful and redirect */
				if (!empty($user)) {
					$this->Session->write('User', $user['MyUser']);
					
					$this->redirect('/simples/my_dashboard');
					exit();
				} else {
					$this->Session->setFlash('Authentifizierung fehlgeschlagen.', null, array(), 'error');
				}
			}
			
			$this->layout = 'login';
		}
		
		/**
		 * Clear session data and redirect to login.
		 */
		public function logout() {
			if ($this->Session->valid())
			{
				$this->Session->destroy('user');
				$this->Session->destroy();
			}
			
			$this->redirect('/simples/my_users/login');
			exit;
		}
		
	}

?>