<?php
App::uses('AppController', 'Controller');
/**
 * Aagentgroups Controller
 *
 * @property Aagentgroup $Aagentgroup
 * @property PaginatorComponent $Paginator
 */
class PlacesController extends AppController {

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
		$this->Place->recursive = 0;
		$this->Paginator->settings=array(
			'Place' => array(
				'order'=>array('Place.name'=>'asc'),
			)
		);
		$places = $this->Paginator->paginate();
		$this->set('places', $destinations);
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
		/*if (!$this->Place->exists($id)) {
			throw new NotFoundException(__('Invalid Place'));
		}*/
		$options = array('conditions' => array('Place.' . $this->Place->primaryKey => $id));
		$place = $this->Place->find('first', $options);
		//pr($place);
		$this->set('place',$place );
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
			$this->Place->create();
			if ($this->Place->save($this->request->data)) {
				$this->Flash->success(__('The Place has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The Place could not be saved. Please, try again.'));
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
		if (!$this->Place->exists($id)) {
			throw new NotFoundException(__('Invalid Place'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Place->save($this->request->data)) {
				$this->Flash->success(__('The Place has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The Place could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Place.' . $this->Place->primaryKey => $id));
			$this->request->data = $this->Place->find('first', $options);
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
		$this->Place->id = $id;
		if (!$this->Place->exists()) {
			throw new NotFoundException(__('Invalid Place'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Place->delete()) {
			$this->Flash->success(__('The Place has been deleted.'));
		} else {
			$this->Flash->error(__('The Place could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
