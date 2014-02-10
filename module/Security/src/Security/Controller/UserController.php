<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Controller
 * @package   User
 * @author    Jamseer N <jamseer@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace Security\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;  
use Security\Form\UserForm;
use Security\Entity\User;

/**
 * Security Controller Manages CRUD of Security.
 */
class UserController extends AbstractActionController {
    
    /**
     * Entity manager to handle database.
     * 
     * @var Doctrine\ORM\EntityManager
     */
    protected $_entityManager;
    
    /**
     * UserService instance.
     * 
     * @var \Security\Service\UserService
     */
    protected $_userService;

    
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
     * Initializes SecurityService and provides it.
     * 
     * @return \Security\Service\UserService
     */
    public function getUserService() {
        if ($this->_userService == null) {
            $this->_userService = $this->getServiceLocator()->get('Security\Service\UserService');
        }
        
        return $this->_userService;
    }
    

    /**
     * Lists the items in album.
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction() {

        return new ViewModel(array(
            'users' => $this->getUserService()->findAll()));
    }
    

    /**
     * Adds a new user.
     * 
     * @return array View information.
     */
    public function addAction() {
        $form = new UserForm();
        
        try {
            $form->get('submit')->setAttribute('label', 'Add');

            $request = $this->getRequest();
            if ($request->isPost()) {
                $user = new User();
               
                $form->setInputFilter($user->getInputFilter());
                $form->setData($request->getPost());
                if ($form->isValid()) { 
                    
                    $data = $user->populate($form->getData());
                    $forceCreation = $request->getPost()->get('force', false);
                    $this->getUserService()->create($user, $forceCreation);
                    $this->flashMessenger()->addSuccessMessage("User '{$user->name}' Added Successfully....");
                    // Redirect to list of albums.
                    return $this->redirect()->toRoute('users'); 
                } else {
                    
                }
                
                
            }
        } catch (\Security\Exception\UserAlreadyExistsException $exc) {
            // TODO: Add logic to add "force creation" button in screen.
            $this->flashMessenger()->addErrorMessage($exc->getMessage());           
        } catch (\Exception $exc) {
            $this->flashMessenger()->addErrorMessage($exc->getMessage());
        }

        return array('form' => $form);
    }
    

    /**
     * Updates an existing user.
     * 
     * @return array View Information.
     */
    public function editAction() {
        $userId = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$userId) {
            return $this->redirect()->toRoute('users', array('action' => 'add'));
        }
        
        $user = $this->getUserService()->findById($userId);

        $form = new UserForm();
        $form->setBindOnValidate(false);
        $form->bind($user);
        $form->get('submit')->setAttribute('label', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {                
                $user = $form->getData();
                $form->bindValues();
                
                $this->getUserService()->update($user);

                // Redirect to list of albums.
                $this->flashMessenger()->addSuccessMessage("User '{$user->name}' Updated Successfully....");
                return $this->redirect()->toRoute('users');
            }
        }

        return array(
            'id' => $userId,
            'form' => $form,
        );
    }
    

    /**
     * Deletes an existing album.
     * 
     * @return array View information.
     */
    public function deleteAction() {
        $userId = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$userId) {
            return $this->redirect()->toRoute('user');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost()->get('del', 'No');
            if ($del == 'Yes') {
                $userId = (int)$request->getPost()->get('id');
                $user = $this->getUserService()->findById($userId);
                if ($user) {
                    $this->getUserService()->remove($user);
                }
            }

            // Redirect to list of albums.
            $this->flashMessenger()->addSuccessMessage("User '{$user->name}' Deleted Successfully....");
            return $this->redirect()->toRoute('user');
        }

        return array(
            'id' => $userId,
            'album' => $this->getUserService()->findById($userId)
        );
    }
    
    
}
