<?php
App::uses('TagentsAppController', 'Tagents.Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class TravelagentsController extends TagentsAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Paginator',
		'Flash',
		'Tagents.Captcha'=>array(
			'field'=>'security_code',
			'model' => 'Travelagent',
			'mlabel'=>'Answer simple math:&nbsp;'
		),
		'MobileDetect.MobileDetect'
	);
		
	public $helper = array('Js','Paginator','Tagents.Captcha');
	public $paginate = array(	'order' => array('Travelagent.created' => 'desc'));
	public $custom_notification_team = array('someone@yahoo.com');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
		AuthComponent::$sessionKey = 'Auth.Travelagent';
		$this->Auth->authenticate = array(
			'Form' => array(
				'fields' => array('username'=>'email_address','password'=>'password'),
				'userModel' => 'Travelagent',
			)
		);
		
		$this->Auth->loginAction = array('plugin'=>'tagents','controller' => 'travelagents','action' => 'login');      
        $this->Auth->loginRedirect = array('plugin'=>'tagents','controller' => 'travelagents','action' => 'dashboard','admin'=>false );  
		$this->Auth->logoutRedirect = array('plugin'=>'tagents','controller' => 'pages','action' => 'homepage','admin'=>false );
		//$this->layout='agents';
	//$this->Auth->allow('register','confirm','logout','captcha','agentsdashboard','forgotpassword','resetpassword','changepassword','thankyou');

		$this->set('masterclass','');
		$this->set('aclclass','');
		$this->set('usersclass','active');
		$this->set('dashboardclass','');
	}
	
	function captcha()	{
        $this->autoRender = false;
        $this->layout='ajax';
        if(!isset($this->Captcha))	{ //if you didn't load in the header
            $this->Captcha = $this->Components->load('Captcha'); //load it
        }
        $this->Captcha->create();
    }
	

