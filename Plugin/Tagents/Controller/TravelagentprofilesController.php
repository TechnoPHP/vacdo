<?php
App::uses('TagentsAppController', 'Tagents.Controller');

/**
 * Profiles Controller
 *
 * @property Profile $Profile
 * @property PaginatorComponent $Paginator
 */
class TravelagentprofilesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
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
		$this->Travelagentprofile->recursive = 0;
		$this->set('profiles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Travelagentprofile->exists($id)) {
			throw new NotFoundException(__('Invalid profile'));
		}
		$conditions = array('Travelagentprofile.' . $this->Travelagentprofile->primaryKey => $id);
		//$profile = $this->Travelagentprofile->find('first', $options);
		
		$fields = array("Travelagentprofile.*","Travelagent.id","Travelagent.firstname","Travelagent.email_address");
		$profile = $this->Travelagentprofile->Travelagent->find('first',array("fields"=>$fields,"conditions"=>$conditions));
		//pr($profile);exit;
		$this->set('profile', $profile);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
		
			$this->Travelagentprofile->create();
			if ($this->Travelagentprofile->save($this->request->data)) {
				$this->Session->setFlash(__('The profile has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
			}
		}
		$agents = $this->Travelagentprofile->Travelagent->find('list');
		$this->set(compact('agents'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		
		if (!$this->Travelagentprofile->exists($id)) {
			throw new NotFoundException(__('Invalid profile'));
		}
			//pr($this->request->data);exit;
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Travelagentprofile->save($this->request->data)) {
				$this->Session->setFlash(__('Travelagentprofile has been saved.'));
				return $this->redirect(array('plugin'=>'tagents','controller'=>'travelagents','action'=>'dashboard',$this->request->data['Travelagentprofile']['travelagent_id']));
			} else {
				$this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Travelagentprofile.' . $this->Travelagentprofile->primaryKey => $id));
			$this->request->data = $this->Travelagentprofile->find('first', $options);
		}
		$conditions = array("Travelagentprofile.id" => $id);
		$fields = array("Travelagentprofile.id","Travelagentprofile.birthdate","Travelagentprofile.userimage","Travelagentprofile.msgtype","Travelagentprofile.messanger","Travelagentprofile.quotes","Travelagent.id","Travelagent.firstname","Travelagent.lastname","Travelagent.email_address","Travelagent.phone");
		$profile = $this->Travelagentprofile->find('first',array("fields"=>$fields,'conditions'=>$conditions));
		//pr($profile);exit;
		$this->set('currentuser',$profile);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Travelagentprofile->id = $id;
		if (!$this->Travelagentprofile->exists()) {
			throw new NotFoundException(__('Invalid profile'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Travelagentprofile->delete()) {
			$this->Session->setFlash(__('The profile has been deleted.'));
		} else {
			$this->Session->setFlash(__('The profile could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function uploadimage() {
		$this->layout='ajax';
		if ($this->request->is(array('post','put'))) {
		//pr($this->request->data);exit;
			if ($this->Travelagentprofile->save($this->request->data,true)) {
				//$this->redirect(array('action' => 'uploadimage'));
			}
		}
		$fields = array("Travelagentprofile.id","Travelagentprofile.userimage");
		$conditions = array("Travelagentprofile.travelagent_id"=>$this->Session->read("Auth.Travelagent.id"));
		$user = $this->Travelagentprofile->find('first',array('conditions'=>$conditions,'fields'=>$fields));
		//pr($user);exit;
		if(!empty($user)){
			$this->set('userimage',$user['Travelagentprofile']['userimage']);
		}
	}
}
