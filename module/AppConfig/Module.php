<?php
/**
 * Sample AppConfig Module for ZendFramework Admin Config Management.
 * 
 * PHP version 5
 * 
 * @category  AppConfig
 * @package   AppConfig
 * @author    Sujai SD <sujai@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace AppConfig;

/**
 * Application Module configuration and bootstrapping events.
 */
class Module {
    
    
    /**
     * Provides the config array declared in module configuration.
     * 
     * @return array
     */
    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }
    
    
    /**
     * Provides the autoloader configuration for the MVC.
     * 
     * @return array
     */
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    
}
