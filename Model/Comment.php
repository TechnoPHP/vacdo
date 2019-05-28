<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property Post $Post
 * @property User $User
 */
class Comment extends AppModel {
	public $actsAs = array(
		'Tree',
		'Captcha.Captcha' => 
		array(
			'field' => array('scode'),
			'error' => 'Incorrect captcha code value'
		)
	);
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'article_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'message' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'firstname' => array(
			array(
				'rule' => array('checkfirstname'),
				'message' => 'Firstname contains only alphabets and space'
			)
		),
		'email_address' => array(
			array(
				'rule' => array('checkemailaddress'),
				'message' => 'Vefiy email address input'
			)
		),
		'message' => array(
			array(
				'rule' => array('minlength','20'),
				'message' => 'Describe your message bit'
			)
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(	
		'ParentComment' => array(
			'className' => 'Comment',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'article_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache'=>true
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
		'ChildComment' => array(
			'className' => 'Comment',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	public function checkfirstname(){
		if(empty($this->request->data['Comment']['user_id'])){
			if(strlen($this->data['Comment']['firstname']) < 4){
				return false;
			}
			if (!preg_match('/^[a-zA-Z0-9 ]+$/',$this->data['Comment']['firstname'])){
				return false;
			}
		}
		return true;
	}
	
	public function checkemailaddress() {
		if(empty($this->request->data['Comment']['user_id'])){
			if(strlen($this->data['Comment']['email_address']) < 6){
				return false;
			}
			if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $this->data['Comment']['email_address'])){
				return true;
			}else{
				return false;		
			}
		}
	}
}
