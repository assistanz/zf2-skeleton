<?php

namespace Security\Service;

/**
 * Description of UserService
 *
 * @author Sujai
 */
class UserService {

    /**
     * Service manager to provide dependencies.
     *
     * @var \Zend\ServiceManager\ServiceLocatorInterface 
     */
    private $serviceLocator;

    /**
     * AlbumDao Instance.
     * 
     * @var \User\Dao\UserDao
     */
    private $userDao;

    /**
     * Prepares the Album Domain Service.
     * 
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator ServiceLocator instance.
     */
    public function __construct(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }

    public function create(\Security\Entity\User $user, $force) {

//        if (!$force) {
//            $title = $user->getTitle();
//            $count = $this->getUserDao()->findCountByTitle($title);
//            
//            if ($count > 0) {
//                throw new \Album\Exception\AlbumAlreadyExistsException("Album with title '{$title}' already exists.");
//            }
//        }

        $this->getUserDao()->add($user);
    }

    /**
     * Update Album after validation.
     * 
     * If the album name already exists, the Updating fails.
     * 
     * @param \Security\Entity\User $user Instance of album to be updated.
     * 
     * @throws \Album\Exception\AlbumAlreadyExistsException Thrown when album title already exists.
     * 
     * @return void
     */
    public function update(\Security\Entity\User $user) {
        $this->getUserDao()->update($user);
    }

    /**
     * Delete the particular Album
     * 
     * @param \Security\Entity\User $user Instance of album to be Deleted.
     * 
     * @return void
     */
    public function remove(\Security\Entity\User $user) {
        $this->getUserDao()->remove($user);
    }

    public function findAll() {
        return $this->getUserDao()->findAll();
    }

    /**
     * Finds the specified album by id.
     * 
     * @param integer $entityId Id of the album.
     * 
     * @return \Security\Entity\User
     */
    public function findById($entityId) {
        return $this->getUserDao()->findById($entityId);
    }

    /**
     * Provides instance of Album Dao.
     * 
     * @return \Security\Dao\UserDao
     */
    private function getUserDao() {

        if ($this->userDao == null) {
            $this->userDao = $this->serviceLocator->get('\Security\Dao\UserDao');
        }

        return $this->userDao;
    }

}
