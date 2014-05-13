<?php
class UsersController extends AppController {
	//public $helpers = array('Html','Form');
	//public $component = array('Session');
	
	public function beforeFilter() {
		parent:: beforeFilter();
		$this->Auth->allow('signup','logout');
	}

	public function index() {
		$this->User->recursive =0;
		$this->set('users',$this->paginate());
	}
	
	public function login() {
		if($this->Session->check('Auth.User')) {
			$this->redirect(array('controller' => 'threads', 'action' => 'index'));
		}
		if($this->request->is('post')) {
			if($this->Auth->login()) {
				$this->Session->setFlash(__('Welcome '.$this->Auth->user('username')));
				return $this->redirect($this->Auth->redirect());//array('controller' => 'posts', 'action' => 'index'));
			}
			$this->Session->setFlash(__('Invalid username or password, try again'));
		}
	}
	
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
	
	public function signup() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Your account has been added.'));
				return $this->redirect(array('action' => 'login'));
			}
			$this->Session->setFlash(__('Unable to create new account'));
		}
	}
	/*public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('post', $post);
	}	
	
	public function add() {
		if ($this->request->is('post')) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('Your post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your post.'));
		}
	}*/
}
