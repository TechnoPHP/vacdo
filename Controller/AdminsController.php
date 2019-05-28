<?php
App::uses('AppController', 'Controller');
/**
 * Admins Controller
 *
 * @property Admin $Admin
 * @property PaginatorComponent $Paginator
 */
class AdminsController extends AppController {

	
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Flash',
	'Auth' => array(
        'loginAction' => array('plugin'=>null,'controller'=>'admins','action'=>'login','admin'=>true),
        'authError' => 'Did you really think you are allowed to see that?',
        'authenticate' => array(
            'Form' => array(
                'fields' => array(
                  'username' => 'email_address', //Default is 'username' in the userModel
                  'password' => 'password'  //Default is 'password' in the userModel
                ),
				'userModel' => 'Admin'
            )
        ),
		/*'authorize' => array(
			'controller',
			'Actions' => array('actionPath' => 'controllers/', 'userModel' => 'Admin'),
        ),*/
    )
	);
	private function __allowedcountries(){
		
		
		
	}
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('admin_login','admin_logout');
		//$this->Auth->allow();
		AuthComponent::$sessionKey = 'Auth.Admin';

		$this->Auth->authenticate = array(
			'Form' => array(
				'fields' => array('username'=>'email_address','password'=>'password'),
				'userModel' => 'Admin'
			)
		);
		$this->Auth->authorize = array(
			AuthComponent::ALL => array('actionPath' => 'controllers/', 'userModel' => 'Admin'),
			'Actions',
			'Controller'
		);
		$this->layout='admin';
		$this->Auth->loginAction = array('plugin'=>null,'controller' => 'admins','action' => 'login','admin'=>true);
        $this->Auth->loginRedirect = array('plugin'=>null,'controller' => 'admins','action' => 'dashboard','admin'=>true );  
		$this->Auth->logoutRedirect = array('plugin'=>null,'controller' => 'admins','action' => 'login','admin'=>true );

		$this->set('masterclass','');
		$this->set('dashboardclass','');
		$this->set('aclclass','');
		$this->set('usersclass','active');
	}
	public function isAuthorized($user = null) {
		return parent::isAuthorized($user);
	}

	public function admin_create() {
		if ($this->request->is(array('post','put'))) {
			//pr($this->request->data);exit;
			$this->Admin->create();
			
			if ($this->Admin->save($this->request->data)) {
				return $this->redirect(array('controller'=>'admins','action' => 'index','admin'=>false));
			}else{
				return $this->redirect(array('controller'=>'admins','action' => 'login','admin'=>false));
			}
		}
		$admingroups = $this->Admin->Admingroup->find('list');
		$this->set(compact('admingroups'));
	}
	
	public function admin_login() {
		if ($this->request->is(array('post','put'))) {
				
			if ($this->Auth->login()) {
				$this->Admin->id = $this->Session->read("Auth.Admin.id");
				$this->Admin->saveField('lastlogin', date('Y-m-d H:i:s') );
				
				return $this->redirect( $this->Auth->loginRedirect);
				
			}
			$this->Session->setFlash(__('Your username or password is incorrect.'));
		}
		//pr($this->Session->read('Auth.User'));exit;
		if ($this->Session->read('Auth.Admin')) {
			$this->Session->setFlash('You ADMIN logged in!','default',['class'=>'alert alert-success']);
			return $this->redirect(array('plugin'=>null,'controller' => 'admins','action' => 'dashboard','admin'=>true ));
		}
	}
	function admin_logout(){
    		$this->Session->delete('Auth.Admin');
    		$this->redirect($this->Auth->logoutRedirect);
	}
	function _profile($userid=null){
		$conditions = array("Admin.id"=>$userid);
		$fields = array("Admin.id","Admin.firstname","Admin.lastname","Admin.phone","Admin.email_address","Adminprofile.admin_id","Adminprofile.id","Adminprofile.messanger","Adminprofile.msgtype","Adminprofile.aboutme","Adminprofile.userimage","Adminprofile.quotes");
		return $currentuser = $this->Admin->find('first',
			array(
				'conditions'=>$conditions,
				'fields'=>$fields,
				'contain' => array('Adminprofile')
				)
			);
	}
	function admin_dashboard($userid=null){
	/*	if(!$userid){
			if(!$this->Session->check('Auth.Admin.id')){
				throw new NotFoundException(__('Your identity does not match with the system'));
			}else{
				$userid = $this->Session->read('Auth.Admin.id');
			}			
		}else{
			if(!$this->Admin->exists($userid)){
				throw new NotFoundException(__('No such profile exists with the system'));
			}
		}
		$this->Admin->Behaviors->load('Containable');
		$currentuser = $this->_profile($userid);
		//pr($currentuser);exit;
		$this->set('currentuser', $currentuser);*/
		$this->_latest_destinations();
	}
	
	public function admin_changepassword() {
		if ($this->request->is(array('post', 'put'))) {
			if (!$current_password = $this->request->data['Admin']['currentpassword']) {
				throw new NotFoundException(__('Enter your current password with the site'));
			}
			//pr($this->request->data);exit;
			if(!$this->Session->check("Auth.Admin.id")){
				$this->Session->setFlash('Session seems expired!! Please login and reset your password');
				$this->redirect(array('controller'=>'admins','action'=>'login','admin'=>true));
				exit;
			}else{
				$this->Admin->id = $this->Session->read("Auth.Admin.id");
				if (!$this->Admin->exists()) {
					throw new NotFoundException(__('Password reset request is invalid'));
				}
				$this->Admin->unbindModel(array("hasOne"=>array("Profile"),"hasMany"=>array("Buynsale","Bscomment")));
				$admin = $this->Admin->find('first',array("conditions"=>array("Admin.id"=>$this->Admin->id)));
				$current_password = AuthComponent::password($this->request->data['Admin']['currentpassword']);
			//pr($admin);exit;
								
				if($current_password == $admin['Admin']['password']){
					if($this->Admin->save($this->request->data,true,array('password'))){
						$this->Session->setFlash('Your new password is set with the system.');
						$this->redirect(array('controller'=>'admins','action'=>'changepassword','admin'=>true));
						exit;
					}else{
					//pr($this->request->data);exit;
					}
				}else{
					throw new AdminNotFoundException(array('error'=>'Your old password field is not matching with system`s password '));
				}
			}
		} //end of if post,put
	}
/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Admin->recursive = 0;
		$admins = $this->Paginator->paginate();
		$this->set('admins', $admins);
		$admingroups = $this->Admin->Admingroup->find('list');
		$this->set(compact('admingroups'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Admin->exists($id)) {
			throw new NotFoundException(__('Invalid admin'));
		}
		$options = array('conditions' => array('Admin.' . $this->Admin->primaryKey => $id));
		$this->set('admin', $this->Admin->find('first', $options));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Admin->exists($id)) {
			throw new NotFoundException(__('Invalid admin'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Admin->save($this->request->data)) {
				$this->Flash->success(__('The admin has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The admin could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Admin.' . $this->Admin->primaryKey => $id));
			$this->request->data = $this->Admin->find('first', $options);
		}
		$admingroups = $this->Admin->Admingroup->find('list');
		$this->set(compact('admingroups'));
	}
	
	public function admin_edit($id = null){
		$this->edit($id);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Admin->id = $id;
		if (!$this->Admin->exists()) {
			throw new NotFoundException(__('Invalid admin'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Admin->delete()) {
			$this->Flash->success(__('The admin has been deleted.'));
		} else {
			$this->Flash->error(__('The admin could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}