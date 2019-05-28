<?php
App::uses('AppController', 'Controller');
App::uses('CakeEvent', 'Event');//using for the event-driven programming
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public function beforeFilter() {
		
		parent::beforeFilter();
		$this->Auth->allow();
		$this->set('masterclass','');
		$this->set('usersclass','active');
	}
	
	public function initDB() {
    $group = $this->User->Group;

    // Allow admins to everything
    $group->id = 1;
    $this->Acl->allow($group, 'controllers');

    // allow managers to posts and widgets
    $group->id = 2;
    $this->Acl->deny($group, 'controllers');
    $this->Acl->allow($group, 'controllers/Products');
    $this->Acl->allow($group, 'controllers/Stores');

    // allow users to only add and edit on posts and widgets
    $group->id = 3;
    $this->Acl->deny($group, 'controllers');
    $this->Acl->allow($group, 'controllers/Products/index');
    $this->Acl->allow($group, 'controllers/Products/view');
    $this->Acl->allow($group, 'controllers/Stores/index');
    $this->Acl->allow($group, 'controllers/Stores/view');
	
	$group->id = 4;
    $this->Acl->deny($group, 'controllers');
    $this->Acl->allow($group, 'controllers/Products/index');
    $this->Acl->allow($group, 'controllers/Products/view');
    $this->Acl->allow($group, 'controllers/Stores/index');
    $this->Acl->allow($group, 'controllers/Stores/view');

    // allow basic users to log out
    $this->Acl->allow($group, 'controllers/users/logout');

    // we add an exit to avoid an ugly "missing views" error message
    echo "all done";
    exit;
}

	private function _profile($userid=null){
		$conditions = array("User.id"=>$userid);
		$fields = array("User.id","User.firstname","User.lastname","User.phone","User.email","Profile.id","Profile.user_id","Profile.userimage","Profile.birthdate","Profile.gender");
		return $currentAgent = $this->User->find('first',
			array(
				'conditions'=>$conditions,
				'fields'=>$fields,
				'contain'=>array('Profile'),
			)
		);
	}
	private function _confurl() { //this function is used in sendtofriend method
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	
		private function _aeskey($key){
		$new_key = str_repeat(chr(0), 16);
		for($i=0,$len=strlen($key);$i<$len;$i++){
			$new_key[$i%16] = $new_key[$i%16] ^ $key[$i];
		}
		return $new_key;
	}
	private function _aes_encrypt($val){
		$key = $this->_aeskey('15061974');
		$pad_value = 16-(strlen($val) % 16);
		$val = str_pad($val, (16*(floor(strlen($val) / 16)+1)), chr($pad_value));
		return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $val, MCRYPT_MODE_ECB, mcrypt_create_iv( mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND));
	}
	private function _aes_decrypt($val){	
		$key = $this->_aeskey('15061974');
		$val = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $val, MCRYPT_MODE_ECB, mcrypt_create_iv( mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND));
		return rtrim($val, "\0..\16");		
	}	
	private function _base64url_encode($data) {
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}
	private function _base64url_decode($data) {
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$users = $this->Paginator->paginate();
		$this->set('users',$users );
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function dashboard($userid=null){
		if(!$userid){
			if(!$this->Session->check('Auth.User.id')){
				throw new NotFoundException(__('Your identity does not match with the system'));
			}else{
				//pr($this->Session->read('Auth.User'));exit;
				$userid = $this->Session->read('Auth.User.id');
			}			
		}else{
			if(!$this->User->exists($userid)){
				throw new NotFoundException(__('No such profile exists with the system'));
			}
		}
		$this->User->Behaviors->load('Containable');
		$currentuser = $this->_profile($userid);
		//pr($currentuser);exit;
		$this->set('currentuser', $currentuser);
	}
	/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}
	
