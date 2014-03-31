<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Controller
 * @package   Album
 * @author    Sujai SD <sujai@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace AppConfig\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Album Controller Manages CRUD of Albums.
 */
class ConfigController extends AbstractActionController 
{
    private $migrationService;
    
    /**
     * Initializes AlbumService and provides it.
     * 
     * @return \AppConfig\Service\MigrationService
     */
    public function getMigrationService() {
        if ($this->migrationService == null) {
            $this->migrationService = $this->getServiceLocator()->get('AppConfig\Service\MigrationService');
        }
        
        return $this->migrationService;
    }
    
    /**
     * Intro page.
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction() {
        $this->layout('layout/app-config');
    }
    
    /**
     * Lists all migration scripts.
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function dbMigrationsAction() {
        $this->layout('layout/app-config');
        return new ViewModel(array(
            'migrations' => $this->getMigrationService()->findAll()));
    }
    
    
}
