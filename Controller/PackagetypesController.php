<?php
App::uses('AppController', 'Controller');
/**
 * Aagentgroups Controller
 *
 * @property Aagentgroup $Aagentgroup
 * @property PaginatorComponent $Paginator
 */
class PackagetypesController extends AppController {

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
		$this->Packagetype->recursive = 0;
		$this->set('packagetypes', $this->Paginator->paginate());
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
		if (!$this->Packagetype->exists($id)) {
			throw new NotFoundException(__('Invalid Packagetype'));
		}
		$options = array('conditions' => array('Packagetype.' . $this->Packagetype->primaryKey => $id));
		$this->set('packagetype', $this->Packagetype->find('first', $options));
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
			$this->Packagetype->create();
			if ($this->Packagetype->save($this->request->data)) {
				$this->Flash->success(__('The Packagetype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The Packagetype could not be saved. Please, try again.'));
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
		if (!$this->Packagetype->exists($id)) {
			throw new NotFoundException(__('Invalid Packagetype'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Packagetype->save($this->request->data)) {
				$this->Flash->success(__('The Packagetype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The Packagetype could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Packagetype.' . $this->Packagetype->primaryKey => $id));
			$this->request->data = $this->Packagetype->find('first', $options);
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
		$this->Packagetype->id = $id;
		if (!$this->Packagetype->exists()) {
			throw new NotFoundException(__('Invalid Packagetype'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Packagetype->delete()) {
			$this->Flash->success(__('The Packagetype has been deleted.'));
		} else {
			$this->Flash->error(__('The Packagetype could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
