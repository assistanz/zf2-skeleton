<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Controller
 * @package   Album
 * @author    Sujai SD <sujai@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace AlbumTest\Controller;

use AlbumTest\Bootstrap;
use Album\Controller\AlbumController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use PHPUnit_Framework_TestCase;

/**
 * Tests AlbumController actions.
 */
class AlbumControllerTest extends PHPUnit_Framework_TestCase {
    
    /**
     * Instance of album controller.
     * 
     * @var \Album\Controller\AlbumController 
     */
    protected $_controller;
    
    /**
     * HTTP request.
     * 
     * @var Zend\Http\Request 
     */
    protected $_request;
    
    /**
     * HTTP Response.
     * 
     * @var Zend\Http\Response 
     */
    protected $_response;
    
    /**
     * The router mapping matcher.
     * 
     * @var Zend\Mvc\Router\RouteMatch 
     */
    protected $_routeMatch;
    
    /**
     * MVC Event to monitor requests and actions.
     * 
     * @var Zend\Mvc\MvcEvent 
     */
    protected $_event;

    
    /**
     * The default test setup before start.
     * 
     * @return void
     */
    protected function setUp() {
        $serviceManager = Bootstrap::getServiceManager();
        $this->_controller = new AlbumController();
        $this->_request    = new Request();
        $this->_routeMatch = new RouteMatch(array('controller' => 'index'));
        $this->_event      = new MvcEvent();
        $config = $serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);
        $this->_event->setRouter($router);
        $this->_event->setRouteMatch($this->_routeMatch);
        $this->_controller->setEvent($this->_event);
        $this->_controller->setServiceLocator($serviceManager);
    }
    

    /**
     * Album 'add' action acceesibility test.
     * 
     * @return void
     */
    public function testAddActionCanBeAccessed() {
        $this->_routeMatch->setParam('action', 'add');

        $this->_controller->dispatch($this->_request);
        $response = $this->_controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
    }
    

    /**
     * Album delete action accessibility test.
     * 
     * @return void
     */
    public function testDeleteActionCanBeAccessed() {
        $this->_routeMatch->setParam('action', 'delete');

        $this->_controller->dispatch($this->_request);
        $response = $this->_controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
    }
    

    /**
     * Album 'edit' action accessibility test.
     * 
     * @return void
     */
    public function testEditActionCanBeAccessed() {
        
        $this->_routeMatch->setParam('action', 'edit');

        $this->_controller->dispatch($this->_request);
        $response = $this->_controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
    }
    

    /**
     * Album 'index' action accessibility test.
     * 
     * @return void
     */
    public function testIndexActionCanBeAccessed() {
        $this->_routeMatch->setParam('action', 'index');

        $this->_controller->dispatch($this->_request);
        $response = $this->_controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
    }
    
    
}
