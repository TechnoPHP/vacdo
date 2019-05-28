<?php
App::uses('AppModel', 'Model');
/**
 * Postcoverimage Model
 *
 * @property Post $Post
 */
class Articlecoverimage extends AppModel {
	public $actsAs = array(
		'Uploader451.Attachment' => array(
			'image' => array(
				'nameCallback' => 'formatName',
				'append' => '',
				'prepend' => '',
				'tempDir' => TMP,
				'uploadDir' => 'files/uploads/postimages/',
				'finalPath' => '/files/uploads/postimages/',
				'dbColumn' => 'name',
				'metaColumns' => array(
					'ext' => 'extension',
					'type' => 'mimetype',
					'size' => 'filesize'
				),
				'defaultPath' => '',
				'overwrite' => true,
				'stopSave' => true,
				'allowEmpty' => true,
				'transforms' => array(
					'name' => array(
					'method' => 'resize', // or crop / AttachmentBehavior::CROP
					'append' => '-medium',
					'overwrite' => true,
					'self' => false,
					'width' => 390,
					'height' => 240,
					'aspect' =>true,
					'mode'=>'width',
					'quality' => 70,
					'dbColumn'=>'namemedium',
					'nameCallback' => 'transformNameCallback',
					),
					'imagesmall' => array(
					'method' => 'resize', // or crop / AttachmentBehavior::CROP
					'append' => '-small',
					'overwrite' => true,
					'self' => false,
					'width' => 175,
					'height' => 108,
					'aspect' =>true,
					'mode'=>'width',
					'quality' => 70,
					'dbColumn'=>'namesmall',
					'nameCallback' => 'transformNameCallback',
					),
					'imagesedium' => array(
					'method' => 'resize',
					'append' => '-big',
					'width' => 650,
					'height' => 400,
					'overwrite' =>true,
					'self' => false,
					'mode'=>'width',
					'aspect' => true,
					'dbColumn'=>'namebig',
					'quality' => 70,
					'mode'=>'height',
					'nameCallback' => 'transformNameCallback',
					)
				),
			)
		),
		'Uploader451.FileValidation' => array(
			'image' => array(
				'extension' => array('gif', 'jpg', 'png', 'jpeg'),
				'filesize' => 5242880 //5 Mb default
			)
		)
	);

	public function formatName($name, $file) {
		return sprintf('%s-%s', $name, $file->size());
	}
	public function transformNameCallback($name, $file) {
		return $this->getUploadedFile()->name();
	}
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'article_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