/***********************Private Functions*************************************/	
	private function _findOrCreateUser($user_profile = array(), $provider=null) {
		if (!empty($user_profile)) {//echo $provider; pr($user_profile);
			//unbind here users related model, not required for users authentication
			if ($provider=='twitter'){
			$user = $this->Travelagent->find("first", 
			array("conditions" => array( "OR"=>array("Travelagent.firstname" => $user_profile->identifier, "Travelagent.email_address"=>$user_profile->displayName.'@twitter.com'))));
			}else{
			$user = $this->Travelagent->find("first", 
			array("conditions" => array( "OR"=>array("Travelagent.firstname" => $user_profile['identifier'], "Travelagent.email_address"=>$user_profile['email']))));
			}
			//pr($user); exit;
			if (!$user) {
				$newpassword = $this->_generateRandomString(8);
				$this->Travelagent->create();
				if ($provider!='twitter'){
					$this->Travelagent->set(
						array( 
						"group_id" => 2, 
						"firstname" => $user_profile['firstName'],
						"lastname" => $user_profile['lastName'],
						"email_address" => $user_profile['email'],
						"username" => $user_profile['identifier'],
						"country" => $user_profile['country'], 
						"city" => $user_profile['city'], 
						"address" => $user_profile['address'], 
						//added another fields as we need in user table
						"password" => AuthComponent::password($newpassword),
						"confirm_password" => AuthComponent::password($newpassword),
						//we generate new password to database for this user and send by mail in welcome email.
						"phone" => '0000000000',
						"confirm" => CakeText::uuid(),
						"active" => 1,
						"src" => $provider,					
						)
					); 
				}else{
					//if provider is twitter
					$this->Travelagent->set(
						array( 
						"group_id" => 2, 
						"firstname" => $user_profile['displayName'],
						"lastname" => $user_profile['lastName'],
						"email_address" => $user_profile['displayName'].'@twitter.com',
						"username" => $user_profile['displayName'],
						"country" => $user_profile['country'], 
						"city" => $user_profile['city'], 
						"address" => $user_profile['address'],
						//added another fields as we need in user table
						"password" => AuthComponent::password($newpassword),
						"confirm_password" => AuthComponent::password($newpassword),
						//we generate new password to database for this user and send by mail in welcome email.
						"phone" => '0000000000',
						"confirm" => CakeText::uuid(),
						"active" => 1,
						"src" => $provider,					
						)
					); 
				}
				if ($this->Travelagent->save()) {
				/*create profile entry for new user */
						App::import('Model','Profile');
						$profile = new Profile();
						$profile->saveField('user_id',$this->Travelagent->getLastInsertId());
				
					$this->Travelagent->recursive = -1;
					$user = $this->Travelagent->read(null, $this->Travelagent->getLastInsertId()); 
					return $user["Travelagent"]; 
				}else{
					//pr($this->Travelagent->validationErrors);exit;
				}
			} else { 
				return $user["Travelagent"];
			} 
		}
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
	
	private function _usergroups($id=null){
		App::import('Model','Group');
  		$group = new Group();
		$group->unbindModel(array('hasMany'=>array('Travelagent')));
		if($id){
			$conditions = array('Group.active'=>1,'Group.id'=>$id);
		}else{
			$conditions = array('Group.active'=>1,'Group.id<>1');
		}
		$fields = array('Group.id','Group.name');
		$usergroups = $group->find("list",array("conditions"=>$conditions));
		return $usergroups;
	}
	private function _generateRandomString($length = 8) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
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
	private function _send_custom_notification($objemail,$group){
		$notification_team = $this->custom_notification_team;
		foreach($group as $key=>$value) {$groupname = $value;}
		;
		$objemail->subject('Registration request received');
		$objemail->emailFormat('html');
		$objemail->template('notifyregistration','notification')->viewVars(
				array(
				'contenttitle'=>'Registration request received',
				'firstname'=>$this->request->data['Travelagent']['firstname'],
				'email'=>$this->request->data['Travelagent']['email_address'],
				'groupname'=> $groupname,
				'sender'=>'Announceit today webmaster'
				)
		);
		foreach($notification_team as $notification){
			$objemail->to ($notification);
			$objemail->from (array('no-reply@announceit.today'=>'no-reply announceit today'));
			$objemail->send();
		}
	}
	
	function _getRealIpAddr(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	function _profile($userid=null){
		$conditions = array("Travelagent.id"=>$userid);
		$fields = array("Travelagent.id","Travelagent.firstname","Travelagent.lastname","Travelagent.phone","Travelagent.email_address","Travelagentprofile.id","Travelagentprofile.travelagent_id","Travelagentprofile.userimage","Travelagentprofile.messanger","Travelagentprofile.msgtype","Travelagentprofile.aboutme","Travelagentprofile.quotes","Travelagency.name");
		return $currentAgent = $this->Travelagent->find('first',
			array(
				'contain'=>array('Travelagentprofile','Travelagency'),
				'conditions'=>$conditions,
				'fields'=>$fields,
			)
		);
	}
/*********************Private functions ends here **************************************/
/**
 * index method
 *
 * @return void
 */
	public function index() {	
		$this->Travelagent->recursive = 0;
		$conditions = array();
		if(!empty($this->request->data)){
			if(array_key_exists('group_id',$this->request->data['Travelagent']) && !empty($this->request->data['Travelagent']['group_id'])){
				$conditions["Travelagent.group_id ="]= $this->request->data['Travelagent']['group_id'];
			}			
		}		
		$this->Paginator->settings = array(
			'conditions' => $conditions,
			'order' => array('Travelagent.group_id' => 'asc','Travelagent.created'=>'asc'),
			'group'=>array(),
			'limit' => 20
		);
		$this->set('aagents', $this->Paginator->paginate('Travelagent'));

		$aagentgroups = $this->Travelagent->Aagentgroup->find("all",array('fields'=>array('Aagentgroup.name','Aagentgroup.id')));
		$aagentgroups = Set::combine($aagentgroups, '{n}.Aagentgroup.id','{n}.Aagentgroup.name');
		$this->set('aagentgroups', $aagentgroups);
	}
	
	public function profile($id = null){
		if($this->Session->check("Auth.Travelagent")){
			if($id == $this->Session->read("Auth.Travelagent.id")){
				$id = $this->Session->read("Auth.Travelagent.id");
			}else{
				
			}
		}		
		if(!$id){
			$this->Session->setFlash('Member identity is not confirmed');
			$this->redirect(array('controller'=>'/'));exit;
		}
		$conditions = array("Travelagent.id"=>$id);
		$fields = array("Travelagentprofile.id");
		$userdata = $this->Travelagent->find('first',array('conditions'=>$conditions,'fields'=>$fields));
		//pr($userdata);exit;
		$this->redirect(array('controller'=>'profiles','action'=>'view',$userdata['Profile']['id']));exit;
	}
	
	public function login() {
		$this->Travelagent->table = 'agents';
		if ($this->request->is(array('post','put'))) {
			if ($this->Auth->login()) {
				//pr($this->Session->read("Auth"));exit;
				$this->Travelagent->id = $this->Session->read("Auth.Travelagent.id"); 
				$this->Travelagent->saveField('lastlogin', date('Y-m-d H:i:s') );
				return $this->redirect($this->Auth->loginRedirect);
			}
			$this->Session->setFlash(__('Your username or password is incorrect.'));
		}
		if ($this->Session->read('Auth.Travelagent')) {
			$this->Session->setFlash('You are logged in!');
			return $this->redirect($this->Auth->loginRedirect);
		}
		$login = 'active';
		$this->set('login',$login);
	}
	/* Not in use
	function agentsdashboard($userid=null){
		if(!$userid){
			if(!$this->Session->check('Auth.Aagent.id')){
				throw new NotFoundException(__('Your identity does not match with the system'));
			}else{
				$userid = $this->Session->read('Auth.Aagent.id');
			}			
		}else{
			if(!$this->Aagent->exists($userid)){
				throw new NotFoundException(__('No such profile exists with the system'));
			}
		}
		$this->Aagent->Behaviors->load('Containable');			
		$currentuser = $this->_profile($userid);
		//pr($currentuser);exit;
		$this->set('currentuser', $currentuser);
	}*/
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Travelagent->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('Travelagent.' . $this->Travelagent->primaryKey => $id));
		$this->set('agent', $this->Travelagent->find('first', $options));
	}
	
	function dashboard($userid=null){
		if(!$userid){
			if(!$this->Session->check('Auth.Travelagent.id')){
				throw new NotFoundException(__('Your identity does not match with the system'));
			}else{
				//pr($this->Session->read('Auth.User'));exit;
				$userid = $this->Session->read('Auth.Travelagent.id');
			}			
		}else{
			if(!$this->Travelagent->exists($userid)){
				throw new NotFoundException(__('No such profile exists with the system'));
			}
		}
		$this->Travelagent->Behaviors->load('Containable');
		$currentuser = $this->_profile($userid);
		//pr($currentuser);exit;
		$this->set('currentuser', $currentuser);
	}
