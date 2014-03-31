<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Config
 * @package   AppConfig
 * @author    Sujai SD <sujai@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace AppConfig;

return array(
    'controllers' => array(
        'invokables' => array(
            'AppConfig\Controller\Config' => 'AppConfig\Controller\ConfigController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'app-config' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/app-config[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'AppConfig\Controller\Config',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            'app-config' => __DIR__ . '/../view',
        ),
    ),
    
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
    
    'service_manager' => array(
        'factories' => array(
            'AppConfig\Dao\MigrationDao' => function ($serviceManager) {
                $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');
                return new \AppConfig\Dao\MigrationDao($entityManager);
            },
                    
                    
            'AppConfig\Service\MigrationService' => function ($serviceManager) {
                $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');
                $domainService = new \AppConfig\Service\MigrationService($serviceManager);
                return new \Application\Util\DomainServiceProxy($entityManager, $domainService);
            },
        ),
        'invokeables' => array(
            
        )
    ),
);
