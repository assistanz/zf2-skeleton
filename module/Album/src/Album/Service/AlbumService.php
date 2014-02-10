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

namespace Album\Service;

/**
 * Service layer to support the business/doamin functions required in the application.
 */
class AlbumService {
    
    /**
     * Service manager to provide dependencies.
     *
     * @var \Zend\ServiceManager\ServiceLocatorInterface 
     */
    private $_serviceLocator;
    
    /**
     * AlbumDao Instance.
     * 
     * @var \Album\Dao\AlbumDao
     */
    private $_albumDao;
    
    
    /**
     * Prepares the Album Domain Service.
     * 
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator ServiceLocator instance.
     */
    public function __construct(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $this->_serviceLocator = $serviceLocator;
    }

    
    /**
     * Creates an album after validations and persists it.
     * 
     * If the album name already exists, the creation fails.
     * 
     * @param \Album\Entity\Album $newAlbum Instance of album to be created.
     * @param boolean             $force    Force creation of the album.
     * 
     * @throws \Album\Exception\AlbumAlreadyExistsException Thrown when album title already exists.
     * 
     * @return void
     */
    public function create(\Album\Entity\Album $newAlbum, $force) {

        if (!$force) {
            $title = $newAlbum->getTitle();
            $count = $this->getAlbumDao()->findCountByTitle($title);
            
            if ($count > 0) {
                throw new \Album\Exception\AlbumAlreadyExistsException("Album with title '{$title}' already exists.");
            }
        }
        
        $this->getAlbumDao()->add($newAlbum);
    }
    
    
    /**
     * Update Album after validation.
     * 
     * If the album name already exists, the Updating fails.
     * 
     * @param \Album\Entity\Album $newAlbum Instance of album to be updated.
     * 
     * @throws \Album\Exception\AlbumAlreadyExistsException Thrown when album title already exists.
     * 
     * @return void
     */
    public function update(\Album\Entity\Album $newAlbum) {
        $this->getAlbumDao()->update($newAlbum);
    }
    
    
    /**
     * Delete the particular Album
     * 
     * @param \Album\Entity\Album $newAlbum Instance of album to be Deleted.
     * 
     * @return void
     */
    public function remove(\Album\Entity\Album $newAlbum) {
        $this->getAlbumDao()->remove($newAlbum);
    }
    
    
    /**
     * Finds the specified album by id.
     * 
     * @param integer $entityId Id of the album.
     * 
     * @return \Album\Dao\AlbumDao
     */
    public function findById($entityId) {
        return $this->getAlbumDao()->findById($entityId);
    }
    
    
    
     /**
      * Finds All Albums
      * 
      * @return \Album\Dao\AlbumDao
      */
    public function findAll($options = array()) {
        return $this->getAlbumDao()->findAll($options);
    }
    
    
    /**
     * Provides instance of Album Dao.
     * 
     * @return \Album\Dao\AlbumDao
     */
    private function getAlbumDao() {
        
        if ($this->_albumDao == null) {
            $this->_albumDao = $this->_serviceLocator->get('\Album\Dao\AlbumDao');
        }
        
        return $this->_albumDao;
    }

    
}
