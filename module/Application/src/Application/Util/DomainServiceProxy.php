<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Util
 * @package   Application
 * @author    Sujai SD <sujai@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace Application\Util;

/**
 * A warpper layer to introduce transaction and logging of failures in domain function calls.
 */
class DomainServiceProxy {

    /**
     * Instance of the DomainService which needs the transaction support.
     * 
     * @var mixed 
     */
    private $_instance;
    
    /**
     * The entity manager which will manage transactions.
     * 
     * @var \Doctrine\ORM\EntityManager 
     */
    private $_entityManager;
    
    
    /**
     * Prepares the wrapper proxy.
     * 
     * The wrapper is create for the provided domain service and uses the entity manager 
     * for transaction management.
     * 
     * @param \Doctrine\ORM\EntityManager $entityManager Instance of entity manager.
     * @param mixed                       $domainService The instance of the domain service to be wrapped.
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager, $domainService) {
        $this->_instance = $domainService;
        $this->_entityManager = $entityManager;
    }
    
    
    /**
     * The common function wrapper.
     * 
     * The wrapper takes care of the following.
     * <ul>
     * <li>Checks the availability of the function call in the service instance and calls it.</li>
     * <li>In case of any exception rolls back the transaction and throws the exception to callee</li>
     * </ul>
     * 
     * @param string $name      Name of the function to be called.
     * @param mixed  $arguments Arguments for the funciton as array.
     * 
     * @return mixed
     * @throws Exception Throws when function called not found and also throws exception from called functions.
     */
    public function __call($name, $arguments) {
        $this->_entityManager->getConnection()->beginTransaction();
        try {
            $reflectionClass = new \ReflectionClass($this->_instance);
            if ($reflectionClass->hasMethod($name)) {
                $reflectionMethod = $reflectionClass->getMethod($name);
                $returnValue = $reflectionMethod->invokeArgs($this->_instance, $arguments);
                $this->_entityManager->getConnection()->commit();
                return $returnValue;
            } else {
                $clazz = get_class($this->_instance);
                throw new \Exception("Method {$name} - not found in class \'{$clazz}\'" );
            }
        } catch (\SecurityException $exc) {
            // Log this exception.
            $this->_entityManager->getConnection()->rollback();
            throw $exc;
        } catch (\Exception $exc) {
            $this->_entityManager->getConnection()->rollback();
            throw $exc;
        }
    }
    
    
}
