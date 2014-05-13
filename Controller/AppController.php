<?php
class AppController extends Controller {
	public $helpers = array('Js' => array('Jquery'));
	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array(
				'controller' => 'threads',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'login',
				'home'
			)
		),
		//'authorize' => array('Controller') 
	);
	
	public function beforeFilter() {
		$this->Auth->allow('login');
	}
	
	public function isAuthorized($user) {
	
	}
}
