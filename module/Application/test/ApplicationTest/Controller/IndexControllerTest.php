<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Config
 * @package   Application
 * @author    Sujai SD <sujai@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace ApplicationTest\Controller;

use ApplicationTest\Bootstrap;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Application\Controller\IndexController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;

/**
 * Test controller for Default application home.
 */
class IndexControllerTest extends PHPUnit_Framework_TestCase {
    
    /**
     * Controller to be tested.
     * 
     * @var \Zend\Mvc\Controller\AbstractActionController
     */
    protected $_controller;
    
    /**
     * Http Request for internal reference.
     * 
     * @var \Zend\Http\Request
     */
    protected $_request;
    
    /**
     * HTTP Response object for testing.
     * 
     * @var \Zend\Http\Response 
     */
    protected $_response;
    
    /**
     * The default router to check the changes.
     *
     * @var \Zend\Mvc\Router\RouteMatch 
     */
    protected $_routeMatch;
    
    /**
     * MVC event to trigger the request.
     * 
     * @var \Zend\Mvc\MvcEvent 
     */
    protected $_event;

    
    /**
     * Initial test setup to initialize parameters.
     * 
     * @return void
     */
    protected function setUp() {
        $serviceManager = Bootstrap::getServiceManager();
        $this->_controller = new IndexController();
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
     * Test to verify the index controller works or not.
     * 
     * @return void
     */
    public function testIndexActionCanBeAccessed() {
        $this->_routeMatch->setParam('action', 'index');

        $result = $this->_controller->dispatch($this->_request);
        $response = $this->_controller->getResponse();
        $result->captureTo(); // Use This content to parse and test values.
        $this->assertEquals(200, $response->getStatusCode());
    }
    
    
}
