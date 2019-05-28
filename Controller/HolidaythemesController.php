<?php
App::uses('AppController', 'Controller');
/**
 * Aagentgroups Controller
 *
 * @property Aagentgroup $Aagentgroup
 * @property PaginatorComponent $Paginator
 */
class HolidaythemesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
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
	public function index() {
		$this->Holidaytheme->recursive = 0;
		$this->set('holidaythemes', $this->Paginator->paginate());
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
		if (!$this->Holidaytheme->exists($id)) {
			throw new NotFoundException(__('Invalid Holidaytheme'));
		}
		$options = array('conditions' => array('Holidaytheme.' . $this->Holidaytheme->primaryKey => $id));
		$this->set('holidaytheme', $this->Holidaytheme->find('first', $options));
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
		if ($this->request->is('post')) {
			$this->Holidaytheme->create();
			if ($this->Holidaytheme->save($this->request->data)) {
				$this->Flash->success(__('The Holidaytheme has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The Holidaytheme could not be saved. Please, try again.'));
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
		if (!$this->Holidaytheme->exists($id)) {
			throw new NotFoundException(__('Invalid Holidaytheme'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Holidaytheme->save($this->request->data)) {
				$this->Flash->success(__('The Holidaytheme has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The Holidaytheme could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Holidaytheme.' . $this->Holidaytheme->primaryKey => $id));
			$this->request->data = $this->Holidaytheme->find('first', $options);
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
		$this->Holidaytheme->id = $id;
		if (!$this->Holidaytheme->exists()) {
			throw new NotFoundException(__('Invalid Holidaytheme'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Holidaytheme->delete()) {
			$this->Flash->success(__('The Holidaytheme has been deleted.'));
		} else {
			$this->Flash->error(__('The Holidaytheme could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
