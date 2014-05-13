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
class MessagesController extends AppController {
	//public $helpers = array('Html','Form');
	
	public function add($threads=NULL) {
		if ($this->request->is('post')) {
			$this->Message->create();
			$this->request->data['Message']['user_id'] = $this->Auth->user('id');
			$this->loadModel('Thread');
			$this->request->data['Message']['thread_id'] = $threads;
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('Your message has been saved.'));
				return $this->redirect(array('controller' => 'threads','action' => 'view',$threads));
			}
			$this->Session->setFlash(__('Unable to add your message.'));
		}
	}
	
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid message'));
		}
		$message = $this->Message->findById($id);
		if (!$message) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('Your message has been updated.'));
				return $this->redirect(array('controller'=>'threads','action' => 'view',$message['Message']['thread_id']));
			}
			$this->Session->setFlash(__('Unable to update your message.'));
		}
		if (!$this->request->data) {
		$this->request->data = $message;
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$message = $this->Message->findById($id);
		if ($this->Message->delete($id)) {
			$this->Session->setFlash(__('The message with id: %s has been deleted.', h($id)));
		return $this->redirect(array('controller' => 'threads','action' => 'view',$message['Message']['thread_id']));
		}
	}
	
}
