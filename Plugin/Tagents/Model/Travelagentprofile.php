<?php
App::uses('AttachmentBehavior', 'Uploader.Model/Behavior');
App::uses('TagentsAppModel', 'Tagents.Model');
/**
 * Profile Model
 *
 * @property User $User
 */
class Travelagentprofile extends TagentsAppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'travelagent_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
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
	public $belongsTo = array(
		'Travelagent' => array(
			'className' => 'Travelagent',
			'foreignKey' => 'travelagent_id',
			
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public $actsAs = array(
		'Uploader.Attachment' => array(
			'image' => array(
				/*'nameCallback' => 'formatName',*/
				'append' => '',
				'prepend' => '',
				'tempDir' => TMP,
				'uploadDir' => 'files/uploads/agentimage/', //either write an absolute path
				'finalPath' => '/files/uploads/agentimage/',
				'dbColumn' => 'userimage',
				'metaColumns' => array(
					'ext' => 'extension',
					'type' => 'mimetype',
					'size' => 'filesize'
				),
				'defaultPath' => '',
				'overwrite' => false,
				'stopSave' => true,
				'allowEmpty' => true,
				'transforms' => array(
					'imageSmall' => array(
					'method' => 'crop', // or crop / AttachmentBehavior::CROP
					'append' => '-small',
					'overwrite' => true,
					'self' => false,
					'width' => 350,
					'height' => 250,
					'dbColumn'=>'userimage',
					'quality'=>70,
					'nameCallback' => 'transformNameCallback',
					)/*,
					'imageMedium' => array(
					'method' => 'resize',
					'append' => '-medium',
					'width' => 600,
					'height' => 500,
					'aspect' => false,
					'dbColumn'=>'namemedium'
					)*/
				),
				'transport' => array(
					'class' => AttachmentBehavior::S3,
					'accessKey' => '08DFA9E7XFP15T0S55R2',
					'secretKey' => 'o+2qK8Jnw22IS5yvLzYNXyCBwav1rn6LqCkNJ6v5',
					'bucket' => 'cbcdnbucket',
					'region' => Aws\Common\Enum\Region::US_WEST_2,
					'folder' => 'announce/users/',
					'acl'=> 'public-read',
				),
				'transportDir' => 'announce/users/',
				'returnUrl'=> true,
			)
		)
	);
	public function formatName($name, $file) {
		return sprintf('%s-%s', $name, $file->size());
	}
	public function transformNameCallback($name, $file) {
		return $this->getUploadedFile()->name();
	}
}
