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

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;  
use Album\Form\AlbumForm;
use Album\Entity\Album;

/**
 * Album Controller Manages CRUD of Albums.
 */
class AlbumController extends AbstractActionController {
    
    /**
     * Entity manager to handle database.
     * 
     * @var Doctrine\ORM\EntityManager
     */
    protected $_entityManager;
    
    /**
     * AlbumService instance.
     * 
     * @var \Album\Service\AlbumService
     */
    protected $_albumService;

    
    /**
     * Sets a new EntityManager.
     * 
     * @param \Doctrine\ORM\EntityManager $entityManager Entity Manager which handles the database.
     * 
     * @return void
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager) {
        $this->_entityManager = $entityManager;
    }
 
    
    /**
     * Provides EntityManager with connection.
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager() {
        if (null === $this->_entityManager) {
            $this->_entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        
        return $this->_entityManager;
    } 
    

    /**
     * Initializes AlbumService and provides it.
     * 
     * @return \Album\Service\AlbumService
     */
    public function getAlbumService() {
        if ($this->_albumService == null) {
            $this->_albumService = $this->getServiceLocator()->get('Album\Service\AlbumService');
        }
        
        return $this->_albumService;
    }
    

    /**
     * Lists the items in album.
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction() {

        return new ViewModel(array(
            'albums' => $this->getAlbumService()->findAll()));
    }
    

    /**
     * Adds a new album item.
     * 
     * @return array View information.
     */
    public function addAction() {
        $form = new AlbumForm();
        
        try {
            $form->get('submit')->setAttribute('label', 'Add');

            $request = $this->getRequest();
            if ($request->isPost()) {
                $album = new Album();

                $form->setInputFilter($album->getInputFilter());
                $form->setData($request->getPost());
                if ($form->isValid()) { 
                    $data = $album->populate($form->getData());
                    $forceCreation = $request->getPost()->get('force', false);
                    $this->getAlbumService()->create($album, $forceCreation);
                    $this->flashMessenger()->addSuccessMessage("Album '{$album->title}' Added Successfully....");
                    // Redirect to list of albums.
                    return $this->redirect()->toRoute('album'); 
                }
            }
        } catch (\Album\Exception\AlbumAlreadyExistsException $exc) {
            // TODO: Add logic to add "force creation" button in screen.
            $this->flashMessenger()->addErrorMessage($exc->getMessage());           
        } catch (\Exception $exc) {
            $this->flashMessenger()->addErrorMessage($exc->getMessage());
        }

        return array('form' => $form);
    }
    

    /**
     * Updates an existing album.
     * 
     * @return array View Information.
     */
    public function editAction() {
        $albumId = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$albumId) {
            return $this->redirect()->toRoute('album', array('action' => 'add'));
        }
        
        $album = $this->getAlbumService()->findById($albumId);

        $form = new AlbumForm();
        $form->setBindOnValidate(false);
        $form->bind($album);
        $form->get('submit')->setAttribute('label', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {                
                $album = $form->getData();
                $form->bindValues();
                
                $this->getAlbumService()->update($album);

                // Redirect to list of albums.
                $this->flashMessenger()->addSuccessMessage("Album '{$album->title}' Updated Successfully....");
                return $this->redirect()->toRoute('album');
            }
        }

        return array(
            'id' => $albumId,
            'form' => $form,
        );
    }
    

    /**
     * Deletes an existing album.
     * 
     * @return array View information.
     */
    public function deleteAction() {
        $albumId = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$albumId) {
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost()->get('del', 'No');
            if ($del == 'Yes') {
                $albumId = (int)$request->getPost()->get('id');
                $album = $this->getAlbumService()->findById($albumId);
                if ($album) {
                    $this->getAlbumService()->remove($album);
                }
            }

            // Redirect to list of albums.
            $this->flashMessenger()->addSuccessMessage("Album '{$album->title}' Deleted Successfully....");
            return $this->redirect()->toRoute('album');
        }

        return array(
            'id' => $albumId,
            'album' => $this->getAlbumService()->findById($albumId)
        );
    }
    
    
}
