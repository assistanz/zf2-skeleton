<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Album
 * @package   Album
 * @author    Sujai SD <sujai@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace AlbumTest;

use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\ArrayUtils;
use RuntimeException;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

/**
 * Bootstrap for tests.
 */
class Bootstrap {
    
    /**
     * Service Manager to access the basic application.
     * 
     * @var \stdClass 
     */
    protected static $_serviceManager;
    
    /**
     * Module configuration array.
     * 
     * @var array 
     */
    protected static $_config;
    
    /**
     * Bootstrap object of the application.
     *  
     * @var Bootstrap 
     */
    protected static $_bootstrap;

    
    /**
     * Initializes the testing bootstrap.
     * 
     * @return void
     */
    public static function init() {
        // Load the user-defined test configuration file, if it exists; otherwise, load.
        if (is_readable(__DIR__ . '/TestConfig.php')) {
            $testConfig = include __DIR__ . '/TestConfig.php';
        } else {
            $testConfig = include __DIR__ . '/TestConfig.php.dist';
        }

        $zfModulePaths = array();

        if (isset($testConfig['module_listener_options']['module_paths'])) {
            $modulePaths = $testConfig['module_listener_options']['module_paths'];
            foreach ($modulePaths as $modulePath) {
                if (($path = static::findParentPath($modulePath))) {
                    $zfModulePaths[] = $path;
                }
            }
        }

        $zfModulePaths  = implode(PATH_SEPARATOR, $zfModulePaths) . PATH_SEPARATOR;
        if (getenv('ZF2_MODULES_TEST_PATHS')) {
            $zfModulePaths .= getenv('ZF2_MODULES_TEST_PATHS');
        } else if (defined('ZF2_MODULES_TEST_PATHS')) {
            $zfModulePaths .= ZF2_MODULES_TEST_PATHS;
        }
        
        static::initAutoloader();

        // Use ModuleManager to load this module and it's dependencies.
        $baseConfig = array(
            'module_listener_options' => array(
                'module_paths' => explode(PATH_SEPARATOR, $zfModulePaths),
            ),
        );

        $config = ArrayUtils::merge($baseConfig, $testConfig);

        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();

        static::$_serviceManager = $serviceManager;
        static::$_config = $config;
    }

    
    /**
     * Provides the service manager.
     * 
     * @return \stdClass
     */
    public static function getServiceManager() {
        return static::$_serviceManager;
    }

    
    /**
     * Provides the config value.
     * 
     * @return array
     */
    public static function getConfig() {
        return static::$_config;
    }

    
    /**
     * Initializes the autoloader.
     * 
     * @return void
     * 
     * @throws RuntimeException Thrown when the module cannot be loaded.
     */
    protected static function initAutoloader() {
        $vendorPath = static::findParentPath('vendor');

        if (is_readable($vendorPath . '/autoload.php')) {
            include $vendorPath . '/autoload.php';
        } else {
            $zfPath = getenv('ZF2_PATH') ? : false;

            if (!$zfPath && defined('ZF2_PATH')) {
                $zfPath = ZF2_PATH;
            } else if (!$zfPath && is_dir($vendorPath . '/ZF2/library')) {
                $zfPath = $vendorPath . '/ZF2/library';
            }
            
            if (!$zfPath) {
                $message = 'Unable to load ZF2. Run `php composer.phar install`';
                $message .= ' or define a ZF2_PATH environment variable.';
                throw new RuntimeException($message);
            }

            include $zfPath . '/Zend/Loader/AutoloaderFactory.php';
        }

        AutoloaderFactory::factory(array(
            'Zend\Loader\StandardAutoloader' => array(
                'autoregister_zf' => true,
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/' . __NAMESPACE__,
                ),
            ),
        ));
    }

    
    /**
     * Finds the parent directory.
     * 
     * @param string $path Path for which the parent is required.
     * 
     * @return boolean
     */
    protected static function findParentPath($path) {
        $dir = __DIR__;
        $previousDir = '.';
        while (!is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);
            if ($previousDir === $dir) {
                return false;
            }
            
            $previousDir = $dir;
        }
        
        return $dir . '/' . $path;
    }
}

Bootstrap::init();
