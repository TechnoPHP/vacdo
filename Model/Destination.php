<?php
App::uses('AppModel', 'Model');
App::uses('AttachmentBehavior', 'Uploader451.Model/Behavior');
/**
 * Category Model
 *
 * @property Category $ParentCategory
 * @property Category $ChildCategory
 * @property Product $Product
 */
class Destination extends AppModel {

	public $actsAs = array('Tags.Taggable','Feedback.Rated',
	
		'Uploader451.Attachment' => array(
			'image' => array(
				'nameCallback' => 'formatName',
				'append' => '',
				'prepend' => '',
				'tempDir' => TMP,
				'uploadDir' => 'files/uploads/destinations/',
				'finalPath' => '/files/uploads/destinations/',
				'dbColumn' => 'imagename', //this will store the default image path and name
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
					'dbColumn'=>'namesmall', //this will store transformed path and name
					'nameCallback' => 'transformNameCallback',
					),
					'imagemedium' => array(
					'method' => 'resize', // or crop / AttachmentBehavior::CROP
					'append' => '-medium',
					'overwrite' => true,
					'self' => false,
					'width' => 390,
					'height' => 240,
					'aspect' =>true,
					'mode'=>'width',
					'quality' => 70,
					'dbColumn'=>'image', //this will store transformed path and name
					'nameCallback' => 'transformNameCallback',
					),
					'imagebig' => array(
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

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		/*
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'destination_id',
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
		'Package' => array(
			'className' => 'Package',
			'foreignKey' => 'destination_id',
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
		'Place' => array(
			'className' => 'Place',
			'foreignKey' => 'destination_id',
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
	public function formatName($name, $file) {
		return sprintf('%s-%s', $name, $file->size());
	}
	public function transformNameCallback($name, $file) {
		return $this->getUploadedFile()->name();
	}
}
