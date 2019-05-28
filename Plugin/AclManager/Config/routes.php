<?php

Router::connect('/admin/AclManagers/:action/*', array(
    'plugin' => 'AclManager',
    'controller' => 'AclManagers'
    ));

Router::connect('/admin/AclManagers/*', array(
    'plugin' => 'AclManager',
    'controller' => 'AclManagers',
    'action'=>'index'
    ));
