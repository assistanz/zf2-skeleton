<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Service
 * @package   Album
 * @author    Sujai SD <sujai@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace AppConfig\Dao;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Data access layer for Album entity.
 */
class MigrationDao extends \Doctrine\ORM\EntityRepository {
    
    /**
     * Class name of the entity to create EntityRepository.
     * 
     * @var string
     */
    private $_className = "\AppConfig\Entity\Migration";
    
    
    /**
     * Default constructor for the AlbumDao.
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
     * @param \AppConfig\Entity\Migration $entity The instance of the record to be persisted.
     * 
     * @return void
     */
    public function add(\AppConfig\Entity\Migration $entity) {
         $this->_em->persist($entity);
         $this->_em->flush();
    }
    
    
    /**
     * Update the provided entity.
     * 
     * @param \AppConfig\Entity\Migration $entity The instance of the record to be persisted.
     * 
     * @return void
     */
    public function update(\AppConfig\Entity\Migration $entity) {
         $this->_em->merge($entity);
         $this->_em->flush();
    }
    
    
    /**
     * Remove the provided entity.
     * 
     * @param \AppConfig\Entity\Migration $entity The instance of the record to be persisted.
     * 
     * @return void
     */
    public function remove(\AppConfig\Entity\Migration $entity) {
         $this->_em->remove($entity);
         $this->_em->flush();
    }
    
    
    /**
     * Find All
     * 
     * @param integer $entityId The primary key identifier.
     * 
     * @return \AppConfig\Entity\Migration 
     */
    public function findById($version) {       
        return $this->find($version);
    }
    
    
    /**
     * Find All Albums
     * 
     * @return \AppConfig\Entity\Migration 
     */
    public function findAll($options = array()) {
        
        $dql = "SELECT m FROM \AppConfig\Entity\Migration m";
        $query = $this->_em->createQuery($dql);
        if (count($options)) {
            $query->setFirstResult($options['first'])
                                ->setMaxResults($options['max']);
        }
        
        $paginator = new Paginator($query, $fetchJoinCollection = true);
        
        return $paginator;
    }
    
}
