<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Service
 * @package   Jamseer
 * @author    Jamseer N <jamseer@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace Security\Dao;

/**
 * Data access layer for Album entity.
 */
class UserDao extends \Doctrine\ORM\EntityRepository {
    
    /**
     * Class name of the entity to create EntityRepository.
     * 
     * @var string
     */
    private $_className = "\Security\Entity\User";
    
    
    /**
     * Default constructor for the UserDao.
     *
     * @param \Doctrine\ORM\EntityManager $entityManager Instance of entity manager.
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager) {
        $classMetaData = $entityManager->getClassMetadata($this->_className);
        parent::__construct($entityManager, $classMetaData);
    }
    
    
    /**
     * Adds the provided entity object to the persistence as a new record.
     * 
     * @param \Security\Entity\User $entity The instance of the record to be persisted.
     * 
     * @return void
     */
    public function add(\Security\Entity\User $entity) {
         $this->_em->persist($entity);
         $this->_em->flush();
    }
    
    
    /**
     * Update the provided entity.
     * 
     * @param \Security\Entity\User $entity The instance of the record to be persisted.
     * 
     * @return void
     */
    public function update(\Security\Entity\User $entity) {
         $this->_em->merge($entity);
         $this->_em->flush();
    }
    
    
    /**
     * Remove the provided entity.
     * 
     * @param \Security\Entity\User $entity The instance of the record to be persisted.
     * 
     * @return void
     */
    public function remove(\Security\Entity\User $entity) {
         $this->_em->remove($entity);
         $this->_em->flush();
    }
    
    
    /**
     * Find All
     * 
     * @param integer $entityId The primary key identifier.
     * 
     * @return \Security\Entity\User 
     */
    public function findById($userId) {       
        return $this->find($userId);
    }
    
    
    /**
     * Find All User
     * 
     * @return \Security\Entity\User 
     */
    public function findALL() {       
        return parent::findAll();
    }

    
    /**
     * Find all User by its name.
     * 
     * @param string $albumName The primary key identifier.
     * 
     * @return array
     */
    public function findAllByUserName($userName) {
        return $this->findBy(array('username' => $userName));
    }    
    
    
    /**
     * Find User count by its name.
     * 
     * @param string $userName The primary key identifier.
     * 
     * @return array
     */
    public function findCountByEmail($email) {
        $queryText = 'SELECT COUNT(a) FROM \Security\Entity\User a WHERE 
                a._email LIKE :email ';
        $query = $this->_em->createQuery($queryText);    
        $query->setParameter("email", "{$email}");
        $count = $query->getSingleScalarResult();
        return $count;
    }
    
    
}
