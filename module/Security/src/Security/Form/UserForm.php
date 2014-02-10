<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Controller
 * @package   UserForm
 * @author    Jamseer <jamseer@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace Security\Form;

use Zend\Form\Form;

/**
 * A music albumform for user input.
 */
class UserForm extends Form {
    
    
    /**
     * Constructor for AlbumForm class.
     */
    public function __construct() {
        // We want to ignore the name passed.
        parent::__construct();
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        
        
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Name',
            ),
        ));
         
        
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));
        
       
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
            ),
            'options' => array(
                'label' => 'Password',
            ),
        ));
        
        
//        $this->add(array(
//            'name' => 'password_check',
//            'attributes' => array(
//                'type'  => 'password',
//            ),
//            'options' => array(
//                'label' => 'Password',
//            ),
//        ));
         
        
        $this->add(array(
            'name' => 'phoneNumber',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Phone number',
            ),
        ));
        
      
//        $this->add(array(
//            'name' => 'gender',
//            'attributes' => array(
//                'type'  => 'radio',
//            ),
//            'options' => array(
//                'label' => 'Gender',
//                'value_options' => array(
//                '0' => 'Male',
//                '1' => 'Female'),
//            ),
//        ));
        
        
        $this->add(array(
            'name' => 'address',
            'attributes' => array(
                'type'  => 'textarea',
            ),
            'options' => array(
                'label' => 'Address',
            ),
        ));
         
         
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
    
    
}
