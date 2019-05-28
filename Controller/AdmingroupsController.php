<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class AdmingroupsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Flash');

	public function beforeFilter() {
		
		parent::beforeFilter();
		// For CakePHP 2.1 and up
		$this->Auth->allow('index','create');
		//$this->Auth->allow();
		$this->layout='admin';
		$this->set('masterclass','');
		$this->set('dashboardclass','');
		$this->set('aclclass','');
		$this->set('usersclass','');
		$this->set('groupsclass','active');
		
		$this->Auth->authorize = array(
			AuthComponent::ALL => array('actionPath' => 'controllers/', 'userModel' => 'Admin'),
			'Actions',
			'Controller'
		);
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Admingroup->recursive = 0;
		$this->set('admingroups', $this->Paginator->paginate());
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
		if (!$this->Admingroup->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		$options = array('conditions' => array('Admingroup.' . $this->Admingroup->primaryKey => $id));
		$this->set('admingroup', $this->Admingroup->find('first', $options));
	}
	
	public function admin_view($id = null){
		$this->view($id);
		$this->set('masterclass','');
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_create() {
		if ($this->request->is(array('post','put'))) {
			$this->Admingroup->create();
			if ($this->Admingroup->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		}
		$this->set('masterclass','');
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Admingroup->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Admingroup->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Admingroup.' . $this->Admingroup->primaryKey => $id));
			$this->request->data = $this->Admingroup->find('first', $options);
		}
	}

	
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Admingroup->id = $id;
		if (!$this->Admingroup->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Admingroup->delete()) {
			$this->Session->setFlash(__('The group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
