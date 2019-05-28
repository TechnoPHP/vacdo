<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Admin Model
 *
 * @property Group $Group
 */
class Admin extends AppModel {
	public $actsAs = array('Acl' => array('type' => 'requester','enabled'=>false));
	
	public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['Admin']['admingroup_id'])) {
            $groupId = $this->data['Admin']['admingroup_id'];
        } else {
            $groupId = $this->field('admingroup_id');
        }
        if (!$groupId) {
            return null;
        }
        return array('Admingroup' => array('id' => $groupId));
    }
	
	public function bindNode($user){
		return array('model'=>'Admingroup','foreign_key'=>$user['Admin']['admingroup_id']);
	}
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data['Admin']['password'] = AuthComponent::password($this->data['Admin']['password']);
		}
        return true;
    }
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'admingroup_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
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
		'email_address' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'phone' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Admingroup' => array(
			'className' => 'Admingroup',
			'foreignKey' => 'admingroup_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public $hasOne = array(
		'Adminprofile' => array(
			'className' => 'Adminprofile',
			'foreignKey' => 'admin_id',
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
}
