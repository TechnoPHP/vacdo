<?php
App::uses('TagentsAppController', 'Tagents.Controller');
/**
 * Workerreferences Controller
 *
 * @property Workerreference $Workerreference
 * @property PaginatorComponent $Paginator
 */
class WorkerreferencesController extends TagentsAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Workerreference->recursive = 0;
		$this->set('workerreferences', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Workerreference->exists($id)) {
			throw new NotFoundException(__('Invalid workerreference'));
		}
		$options = array('conditions' => array('Workerreference.' . $this->Workerreference->primaryKey => $id));
		$this->set('workerreference', $this->Workerreference->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Workerreference->create();
			if ($this->Workerreference->save($this->request->data)) {
				$this->Flash->success(__('The workerreference has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The workerreference could not be saved. Please, try again.'));
			}
		}
		$workers = $this->Workerreference->Worker->find('list');
		$this->set(compact('workers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Workerreference->exists($id)) {
			throw new NotFoundException(__('Invalid workerreference'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Workerreference->save($this->request->data)) {
				$this->Flash->success(__('The workerreference has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The workerreference could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Workerreference.' . $this->Workerreference->primaryKey => $id));
			$this->request->data = $this->Workerreference->find('first', $options);
		}
		$workers = $this->Workerreference->Worker->find('list');
		$this->set(compact('workers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Workerreference->id = $id;
		if (!$this->Workerreference->exists()) {
			throw new NotFoundException(__('Invalid workerreference'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Workerreference->delete()) {
			$this->Flash->success(__('The workerreference has been deleted.'));
		} else {
			$this->Flash->error(__('The workerreference could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
