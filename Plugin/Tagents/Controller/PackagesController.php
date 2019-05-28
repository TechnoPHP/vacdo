<?php
App::uses('TagentsAppController', 'Tagents.Controller');

/**
 * Profiles Controller
 *
 * @property Profile $Profile
 * @property PaginatorComponent $Paginator
 */
class PackagesController extends TagentsAppController {

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
	public function index($packagetype=null) {

		$postconditions = array();
		//$this->Package->recursive = 0;
		
		$postconditions = array("Packagetype.id"=>$packagetype);
		//$this->Package->Behaviors->load('Containable');
		$packages=$this->Package->find("all",
			array(
				'contain'=>array(
					'Packagetype'=>array(
						'conditions' => array(),
					)
				),
				'fields'=>array('Package.title','Package.id','Package.numberofdays','Package.numberofnights','Package.modified','Package.price'),
				'limit' => 10,
				'order'=>array('')
			)		
		);
		$packagess=$this->Paginator->paginate();
		$this->set('packages',$packages );
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Package->exists($id)) {
			throw new NotFoundException(__('Invalid profile'));
		}
		$conditions = array('Package.' . $this->Package->primaryKey => $id);
		//$profile = $this->Package->find('first', $options);
		
		$fields = array("Package.*","Travelagent.id","Travelagent.firstname","Travelagent.email_address");
		$profile = $this->Package->Travelagent->find('first',array("fields"=>$fields,"conditions"=>$conditions));
		//pr($profile);exit;
		$this->set('profile', $profile);
	}

/**
 * add method
 *
 * @return void
 */
	public function create() {
		if ($this->request->is(array('put','post'))) {
			if(!$this->Session->check("Auth.Travelagent")){
				$this->Flash->failure(__('The profile could not be saved. Please, try again.'));
				$this->redirect($this->Auth->logoutRedirect);
			}
			//pr($this->Session->read("Auth.Travelagent.Travelagency.id"));die;
			$this->request->data['Package']['travelagency_id'] = $this->Session->read("Auth.Travelagent.Travelagency.id");
			$this->Package->create();
			if ($this->Package->save($this->request->data)) {
				$this->Flash->success(__('The profile has been saved.'));
				return $this->redirect(array('plugin'=>'tagents','controller'=>'packages','action'=>'index','admin'=>false));
			} else {
				$this->Flash->failure(__('The package could not be saved. Please, try again.'));
			}
		}
		/*list of Package types and Holiday themes are being populated from the Appcontroller*/
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Package->exists($id)) {
			throw new NotFoundException(__('Invalid package'));
		}
		if(!$this->Session->check("Auth.Travelagent")){
				$this->Flasy->failure(__('The profile could not be saved. Please, try again.'));
				$this->redirect($this->Auth->logoutRedirect);
		}else{
		//pr($this->Session->read("Auth.Travelagent.Travelagency.id"));die;
		$this->request->data['Package']['travelagency_id'] = $this->Session->read("Auth.Travelagent.Travelagency.id");
		}
			//pr($this->request->data);exit;
		if ($this->request->is(array('post', 'put'))) {
			if(!array_key_exists('id',$this->request->data['Package'])){
				
			}
			if ($this->Package->saveAll($this->request->data)) {
				$this->Flash->success(__('Package has been saved.'));
				return $this->redirect(array('plugin'=>'tagents','controller'=>'packages','action'=>'index'));
			} else {
				$this->Flash->failure(__('The package could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Package.' . $this->Package->primaryKey => $id));
			$this->request->data = $this->Package->find('first', $options);
		}
		$packagetypes = $this->Package->Packagetype->find('list');		
		$this->set(compact('packagetypes'));
		$holidaythemes = $this->Package->Holidaytheme->find('list');		
		$this->set(compact('holidaythemes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Package->id = $id;
		if (!$this->Package->exists()) {
			throw new NotFoundException(__('Invalid Package'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Package->delete()) {
			$this->Session->setFlash(__('The Package has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Package could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
}