/**
 * add method
 *
 * @return void
 */
	public function register($key=null) {
		if ($this->request->is(array('post','put'))) {
			
			$this->request->data['User']['group_id']=1;
			$this->request->data['User']['confirmkey']=CakeText::uuid();
			//pr($this->request->data);exit;
			$this->User->create();

			if ($this->User->save($this->request->data)) {
				/*afterSave callback is sending a mail from User model*/
				
				$this->Flash->success(__('Received registration info successfully'));
				return $this->redirect(array('plugin'=>'','controller'=>'users','action'=>'success'));
			} else {
				
				$this->Flash->error(__('The traveler could not be registered. Please, try again.'));
			}
		
		}else{ //check the confirmation key from mail and make the user active
			if($key){
				$code = $this->_aes_decrypt($this->_base64url_decode($key));
				$fields = array("User.id","User.confirmkey","User.active");
				$user = $this->User->findByConfirmkey($code,$fields);
				//pr($user);exit;
				if(!empty($user)){//$user found
					if($user['User']['active'] =='0'){
						$event = new CakeEvent('Controller.User.makeActive', $this, array(
							'user' => $user['User'],
							)
						);
						$this->getEventManager()->dispatch($event);
						
						$eventprofile = new CakeEvent('Controller.User.makeProfile', $this, array(
							'user' => $user['User'],
							)
						);
						$this->getEventManager()->dispatch($eventprofile);
					}
					$this->Flash->success(__('Your account with the site is activated'),
						array(
							'key'=>'confirm-success',
							'params'=>array('class'=>'bg-success-custom')
						)
					);
					return $this->redirect(array('plugin'=>'','controller'=>'users','action'=>'login','admin'=>false));	
				}else{//$user not present
					$this->Flash->failure(__('Your account with the site is not found'),
						array(
							'key'=>'confirm-failure',
							'params'=>array('class'=>'bg-danger-custom')
						)
					);
					return $this->redirect(array('plugin'=>'','controller'=>'users','action'=>'login','admin'=>false));	
				}
			}
		}
	}
	public function success(){
	
	}

	public function forgotpassword($code=null) {
		if ($this->request->is(array('post','put'))){
			if (!$email_address = $this->request->data['User']['email']) {
				throw new NotFoundException(__('Enter your registered email address with the site'));
			}
			$this->User->unbindModel(array('hasMany'=>array("Deliveryaddress")));
			$this->User->recursive = -1;
			$fields = array("User.id","User.firstname","User.password","User.confirmkey");//fields are been fatched while finding dataset
			
			if (!$user= $this->User->findByEmail($email_address,$fields)) {
				$this->Flash->failuremessage('The Email Id doesn`t have an associated user account',
					array(
						'params'=>array(
							'class'=>'mt-2 bg-danger-custom px-3 pb-2'
						)
					)
				);
			}else{
				$userconfirm = $this->_base64url_encode($this->_aes_encrypt($user['User']['confirmkey']));
				$link = str_replace('forgotpassword','resetpassword',$this->_confurl());
				$Email = new CakeEmail('gmail');
				$Email->to($email_address);
				$Email->subject('Your password reset request');
				$Email->from (array('no-reply@eCom.site'=>'no-reply eCom.site'));
				$Email->emailFormat('html');
				$Email->template('forgotpassword','default')->viewVars(
					array(
						'firstname' => $user['User']['firstname'],
						'newpassword' => $link.'/'.$userconfirm,
						'sender' => 'eCom site Team',
						)
					);
					
				if($Email->send()){
					$this->Flash->forgotpasswordsuccess(
						'Your change password link is sent to your registered emaill address.',
						array(
							 'params' => array(
								'class' => 'mt-2 bg-success-custom px-3 pb-2'
							)
						)
					);
					$this->redirect(array('controller'=>'users','action'=>'login','admin'=>false));
					exit;
				}else{
					$this->Flash->setFlash('We are not able to forward your reset password request this time.');
					$this->redirect(array('controller'=>'users','action'=>'registration','admin'=>false));
					exit;
				}
			}		
		}else{
			
		}
	}
	
	public function resetpassword($confcode=null) {		
		if ($this->request->is(array('post','put'))){
			//pr($this->request->data);exit;
			if (!$confirm = $this->request->data['User']['confirmkey']) {
				throw new NotFoundException(__('Your identity doesn`t clear with the system'));
			}
			$fields = array("User.id","User.confirmkey","User.active");
			$this->User->unbindModel(array('hasMany'=>array('Deliveryaddress')));
			$this->User->recursive = -1;			
			$user = $this->User->findByConfirmkey($this->request->data['User']['confirmkey'],$fields);
			//pr($user);exit;
			if($user){
				$this->User->id=$user['User']['id'];
				if($this->User->save($this->request->data,true,array('password'))){
					$this->Flash->resetpasswordsuccess(
						'Your new password is set with the system. Login with new password now onwards',
						array(
							'params' => array( 
								'class'=>'mt-2 bg-success-custom px-3 pb-2'
							)
						)
					);
					$this->redirect(array('controller'=>'users','action'=>'login','admin'=>false));
					exit;
				}
				//$this->User->invalidFields();
				$this->set('confirm',$this->request->data['User']['confirmkey']);
			}
		}else{
			if (!$confcode) {
				throw new NotFoundException(__('No account with the system'));
			}
			$confcode = $this->_aes_decrypt($this->_base64url_decode($confcode));
			$this->set('confirm',$confcode);
		}
	}
	
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
		//pr($this->request->data);exit;
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}
	
	public function admin_edit($id = null) {
		$this->edit($id);
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('get', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function admin_delete($id = null) {
		$this->delete($id);
	}
	
	public function login() {
		if ($this->request->is(array('post','put'))) {
		//pr($this->request->data);exit;
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			}
			//$this->Session->setFlash(__('Your Email or Password was incorrect.'));
			$this->Flash->failure(__('Your Email or Password was incorrect.'),
						array(
							'key'=>'flash',
							'params'=>array('class'=>'bg-danger-custom')
						)
					);
		}
	}
	function admin_login(){
		if ($this->request->is(array('post','put'))) {
			if (!empty($this->request->data)) {
				
				if($this->Auth->login()) {
					$user = $this->Auth->user();
					//pr($user);exit;
					$this->User->id = $user['id'];
					$this->User->saveField('lastlogin', date('Y-m-d H:i:s') );
					$conditions = array('conditions'=>array('User.id'=>$user['id']));
					$super = $this->User->find('first',$conditions);
					//pr($super); exit;
					switch($super['Group']['id']){
						case '1':					 
							$this->redirect(array('controller'=>'users', 'action'=>'dashboard','admin'=>true));
							exit;
						case '3':
							$this->redirect(array('controller'=>'amenities', 'action'=>'index','admin'=>true));
							exit;
						case '2':							
							$this->Session->setFlash('You are not an authorized administrator');
							$this->redirect(array('controller'=>'users', 'action'=>'login', 'admin'=>true));
							exit;
					}		
				}
			}
		}
	}
	function admin_dashboard(){
		// # of Posts # Comments # Tags # tests
	}
	public function logout() {
		$this->Session->delete('Auth.User');
    	$this->redirect($this->Auth->logoutRedirect);
	}
	public function admin_logout() {
		$this->Session->delete('Auth.User');
    	$this->redirect($this->Auth->logoutRedirect);
	}
	function admin_index(){
		$this->index();
	}
	function admin_create(){
	
		if(!empty($this->request->data)){//pr($this->request->data);exit;
		
			$this->request->data['User']['confirm'] = CakeText::uuid();
			//pr($this->request->data);exit;
			if($this->User->save($this->request->data)){/*
				$encryptconfirm = $this->_base64url_encode($this->_aes_encrypt($this->request->data['User']['confirm']));
				$userID = $this->User->getLastInsertID();
				$link = str_replace('admin/','',$this->_confurl());
				$link = str_replace('create','confirm',$link);
				$domain = Router::url('/', true);				
				$adminmail = 'contact@announceit.today';
				//here the code for sending email is written
				$Email = new CakeEmail('smtp');
				$Email->from(array($adminmail=> 'Announce it today Team'));
				$Email->to($this->request->data['User']['email_address']);
				$Email->subject('Welcome to Announce it today');
				$Email->emailFormat('html');
				$Email->template('default','notification')->viewVars(
								array(
									'username' => $this->request->data['User']['firstname'],
									'sender' => 'Announce it today Team',
									'confirmationkey' => $link.'/'.$encryptconfirm
									)
								);			
				
				if($Email->send()){
					$this->Session->setFlash('Your membership is registered and activation mail sent to your email address');
					$this->redirect(array('controller'=>'users','action'=>'index','admin'=>true));
					exit;
				}else{
					$this->Session->setFlash('We have registered your membership request but not able to forward you confirmation link this time.');
					$this->redirect(array('controller'=>'users','action'=>'index','admin'=>true));
					exit;
				}
				*/
			}else{
				$this->Session->setFlash('Sorry! We are not able to forward your registration request this time.');
				$this->redirect(array('controller'=>'users','action'=>'index','admin'=>true));
				exit;
			}
		}
		$groups = $this->User->Group->find("all",array('fields'=>array('Group.name','Group.id')));
		$groups = Set::combine($groups, '{n}.Group.id','{n}.Group.name');
		$this->set('groups', $groups);
		
		
		$this->set(compact('groups'));
		$this->set('masterclass','');
	}
}