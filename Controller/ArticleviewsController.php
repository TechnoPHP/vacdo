<?php
App::uses('AppController', 'Controller');
/**
 * Postviews Controller
 *
 * @property Postview $Postview
 * @property PaginatorComponent $Paginator
 */
class ArticleviewsController extends AppController {

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
		$this->Articleview->recursive = 0;
		$this->set('postviews', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Articleview->exists($id)) {
			throw new NotFoundException(__('Invalid Articleview'));
		}
		$options = array('conditions' => array('Articleview.' . $this->Articleview->primaryKey => $id));
		$this->set('Articleview', $this->Articleview->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Articleview->create();
			if ($this->Articleview->save($this->request->data)) {
				$this->Session->setFlash(__('The Articleview has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Articleview could not be saved. Please, try again.'));
			}
		}
		$posts = $this->Articleview->Article->find('list');
		$this->set(compact('posts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Articleview->exists($id)) {
			throw new NotFoundException(__('Invalid Articleview'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Articleview->save($this->request->data)) {
				$this->Session->setFlash(__('The Articleview has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Articleview could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Articleview.' . $this->Articleview->primaryKey => $id));
			$this->request->data = $this->Articleview->find('first', $options);
		}
		$posts = $this->Articleview->Article->find('list');
		$this->set(compact('posts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Articleview->id = $id;
		if (!$this->Articleview->exists()) {
			throw new NotFoundException(__('Invalid Articleview'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Articleview->delete()) {
			$this->Session->setFlash(__('The Articleview has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Articleview could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
