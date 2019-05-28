<?php
App::uses('TagentsAppModel', 'Tagents.Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Agent Model
 *
 * @property Group $Group
 * @property Post $Post
 */
class Travelagency extends TagentsAppModel {
	public $actsAs = array(
					//'Acl' => array('type' => 'requester', 'enabled' => false),
					'Tagents.Captcha' => array(
						'field' => array('security_code'),						
						'error' => 'Incorrect captcha code value'
					),
				);
	public $useTable = 'travelagencies';
	public $location;
    
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Agency name is mandatory',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			array(
				'rule' => '/^[a-z0-9 ]{3,}$/i',
				'message' => 'Only letters and digits'
			)
		),
		'city' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'City is mandatory',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
		
		
		'country_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Country is not being specified',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array();

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Travelagent' => array(
			'className' => 'Travelagent',
			'foreignKey' => 'travelagency_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		/*'Worker' => array(
			'className' => 'Worker',
			'foreignKey' => 'travelagency_id',
			'dependent' => true,
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
	/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		
	);
	
	
	public function phone($check) {
		if(is_array($check)) {$value = array_shift($check);} else { $value = $check; }
		if(strlen($value) == 0) {return true;}
		return preg_match('/^[0-9-+()# ]{6,23}+$/', $value);
	}
}
