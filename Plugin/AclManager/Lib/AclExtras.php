<?php
namespace \

/**
 * Acl Extras.
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2008-2013, Mark Story.
 * @link http://mark-story.com
 * @author Mark Story <mark@mark-story.com>
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::uses('Controller', 'Controller');
App::uses('ComponentCollection', 'Controller');
App::uses('AclComponent', 'Controller/Component');
App::uses('DbAcl', 'Model');
App::uses('Shell', 'Console');
App::uses('String', 'Utility');

/**
 * Shell for ACO extras
 *
 * @package     acl_extras
 * @subpackage  acl_extras.Console.Command
 */
class AclExtras extends Object
{

/**
 * Contains instance of AclComponent
 *
 * @var AclComponent
 * @access public
 */
    public $Acl;

/**
 * Contains arguments parsed from the command line.
 *
 * @var array
 * @access public
 */
    public $args;
    public $mensagem = array();
/**
 * Contains database source to use
 *
 * @var string
 * @access public
 */
    public $dataSource = 'default';

/**
 * Root node name.
 *
 * @var string
 **/
    public $rootNode = 'controllers';

/**
 * Internal Clean Actions switch
 *
 * @var boolean
 **/
    protected $clean = false;

/**
 * Start up And load Acl Component / Aco model
 *
 * @return void
 **/
    public function startup($controller = null)
    {
        if (!$controller) {
            $controller = new Controller(new CakeRequest());
        }
        $collection = new ComponentCollection();
        $this->Acl = new AclComponent($collection);
        $this->Acl->startup($controller);
        $this->Aco = $this->Acl->Aco;
        $this->controller = $controller;
    }

    public function out($msg, $tipo)
    {
        if (!empty($this->controller->Session)) {
            $this->controller->Session->setFlash($msg);
        } elseif (isset($this->Shell)) {
            return $this->Shell->out($this->cleanString($msg));
        } else {
            array_push($this->mensagem, array($tipo=>$msg));
        }
    }

