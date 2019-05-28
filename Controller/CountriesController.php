<?php
class CountriesController extends AppController {
	var $name = 'Countries';
	
	public $components = array('Paginator');
	
	function beforeFilter(){
		parent::beforeFilter();
	//	$this->Auth->allow('admin_index');
		$this->set('masterclass','active');
		$this->set('dashboardclass','');
		$this->set('usersclass','');
		$this->set('groupsclass','');
		$this->set('aclclass','');
		
		$this->Auth->authorize = array(
			AuthComponent::ALL => array('actionPath' => 'controllers/', 'userModel' => 'Admin'),
			'Actions',
			'Controller'
		);
	}

	public function getcountries(){
		$conditions = array();
		//pr($this->params);exit;
		if($this->request->is('post')){
			if(json_decode($this->params['data'])!=null){
				$countryId = json_decode($this->params['data']);
				$conditions = array("Country.id"=>$countryId);
			}else{}
		}else{ }		
		$countries = $this->Country->find("list",array("conditions"=>$conditions));
		//pr($countries);exit;
		$this->set('countries',$countries);
		$this->set('_serialize','countries');
	}
	
	public function getcountrydata(){
		//Configure::write('debug','0');
		//pr($this->request->params['named']);exit;
		foreach($_POST as $data){
			list($key,$value) = explode('=',$data);
		}
		$this->Country->unbindModel(array("hasMany"=>array("Region")));
		$conditions = array("Country.id"=>$value);
		$country = $this->Country->findById($value);
		$this->set('country',$country);
		$this->set('_serialize', 'country');
	}

	public function admin_create(){
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Country->save($this->request->data)) {
				$this->Session->setFlash('country data is saved');
			} else {
				$this->Session->setFlash('Error in saving country data');
			}
			$this->redirect(array('controller' => 'countries','action' =>'index','admin'=>true));
		}
		
	}
	
	public function edit(){
		//pr(json_decode($this->params['data']));exit;
		$this->request->data = json_decode($this->params['data']);
		 if ($this->Country->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array('message' => $message,'_serialize' => array('message')));
	}
	
	public function admin_edit($countryid=null){	
	
		if (!$this->Country->exists($countryid)) {
			throw new NotFoundException(__('Invalid Country'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Country->save($this->request->data)) {
				$this->Session->setFlash('country data is saved');
			} else {
				$this->Session->setFlash('Error in saving country data');
			}
			$this->redirect(array('controller' => 'countries','action' =>'index','admin'=>true));
		}else {
			$options = array('conditions' => array('Country.' . $this->Country->primaryKey => $countryid));
			$this->request->data = $this->Country->find('first', $options);
			//pr($this->request->data);
		}
		
	}
	
	public function index($countryid=null){
	
		$countrycondition = array(); //"Country.active"=>1
		if($countryid){
			$countrycondition = array_merge($countrycondition,array("Country.id"=>$countryid));
		}
		
		$this->Country->unbindModel(array('hasMany' => array('Region')));
		$this->Paginator->settings = array(
					'Country'=>array('fields'=>array('Country.id','Country.name','Country.iso_2','Country.iso_3','Country.phonecode','Country.isonumeric','Country.lat','Country.long','Country.active'),
									'conditions' => array($countrycondition),
									'limit' => 50,
									'order'=>array('modified' => 'DESC')
					)
		);
		$countries = $this->Paginator->paginate();
		//pr($countries);exit;
		$this->set('countries', $countries);
	}
	
	public function admin_index(){
		$this->index();
	}
	public function admin_view($countryid=null){
		$this->Country->unbindModel(array('hasMany'=>array('Region')));	
		$options = array('conditions' => array('Country.' . $this->Country->primaryKey => $countryid));
		$country = $this->Country->find('first', $options);
		//pr($country);exit;	
		$this->set('country', $country);
		$this->set('masterclass','active');
	}
}
?>