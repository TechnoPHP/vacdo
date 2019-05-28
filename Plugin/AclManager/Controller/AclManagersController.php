<?php
namespace \

App::uses('AclManagerAppController', 'AclManager.Controller');
App::uses('AclExtras', 'AclManager.Lib');
/**
 * AclManagers Controller
 *
 */
class AclManagersController extends AclManagerAppController
{
    public $components = array('AclManager.DataTable');
    public $uses = array('AclManager.AclAco','AclManager.AclAro', 'AclManager.AclAcosAro','Admingroup','Admin');
/**
 * Scaffold
 *
 * @var mixed
 */
    public $scaffold;

    public function beforeFilter()
    { 
        parent::beforeFilter();
		//$this->Auth->allow();
		$this->set('masterclass','');
		$this->set('announceclass','');
		$this->set('aclclass','');
		$this->set('usersclass','');
		$this->Auth->authorize = array(
			AuthComponent::ALL => array('actionPath' => 'controllers/', 'userModel' => 'Admin'),
			'Actions',
			'Controller'
		);
    }
	
    public function index()
    {
        $Acl = new AclExtras();
        $Acl->startup();
        $retorno = $Acl->acoSync();
    }

/**
 * Action whose shows all Groups Permissions
 * @param  [int] $groupID [Group ID]
 */
    public function groupsPermission($groupID = null)
    {
        if ($this->request->is('get')) {
            $group = $this->Admingroup->find('first', array(
                'conditions'=>array(
                    'Admingroup.id'=>$groupID,
                )
            ));
            $groupName = $group['Admingroup']['name'];

            $aro = $this->AclAro->find('first', array(
                'conditions'=>array(
                    'AclAro.model'=>'Admingroup',
                    'AclAro.foreign_key'=>$groupID,
                    )
            ));
			
            $aroID = $aro['AclAro']['id'];

            $this->set(compact('aroID'));
            $this->set(compact('groupID'));
            $this->set(compact('groupName'));

        } else {
            $this->groupInvalid();
        }
    }

/**
 * Action whose shows all Users permissions
 * @param  [int] $userID [User ID]
 */
    public function usersPermission($userID = null)
    {
        if ($this->request->is('get')) {
            $checkUser = $this->Admin->find('count', array(
                'conditions'=>array(
                    'Admin.id'=>$userID,
                )
            ));

            if ($checkUser > 0) {
                $user = $this->Admin->find('first', array(
                    'conditions'=>array(
                        'Admin.id'=>$userID
                    )
                ));


                $aro = $this->AclAro->find('first', array(
                  'conditions'=>array(
                    'AclAro.model'=>'Admin',
                    'AclAro.foreign_key'=>$userID,
                    )
                  ));

                $aroID = $aro['AclAro']['id'];
                $username = $user['Admin']['email_address'];

                $this->set(compact('username'));
                $this->set(compact('aroID'));
                $this->set(compact('userID'));
            } else {
                $this->userInvalid();
            }
        } else {
            $this->userInvalid();
        }
    }

/**
 * Makes the timing of Acos array (Search and writing to the bank of all Controllers / Plugins / Actions)
 * Through Ajax with the Lib Modified AclManager.AclExtras
 * @return [json] $retorno [Returns an array with the coming of the Lib Posts]
 */
    public function acosSyncAjax()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->layout = false;
            $this->render(false);

            $Acl = new AclExtras();
            $Acl->startup();
            $retorno = $Acl->acoSync();

            echo json_encode($retorno);
        }
    }