    public function err($msg)
    {
        if (!empty($this->controller->Session)) {
            $this->controller->Session->setFlash($msg);
        } elseif (isset($this->Shell)) {
            return $this->Shell->err($this->cleanString($msg));
        } else {
            array_push($this->mensagem, array('error'=>$msg));
        }
    }

/**
 * Sync the ACO table
 *
 * @return void
 **/
    public function acoSync($params = array())
    {
        $this->clean = true;
        $this->acoUpdate($params);
        return $this->mensagem;
    }

/**
 * Updates the Aco Tree with new controller actions.
 *
 * @return void
 **/
    public function acoUpdate($params = array())
    {
        $root = $this->checkNode($this->rootNode, $this->rootNode, null);

        if (empty($params['plugin'])) {
            $controllers = $this->getControllerList();
            $this->updateControllers($root, $controllers);
            $plugins = CakePlugin::loaded();
        } else {
            $plugin = $params['plugin'];
            if (!in_array($plugin, App::objects('plugin')) || !CakePlugin::loaded($plugin)) {
                $this->err(__('Plugin %s not found or not activated.', $plugin));
                return false;
            }
            $plugins = array($params['plugin']);
        }

        foreach ($plugins as $plugin) {
            $controllers = $this->getControllerList($plugin);

            $path = $this->rootNode . '/' . $plugin;

            $pluginRoot = $this->checkNode($path, $plugin, $root['Aco']['id']);
            $this->updateControllers($pluginRoot, $controllers, $plugin);
        }
        $this->out(__('Aco Update Complete.'), 'success');
        return true;
    }

/**
 * Updates a collection of controllers.
 *
 * @param array $root Array or ACO information for root node.
 * @param array $controllers Array of Controllers
 * @param string $plugin Name of the plugin you are making controllers for.
 * @return void
 */
    protected function updateControllers($root, $controllers, $plugin = null)
    {
        $dotPlugin = $pluginPath = $plugin;
        if ($plugin) {
            $dotPlugin .= '.';
            $pluginPath .= '/';
        }

        $appIndex = array_search($plugin . 'AppController', $controllers);
        if ($appIndex !== false) {
            App::uses($plugin . 'AppController', $dotPlugin . 'Controller');
            unset($controllers[$appIndex]);
        }
        // look at each controller
        foreach ($controllers as $controller) {
            App::uses($controller, $dotPlugin . 'Controller');
            $controllerName = preg_replace('/Controller$/', '', $controller);

            $path = $this->rootNode . '/' . $pluginPath . $controllerName;

            $tipo = $this->getTipoPluginPath($pluginPath);


            $controllerNode = $this->checkNode($path, $controllerName, $root['Aco']['id'], $tipo);
            $this->checkMethods($controller, $controllerName, $controllerNode, $pluginPath);
        }
        if ($this->clean) {
            if (!$plugin) {
                $controllers = array_merge($controllers, App::objects('plugin', null, false));
            }
            $controllerFlip = array_flip($controllers);

            $this->Aco->id = $root['Aco']['id'];
            $controllerNodes = $this->Aco->children(null, true);
            foreach ($controllerNodes as $ctrlNode) {
                $alias = $ctrlNode['Aco']['alias'];
                $name = $alias . 'Controller';
                if (!isset($controllerFlip[$name]) && !isset($controllerFlip[$alias])) {
                    if ($this->Aco->delete($ctrlNode['Aco']['id'])) {
                        $this->out(__(
                            'Deleted %s and all children.',
                            $this->rootNode . '/' . $ctrlNode['Aco']['alias']
                        ));
                    }
                }
            }
        }
    }

/**
 * Get a list of controllers in the app and plugins.
 *
 * Returns an array of path => import notation.
 *
 * @param string $plugin Name of plugin to get controllers for
 * @return array
 **/
    public function getControllerList($plugin = null)
    {
        if (!$plugin) {
            $controllers = App::objects('Controller', null, false);
        } else {
            $controllers = App::objects($plugin . '.Controller', null, false);
        }
        return $controllers;
    }

/**
 * Check a node for existance, create it if it doesn't exist.
 *
 * @param string $path
 * @param string $alias
 * @param int $parentId
 * @return array Aco Node array
 */
    protected function checkNode($path, $alias, $parentId = null, $tipo = null)
    {

        $node = $this->Aco->node($path);
        if ($alias == 'controllers') {
            $tipo = 'Controller';
        }

        if ($tipo == null) {
            $tipo = 'Plugin';
        }

        if (!$node) {
            $this->Aco->create(array(
                'parent_id' => $parentId,
                'model' => $tipo,
                'foreign_key'=>$this->intHash(),
                'alias' => $alias
            ));
            $node = $this->Aco->save();
            $node['Aco']['id'] = $this->Aco->id;
            $this->out(__('Created Aco node: %s.', $path), 'success');
        } else {
            $node = $node[0];
        }
        return $node;
    }

/**
 * Get a list of registered callback methods
 */
    protected function getCallbacks($className)
    {
        $callbacks = array();
        $reflection = new ReflectionClass($className);
        if ($reflection->isAbstract()) {
            return $callbacks;
        }
        try {
            $method = $reflection->getMethod('implementedEvents');
        } catch (ReflectionException $e) {
            return $callbacks;
        }
        if (version_compare(phpversion(), '5.4', '>=')) {
            $object = $reflection->newInstanceWithoutConstructor();
        } else {
            $object = unserialize(
                sprintf('O:%d:"%s":0:{}', strlen($className), $className)
            );
        }
        $implementedEvents = $method->invoke($object);
        foreach ($implementedEvents as $event => $callable) {
            if (is_string($callable)) {
                $callbacks[] = $callable;
            }
            if (is_array($callable) && isset($callable['callable'])) {
                $callbacks[] = $callable['callable'];
            }
        }
        return $callbacks;
    }

/**
 * Check and Add/delete controller Methods
 *
 * @param string $controller
 * @param array $node
 * @param string $plugin Name of plugin
 * @return void
 */
    protected function checkMethods($className, $controllerName, $node, $pluginPath = false)
    {
        $excludes = $this->getCallbacks($className);
        $baseMethods = get_class_methods('Controller');
        $actions = get_class_methods($className);
        if ($actions == null) {
            $this->err(__('Unable to get methods for "%s".', $className));
            return false;
        }
        $methods = array_diff($actions, $baseMethods);
        $methods = array_diff($methods, $excludes);
        foreach ($methods as $action) {
            if (strpos($action, '_', 0) === 0) {
                continue;
            }

            $tipo = $this->getTipoPluginPath($pluginPath, $action);

            $path = $this->rootNode . '/' . $pluginPath . $controllerName . '/' . $action;

            $this->checkNode($path, $action, $node['Aco']['id'], $tipo);
        }

        if ($this->clean) {
            $actionNodes = $this->Aco->children($node['Aco']['id']);
            $methodFlip = array_flip($methods);
            foreach ($actionNodes as $action) {
                if (!isset($methodFlip[$action['Aco']['alias']])) {
                    $this->Aco->id = $action['Aco']['id'];
                    if ($this->Aco->delete()) {
                        $path = $this->rootNode . '/' . $controllerName . '/' . $action['Aco']['alias'];
                        $this->out(__('Deleted Aco node: %s.', $path), 'warning');
                    }
                }
            }
        }
        return true;
    }

/**
 * Verify a Acl Tree
 *
 * @param string $type The type of Acl Node to verify
 * @access public
 * @return void
 */
    public function verify()
    {
        $type = Inflector::camelize($this->args[0]);
        $return = $this->Acl->{$type}->verify();
        if ($return === true) {
            $this->out(__('Tree is valid and strong.'), 'success');
        } else {
            $this->err(print_r($return, true));
            return false;
        }
    }

/**
 * Recover an Acl Tree
 *
 * @param string $type The Type of Acl Node to recover
 * @access public
 * @return void
 */
    public function recover()
    {
        $type = Inflector::camelize($this->args[0]);
        $return = $this->Acl->{$type}->recover();
        if ($return === true) {
            $this->out(__('Tree has been recovered, or tree did not need recovery.'), 'success');
        } else {
            $this->err(__('Tree recovery failed.'));
            return false;
        }
    }

