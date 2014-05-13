<?php
App::uses('SimplePasswordHasher','Controller/Component/Auth');

class User extends AppModel {
	public $hasMany = array(
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'user_id'
		)
	);
	
			
	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
				)
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			)
		),
		'password_confirm' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please confirm your password'
			),
			'equaltofield' => array(
				'rule' => array('equaltofield','password'),
				'message' => 'Both passwords must match'
			)
		)
	
	);
	
	public function beforeSave($options = array()) {
		if(isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new SimplePasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher -> hash(
				$this ->data[$this->alias]['password']
			);
		}
		return true;
	}
	
}

