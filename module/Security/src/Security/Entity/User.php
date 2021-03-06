<?php

/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Entity
 * @package   User
 * @author    Jamseer <jamseer@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace Security\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Crypt\Password\Bcrypt;

/**
 * Application user.
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @property string $username
 * @property string $displayName
 * @property string $password
 * @property integer $state
 * @property integer $phoneNumber
 * @property string $gender
 * @property string $address
 */
class User implements InputFilterAwareInterface, \ZfcUser\Entity\UserInterface {

    /**
     * Input filter for user data.
     * 
     * @var Zend\InputFilter\InputFilterInterface 
     */
    protected $_inputFilter;

    /**
     * User unique identifier.
     * 
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer", name="user_id");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * User email.
     * 
     * @var string
     * @ORM\Column(type="string", name="username")
     */
    protected $username;

    /**
     * User name.
     * 
     * @var string
     * @ORM\Column(type="string", name="name")
     */
    protected $displayName;

    /**
     * User password.
     * 
     * @var string
     * @ORM\Column(type="string", name="password")
     */
    protected $password;

    /**
     * User state.
     * 
     * @var integer
     * @ORM\Column(type="integer", name="state")
     */
    protected $state;

    /**
     * User address.
     * 
     * @var string
     * @ORM\Column(type="integer", name="email")
     */
    protected $email;

    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property The property for which value is required.
     * 
     * @return mixed Value of the requested property.
     */
    public function __get($property) {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property Name of the property.
     * @param mixed  $value    Value of the property to be set.
     * 
     * @return void
     */
    public function __set($property, $value) {
        $this->$property = $value;
    }

    /**
     * Provides the id.
     * 
     * @return integer
     */
    public function getUserId() {
        return $this->id;
    }

    /**
     * Sets the new id.
     * 
     * @param integer $id New value.
     * 
     * @return void
     */
    public function setUserId($id) {
        $this->id = $id;
    }

    /**
     * Provides the email.
     * 
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Sets new email.
     * 
     * @param string $email New Value.
     * 
     * @return void
     */
    public function setUsername($email) {
        return $this->username = $email;
    }

    /**
     * Provides the name of the user.
     * 
     * @return string
     */
    public function getName() {
        return $this->displayName;
    }

    /**
     * Sets new display name.
     * 
     * @param string $_display_name New Value.
     * 
     * @return void
     */
    public function setName($name) {
        return $this->displayName = $name;
    }

    /**
     * Sets new display name.
     * 
     * @param string $_display_name New Value.
     * 
     * @return void
     */
    public function setPassword($password) {
        $bcrypt = new Bcrypt();
        return $this->password = $bcrypt->create($password);
    }

    /**
     * Provides the password of the user.
     * 
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Provides the state of the user.
     * 
     * @return string
     */
    public function getState() {
        return $this->state;
    }

    /**
     * Sets new display name.
     * 
     * @param string $state New Value.
     * 
     * @return void
     */
    public function setState($state) {
        $this->state = $state;
    }

    /**
     * Provides the gender of the user.
     * 
     * @return string
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * Sets new gender.
     * 
     * @param string $gender New Value.
     * 
     * @return void
     */
    public function setGender($gender) {
        $this->gender = $gender;
    }

    /**
     * Provides the phone number of the user.
     * 
     * @return string
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    /**
     * Sets new gender.
     * 
     * @param string $_gender New Value.
     * 
     * @return void
     */
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Provides the address of the user.
     * 
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Sets new address.
     * 
     * @param string $address New Value.
     * 
     * @return void
     */
    public function setAddress($address) {
        $this->address = $address;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() {
        $arrayValues = array();
        foreach ($this as $key => $value) {
            $arrayValues[$key] = $value;
        }

        return $arrayValues;
    }

    /**
     * Populate from an array.
     *
     * @param mixed $data Populate the album values.
     * 
     * @return void
     */
    public function populate($data = array()) {
        $this->id = $data['id'];
        $this->username = $data['email'];
        $this->displayName = $data['name'];
        $this->setPassword($data['password']);
//        $this->_state = $data['state'];
        $this->phoneNumber = $data['phoneNumber'];
//        $this->_gender = $data['gender'];
        $this->address = $data['address'];
    }

    /**
     * Set input filter for user inputs.
     *
     * @param InputFilterInterface $inputFilter Set input filter for user inputs.
     * 
     * @return void
     */
    public function setInputFilter(InputFilterInterface $inputFilter) {
        $this->_inputFilter = $inputFilter;
    }

    /**
     * Get input filter for user inputs.
     *
     * @return object
     */
    public function getInputFilter() {
        if (!$this->_inputFilter) {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name' => 'id',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));

//            $inputFilter->add($factory->createInput(array(
//                'name'     => 'username',
//                'required' => true,
//                'filters'  => array(
//                    array('name' => 'StripTags'),
//                    array('name' => 'StringTrim'),
//                ),
//                'validators' => array(
//                    array(
//                        'name'    => 'StringLength',
//                        'options' => array(
//                            'encoding' => 'UTF-8',
//                            'min'      => 1,
//                            'max'      => 100,
//                        ),
//                    ),
//                ),
//            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'username',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'name',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'password',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100,
                                ),
                            ),
                        ),
            )));


//            $inputFilter->add($factory->createInput(array(
//                'name'     => 'state',
//                'required' => true,
//                'filters'  => array(
//                    array('name' => 'StripTags'),
//                    array('name' => 'StringTrim'),
//                ),
//                'validators' => array(
//                    array(
//                        'name'    => 'StringLength',
//                        'options' => array(
//                            'encoding' => 'UTF-8',
//                            'min'      => 1,
//                            'max'      => 100,
//                        ),
//                    ),
//                ),
//            )));


            $inputFilter->add($factory->createInput(array(
                        'name' => 'phoneNumber',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));

//            $inputFilter->add($factory->createInput(array(
//                'name'     => 'gender',
//                'required' => true,
//                'filters'  => array(
//                    array('name' => 'StripTags'),
//                    array('name' => 'StringTrim'),
//                ),
//                
//            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'address',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
            )));

            $this->_inputFilter = $inputFilter;
        }

        return $this->_inputFilter;
    }

    public function getId() {
        return $this->id;
    }

    public function getDisplayName() {
        return $this->displayName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDisplayName($displayName) {
        $this->displayName = $displayName;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

}
