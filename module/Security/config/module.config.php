<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Config
 * @package   Application
 * @author    Jamseer N <jamseer@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace Security;

return array(
    'controllers' => array(
        'invokables' => array(
            'Security\Controller\User' => 'Security\Controller\UserController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'users' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/users[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Security\Controller\User',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            'security' => __DIR__ . '/../view',
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
            'Security\Dao\UserDao' => function ($serviceManager) {
                $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');
                return new \Security\Dao\UserDao($entityManager);
            },
                    
                    
            'Security\Service\UserService' => function ($serviceManager) {
                $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');
                $domainService = new \Security\Service\UserService($serviceManager);
                return new \Application\Util\DomainServiceProxy($entityManager, $domainService);
            },
        ),
        'invokeables' => array(
            
        )
    ),
);
