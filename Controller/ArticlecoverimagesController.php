<?php
App::uses('AppController', 'Controller');
/**
 * Postcoverimages Controller
 *
 * @property Postcoverimage $Postcoverimage
 * @property PaginatorComponent $Paginator
 */
class ArticlecoverimagesController extends AppController {

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
		$this->Articlecoverimage->recursive = 0;
		$this->set('articlecoverimages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Articlecoverimage->exists($id)) {
			throw new NotFoundException(__('Invalid postcoverimage'));
		}
		$options = array('conditions' => array('Articlecoverimage.' . $this->Articlecoverimage->primaryKey => $id));
		$this->set('articlecoverimage', $this->Articlecoverimage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Articlecoverimage->create();
			if ($this->Articlecoverimage->save($this->request->data)) {
				$this->Session->setFlash(__('The Articlecoverimage has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Articlecoverimage could not be saved. Please, try again.'));
			}
		}
		$articles = $this->Articlecoverimage->Article->find('list');
		$this->set(compact('articles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Articlecoverimage->exists($id)) {
			throw new NotFoundException(__('Invalid Articlecoverimage'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Articlecoverimage->save($this->request->data)) {
				$this->Session->setFlash(__('The Articlecoverimage has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Articlecoverimage could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Articlecoverimage.' . $this->Articlecoverimage->primaryKey => $id));
			$this->request->data = $this->Articlecoverimage->find('first', $options);
		}
		$articles = $this->Articlecoverimage->Post->find('list');
		$this->set(compact('articles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Articlecoverimage->id = $id;
		if (!$this->Articlecoverimage->exists()) {
			throw new NotFoundException(__('Invalid Articlecoverimage'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Articlecoverimage->delete()) {
			$this->Session->setFlash(__('The Articlecoverimage has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Articlecoverimage could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function listextraimages($size='medium',$last=7){
		$folderpath = '/files/uploads/';
		$conditions = array('UNIX_TIMESTAMP(Articlecoverimage.created) >'=>mktime(0, 0, 0, date("m"), date("d")-$last, date("Y")));
		$fields = array('Articlecoverimage.id','Articlecoverimage.created','Articlecoverimage.name'.$size);
		$dbcoverimages = $this->Articlecoverimage->find('all', array('fields'=>$fields,'conditions'=>$conditions));
		//pr($dbcoverimages);
		return($dbcoverimages);
	}
	
	public function folderlistextraimages($size='medium',$last=7){
		$folderpath = 'files/uploads/postimages';
		$conditions = array('UNIX_TIMESTAMP(Articlecoverimage.created) >'=>mktime(0, 0, 0, date("m"), date("d")-$last, date("Y")));
		$fields = array('Articlecoverimage.id','Articlecoverimage.created','Articlecoverimage.name'.$size);
		$smallimages = $this->listextraimages('small',$last=7);
		$mediumimages = $this->listextraimages('medium',$last=7);
		$bigimages = $this->listextraimages('big',$last=7);
		$origimages = $this->listextraimages('',$last=7);
		$combinearray = array_merge($smallimages,$mediumimages,$bigimages,$origimages);
		$dh  = opendir($folderpath);
			while (false !== ($filename = readdir($dh))) {
				if(filemtime($folderpath.'/'.$filename)>=mktime(0, 0, 0, date("m"), date("d")-$last, date("Y"))){
					
					$foldercoverimages[] = $filename;
				}
			}
		pr($combinearray); //database array from last 7 days
		//pr($foldercoverimages);
	}
}
