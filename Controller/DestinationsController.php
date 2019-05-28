<?php
App::uses('AppController', 'Controller');
/**
 * Aagentgroups Controller
 *
 * @property Aagentgroup $Aagentgroup
 * @property PaginatorComponent $Paginator
 */
class DestinationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Flash');
	
	public function beforeFilter() {
		parent::beforeFilter();
		// For CakePHP 2.1 and up
		//$this->Auth->allow();
		$this->Auth->authorize = array(
			AuthComponent::ALL => array('actionPath' => 'controllers/', 'userModel' => 'Admin'),
			'Actions',
			'Controller'
		);

		$this->set('masterclass','');
		$this->set('dashboardclass','');
		$this->set('aclclass','');
		$this->set('usersclass','');
		$this->set('groupsclass','active');
	}

/**
 * index method
 *
 * @return void
 */
	public function index($admin=null) {
		$this->Destination->recursive = 0;
		$this->Paginator->settings=array(
			'Destination' => array(
				'order'=>array('Destination.name'=>'asc'),
			)
		);
		$destinations = $this->Paginator->paginate();
		$this->set('destinations', $destinations);
	}
	public function admin_index($admin=true) {
		$this->index($admin);
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		/*if (!$this->Destination->exists($id)) {
			throw new NotFoundException(__('Invalid Destination'));
		}*/
		$options = array('conditions' => array('Destination.' . $this->Destination->primaryKey => $id));
		$destination = $this->Destination->find('first', $options);
		//pr($destination);
		$this->set('destination',$destination );
	}
	public function admin_view($id = null) {
		
		$this->view($id);
	}

/**
 * add method
 *
 * @return void
 */
	public function create() {
		if ($this->request->is(array('post','put'))) {
			//pr($this->request->data);exit;
			$this->Destination->create();
			if ($this->Destination->save($this->request->data)) {
				$this->Flash->success(__('The Destination has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The Destination could not be saved. Please, try again.'));
			}
		}
	}
public function admin_create() {
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
		if (!$this->Destination->exists($id)) {
			throw new NotFoundException(__('Invalid Destination'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Destination->save($this->request->data)) {
				$this->Flash->success(__('The Destination has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The Destination could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Destination.' . $this->Destination->primaryKey => $id));
			$this->request->data = $this->Destination->find('first', $options);
		}
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
		$this->Destination->id = $id;
		if (!$this->Destination->exists()) {
			throw new NotFoundException(__('Invalid Destination'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Destination->delete()) {
			$this->Flash->success(__('The Destination has been deleted.'));
		} else {
			$this->Flash->error(__('The Destination could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
