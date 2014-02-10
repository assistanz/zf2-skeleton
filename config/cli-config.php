<?php

require 'Doctrine/ORM/Tools/Setup.php';
 
// Setup Autoloader (1)
Doctrine\ORM\Tools\Setup::registerAutoloadPEAR();

$appConfig = include __DIR__ .'/autoload/local.php';

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

// Define application environment
define('APPLICATION_ENV', "development");
 
/*
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
*/
$handle = opendir(__DIR__ . '/../module/');
$entitiesDir = array();
if ($handle) {
   
    while (false !== ($directory = readdir($handle))) {
        if($directory == '.' || $directory == '..' || !is_dir(__DIR__ . '/../module/' . $directory)) {
            continue;
        }
        $path = realpath(__DIR__ . "/../module/{$directory}/src/{$directory}/Entity");
        if($path) {
            $entitiesDir[] = $path;
        }
        
    }    
    closedir($handle);
}
 
// $classLoader = new \Doctrine\Common\ClassLoader("Album\Entity', __DIR__ . '/../module/Album/src/Album/Entity');
// $classLoader->register();
// $classLoader = new \Doctrine\Common\ClassLoader('Proxies', __DIR__);
// $classLoader->register();
 
// configuration (2)
 $config = new \Doctrine\ORM\Configuration();
 
// Proxies (3)
 $config->setProxyDir(__DIR__ . '/../data/Proxies');
 $config->setProxyNamespace('Proxies');
 
 $config->setAutoGenerateProxyClasses((APPLICATION_ENV == "development"));
 //echo __DIR__ . '/../module/Album/src/Album/Entity';
// Driver (4)
 
AnnotationRegistry::registerFile("Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php");
$reader = new AnnotationReader();
 
// $driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__ . '/../module/Album/src/Album/Entity/'));
// $config->setMetadataDriverImpl($driverImpl);
 
$driverImpl = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($reader, $entitiesDir);
$config->setMetadataDriverImpl($driverImpl);
 
// Caching Configuration (5)
 if (APPLICATION_ENV == "development") {
 
     $cache = new \Doctrine\Common\Cache\ArrayCache();
 
 } else {
 
     $cache = new \Doctrine\Common\Cache\ApcCache();
 }
 
 $config->setMetadataCacheImpl($cache);
 $config->setQueryCacheImpl($cache);
 

 $connectionOptions = $appConfig['doctrine']['connection']['orm_default']['params'];
 $connectionOptions['driver'] = 'pdo_mysql';
 $em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);
 
 $helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
     'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
     'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
 ));
 
 return $helperSet;