<?php
namespace \

App::uses('AppController', 'Controller');
class AclManagerAppController extends AppController
{
    public $components = array('AclManager.DataTable','AclManager.AclSession','AclManager.ArraySearch');
    public $helpers = array('AclManager.AuthMode');
    public $authMode;

    public function beforeFilter(){
        parent::beforeFilter();
        $this->authMode = $this->detectAuthMode();
        $authMode = $this->authMode;
		$this->layout='admin';
        $this->Session->write('authMode', $authMode);
        $this->set(compact('authMode'));
		AuthComponent::$sessionKey = 'Auth.Admin';

    }
	
/**
 * Detects the Authorization Mode of Acl
 * @return [array] return an array with a bool values about Crud,Action or Controller Mode
 */
    private function detectAuthMode()
    {
         $authorizeArray = $this->Auth->authorize;

         $result = array('CRUD'=>false,'ACTIONS'=>false,'CONTROLLER'=>false);

        if ($this->ArraySearch->insensitiveCheck('ACTIONS', $authorizeArray)) {
            $result['ACTIONS'] = true;
        }

        if ($this->ArraySearch->insensitiveCheck('CRUD', $authorizeArray)) {
            $result['CRUD'] = true;
        }

        if ($this->ArraySearch->insensitiveCheck('CONTROLLER', $authorizeArray)) {
            $result['CONTROLLER'] = true;
        }

        return $result;

    }
}
