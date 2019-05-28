<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 * @property PaginatorComponent $Paginator
 */
class CommentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Paginator',
		'Captcha.Captcha'=>array(
			'model'=>'Comment','field'=>'captcha'
		),
	);
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
		$this->set('masterclass','');
	}
/*========================Private Methodes==================================*/

	private function _send_custom_notification($objemail,$post=null,$comment=null){
		$notification_team = $this->custom_notification_team;//defined in appController
		$objemail->subject('New comment is added');
		$objemail->emailFormat('html');
		$objemail->template('notifycomment','commentnotification')->viewVars(
							array(
								'post'=>$post,
								'comment'=>$comment
							)
							);
		if (count($notification_team)>0){
			foreach($notification_team as $member){
				$objemail->to ($member);
				if(!empty($this->request->data['Comment']['email_address'])){
					$from_email = $this->request->data['Comment']['email_address'];
				}else{
					$from_email = 'no-reply@chirayu.im';
				}
				$objemail->from (array($from_email=> $this->request->data['Comment']['firstname']));
				$objemail->send();
			}
		}
	}

/*===========================================================================*/
/**
 * index method
 *
 * @return void
 */
	public function index() {
		//$this->Comment->recursive = 0;
		$this->Paginator->settings = array(
		'Comment'=>array(
        'conditions' => array(),
        'limit' => 20,
		'order'=>array('modified' => 'DESC'))
    );
		$this->Comment->Behaviors->attach('Containable');
		$this->set('comments', $this->Paginator->paginate());
	}

	public function admin_index() {
		$this->index();
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Comment->exists($id)) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
		$this->set('comment', $this->Comment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function create() {
	
		if ($this->request->is(array('post','put'))) {//pr($this->request->data);exit;
			$this->Comment->create();
			App::import('Model','Post');
			$post = new Post();
			$postdata = $post->find('first',array('fields'=>array("Post.title"),'conditions'=>array("Post.id"=>$this->request->data['Comment']['post_id'])));
			
			$this->request->data['Comment']['message']=strip_tags($this->request->data['Comment']['message'],'<p><b>');
			$this->Comment->setCaptcha('scode', $this->Captcha->getCode('Comment.scode'));
			if ($this->Comment->save($this->request->data)) {
				
				$Email = new CakeEmail('smtp');
				$this->_send_custom_notification($Email,$postdata['Post']['title'],$this->request->data['Comment']['message']);
				$this->Session->setFlash(__('The comment has been saved.'));
				//return $this->redirect(array('controller'=>'posts','action'=>'view','slug'=>Inflector::slug($postdata['Post']['title'],'-'),'id'=>$this->request->data['Comment']['post_id']));
			} else {
				$this->Session->setFlash(__('Comment could not be saved. Check your comments inputs.'));
				$this->_persistValidation('Comment');
			}
			return $this->redirect(array('controller'=>'posts','action'=>'view','slug'=>Inflector::slug($postdata['Post']['title'],'-'),'id'=>$this->request->data['Comment']['post_id']));
		}
		
		//$posts = $this->Comment->Post->find('list');
		//$users = $this->Comment->User->find('list');
		//$this->set(compact('posts', 'users'));
	}
	
	public function admin_create(){
		$this->create();
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
		} else {
			if (!$this->Comment->exists($id)) {
				throw new NotFoundException(__('Invalid comment'));
			}
			$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
			$this->request->data = $this->Comment->find('first', $options);
		}
		
		//$posts = $this->Comment->Post->find('list');
		//$users = $this->Comment->User->find('list');
		//$this->set(compact('posts', 'users'));
	}
	public function admin_edit($id = null) {
		
		$this->edit($id);
		App::import('Model','Postcategory');
		$postcategory = new Postcategory();
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
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$this->request->allowMethod('post','admin_delete');
		if ($this->Comment->delete()) {
			$this->Session->setFlash(__('The comment has been deleted.'));
		} else {
			$this->Session->setFlash(__('The comment could not be deleted. Please, try again.'));
		}
		
		return $this->redirect(array('action' => 'index','admin'=>true));
	}
}
