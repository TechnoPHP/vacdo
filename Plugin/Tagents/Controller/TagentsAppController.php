<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('AppController', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class TagentsAppController extends AppController {
		
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
		$this->Auth->authenticate = array(
			'Form' => array(
				'userModel'=>'Tagents.Travelagent',
				'fields' => array(
					'username'=>'email_address',
					'password'=>'password'
				),
			)
		);
		AuthComponent::$sessionKey = 'Auth.Travelagent';
		if(isset($this->params['prefix']) && ($this->params['prefix']=='admin')){
			$this->layout = 'Tagents.admin';
        }
		$this->Auth->loginAction = array('plugin'=>'tagents','controller' => 'travelagents','action' => 'login');      
        $this->Auth->loginRedirect = array('plugin'=>'tagents','controller' => 'travelagents','action' => 'dashboard','admin'=>false );  
		$this->Auth->logoutRedirect = array('plugin'=>false,'controller' => 'pages','action'=>'display','admin'=>false );
		//$this->_list_countries(); //defined in AppController.php
	}
	
}
