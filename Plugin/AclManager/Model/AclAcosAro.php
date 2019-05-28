<?php
namespace \

App::uses('AclManagerAppModel', 'AclManager.Model');
/**
 * Aro Model
 *
 * @property Aro $ParentAro
 * @property Aro $ChildAro
 * @property Aco $Aco
 */
class AclAcosAro extends AclManagerAppModel
{
    public $useTable = 'aros_acos';

    public $belongsTo = array(
        'AclAco' => array(
            'className' => 'AclManager.AclAco',
            'foreignKey' => 'aco_id',
        ),
        'AclAro' => array(
            'className' => 'AclManager.AclAro',
            'foreignKey' => 'aro_id',
        ),
    );
}
