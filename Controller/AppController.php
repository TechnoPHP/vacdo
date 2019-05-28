<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller implements IteratorAggregate {

	public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            ),
			'authError' => 'Action not allowed for your role',
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username'=>'email','password'=>'password')
				)
			),
        ),
        'Session','Flash'
    );
    public $helpers = array('Html', 'Form', 'Session');
	
	public function getIterator(){
       
    }
    public function beforeFilter() {
		//$this->Auth->allow();
        //Configure AuthComponent
		$this->Auth->allow('add','create','display','index','view','login','logout','registration','success','admin_login','checkout');
        $this->Auth->loginAction = array('plugin'=>'','controller'=>'users','action'=>'login');
        $this->Auth->logoutRedirect = array('plugin'=>'','controller'=>'users','action'=>'login');
        $this->Auth->loginRedirect = array('plugin'=>'','controller'=>'users','action'=>'dashboard');
		if(isset($this->params['prefix']) && ($this->params['prefix']=='admin')){
			if($this->Session->check("Auth.Admin.Admingroup")){
				if($this->Session->read("Auth.Admin.Admingroup.id")==1){
					$this->Auth->allow();
				}
			}$this->layout = 'admin';
        }
				
		if (isset($this->request->params['page'])) {
			$this->request->params['named']['page'] = $this->request->params['page'];
		}
		$this->categorylist();
		$this->countryisolist();
		$this->childcatlist();
		//$this->featuredcatlist();
		$this->newarticlelist();
		$this->_list_countries();
		$this->_list_packagetypes();
		$this->_list_holidaythemes();
    }
	protected function categorylist(){
		App::import('Model','Articlecategory');
		$category = new Articlecategory();
		$categories = $category->find("all",array('fields'=>array('Articlecategory.name','Articlecategory.id'),'conditions'=>array("Articlecategory.parent_id"=>null)));
		$appcategory = Set::combine($categories, '{n}.Articlecategory.id','{n}.Articlecategory.name');
		//pr($appcategory);exit;
		$this->set('appcategory', $appcategory);
	}
	protected function countryisolist(){
		App::import('Model','Country');
		$country = new Country();
		$countries = $country->find("all",array('fields'=>array('Country.name','Country.iso_2'),'conditions'=>array("Country.active"=>1)));
		$appdestinationcountry = Set::combine($countries, '{n}.Country.iso_2','{n}.Country.name');
		//pr($appdestinationcountry);exit;
		$this->set('appdestinationcountry', $appdestinationcountry);
	}
	protected function featuredcatlist(){
		App::import('Model','Articlecategory');
		$category = new Articlecategory();
		$categories = $category->find("all",array('fields'=>array('Articlecategory.name','Articlecategory.id'),'conditions'=>array("Articlecategory.parent_id"=>null,"Articlecategory.featured"=>1,"Articlecategory.active"=>1)));
		$appfcategory = Set::combine($categories, '{n}.Articlecategory.id','{n}.Articlecategory.name');
		//pr($appfcategory);exit;
		$this->set('appfcategory', $appfcategory);
	}
	protected function newarticlelist(){
		App::import('Model','Article');
		$article = new Article();
		$article->unbindModel(array("hasAndBelongsToMany"=>array("User")));
		$appnewarticles = $article->find("all",array(
			'fields'=>array('Article.title','Article.id','Article.modified','Articlecoverimage.namemedium','Articlecoverimage.namesmall'),
			'conditions'=>array("Article.active"=>1),
			'order'=>array("Article.modified"=>"desc"),
			'limit'=>7
			)
		);
		
		//pr($appnewarticles);exit;
		$this->set('appnewarticles', $appnewarticles);
	}
	protected function childcatlist(){
		App::import('Model','Articlecategory');
		$category = new Articlecategory();
		$category->Behaviors->load('Containable');
		$catwithchildren = $category->find('threaded',
			array(
				'fields'=>array('Articlecategory.name','Articlecategory.id','Articlecategory.parent_id'),
				'contain'=>array(
					'ChildCategory'=>array(
						'fields'=>array('id','name','parent_id')
					)
				)
			)
		);
		//$appcategory = Set::combine($categories, '{n}.Category.id','{n}.Category.name');
		//pr($catwithchildren);exit;
		$this->set('catwithchildren', $catwithchildren);
	}
	protected function _list_countries(){
	/*update countries set active=0;update countries set active=1 where iso_2 in ('in','au');*/
		App::import('Model','Country');
  		$country = new Country();
		//$country->unBindModel(array("hasMany" => array("Region")));
		$countries = $country->find("all",array('fields'=>array('Country.name','Country.id'),'conditions'=>array("Country.active"=>1)));
		$appcountries = Set::combine($countries, '{n}.Country.id','{n}.Country.name');
		//pr($appcountries);exit;
		$this->set('appcountries', $appcountries);
	}
	protected function _list_packagetypes(){
		App::import('Model','Packagetype');
  		$packagetype = new Packagetype();
		$packagetypes = $packagetype->find("all",array('fields'=>array('Packagetype.name','Packagetype.id'),'conditions'=>array("Packagetype.active"=>1)));
		$apppackagetypes = Set::combine($packagetypes, '{n}.Packagetype.id','{n}.Packagetype.name');
		//pr($apppackagetypes);exit;
		$this->set('apppackagetypes', $apppackagetypes);
	}
	protected function _list_holidaythemes(){
		App::import('Model','Holidaytheme');
  		$holidaytheme = new Holidaytheme();
		$holidaythemes = $holidaytheme->find("all",array('fields'=>array('Holidaytheme.name','Holidaytheme.id'),'conditions'=>array("Holidaytheme.active"=>1)));
		$appholidaythemes = Set::combine($holidaythemes, '{n}.Holidaytheme.id','{n}.Holidaytheme.name');
		//pr($appholidaythemes);exit;
		$this->set('appholidaythemes', $appholidaythemes);
	}
	protected function _latest_destinations(){
		App::import('Model','Destination');
  		$destination = new Destination();
		$appdestinations = $destination->find("all",
			array(
			'fields'=>array('Destination.name','Destination.id','Destination.country'),
			'conditions'=>array("Destination.active"=>1),
			'limit'=>5,
			'order'=>array('Destination.created'=>'asc')
			)
		);

		//pr($appdestinations);exit;
		$this->set('appdestinations', $appdestinations);
	}
}