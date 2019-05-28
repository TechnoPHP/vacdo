<?php
App::uses('TagentsAppController', 'Tagents.Controller');
/**
 * Aagentgroups Controller
 *
 * @property Aagentgroup $Aagentgroup
 * @property PaginatorComponent $Paginator
 */
class HolidaythemesController extends TagentsAppController {

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
		$this->Aagentgroup->recursive = 0;
		$this->set('aagentgroups', $this->Paginator->paginate());
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
		if (!$this->Aagentgroup->exists($id)) {
			throw new NotFoundException(__('Invalid aagentgroup'));
		}
		$options = array('conditions' => array('Aagentgroup.' . $this->Aagentgroup->primaryKey => $id));
		$this->set('aagentgroup', $this->Aagentgroup->find('first', $options));
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
			$this->Aagentgroup->create();
			if ($this->Aagentgroup->save($this->request->data)) {
				$this->Flash->success(__('The aagentgroup has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The aagentgroup could not be saved. Please, try again.'));
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
		if (!$this->Aagentgroup->exists($id)) {
			throw new NotFoundException(__('Invalid aagentgroup'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Aagentgroup->save($this->request->data)) {
				$this->Flash->success(__('The aagentgroup has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The aagentgroup could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Aagentgroup.' . $this->Aagentgroup->primaryKey => $id));
			$this->request->data = $this->Aagentgroup->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Aagentgroup->id = $id;
		if (!$this->Aagentgroup->exists()) {
			throw new NotFoundException(__('Invalid aagentgroup'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Aagentgroup->delete()) {
			$this->Flash->success(__('The aagentgroup has been deleted.'));
		} else {
			$this->Flash->error(__('The aagentgroup could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
