<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class ArticlecategoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
		$this->set('masterclass','active');
		$this->set('usersclass','');
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Articlecategory->recursive = 0;

		$this->Paginator->settings=array(
			'Articlecategory' => array(
				'order'=>array('Articlecategory.name'=>'asc'),
			)
		);
		$destinations = $this->Paginator->paginate();
		$this->set('articalcategories', $destinations);
	}
	
	public function admin_index(){
		$this->index();
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_create() {
		if ($this->request->is('post')) {
			$this->Articlecategory->create();
			if ($this->Articlecategory->save($this->request->data)) {
				$this->Flash->success(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index','admin'=>true));
			} else {
				$this->Flash->error(__('The category could not be saved. Please, try again.'));
			}
		}
		$spacer="-";
		$parent = $this->Articlecategory->generateTreeList('', '', '', $spacer);
		$this->set(compact('parent'));
	}
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Articlecategory->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Articlecategory.' . $this->Articlecategory->primaryKey => $id));
		$this->set('articlecategory', $this->Articlecategory->find('first', $options));
	}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Articlecategory->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Articlecategory->save($this->request->data)) {
				$this->Flash->success(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Articlecategory.' . $this->Articlecategory->primaryKey => $id));
			$this->request->data = $this->Articlecategory->find('first', $options);
		$spacer="-";
		$parent = $this->Articlecategory->generateTreeList('', '', '', $spacer);
		$this->set(compact('parent'));
		}
		
	}
	public function admin_edit($id = null){
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
		$this->Articlecategory->id = $id;
		if (!$this->Articlecategory->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Articlecategory->delete()) {
			$this->Flash->success(__('The category has been deleted.'));
		} else {
			$this->Flash->error(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
