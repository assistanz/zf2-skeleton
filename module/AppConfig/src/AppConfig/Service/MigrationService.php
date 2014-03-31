<?php

/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Service
 * @package   Album
 * @author    Sujai SD <sujai@assistanz.com>
 * @copyright 2005-2013 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace AppConfig\Service;

/**
 * Service layer to support the business/doamin functions required in the application.
 */
class MigrationService {

    /**
     * Service manager to provide dependencies.
     *
     * @var \Zend\ServiceManager\ServiceLocatorInterface 
     */
    private $_serviceLocator;

    /**
     * AlbumDao Instance.
     * 
     * @var \AppConfig\Dao\MigrationDao
     */
    private $_migrationDao;

    /**
     * Prepares the Album Domain Service.
     * 
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator ServiceLocator instance.
     */
    public function __construct(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $this->_serviceLocator = $serviceLocator;
    }

    /**
     * Finds All Albums
     * 
     * @return \MigrationService\Entity\Migration
     */
    public function findAll($options = array()) {
        return $this->getMigrationDao()->findAll($options);
    }

    /**
     * Provides instance of Album Dao.
     * 
     * @return \Album\Dao\AlbumDao
     */
    private function getMigrationDao() {

        if ($this->_migrationDao == null) {
            $this->_migrationDao = $this->_serviceLocator->get('\AppConfig\Dao\MigrationDao');
        }

        return $this->_migrationDao;
    }

}
