<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class Message extends AppModel {
	public $belongsTo = 'User'; 
	public $validate = array(
		'content' => array(
			'rule' => 'notEmpty'
		)
 );
 
 /*public function isOwnedBy($post, $user) {
	return $this->field('id', array('id' => 'post', 'user_id' => $user)) === $post;
 }*/
}
