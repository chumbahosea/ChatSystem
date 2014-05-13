<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class ThreadsController extends AppController {
	//var $helpers = array('Html','Form','Javascript','Ajax');

	public function index() {
		$this->set('threads', $this->Thread->find('all'));
		//$this->set('user_id',$this->Auth->user('id'));
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid thread'));
		}
		
		$thread = $this->Thread->findById($id);
		if (!$thread) {
			throw new NotFoundException(__('Invalid thread'));
		} else {
			$this->loadModel('Message');
			//$this->loadModel('User');
			$this->Message->find('all',array(
				'joins' => array(
					array(
						'table' => 'users',
						'alias' => 'UserJoin',
						'type' => 'INNER',
						'conditions' => array(
							'UserJoin.id = Message.user_id'	
						)
					)
				),
				'conditions' => array(
					'Message.thread_id' => $id
				),
				'fields' => array('UserJoin.*','Message.*'),
				'order' => 'Message.id ASC'
			));
			
			$message = $this->Message->findAllByThreadId($id,array(),array('Message.id' => 'asc'));
			
			$this->set('threads', $thread);
			$this->set('messages', $message);
			$this->set('user_id', $this->Auth->user('id'));
			
			//$this->layout = 'ajax';
			//$this->autoRender = false;
			if ($this->request->is('post')) {
				$this->Message->create();
				$this->request->data['Message']['user_id'] = $this->Auth->user('id');
				$this->request->data['Message']['thread_id'] = $thread['Thread']['id'];
				if ($this->Message->save($this->request->data)) {
					$this->Session->setFlash(__('Your message has been saved.'));
					//return $this->redirect($this->referer());
					return $this->redirect(array('action' => 'view',$thread['Thread']['id']));
				}
				$this->Session->setFlash(__('Unable to add your message.'));
			}
		}
		//$this->render('view','ajax');
	}	
	
	public function add() {
		if ($this->request->is('post')) {
			$this->Thread->create();
			$this->request->data['Thread']['user_id'] = $this->Auth->user('id');
			if ($this->Thread->save($this->request->data)) {
				$this->Session->setFlash(__('Your thread has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your thread.'));
		}
	}
	
	
	
	/*public function isAuthorized($user) {
		if($this->action === 'add') {
			return true;
		}
	
		if(in_array($this->action, array('edit','delete'))) {
			$postId = $this->request->params['pass'][0];
			if($this->Post->isOwnedBy($postID,$user['id'])) {
				return true;
			}
		}
		
		return parent::isAuthorized($user);
	}*/
	
}
