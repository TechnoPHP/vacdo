<?php
App::uses('TagentsAppController', 'Tagents.Controller');
/**
 * Workers Controller
 *
 * @property Worker $Worker
 * @property PaginatorComponent $Paginator
 */
class WorkersController extends TagentsAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Flash');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Worker->recursive = 0;
		$postcondition = array();
		$this->Paginator->settings = array(
			'Worker'=>array(				
				'fields'=>array('Agency.id','Agency.name','Worker.id','Worker.firstname','Worker.lastname','Worker.gender','Worker.phone','Category.name','Category.id','Worker.modified','Worker.ctcity','Worker.active','Worker.approved'),
				'conditions' => array($postcondition),
				'limit' => 20,
				'order'=>array('Worker.modified'=>'desc'),
			)
		);
		
		$workers = $this->Paginator->paginate();
		//pr($workers);exit;
		$this->set('workers',$workers );
	}
	 function myworkers(){
		if(!$this->Session->check("Auth.Aagent")){
			throw new NotFoundException(__('Agent is not logged In'));
		}
		$postcondition = array("Workers.agency_id"=>$this->Session->read("Auth.Aagent.agency_id"));
		$myworkers = $this->Worker->findAllByAgencyId($this->Session->read("Auth.Aagent.agency_id"),array('Agency.id','Agency.name','Worker.id','Worker.firstname','Worker.lastname','Worker.gender','Worker.phone','Category.name','Category.id','Worker.modified','Worker.ctcity','Worker.active','Worker.approved'));
		/*$this->Paginator->settings = array(
			'Worker'=>array(				
				'fields'=>array('Agency.id','Agency.name','Worker.id','Worker.firstname','Worker.lastname','Worker.gender','Worker.phone','Category.name','Category.id','Worker.modified','Worker.ctcity','Worker.active','Worker.approved'),
				'conditions' => array($postcondition),
				'limit' => 20,
				'order'=>array('Worker.modified'=>'desc'),
			)
		);*/
		$this->Paginator->paginate($myworkers);
		pr($myworkers);
		$this->set('myworkers',$myworkers);
	}

	protected function _findAgencyId(){
		
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Worker->exists($id)) {
			throw new NotFoundException(__('Invalid worker'));
		}
		$options = array('conditions' => array('Worker.' . $this->Worker->primaryKey => $id));
		$this->set('worker', $this->Worker->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function create() {
		if ($this->request->is(array('post','put'))) {
			
			$this->request->data['Worker']['agency_id'] = $this->Session->read("Auth.Aagent.agency_id");
			//pr($this->Session->read("Auth.Aagent"));exit;
			$this->Worker->create();
			
			if ($this->Worker->save($this->request->data)) {
				$this->Flash->success(__('The worker has been saved.'));
				return $this->redirect(array('controller'=>'workers','action' => 'index'));
			} else {
				$this->Flash->error(__('The worker could not be saved. Please, try again.'));
			}
		}
		$aagents = $this->Worker->Agency->find('list');
		$categories = $this->Worker->Category->find('list');
		$admins = $this->Worker->Admin->find('list');
		$this->set(compact('aagents', 'categories', 'admins'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Worker->exists($id)) {
			throw new NotFoundException(__('Invalid worker'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Worker->save($this->request->data)) {
				$this->Flash->success(__('The worker has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The worker could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Worker.' . $this->Worker->primaryKey => $id));
			$this->request->data = $this->Worker->find('first', $options);
		}
		$aagents = $this->Worker->Aagent->find('list');
		$categories = $this->Worker->Category->find('list');
		$admins = $this->Worker->Admin->find('list');
		$this->set(compact('aagents', 'categories', 'admins'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Worker->id = $id;
		if (!$this->Worker->exists()) {
			throw new NotFoundException(__('Invalid worker'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Worker->delete()) {
			$this->Flash->success(__('The worker has been deleted.'));
		} else {
			$this->Flash->error(__('The worker could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
