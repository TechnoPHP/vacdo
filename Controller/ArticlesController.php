<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class ArticlesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	
	public $components = array('Paginator',
		'Captcha.Captcha',
		'Feedback.Ratings' => array('on' => array('admin_view', 'view','index')),
		'MobileDetect.MobileDetect','Cookie'
	);
	public $helpers = array('Js','Tree',
		'Tags.TagCloud',
		'SocialShare',
		'Captcha.Captcha',
		'Feedback.Ratings'
	);
	public $paginate = array('order'=>array('Article.created'=>'desc'));
	public $uses=array('Article','Tofriend','Fulltextpost');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
		$this->set('masterclass','');
	}
	
	public function beforeRender(){
		//$this->_persistValidation();
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
	
	public function sendtofriend(){		
			//pr($this->request->data);
			$this->autoRender = false; 
			$this->Tofriend->setCaptcha('captcha', $this->Captcha->getCode('Tofriend.captcha'));
			$this->Tofriend->set($this->request->data);
			
			if($this->Tofriend->validates()){
				if($this->Tofriend->save($this->request->data)){
					
					$domain = $_SERVER['SERVER_NAME'];				
					$adminmail = 'contact@chirayu.im';//$this->Sitesetting->field('value',array('Sitesetting.key'=>'ContactEmail'));
					$email = new CakeEmail('smtp');
					$email->to ($this->request->data['Tofriend']['recemail']);
					$email->subject('Interesting Post For You');
					$email->from ($this->request->data['Tofriend']['senderemail']);
					$email->emailFormat('html');				
					$email->template('default','interestingpost')->viewVars(
									array(
										'username' => $this->request->data['Tofriend']['receiver'],
										'sender' => $this->request->data['Tofriend']['senderemail'],
										'postlink' => $this->request->data['Tofriend']['link'],
										'message' => $this->request->data['Tofriend']['message']
										)
									);
					if($email->send()){
						$this->Tofriend->saveField('mailsent', 1);
						//$this->_send_custom_notification($email);
					}else{
						$this->Session->setFlash('Sorry! We are not able to forward your request this time.');
						$this->redirect(array('controller'=>'contacts','action'=>'index'));exit;
					}
					if($this->RequestHandler->isAjax()){
						$this->render('successtofriend','ajax');
					}
				}
			}else{
                //$this->Session->setFlash('Data Validation Failure', 'default', array('class' => 'cake-error'));
                //pr($this->Tofriend->validationErrors['captcha']);
            }
	}
	private function _send_custom_notification($objemail){
		$notification_team = $this->custom_notification_team;		
		$objemail->subject('Contact Message Received');
		$objemail->emailFormat('html');
		$objemail->template('default','contactmessagenotification')->viewVars(
							array(
								'username' => 'Site Admin',
								'message'=> $this->request->data['Contact']['message']
								)
							);
		foreach($notification_team as $notification){
			$objemail->to ($notification);
			$objemail->sender($this->request->data['Contact']['email_address'], $this->request->data['Contact']['firstname']);
			$objemail->from (array($this->request->data['Contact']['email_address']=> $this->request->data['Contact']['firstname']));
			$objemail->send();
		}
	}
	function validateform(){
		if($this->RequestHandler->isAjax()){//pr($this->params['data']['field']);exit;
			$this->request->data['Tofriend'][$this->params['data']['field']] = $this->params['data']['value'];
			$this->Tofriend->set($this->request->data);
			if($this->Tofriend->validates()){
				$this->autoRender = false;
			}else{
				$error = $this->Tofriend->validationErrors;
				//pr($error);exit;
				$this->set('error',(!empty($error[$this->params['data']['field']])?$error[$this->params['data']['field']]:''));
			}
		}
	
	}
	function captcha()	{
        $this->autoRender = false;
        $this->layout='ajax';
        if(!isset($this->Captcha))	{ //if you didn't load in the header
            $this->Captcha = $this->Components->load('Captcha'); //load it
        }
        $this->Captcha->create();
    }
/**
 * fullsearch method
 *
 * @return void
 */	
	public function searchfull($phrase=null) {
		if (!empty($this->request->data['Post']['fullsearch'])) {
			//pr($this->request->data['Post']['fullsearch']);exit;
			$phrase =  $this->request->data['Article']['fullsearch'];
			$postcondition =array("MATCH (Fulltextpost.title) AGAINST('{$phrase}' IN BOOLEAN MODE)","Fulltextpost.active=1");
			$this->Paginator->settings = array(
				"Fulltextpost"=>array(
					'fields'=>array('Fulltextpost.id','Fulltextpost.title','Fulltextpost.body'),
					'conditions' => array($postcondition),
					'limit' => 10,
					'order'=>array('Fulltextpost.modified'=> 'desc'),
				)
			);
			$posts = $this->Paginator->paginate('Fulltextpost');
			$this->set(array('posts'=>$posts,'_serialize'=>array('posts')));
			//pr($posts);exit;
		}else{
			$this->redirect($this->referer());
		}
	}
/**
 * index method
 *
 * @return void
 */
	public function index($page=null) {
		$postcondition = array();
		$this->Article->unbindModel(array('hasMany'=>array('Comment','Articleview')));
		$this->Article->Behaviors->load('Containable');
		$this->Paginator->settings = array(
			'Article'=>array(
				'contain'=>array(
					'Tag'=>array('id','name','keyname'),
					'Admin'=>array('id','firstname'),
					'Articlecoverimage'=>array('namesmall','namemedium'),
					'Rating'=>array()
				),
				'conditions'=>array($postcondition),
				'limit'=>10,
				'order'=>array('Article.created' =>'desc')
			)
		);
		$posts = $this->Paginator->paginate('Article');
		//pr($posts);exit;
		//$this->set(array('posts'=>$posts,'_serialize'=>array('posts')));
		$this->set('posts',$posts);
		/*fetch all nested categories list*/
		App::import('Model','Articlecategory');
		$postcategory = new Articlecategory();
		$postcategory->recursive = 1;
		$data = $postcategory->find('threaded');// Extra parameters added
		$this->set('postcategories', $data);//it is handled in index.ctp
		$this->set('tags',$this->Article->Tagged->find('cloud',array('limit'=>20)));
		/*Tag Cloud Ends*/
	}
	
	public function filter($category=null,$postcategoryid=null,$page=null) {
	
		if (empty($postcategoryid)) {
			throw new PostcategoryNotFoundException(__('Invalid post category'));
		}
		$postcondition = array();
		App::import('Controller','Articlecategories');
		$postcate = new ArticlecategoriesController();
		$postcats = $postcate->_getchildcategories($postcategoryid);
		//pr($postcats);exit;		
		if(!empty($postcats)){
			if(count($postcats)>1)
			$postconditions = array("Article.articlecategory_id IN "=>$postcats);
			else
			$postconditions = array("Article.articlecategory_id"=>$postcats);
		}
		$this->Article->unbindModel(array('hasMany'=>array('Comment','Articleview')));
		$this->Article->Behaviors->load('Containable');
		$this->Paginator->settings = array(
			'Article'=>array(
					'contain'=>array(
						'Tag'=>array('id','name','keyname'),
						'Admin'=>array('id','firstname'),
						'Articlecoverimage'=>array('namesmall','namemedium'),
						'Rating'=>array()
					),
			'conditions' => array($postconditions),
			'limit' => 10,
			'order'=>array('Article.created'=> 'desc'),
			)
		);
		$posts = $this->Paginator->paginate();
		//pr($posts);exit;
		$this->set('posts', $posts);
		
		/*fetch all nested categories list*/
		App::import('Model','Articlecategory');
		$postcategory = new Articlecategory();
		$postcategory->recursive = 1;
		$data = $postcategory->find('threaded');// Extra parameters added
		$this->set('postcategories', $data);//it is handled in index.ctp
		$this->set('tags',$this->Article->Tagged->find('cloud',array('limit'=>20)));
		
		/*Tag Cloud Ends*/
	}
	
	public function search($tag=null,$tagid=null){	
		//$posts = $this->Post->Tagged->find('tagged', array('by' => $tag, 'model' => 'Post','recursive'=>'1','fields'=>array('Tagged.foreign_key','Tag.name','Tag.keyname')));	
		
		$this->Paginator->settings['Tagged'] = array(
			'tagged',
			'model' =>'Article',			
			'fields'=>array('Admin.id','Admin.email_address','Admin.firstname','Tagged.foreign_key','Tag.name','Tag.id','Tag.keyname'),
			'by' => $tag,'recursive'=>'1',
			'joins'=>array(array('table' => 'users',
                                        'alias' => 'Admin',
                                        'type' => 'INNER',
                                        'conditions' => array('Admin.id = Article.admin_id'))),
		);
		$posts = $this->Paginator->paginate('Tagged');
		//pr($posts);exit;
		$this->set('posts', $posts);
	
		/*fetch all nested categories list*/
		App::import('Model','Articlecategory');
		$postcategory = new Articlecategory();
		$postcategory->recursive = 1;
		$data = $postcategory->find('threaded');// Extra parameters added
		$this->set('postcategories', $data);//it is handled in index.ctp
		/*Tag Cloud Starts*/
		$this->set('tags', $this->Article->Tagged->find('cloud', array('limit' => 20)));
		/*Tag Cloud Ends*/
	}
	
	public function admin_index($postcategoryid=null) {
		$this->index($postcategoryid);
		$this->set('masterclass','');
	}
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($slug=null,$id = null) {
		if (!$this->Article->exists($id)) {
			//throw new PostNotFoundException(__('Invalid post'));
			
		}
		
		$fields = array("Article.id","Article.articlecategory_id","Article.admin_id","Article.title","Article.body","Article.modified","Admin.firstname","Admin.id","Article.articleview_count","Article.comment_count");
		$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
		$post = $this->Article->find('first', $options);
		//pr($post);exit;
		/*$value = array('post'=>$post['Post']['title'],'image'=>$post['Postcoverimage']['namebig'],'created'=>$post['Post']['created'],'user'=>$post['User']['firstname']);$value = serialize($value);
		$this->Cookie->write("impost", $value,false,time()+3600);*/
		$this->set('post', $post);
		$this->set('article_id',$id);
		
		App::import('Model','Articlecategory');
		$postcategory = new Articlecategory();
		$treePath = $postcategory->getPath($post['Article']['articlecategory_id']);
		$this->set(compact('treePath')); //this is used for the breadcrumb
		
		$data = $postcategory->find('threaded');// Extra parameters added
		$this->set('postcategories', $data);//it is used for sidebar category tree
		
		/*this generate list of comment in the tree structure but need to set UI for this */
		$commentconditions = array("Comment.article_id"=>$post['Article']['id'],"Comment.active"=>1);
		$comments = $this->Article->Comment->find('threaded',array('conditions' => $commentconditions));
		//pr($comments);exit;		
		$this->set(compact('comments'));
		
		$this->set('pageurl',$this->_confurl());
		
		App::import('Model','Articleview');
		$postview = new Articleview();
		$postviews['Articleview']['article_id'] = $id;
		$postviews['Articleview']['ipadds'] = $this->_getRealIpAddr();
		$postviews['Articleview']['realipadds'] = $this->_getRealIpAddr();
		$postviews['Articleview']['opsys'] = '';
		if($this->MobileDetect->detect('isMobile')){
			if($this->MobileDetect->detect('isiOS')){
				$iv = $this->MobileDetect->detect('version','iPhone');
				$postviews['Articleview']['opsys'] = 'Mobile.iOS'.$iv;
			}
			if($this->MobileDetect->detect('isAndroidOS')){
				$iv = $this->MobileDetect->detect('version','Android');
				$postviews['Articleview']['opsys'] = 'Mobile.Android'.$iv;
			}
		}
		if($this->MobileDetect->detect('isTablet')){
			if($this->MobileDetect->isiOS()){
				$iv = $this->MobileDetect->detect('version','iPad');
				$postviews['Articleview']['opsys'] = 'iPad'.$iv;
			}
			if($this->MobileDetect->isAndroidOS()){
				$iv = $this->MobileDetect->detect('version','Android');
				$postviews['Articleview']['opsys'] = 'Tab.Android'.$iv;
			}
		}
		$postview->create();
		$postview->save($postviews);unset($postviews);
		
		/*fetch the view and comment counts of the post */
		$view_count = $this->Article->Articleview->find('count', array('conditions'=>array('Articleview.article_id'=>$id)));
		$this->set('view_count',$view_count);
		$comment_count = $this->Article->Comment->find('count', array('conditions'=>array('Comment.article_id'=>$id)));
		$this->set('comment_count',$comment_count);
		
			
		/*Tag Cloud Starts*/
		$this->set('tags', $this->Article->Tagged->find('cloud', array('limit' => 20)));
		/*Tag Cloud Ends*/
	}
	
	public function admin_view($id = null){
		$fields = array("Article.id","Article.articlecategory_id","Article.admin_id","Article.title","Article.body","Article.modified","Admin.firstname","Admin.id","Comment.id");
		$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
		$post = $this->Article->find('first', $options);
	//	pr($post);exit;
		$this->set('post', $post);
		$this->set('article_id',$id);
		
		App::import('Model','Articlecategory');
		$postcategory = new Articlecategory();
		$treePath = $postcategory->getPath($post['Article']['articlecategory_id']);
		$this->set(compact('treePath'));
		
		/*this generate list of comment in the tree structure but need to set UI for this */
		$commentconditions = array("Comment.article_id"=>$post['Article']['id']);
		$comments = $this->Article->Comment->find('threaded',array('conditions' => $commentconditions));
		//pr($comments);exit;		
		$this->set(compact('comments'));
		
		$this->set('masterclass','');
	}

/**
 * add method
 *
 * @return void
 */
	public function create($admin=null) {
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Article']['admin_id'] = $this->Session->read("Auth.Admin.id");
			$this->Article->Articlecoverimage->set($this->request->data);
			if($this->Article->validates() && $this->Article->Articlecoverimage->validates()){
				$this->Article->create();				
				if ($this->Article->save($this->request->data)) {
					$post_id = $this->Article->getLastInsertId();
					$this->request->data['Articlecoverimage']['article_id'] = $post_id;
					if($this->Article->Articlecoverimage->save($this->request->data['Articlecoverimage'])){
						$this->Session->setFlash(__('The post has been saved.'));
						return $this->redirect(array('controller'=>'articles','action'=>'index'));						
					}else{
						$this->Session->setFlash(__('Featured image for post is not uploaded'));
						return $this->redirect(array('controller'=>'articles','action'=>'index'));
					}
					
				} else {
					$this->Session->setFlash(__('The post could not be saved. Please, try again'));
					return $this->redirect(array('controller'=>'articles','action'=>'index'));
				}
			}
		}
		/*fetch all nested categories list*/
		App::import('Model','Articlecategory');
		$postcategory = new Articlecategory();
		$postcategory->recursive = 1;
		$data = $postcategory->find('threaded');// Extra parameters added
		$this->set('postcategories', $data);//it is handled in index.ctp
		if($this->Session->check("Auth.Admin")){
			$user_id = $this->Session->read("Auth.Admin.id");
			$this->set('admin_id',$user_id);
		}else{
			$this->Session->setFlash(__('User identity is not recognised'));
			return $this->redirect($this->Auth->logoutRedirect);
		}
	}

	public function admin_create(){ 
		$this->create($admin=true);
		App::import('Model','Articlecategory');
		$treecategory = new Articlecategory();
		
		$spacer="--";
		$parent = $treecategory->generateTreeList('', '', '', $spacer);
		$this->set(compact('parent'));
		
	}
	
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		//pr($this->request->data);exit;
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Article->save($this->request->data)) {
				if(!empty($this->request->data['Postcoverimage']['image']['name'])){
					$this->Article->Articlecoverimage->delete($this->request->data['Articlecoverimage']['id']);
					$this->request->data['Postcoverimage']['article_id'] = $id;
					$this->Article->Articlecoverimage->set($this->request->data['Articlecoverimage']);
					$this->Article->Articlecoverimage->save($this->request->data['Articlecoverimage']);
				}
				$this->Session->setFlash(__('The post has been saved.'));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'));
			}
		} else {
			
		}
			$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
			$this->request->data = $this->Article->find('first', $options);
			$this->set('featured_image',$this->request->data['Articlecoverimage']['namesmall']);
		$users = $this->Article->Admin->find('list');
		$this->set(compact('users'));
	}
	
	public function admin_edit($id = null){
		$this->edit($id);
		App::import('Model','Articlecategory');
		$postcategory = new Articlecategory();
		$spacer="--";
		$parent = $postcategory->generateTreeList('', '', '', $spacer);
		$this->set(compact('parent'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Article->id = $id;
		if (!$this->Article->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		//$this->request->allowMethod('post', 'admin_delete');
		if ($this->Article->delete()) {
			$this->Session->setFlash(__('The post has been deleted.'));
		} else {
			$this->Session->setFlash(__('The post could not be deleted. Please, try again.'));
		}
		
		return $this->redirect(array('action' => 'index'));
	}
}
