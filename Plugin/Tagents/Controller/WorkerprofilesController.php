<?php
App::uses('TagentsAppController', 'Tagents.Controller');
/**
 * Workerprofiles Controller
 *
 * @property Workerprofile $Workerprofile
 * @property PaginatorComponent $Paginator
 */
class WorkerprofilesController extends TagentsAppController {

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
		$this->Workerprofile->recursive = 0;
		$this->set('workerprofiles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Workerprofile->exists($id)) {
			throw new NotFoundException(__('Invalid workerprofile'));
		}
		$options = array('conditions' => array('Workerprofile.' . $this->Workerprofile->primaryKey => $id));
		$this->set('workerprofile', $this->Workerprofile->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Workerprofile->create();
			if ($this->Workerprofile->save($this->request->data)) {
				$this->Flash->success(__('The workerprofile has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The workerprofile could not be saved. Please, try again.'));
			}
		}
		$workers = $this->Workerprofile->Worker->find('list');
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
		if (!$this->Workerprofile->exists($id)) {
			throw new NotFoundException(__('Invalid workerprofile'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Workerprofile->save($this->request->data)) {
				$this->Flash->success(__('The workerprofile has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The workerprofile could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Workerprofile.' . $this->Workerprofile->primaryKey => $id));
			$this->request->data = $this->Workerprofile->find('first', $options);
		}
		$workers = $this->Workerprofile->Worker->find('list');
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
		$this->Workerprofile->id = $id;
		if (!$this->Workerprofile->exists()) {
			throw new NotFoundException(__('Invalid workerprofile'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Workerprofile->delete()) {
			$this->Flash->success(__('The workerprofile has been deleted.'));
		} else {
			$this->Flash->error(__('The workerprofile could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
