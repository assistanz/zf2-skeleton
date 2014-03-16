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
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action as global.
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'flashMessage' => function ($sm) {
        $messenger = $sm->getServiceLocator()->get('ControllerPluginManager')->get('FlashMessenger');
        return new \Application\View\Helper\FlashMessage($messenger);
    },
        ),
        'invokeables' => array(
        )
    ),
    'asset_manager' => array(
        'resolver_configs' => array(
            'collections' => array(
                'js/all.js' => array(
                    'lib/require.js',
                    'lib/jquery/jquery.js',
                    'lib/bootstrap/js/bootstrap.js',
                ),
            ),
            'paths' => array(
                 __DIR__ . '/../../../public',
            ),
            'map' => array(
                'js/' => __DIR__ . '/../../../public/js',
                'lib/require.js' => __DIR__ . '/../../../public/lib/require.js',
                'lib/jquery/jquery.js' => __DIR__ . '/../../../public/lib/jquery/jquery.js',
                'lib/bootstrap/js/bootstrap.js' => __DIR__ . '/../../../public/lib/bootstrap/js/bootstrap.js',
            ),
        ),
        'filters' => array(
//            'js/all.js' => array(
//                array(
//                    // Note: You will need to require the classes used for the filters yourself.
//                    'filter' => 'JSMin',
//                ),
//            ),
        ),
        'caching' => array(
//            'js/all.js' => array(
//                'cache' => 'Apc',
//            ),
        ),
    ),
);
