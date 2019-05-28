<?php
App::uses('Aco', 'AclManager.Model');

/**
 * Aco Test Case
 *
 */
class AcoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.acl_manager.aco',
		'plugin.acl_manager.aro',
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
		$this->Aco = ClassRegistry::init('AclManager.Aco');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Aco);

		parent::tearDown();
	}

}