    /**
     * Função que Identifica o tipo de Aco (Plugin, Controller, ControllerAction, PluginAction), retornando o tipo
     * para inserção na tabela Aco.model (Campo não usado na ACL)
     * @param  [string] $pluginPath [Retorna o Caminho caso seja um Plugin senão seta NULL]
     * @param  [string] $actionName [Retorna a Action caso não seja um diretorio rais]
     *
     */
    protected function getTipoPluginPath($pluginPath, $actionName = null)
    {

        if ($pluginPath != false) {
            if ($actionName == null) {
                $tipo = 'Plugin';
            } else {
                $tipo = 'PluginAction';
            }
        } else {
            if ($actionName == null) {
                $tipo = 'Controller';
            } else {
                $tipo = 'ControllerAction';
            }
        }
        return $tipo;
    }

    protected function intHash()
    {
        $hashString = (int) hexdec(crc32(substr(sha1(CakeText::uuid()), 0, 11)));
        if ($hashString < 0) {
            $hashString = -1 * $hashString;
        }
        return $hashString;
    }

    protected function cleanString($text)
    {
        $utf8 = array(
            '/[áàâãªä]/u'   =>   'a',
            '/[ÁÀÂÃÄ]/u'    =>   'A',
            '/[ÍÌÎÏ]/u'     =>   'I',
            '/[íìîï]/u'     =>   'i',
            '/[éèêë]/u'     =>   'e',
            '/[ÉÈÊË]/u'     =>   'E',
            '/[óòôõºö]/u'   =>   'o',
            '/[ÓÒÔÕÖ]/u'    =>   'O',
            '/[úùûü]/u'     =>   'u',
            '/[ÚÙÛÜ]/u'     =>   'U',
            '/ç/'           =>   'c',
            '/Ç/'           =>   'C',
            '/ñ/'           =>   'n',
            '/Ñ/'           =>   'N',
            '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
            '/[“”«»„]/u'    =>   ' ', // Double quote
            '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
        );
        return preg_replace(array_keys($utf8), array_values($utf8), $text);
    }
}
