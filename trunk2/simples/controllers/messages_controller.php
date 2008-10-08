<?php
class MessagesController extends AppController {

	public $components = array('Email', 'RequestHandler');
	public $helpers = array('List', 'Text', 'Time');
	public $uses = array('Message', 'Page');
	public $paginate = array(
        'order' => 'created DESC',
        'limit' => 25
	);
	
	function admin_index() {
	    $messages = $this->paginate('Message');
	    $this->set(compact('messages'));
	}
	
	function admin_view($id = null) {
	    $message = $this->Message->findById($id);
	    $this->set(compact('message'));
	}
	
	function beforeRender() {
		parent::beforeRender();
		$this->params['current']['body_class'] = 'contact-page';
	}
	
    function create() {
    	if ($this->Message->save($this->data)) {
    		// @TODO: Akismet validation in model
    		$this->Email->to = Configure::read('AppSettings.contact_email');
    		$this->Email->from = $this->data['Message']['email'];
    		$this->Email->replyTo = $this->data['Message']['email'];
    		$this->Email->subject = Configure::read('AppSettings.site_name') . ' contact form';
    		$this->Email->sendAs = 'text';
    		$this->Email->template = 'contact_form';
    		
    		$this->set('message', $this->data['Message']['content']);
    		$this->set('phone', isset($this->data['Message']['phone']) ? $this->data['Message']['phone'] : '');

    		$this->Email->delivery = Configure::read('AppSettings.email_delivery');
    		if ($this->Email->delivery == 'smtp') {
        		$this->Email->smtpOptions = array(
                    'username' => Configure::read('AppSettings.smtp_username'),
                    'password' => Configure::read('AppSettings.smtp_password'),
                    'host' => Configure::read('AppSettings.smtp_server'),
        		    'port' => 25, // @TODO add port to settings
        		    'timeout' => 30
        		);
    		}
    		
    		if ($this->Email->send()) {
    			$message = 'Your message has been succesfuly sent. Thanks!';
    		} else {
    			$message = "A problem occured. Your message has not been send. Sorry!";
    		}

    		if ($this->RequestHandler->isAjax()) {
    			$this->set('message', $message);
    			return $this->render('message');
    		} else {
    			$this->Session->setFlash($message);
    			$this->redirect('/contact');
    		}
    	} else {
    		$this->populateContactPage();
    		$this->render('contact');
    	}
    }
    
    function index() {
        $this->populateContactPage();
        $this->render('contact');
    }
    
    function populateContactPage() {
    	$page = $this->Page->findBySlug('contact');
        $this->set('page', $page);
        // @TODO: Unify parameters
        $this->params['Simples']['view']['isPage'] = true;
        $this->params['Simples']['page']['slug'] = $page['Page']['slug'];
        $this->params['current']['slug'] = $page['Page']['slug'];
        $this->pageTitle = 'Contact';
        $this->params['breadcrumb'][] = array('title' => 'Contact');
    }
    
}
