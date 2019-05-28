<?php
App::uses('Aro', 'AclManager.Model');

/**
 * Aro Test Case
 *
 */
class AroTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.acl_manager.aro',
		'plugin.acl_manager.aco',
		'plugin.acl_manager.permission',
		'plugin.acl_manager.aros_aco'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Aro = ClassRegistry::init('AclManager.Aro');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Aro);

		parent::tearDown();
	}

}
