<?php
namespace \

App::uses('AppHelper', 'View/Helper');
class AuthModeHelper extends AppHelper
{
    public $helpers = array ('Html', 'Form', 'Session');

    public function getMode()
    {
        $authMode = $this->Session->read('authMode');

        if ($authMode['CRUD']) {
            echo '<span class="label label-primary">CRUD MODE</span> ';
        }

        if ($authMode['ACTIONS']) {
            echo '<span class="label label-default">ACTIONS MODE</span> ';
        }

        if ($authMode['CONTROLLER']) {
            echo '<span class="label label-success">CONTROLLER MODE</span> ';
        }
    }
}
