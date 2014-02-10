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

namespace Album\Dao;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Data access layer for Album entity.
 */
class AlbumDao extends \Doctrine\ORM\EntityRepository {
    
    /**
     * Class name of the entity to create EntityRepository.
     * 
     * @var string
     */
    private $_className = "\Album\Entity\Album";
    
    
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
     * @param \Album\Entity\Album $entity The instance of the record to be persisted.
     * 
     * @return void
     */
    public function add(\Album\Entity\Album $entity) {
         $this->_em->persist($entity);
         $this->_em->flush();
    }
    
    
    /**
     * Update the provided entity.
     * 
     * @param \Album\Entity\Album $entity The instance of the record to be persisted.
     * 
     * @return void
     */
    public function update(\Album\Entity\Album $entity) {
         $this->_em->merge($entity);
         $this->_em->flush();
    }
    
    
    /**
     * Remove the provided entity.
     * 
     * @param \Album\Entity\Album $entity The instance of the record to be persisted.
     * 
     * @return void
     */
    public function remove(\Album\Entity\Album $entity) {
         $this->_em->remove($entity);
         $this->_em->flush();
    }
    
    
    /**
     * Find All
     * 
     * @param integer $entityId The primary key identifier.
     * 
     * @return \Album\Entity\Album 
     */
    public function findById($albumId) {       
        return $this->find($albumId);
    }
    
    
    /**
     * Find All Albums
     * 
     * @return \Album\Entity\Album 
     */
    public function findAll($options = array()) {
        
        $dql = "SELECT a FROM \Album\Entity\Album a";
        $query = $this->_em->createQuery($dql);
        if (count($options)) {
            $query->setFirstResult($options['first'])
                                ->setMaxResults($options['max']);
        }
        
        $paginator = new Paginator($query, $fetchJoinCollection = true);
        
        return $paginator;
    }

    
    /**
     * Find all Album by its title.
     * 
     * @param string $albumTitle The primary key identifier.
     * 
     * @return array
     */
    public function findAllByTitle($albumTitle) {
        return $this->findBy(array('title' => $albumTitle));
    }    
    
    
    /**
     * Find Album count by its title.
     * 
     * @param string $albumTitle The primary key identifier.
     * 
     * @return array
     */
    public function findCountByTitle($albumTitle) {
        $queryText = 'SELECT COUNT(a) FROM \Album\Entity\Album a WHERE 
                a._title LIKE :title ';
        $query = $this->_em->createQuery($queryText);    
        $query->setParameter("title", "{$albumTitle}");
        $count = $query->getSingleScalarResult();
        return $count;
    }
    
    
}
