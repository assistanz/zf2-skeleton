<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Config
 * @package   Common
 * @author    Sujai SD <sujai@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

$dbParams = array(
    'database'  => 'zf2',
    'username'  => 'root',
    'password'  => 'root',
    'hostname'  => 'localhost',
);

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => $dbParams['hostname'],
                    'port'     => '3306',
                    'user'     => $dbParams['username'],
                    'password' => $dbParams['password'],
                    'dbname'   => $dbParams['database'],
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParams) {
                return new Zend\Db\Adapter\Adapter(array(
                    'driver'    => 'pdo',
                    'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
                    'database'  => $dbParams['database'],
                    'username'  => $dbParams['username'],
                    'password'  => $dbParams['password'],
                    'hostname'  => $dbParams['hostname'],
                ));
            },
        ),
    ),
);