/**
 * add method
 *
 * @return void
 */
	public function register($type=null) {
		$register = '';
		if ($this->request->is(array('post','put'))) {
		//pr($this->request->data);exit;
			$this->request->data['Travelagent']['confirm'] = CakeText::uuid();
			$this->request->data['Travelagent']['opsys'] = 'desktop';
			$this->request->data['Travelagent']['ipaddr'] = $this->_getRealIpAddr();
			$this->request->data['Travelagent']['realipaddr'] = $this->_getRealIpAddr();
			$this->request->data['Travelagent']['src'] = 'site';
			$this->request->data['Travelagent']['travelagentgroup_id'] = '2';
			$this->Travelagent->setCaptcha('security_code', $this->Captcha->getCode('Travelagent.security_code'));
			if($this->MobileDetect->detect('isMobile')){
				if($this->MobileDetect->detect('isiOS')){
					$iv = $this->MobileDetect->detect('version','iPhone');
					$this->request->data['Travelagent']['opsys'] = 'Mobile.iOS'.$iv;
				}
				if($this->MobileDetect->detect('isAndroidOS')){
					$iv = $this->MobileDetect->detect('version','Android');
					$this->request->data['Travelagent']['opsys'] = 'Mobile.Android'.$iv;
				}
			}
			if($this->MobileDetect->detect('isTablet')){
				if($this->MobileDetect->isiOS()){
					$iv = $this->MobileDetect->detect('version','iPad');
					$this->request->data['Travelagent']['opsys'] = 'iPad'.$iv;
				}
				if($this->MobileDetect->isAndroidOS()){
					$iv = $this->MobileDetect->detect('version','Android');
					$this->request->data['Travelagent']['opsys'] = 'Tab.Android'.$iv;
				}
			}
			$this->Travelagent->create();
			if ($this->Travelagent->saveAll($this->request->data)) {
				$link = str_replace('register','confirm',$this->_confurl());
				$encryptconfirm = $this->_base64url_encode($this->_aes_encrypt($this->request->data['Travelagent']['confirm']));
				//here the code for sending email is written
				$Email = new CakeEmail('gmail');
				$Email->from(array('no-reply@VacDo.in'=>'no-reply VacDo.in'));
				$Email->to($this->request->data['Travelagent']['email_address']);
				$Email->subject('Welcome to VacDo.in');
				$Email->emailFormat('html');
				$Email->template('sendconfirmkey','default')->viewVars(
						array(
							'firstname' => $this->request->data['Travelagent']['firstname'],
							'confirmationkey' => $link.'/'.$encryptconfirm,
							'sender' => 'Insurance Company Team',
							)
						);
				if($Email->send()){
					$group = $this->_usergroups($this->request->data['Travelagent']['travelagentgroup_id']);
					if(empty($group)){ $group = 'member'; }
					$this->_send_custom_notification($Email,$group);//send registration message to custom ids
					$this->Session->setFlash(__('Your registration reuest is received. Please confirm your registration from the link sent to your Email address'));		
					return $this->redirect(array('controller'=>'travelagents','action' => 'thankyou/registration'));
				}else{
					$this->Session->setFlash(__('Your account information is saved. Due to some reson we are not able to send you the varification link in your email. Please contact the support team.'));
					return $this->redirect(array('controller'=>'travelagents','action' => 'login','admin'=>false));
				}
			}
		}
	}
	
	public function confirm($encryptconfirm = null) {
		if (!$this->request->is(array('post','put'))) {
			if($encryptconfirm){
				$code = $this->_aes_decrypt($this->_base64url_decode($encryptconfirm));
				$fields = array("Travelagent.id","Travelagent.confirm","Travelagent.active");
				$user = $this->Travelagent->findByConfirm($code,$fields);
				//pr($user);exit;
				if(($user)){
					if($user['Travelagent']['active'] =='0'){
						$this->Travelagent->id = $user['Travelagent']['id'];
						$this->Travelagent->saveField('active','1');
						App::import('Model','Tagents.Travelagentprofile');
						$profile = new Travelagentprofile();
						$profile->saveField('travelagent_id',$user['Travelagent']['id']); //create a profile id after user confirms
						$this->Session->setFlash('Your account is now activated. You can login with your credentials.');
					}
					if($user['Travelagent']['active'] =='1'){
						$this->Session->setFlash('Your account is already activated. You can login with your credentials.');
					}
					if($user['Travelagent']['active'] =='2'){
						$this->Session->setFlash('Your account is banned for some resons. Please contact site administrator.');
					}
					return $this->redirect(array('controller'=>'travelagents','action' => 'thankyou/confirmation'));
				}else{
					$this->Session->setFlash('This is not a valid user account');
					return $this->redirect('/');exit;
				}
			}
		}
	}
	public function resetpassword($confcode=null) {		
		if ($this->request->is(array('post','put'))){
			//pr($this->request->data);exit;
			if (!$confirm = $this->request->data['Travelagent']['confirm']) {
				throw new NotFoundException(__('Your identity doesn`t clear with the system'));
			}
			$fields = array("Travelagent.id","Travelagent.confirm","Travelagent.active");
			$this->Travelagent->unbindModel(array('hasMany'=>array('Buynsale','Eventsnshow','Hcservice','Jobsvacancy','Foodnrecipe','Scintech')));
			$this->Travelagent->recursive = -1;			
			$user = $this->Travelagent->findByConfirm($this->request->data['Travelagent']['confirm'],$fields);
			//pr($user);exit;
			if($user){
				$this->Travelagent->id=$user['Travelagent']['id'];
				if($this->Travelagent->save($this->request->data,true,array('password'))){
					$this->Session->setFlash('Your new password is set with the system.');
					$this->redirect(array('controller'=>'travelagents','action'=>'thankyou/changepassword','admin'=>false));
					exit;
				}
				//$this->Travelagent->invalidFields();
				$this->set('confirm',$this->request->data['Travelagent']['confirm']);
			}
		}else{
			if (!$confcode) {
				throw new NotFoundException(__('No account with the system'));
			}
			$confcode = $this->_aes_decrypt($this->_base64url_decode($confcode));
			$this->set('confirm',$confcode);
		}
	}
	public function forgotpassword($code=null) {
		if ($this->request->is(array('post','put'))){
			if (!$email_address = $this->request->data['Travelagent']['email_address']) {
				throw new NotFoundException(__('Enter your registered email address with the site'));
			}
			$this->Travelagent->unbindModel(array('hasMany'=>array('Buynsale','Eventsnshow','Hcservice','Jobsvacancy','Foodnrecipe','Scintech')));
			$this->Travelagent->recursive = -1;
			$fields = array("Travelagent.id","Travelagent.firstname","Travelagent.password","Travelagent.confirm");//fields are been fatched while finding dataset
			
			if (!$user= $this->Travelagent->findByEmailAddress($email_address,$fields)) {
				/*$this->render('/Errors/excaption');
				throw new NotFoundException(__('Password reset request is invalid'));*/
				$this->Session->setFlash('The Email Id doesn`t have an associated user account');
			}else{
				$userconfirm = $this->_base64url_encode($this->_aes_encrypt($user['Travelagent']['confirm']));
				$link = str_replace('forgotpassword','resetpassword',$this->_confurl());
				$Email = new CakeEmail('smtp');
				$Email->to($email_address);
				$Email->subject('Your password reset request');
				$Email->from (array('no-reply@announceit.today'=>'no-reply Announceit.today'));
				$Email->emailFormat('html');
				$Email->template('forgotpassword','default')->viewVars(
					array(
						'firstname' => $user['Aagent']['firstname'],
						'newpassword' => $link.'/'.$userconfirm,
						'sender' => 'iAdvisor Company Team',
						)
					);
					
				if($Email->send()){
					$this->Session->setFlash('Your change password link is sent to your registered emaill address.');
					$this->redirect(array('controller'=>'travelagents','action'=>'thankyou/forgotpassword','admin'=>false));
					exit;
				}else{
					$this->Session->setFlash('We are not able to forward your reset password request this time.');
					$this->redirect(array('controller'=>'travelagents','action'=>'registration','admin'=>false));
					exit;
				}
			}		
		}else{
			
		}
	}
	
	public function changepassword() {		
		if ($this->request->is(array('post','put'))) {
			if (!$current_password = $this->request->data['Travelagent']['current_password']) {
				throw new NotFoundException(__('Enter your current password with the site'));
			}else{
				if(!empty($this->request->data['Travelagent']['confirm'])){
					$currentuserid = $this->_aes_decrypt($this->_base64url_decode($this->request->data['Travelagent']['confirm']));
					if((string)($this->Session->read('Auth.Travelagent.confirm')) != (string)$currentuserid){
						throw new NotFoundException(__('Your identity does not match with the system'));
					}
				}
			}			
			$current_password = AuthComponent::password($this->request->data['Travelagent']['current_password']);
			$this->Travelagent->unbindModel(array('hasMany'=>array('Buynsale','Eventsnshow','Hcservice','Jobsvacancy','Foodnrecipe','Scintech')));
			$this->Travelagent->recursive = -1;
			$fields = array("Travelagent.password");			
			if (!$user= $this->Travelagent->findByConfirm($currentuserid,$fields)) {
				throw new NotFoundException(__('Password reset request is invalid'));
			}else{
				if($current_password == $user['Travelagent']['password']){
					$this->Travelagent->id = $this->Session->read("Auth.Travelagent.id");
					if($this->Travelagent->save($this->request->data,true,array('password'))){
						$this->Session->setFlash('Your new password is set with the system.');
						$this->redirect(array('controller'=>'travelagents','action'=>'thankyou/changepassword','admin'=>false));
						exit;
					}$this->set('confirm',$this->_base64url_encode($this->_aes_encrypt($currentuserid)));
				}else{
					throw new NotFoundException(__('Recheck with your new password input.'));
				}
			}
		}else{
			if(!$this->Session->check("Auth.Travelagent.id")){
				$this->Session->setFlash('Session seems expired!! Please login and reset your password');
				$this->redirect(array('controller'=>'travelagents','action'=>'login','admin'=>false));
				exit;
			}
			$this->set('confirm',$this->_base64url_encode($this->_aes_encrypt($this->Session->read("Auth.Travelagent.confirm"))));
		}
	}
	public function thankyou($req=null) {
		switch($req){
			case 'registration':
				$h3 = "Thank you for sending registration reqest";
				$message3 = "We have send you a confirmation link in email provided by you. If you do not get within some time, please contact our support team at support@VacDo.in. Our team would like to help you for site usage queries.";
				$this->set('h3',$h3);
				$this->set('message3',$message3);
				$this->set('class','glyphicon glyphicon-thumbs-up');
			break;
			case 'confirmation':
				$h3 = "Welcome to VacDo.in";
				$message3 = "Your email address is verified in the system. Please use this email address and your provided password to login in the system. If you need any assistance, send a mail to support@VacDo.in";
				$this->set('h3',$h3);
				$this->set('message3',$message3);
				$this->set('class','glyphicon glyphicon-thumbs-up');
			break;
			case 'changepassword':
				$h3 = "Change password request is proccessed";
				$message3 = "Your password is reset with the system. Now you can use the new password from your next login. If you need any assistance, send a mail to support@VacDo.in";
				$this->set('h3',$h3);
				$this->set('message3',$message3);
				$this->set('class','glyphicon glyphicon-thumbs-up');
			break;
			case 'forgotpassword':
				$h3 = "Forgot password request is proccessed";
				$message3 = "Your reset password link is sent to your registered email address. You can click on the link or copy and past directly in your brower. Set a new password when you get update password form. If you need any assistance, send a mail to support@VacDo.in";
				$this->set('h3',$h3);
				$this->set('message3',$message3);
				$this->set('class','glyphicon glyphicon-thumbs-up');
			break;
			default:
				$h3 = "Your operation request is not verified";
				$message3 = "Your operation request is not verified. If you need any assistance, send a mail to support@VacDo.in";
				$this->set('h3',$h3);
				$this->set('message3',$message3);
				$this->set('class','glyphicon glyphicon-thumbs-down');
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
		if (!$this->Travelagent->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Travelagent->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Travelagent.' . $this->Travelagent->primaryKey => $id));
			$this->request->data = $this->Travelagent->find('first', $options);
			//pr($this->request->data);exit;
		}
		$groups = $this->Travelagent->Aagentgroup->find('list');
		$this->set(compact('groups'));
	}
	
	public function admin_index(){
		$this->index();
	}
	
	public function admin_edit($id = null){
		$this->edit($id);
	}
	
	function admin_create($packageid=null){
	
		if(!empty($this->request->data)){//pr($this->request->data);exit;
		
			$this->request->data['Travelagent']['confirm'] = CakeText::uuid();
			//pr($this->request->data);exit;
			if($this->Travelagent->save($this->request->data)){
				$encryptconfirm = $this->_base64url_encode($this->_aes_encrypt($this->request->data['Travelagent']['confirm']));
				$userID = $this->Travelagent->getLastInsertID();
				$link = str_replace('admin/','',$this->_confurl());
				$link = str_replace('create','confirm',$link);
				$domain = Router::url('/', true);				
				$adminmail = 'contact@announceit.today';
				//here the code for sending email is written
				$Email = new CakeEmail('smtp');
				$Email->from(array($adminmail=> 'Announce it today Team'));
				$Email->to($this->request->data['Travelagent']['email_address']);
				$Email->subject('Welcome to Announce it today');
				$Email->emailFormat('html');
				$Email->template('default','notification')->viewVars(
								array(
									'username' => $this->request->data['Travelagent']['firstname'],
									'sender' => 'Announce it today Team',
									'confirmationkey' => $link.'/'.$encryptconfirm
									)
								);			
				
				if($Email->send()){
					$this->Session->setFlash('Your membership is registered and activation mail sent to your email address');
					$this->redirect(array('controller'=>'travelagents','action'=>'index','admin'=>true));
					exit;
				}else{
					$this->Session->setFlash('We have registered your membership request but not able to forward you confirmation link this time.');
					$this->redirect(array('controller'=>'travelagents','action'=>'index','admin'=>true));
					exit;
				}
			}else{
				$this->Session->setFlash('Sorry! We are not able to forward your registration request this time.');
				$this->redirect(array('controller'=>'travelagents','action'=>'index','admin'=>true));
				exit;
			}
		}
		$groups = $this->Travelagent->Aagentgroup->find("all",array('fields'=>array('Aagentgroup.name','Aagentgroup.id')));
		$groups = Set::combine($groups, '{n}.Aagentgroup.id','{n}.Aagentgroup.name');
		$this->set('groups', $groups);
		
		
		$this->set(compact('groups'));
		$this->set('masterclass','');
	}

	public function admin_view($id = null){
		$this->view($id);
		$this->set('masterclass','');
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Travelagent->id = $id;
		if (!$this->Travelagent->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Travelagent->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	/*public function admin_login() {
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Auth->login()) {
				if($this->Session->read("Auth.Aagent.Group.id") ==='1'){
					$this->Aagent->id = $this->Session->read("Auth.Aagent.id");
					$this->Aagent->saveField('lastlogin', date('Y-m-d H:i:s') );
					return $this->redirect(array('controller'=>'aagents','action'=>'dashboard','admin'=>true));
					exit;
				}else{
					$this->Session->delete("Auth.Aagent");
				}
			}
			$this->Session->setFlash(__('You are not authorized administrator'));
		}
	}
	
	public function admin_changepassword() {
		if ($this->request->is(array('post', 'put'))) {
			if (!$current_password = $this->request->data['Aagent']['currentpassword']) {
				throw new NotFoundException(__('Enter your current password with the site'));
			}
			//pr($this->request->data);exit;
			if(!$this->Session->check("Auth.Aagent.id")){
				$this->Session->setFlash('Session seems expired!! Please login and reset your password');
				$this->redirect(array('controller'=>'aagents','action'=>'login','admin'=>true));
				exit;
			}else{
				$this->Aagent->id = $this->Session->read("Auth.Aagent.id");
				if (!$this->Aagent->exists()) {
					throw new NotFoundException(__('Password reset request is invalid'));
				}
				$this->Aagent->unbindModel(array("hasOne"=>array("Profile"),"hasMany"=>array("Buynsale","Bscomment")));
				$user = $this->Aagent->find('first',array("conditions"=>array("Aagent.id"=>$this->Aagent->id)));
				$current_password = AuthComponent::password($this->request->data['Aagent']['currentpassword']);
			//pr($user);exit;
								
				if($current_password == $user['Aagent']['password']){			
					if($this->Aagent->save($this->request->data,true,array('password'))){
						$this->Session->setFlash('Your new password is set with the system.');
						$this->redirect(array('controller'=>'aagents','action'=>'changepassword','admin'=>true));
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
	public function admin_logout(){
		$this->redirect($this->Auth->logout());
	}*/
	
	function logout(){
		$this->Session->delete('Auth.Travelagent');		
		$this->redirect($this->Auth->logoutRedirect);
	}
}