/**
 * Set a single item permission from UsersPermission with ajax
 */
    public function ajaxSetPermission()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->layout = false;
            $this->render(false);
            $request = $this->request->data;

            $operation = strtolower($request['operation']);

            $aroID = $request['aroID'];
            @$acoID = $request['acoID'];

            $aroCheck = $this->AclAro->find('count', array(
                'conditions'=>array(
                    'AclAro.id'=>$aroID
                )
            ));
            $acoCheck = $this->AclAco->find('count', array(
                'conditions'=>array(
                    'AclAco.id'=>$acoID
                )
            ));

            //Check if value exists in encrypted array and Aco and Aro are valids
            if (($this->AclSession->check($acoID)) && ($acoCheck > 0) && ($aroCheck > 0)) {
                $checkInDB = $this->AclAcosAro->find('count', array(
                    'conditions'=>array(
                        'AclAcosAro.aco_id'=>$acoID,
                        'AclAcosAro.aro_id'=>$aroID,
                    )
                ));
                $setPermission = array();
                $permissions = array();

                if ($checkInDB > 0) {
                    $permissions = $this->AclAcosAro->find('first', array(
                        'conditions'=>array(
                            'AclAcosAro.aco_id'=>$acoID,
                            'AclAcosAro.aro_id'=>$aroID,
                        )
                    ));

                    $create = $permissions['AclAcosAro']['_create'];
                    $read = $permissions['AclAcosAro']['_read'];
                    $update = $permissions['AclAcosAro']['_update'];
                    $delete = $permissions['AclAcosAro']['_delete'];

                    $setPermission['AclAcosAro']['id'] = $permissions['AclAcosAro']['id'];
                }


                $crud = -1;
                //reset to parent inherit (Groups)

                switch ($operation) {
                    //Total
                    case 't':
                        if ($checkInDB > 0) {
                            if (($create === $read) && ($read === $update) && ($update == $delete)) {
                                $crud = -1 * $create;
                            }

                            $setPermission['AclAcosAro']['_create'] = $crud;
                            $setPermission['AclAcosAro']['_read'] = $crud;
                            $setPermission['AclAcosAro']['_update'] = $crud;
                            $setPermission['AclAcosAro']['_delete'] = $crud;

                        } else {
                            $this->AclAcosAro->create();
                            $crud = -1 * $crud;
                            $setPermission['AclAcosAro']['_create'] = $crud;
                            $setPermission['AclAcosAro']['_read'] = $crud;
                            $setPermission['AclAcosAro']['_update'] = $crud;
                            $setPermission['AclAcosAro']['_delete'] = $crud;
                            $setPermission['AclAcosAro']['aco_id'] = $acoID;
                            $setPermission['AclAcosAro']['aro_id'] = $aroID;
                        }
                        break;
                    case 'c':
                        if ($checkInDB > 0) {
                            $setPermission['AclAcosAro']['_create'] = -1 * $permissions['AclAcosAro']['_create'];
                        } else {
                            $this->AclAcosAro->create();
                            $setPermission['AclAcosAro']['_create'] = 1;
                            $setPermission['AclAcosAro']['_read'] = $crud;
                            $setPermission['AclAcosAro']['_update'] = $crud;
                            $setPermission['AclAcosAro']['_delete'] = $crud;
                            $setPermission['AclAcosAro']['aco_id'] = $acoID;
                            $setPermission['AclAcosAro']['aro_id'] = $aroID;
                        }
                        break;
                    case 'r':
                        if ($checkInDB > 0) {
                            $setPermission['AclAcosAro']['_read'] = -1 * $permissions['AclAcosAro']['_read'];
                        } else {
                            $this->AclAcosAro->create();
                            $setPermission['AclAcosAro']['_create'] = $crud;
                            $setPermission['AclAcosAro']['_read'] = 1;
                            $setPermission['AclAcosAro']['_update'] = $crud;
                            $setPermission['AclAcosAro']['_delete'] = $crud;
                            $setPermission['AclAcosAro']['aco_id'] = $acoID;
                            $setPermission['AclAcosAro']['aro_id'] = $aroID;
                        }

                        break;
                    case 'u':
                        if ($checkInDB > 0) {
                            $setPermission['AclAcosAro']['_update'] = -1 * $permissions['AclAcosAro']['_update'];
                        } else {
                            $this->AclAcosAro->create();
                            $setPermission['AclAcosAro']['_create'] = $crud;
                            $setPermission['AclAcosAro']['_read'] = $crud;
                            $setPermission['AclAcosAro']['_update'] = 1;
                            $setPermission['AclAcosAro']['_delete'] = $crud;
                            $setPermission['AclAcosAro']['aco_id'] = $acoID;
                            $setPermission['AclAcosAro']['aro_id'] = $aroID;
                        }
                        break;
                    case 'd':
                        if ($checkInDB > 0) {
                            $setPermission['AclAcosAro']['_delete'] = -1 * $permissions['AclAcosAro']['_delete'];
                        } else {
                            $this->AclAcosAro->create();
                            $setPermission['AclAcosAro']['_create'] = $crud;
                            $setPermission['AclAcosAro']['_read'] = $crud;
                            $setPermission['AclAcosAro']['_update'] = $crud;
                            $setPermission['AclAcosAro']['_delete'] = 1;
                            $setPermission['AclAcosAro']['aco_id'] = $acoID;
                            $setPermission['AclAcosAro']['aro_id'] = $aroID;
                        }
                        break;
                    case 'p':
                        if ($checkInDB > 0) {
                            if ($this->authMode['CRUD']) {
                                $permission = $this->AclAcosAro->find('first', array(
                                    'conditions'=>array(
                                        'AclAcosAro.id'=>$setPermission['AclAcosAro']['id'],
                                    )
                                ));


                                $childrensAcos = $this->AclAco->children($permission['AclAcosAro']['aco_id']);

                                if (count($childrensAcos) > 0) {
                                    foreach ($childrensAcos as $key => $child) {
                                        $permissionChildrens = $this->AclAcosAro->find('first', array(
                                            'conditions'=>array(
                                                'AclAcosAro.aco_id'=>$child['Aco']['id'],
                                                'AclAcosAro.aro_id'=>$aroID,
                                            )
                                        ));
                                        $this->AclAcosAro->delete($permissionChildrens['AclAcosAro']['id']);
                                    }
                                }
                            }//end if CrudMode Check

                            $this->AclAcosAro->delete($setPermission['AclAcosAro']['id']);
                            echo json_encode(true);
                            return;
                        }
                        break;
                }
            }

            echo json_encode($this->AclAcosAro->save($setPermission));
        }
    }

    public function ajaxSetAllPermission()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->layout = false;
            $this->render(false);
            $return = array();
            $request = $this->request->data;

            $operation = strtolower($request['AclAcosAro']['permissionType']);

            $aroID = $request['AclAcosAro']['aroID'];


            $aroCheck = $this->AclAro->find('count', array(
                'conditions'=>array(
                    'AclAro.id'=>$aroID
                )
            ));


            if (isset($request['AclAcosAro']['acoID']) || !empty($request['AclAcosAro']['acoID'])) {
                foreach ($request['AclAcosAro']['acoID'] as $key => $acoID) {
                    $acoCheck = $this->AclAco->find('count', array(
                        'conditions'=>array(
                            'AclAco.id'=>$acoID
                        )
                    ));
                    if (($this->AclSession->check($acoID)) && ($acoCheck > 0) && ($aroCheck > 0)) {
                        //Check if the permission was grantted
                        $checkInDB = $this->AclAcosAro->find('count', array(
                            'conditions'=>array(
                                'AclAcosAro.aco_id'=>$acoID,
                                'AclAcosAro.aro_id'=>$aroID,
                            )
                        ));

                        //check if permission is Reset
                        if ($operation != 'r') {
                            switch ($operation) {
                                //Permission Allow
                                case 'a':
                                    $crud = 1;
                                    break;
                                //Permission Deny
                                case 'd':
                                    $crud = -1;
                                    break;
                            }


                            $setPermission = array();
                            $permissions = array();

                            if ($checkInDB > 0) {
                                $permissions = $this->AclAcosAro->find('first', array(
                                    'conditions'=>array(
                                        'AclAcosAro.aco_id'=>$acoID,
                                        'AclAcosAro.aro_id'=>$aroID,
                                    )
                                ));
                                $setPermission['AclAcosAro']['id'] = $permissions['AclAcosAro']['id'];
                            } else {
                                $this->AclAcosAro->create();
                                $setPermission['AclAcosAro']['aco_id'] = $acoID;
                                $setPermission['AclAcosAro']['aro_id'] = $aroID;
                            }

                            $setPermission['AclAcosAro']['_create'] = $crud;
                            $setPermission['AclAcosAro']['_read'] = $crud;
                            $setPermission['AclAcosAro']['_update'] = $crud;
                            $setPermission['AclAcosAro']['_delete'] = $crud;

                            if ($this->AclAcosAro->save($setPermission)) {
                                $return['status'] = 'success';
                                switch ($crud) {
                                    case 1:
                                        $return['msg'] = __('Added permissions!');
                                        break;
                                    case -1:
                                        $return['msg'] = __('Permissions removed!');
                                        break;
                                }
                            } else {
                                $return['status'] = 'error';
                                $return['msg'] = __('Failed to save!');
                            }

                        } else {
                            if ($checkInDB > 0) {
                                $permissions = $this->AclAcosAro->find('first', array(
                                    'conditions'=>array(
                                        'AclAcosAro.aco_id'=>$acoID,
                                        'AclAcosAro.aro_id'=>$aroID,
                                    )
                                ));

                                if ($this->authMode['CRUD']) {
                                    $childrensAcos = $this->AclAco->children($acoID);
                                    if (count($childrensAcos)>0) {
                                        foreach ($childrensAcos as $key => $child) {
                                            $permissionChildrens = $this->AclAcosAro->find('first', array(
                                                'conditions'=>array(
                                                    'AclAcosAro.aco_id'=>$child['Aco']['id'],
                                                    'AclAcosAro.aro_id'=>$aroID,
                                                )
                                            ));
                                            $this->AclAcosAro->delete($permissionChildrens['AclAcosAro']['id']);
                                        }
                                    }
                                }//end crudMode check

                                $this->AclAcosAro->delete($permissions['AclAcosAro']['id']);
                            }
                                $return['status'] = 'success';
                                $return['msg'] = __('Permissions were reset!');

                        }//end if $operation

                    }//end if session Encrypt check
                }//end foreach

            } else {
                $return['status'] = 'error';
                $return['msg'] = __('Select a Local Access!');

            }//End If AcoID
            echo json_encode($return);
        }//End if is Ajax
    }

  /**
   * List all GroupsAcos with the count number of users setted permissions
   * @return [json] [The json array with acos]
   */
    public function ajaxListGroupsAcos()
    {

        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->layout = false;
            $this->render(false);

            $groupID = $_GET['admingroup_id'];


            //Receive names from acos (controller->action)
            $acoList = $this->getAcoList();

            // Search and get this Group permission
            $aroPermission = $this->AclAro->find('threaded', array(
                'conditions'=>array(
                    'AclAro.model'=>'Admingroup',
                    'AclAro.foreign_key'=>$groupID,
                    )
                ));

            $groupsPermission = $this->getArrayPermission($aroPermission, $acoList);


            $this->set(compact('groupsPermission'));
            //Write  in Session Aco List
            $this->AclSession->encrypt($acoList);

            //Compute datatalbes plugin data
            $response = array();
            $response['iTotalRecords'] = $this->AclAro->find('count');
            $response['iTotalDisplayRecords'] = $this->AclAro->find('count', array(
                    'conditions'=>array(
                        'AclAro.model'=>'Admingroup',
                    'AclAro.foreign_key'=>$groupID,
                    ),
                ));
            $response['aaData'] = $groupsPermission;

            $this->set('response', $response);
            $this->set('_serialize', 'response');

            echo json_encode($response);

        }
    }

  /**
   * List all Users with a count number of permissions
   * @return [json] [The json array with acos]
   */
    public function ajaxListUsersAcos()
    {

        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->layout = false;
            $this->render(false);

            $userID = $_GET['admin_id'];


            //Receive names from acos (controller->action)
            $acoList = $this->getAcoList();

            // Search and get this User permission
            $aroPermission = $this->AclAro->find('threaded', array(
                'conditions'=>array(
                    'AclAro.model'=>'Admin',
                    'AclAro.foreign_key'=>$userID,
                )
            ));

            $usersPermission = $this->getArrayPermission($aroPermission, $acoList);


            $this->set(compact('usersPermission'));
            //Write  in Session Aco List
            $this->AclSession->encrypt($acoList);

            //Compute datatalbes plugin data

            $response = array();
            $response['iTotalRecords'] = $this->AclAro->find('count');
            $response['iTotalDisplayRecords'] = $this->AclAro->find('count', array(
                'conditions'=>array(
                    'AclAro.model'=>'Admin',
                    'AclAro.foreign_key'=>$userID,
                ),
            ));
            $response['aaData'] = $usersPermission;

            $this->set('response', $response);
            $this->set('_serialize', 'response');

            echo json_encode($response);
        }
    }


  /**
   * Returns the list of groups  inserted in DB
   * @return [json] $response [data array]
   */
    public function ajaxListGroups()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->layout = false;
            $this->render(false);

            $this->paginate = array(
                'fields' => array('Admingroup.id','Admingroup.name'),
            );

            $this->DataTable->mDataProp = true;
            $response = $this->DataTable->getResponse($this, $this->Admingroup);

            foreach ($response['aaData'] as $indexG => $group) {
                $users = $this->Admin->find('all', array(
                    'conditions'=>array(
                        'Admin.admingroup_id'=>$group['Admingroup']['id'],
                    ),
                    'recursive'=>-1,
                ));
                $numberUsers = 0;

                foreach ($users as $indexU => $user) {
                    $aro = $this->AclAro->find('first', array(
                        'conditions'=>array(
                            'AclAro.model'=>'Admin',
                            'AclAro.foreign_key'=>$user['Admin']['id'],
                        ),
                        'recursive'=>-1
                    ));

                    if (!empty($aro)) {
                        $countPermissions = $this->AclAcosAro->find('count', array(
                            'conditions'=>array(
                                'AclAcosAro.aro_id'=>$aro['AclAro']['id'],
                            )
                        ));
                    } else {
                        $countPermissions = 0;
                    }

                    if ($countPermissions > 0) {
                        $numberUsers++;
                    }
                }
                $response['aaData'][$indexG]['Admingroup']['permissions'] = $numberUsers;
            }

            $this->set('response', $response);
            $this->set('_serialize', 'response');

            echo json_encode($response);
        }
    }

  /**
   * Returns the list of users inserted in DB
   * @return [json] $response [Um array de Dados]
   */
    public function ajaxListUsers()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->layout = false;
            $this->render(false);

            $this->Admingroup->recursive = 0;
            $groups = $this->Admingroup->find('list', array('contain' => false));

            $this->paginate = array(
                'fields' => array(
                    'Admin.id',
                    'Admin.email_address', 
                    'Admin.admingroup_id',
                    //'Admingroup.name'
                ),
                //'contain'=>array('Group'),
                'order'=>array(
                    'Admin.email_address'=>'asc'
                )
            );

            $this->DataTable->mDataProp = true;
            $response = $this->DataTable->getResponse(null, $this->Admin);

            foreach ($response['aaData'] as $key => $userData) {
                //Used because contain not working
                if (array_key_exists($userData['Admin']['admingroup_id'], $groups)) { 
                    $response['aaData'][$key]['Admingroup']['name'] = $groups[$userData['Admin']['admingroup_id']];
                }

                $aro = $this->AclAro->find('first', array(
                    'conditions'=>array(
                        'AclAro.model'=>'Admin',
                        'AclAro.foreign_key'=>$userData['Admin']['id'],
                    ),
                    'recursive'=>-1
                ));
                if (!empty($aro)) {
                    $countPermissions = $this->AclAcosAro->find('count', array(
                        'conditions'=>array(
                            'AclAcosAro.aro_id'=>$aro['AclAro']['id'],
                        )
                    ));
                } else {
                    $countPermissions = 0;
                }

                $response['aaData'][$key]['Admin']['permissions'] = (int)$countPermissions;
            }

            $this->set('response', $response);
            $this->set('_serialize', 'response');

            echo json_encode($response);
        }
    }

  /**
   * Generates the return to the datatables with each Controller / Plugin / Action of permissions (path of Acos)
   * @param  [string] $divisor [Item separator]
   * @return [array] $path [Full path of permission item]
   */
    private function getAcoList($divisor = '->')
    {
        $groupID = 1;

        $this->paginate = array(
            'order' => array('parent_id', 'id'),
        );

        $conditions = array();

        if ($this->authMode['CRUD']) {
            $conditions = array(
                'OR'=>array(
                    'Aco.model'=>'Controller',
                    array(
                        'Aco.model'=>'Plugin'
                    )
                ),
            );
        }

        $this->DataTable->mDataProp = true;
        $response = $this->DataTable->getResponse(null, $this->AclAco);

        $controllersActions = $this->AclAco->find('threaded', array(
            'conditions'=>$conditions,
            'order'=>array(
                'AclAco.model'=>'asc'
            )
        ));
        $aData = array();

        foreach ($controllersActions as $ca) {
            $path = array();

            $ca['children'] = Hash::sort($ca['children'], '{n}.Aco.alias', 'asc');
            foreach ($ca['children'] as $firstLevel) {
                $firstAlias = $firstLevel['AclAco']['alias'];
                $path[$firstLevel['AclAco']['id']]['AclAco']['path'] = $firstAlias;
                $path[$firstLevel['AclAco']['id']]['AclAco']['id'] = $firstLevel['AclAco']['id'];

                if (!empty($firstLevel['children'])) {
                    $firstLevel['children'] = Hash::sort($firstLevel['children'], '{n}.Aco.alias', 'asc');

                    foreach ($firstLevel['children'] as $secondLevel) {
                        $secondAlias = $firstAlias.$divisor.$secondLevel['AclAco']['alias'];
                        $path[$secondLevel['AclAco']['id']]['AclAco']['path'] = $secondAlias;
                        $path[$secondLevel['AclAco']['id']]['AclAco']['id'] = $secondLevel['AclAco']['id'];

                        if (!empty($secondLevel['children'])) {
                            $secondLevel['children'] = Hash::sort($secondLevel['children'], '{n}.Aco.alias', 'asc');

                            foreach ($secondLevel['children'] as $thirdLevel) {
                                $thirdAlias = $secondAlias.$divisor.$thirdLevel['AclAco']['alias'];
                                $path[$thirdLevel['AclAco']['id']]['AclAco']['path'] = $thirdAlias;
                                $path[$thirdLevel['AclAco']['id']]['AclAco']['id'] = $thirdLevel['AclAco']['id'];

                            }
                        }
                    }
                }
            }
        }
        return $path;
    }
  /**
   * Function thats throw one Exception if the Group is not valid
   * @return [exception] NotFoundException
   */
    private function groupInvalid()
    {
        throw new NotFoundException(__('Group Invalid!'));
    }

  /**
   * Function thats throw one Exception if the User is not valid
   * @return [exception] NotFoundException
   */
    private function userInvalid()
    {
        throw new NotFoundException(__('Invalid User'));
    }

  /**
   * Generates the return array with a list group permissions
   * @param  [array] $aroPermission [Array derived Find with permissions Aro]
   * @param  [array] $acorList [Array List Total derivative of Acos]
   * @return [array] $acoList [Array modified with all permissions and Hash]
   */
    private function getArrayPermission($aroPermission, $acoList)
    {
        $arrayPermission = array();

        foreach ($aroPermission as $acosAros) {
            foreach ($acosAros['Aco'] as $acos) {
                $arrayPermission[$acos['id']] = $acos['Permission'];
            }
        }

        foreach ($acoList as $key => $list) {
            if (array_key_exists($key, $arrayPermission)) {
                $acoList[$key]['Aco']['create'] = $arrayPermission[$key]['_create'];
                $acoList[$key]['Aco']['read'] = $arrayPermission[$key]['_read'];
                $acoList[$key]['Aco']['update'] = $arrayPermission[$key]['_update'];
                $acoList[$key]['Aco']['delete'] = $arrayPermission[$key]['_delete'];
            } else {
                $acoList[$key]['Aco']['create'] = 0;
                $acoList[$key]['Aco']['read'] = 0;
                $acoList[$key]['Aco']['update'] = 0;
                $acoList[$key]['Aco']['delete'] = 0;
            }
        }

        $newAcoList = array();
        foreach ($acoList as $newAco) {
            array_push($newAcoList, $newAco);
        }
        return $newAcoList;
    }
}
