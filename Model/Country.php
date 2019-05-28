<?php
App::uses('AppModel', 'Model');
/**
 * Country Model
 *
 * @property Zone $Zone
 * @property Buynsale $Buynsale
 * @property Eventsnshow $Eventsnshow
 */
class Country extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

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
	public $hasMany = array();

	function getshortname($countryid=null){
		if(!$countryid){
			
		}else{
			
			$short_name = $this->find('first',array('fields'=>array('iso_2'),'conditions'=>array('Country.id'=>$countryid)));
		}
		return $short_name;
	}
}