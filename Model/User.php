<?php
App::uses('AppModel', 'Model');
App::uses('CakeEvent', 'Event');//using for the event-driven programming
/**
 * User Model
 *
 * @property Group $Group
 * @property Order $Order
 * @property Profile $Profile
 * @property Store $Store
 */
class User extends AppModel {

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
        return true;
    }
	
	public function afterSave($created, $options = array()) {
		//$created returns true if it inserts new row
		if($created){
			$link = $this->_confurl();
			$encryptconfirm = $this->_base64url_encode($this->_aes_encrypt($this->data['User']['confirmkey']));
			$eventregister = new CakeEvent('Model.User.userRegistered', $this, array(
				'user' => $this->data['User'],
				'link'=> $link.'/vacdo/users/register/'.$encryptconfirm
				)
			);
			$this->getEventManager()->dispatch($eventregister);
		}
	}
	
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'firstname' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'notEmpty' => array(
				'rule' => array('notBlank'),
				'message' => 'Provide an email address'
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Email Id is not correct',
				//'allowEmpty' => false,
				'required' => false,
				'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Email Id is already registered',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'phone' => array(
			'notBlank'=>array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
			'phone'=>array(
				'rule' => array('minLength',10),
				'message' => 'Start with area code to phone',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		'password'=>array(
			'notBlank'=>array(
				'rule' => array('notBlank'),
				'message' => 'Password can not leave blank',
				//'required'=>true,
				//'allowEmpty'=>false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength'=>array(
				'rule'=>array('minLength',6),
				//'required'=>true,
				//'allowEmpty'=>false,
				'message'=>'Please enter min 6 character Password',
				//'on' => 'create'
				),
			'identical'=>array(
				'rule' => array('identicalFieldValues', 'confirmpassword' ),
				'message' => 'Passwords does not match',
				//'on' => 'create'
				)
		),
		'confrimpassword'=>array(
			'notBlank'=>array(
				'rule' => array('notBlank'),
				'message' => 'Your custom message here',
				//'required'=>true,
				//'allowEmpty'=>false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength'=>array(
				'rule'=>array('minLength',6),
				//'required'=>true,
				//'allowEmpty'=>false,
				'message'=>'Please retype your Password',
				//'on' => 'create'
			),
			'identical'=>array(
				'rule' => array('identicalFieldValues', 'password'),
				'message' => 'Passwords does not match',
				//'on' => 'create'
			)
		),

	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public $hasAndBelongsToMany = array( /*used for wishlist*/
		/*'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)*/
	);
	public $hasOne = array(
		'Profile' => array(
			'className' => 'Profile',
			'foreignKey' => 'user_id',
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
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		
		/*
		'Deliveryaddress' => array(
			'className' => 'Deliveryaddress',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)*/
	);
	
	public function beforeValidate($options = array()) {
		parent::beforeValidate($options);
	}
	
	function identicalFieldValues( $field=array(), $compare_field=null ){
		foreach( $field as $key => $value ){
		$v1 = $value;
		$v2 = $this->data[$this->name][ $compare_field ];

			if($v1 !== $v2) { 
				return FALSE;
			} else {
				continue;
			}
		}
        	return TRUE;
	}
}
