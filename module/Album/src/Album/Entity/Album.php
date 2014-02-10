<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Controller
 * @package   Album
 * @author    Jamseer <jamseer@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace Album\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * A music album.
 *
 * @ORM\Entity
 * @ORM\Table(name="album")
 * @property string $_artist
 * @property string $_title
 * @property int $_id
 */
class Album implements InputFilterAwareInterface {
    
    /**
     * Input filter for user data.
     * 
     * @var Zend\InputFilter\InputFilterInterface 
     */
    protected $_inputFilter;

    /**
     * Album unique identifier.
     * 
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer", name="id");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $_id;

    /**
     * Album artist.
     * 
     * @var string
     * @ORM\Column(type="string", name="artist")
     */
    protected $_artist;

    /**
     * Album title.
     * 
     * @var string
     * @ORM\Column(type="string", name="title")
     */
    protected $_title;

    
    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property The property for which value is required.
     * 
     * @return mixed Value of the requested property.
     */
    public function __get($property) {
        $param = '_' . $property;
        return $this->$param;
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
        $param = '_' . $property;
        $this->$param = $value;
    }

    
    /**
     * Provides the id.
     * 
     * @return integer
     */
    public function getId() {
        return $this->_id;
    }

    
    /**
     * Sets the new id.
     * 
     * @param integer $id New value.
     * 
     * @return void
     */
    public function setId($id) {
        $this->_id = $id;
    }

    
    /**
     * Provides the artist name.
     * 
     * @return string
     */
    public function getArtist() {
        return $this->_artist;
    }
    

    /**
     * Sets new artist name.
     * 
     * @param string $artist New Value.
     * 
     * @return void
     */
    public function setArtist($artist) {
        $this->_artist = $artist;
    }

    
    /**
     * Provides the title of the album.
     * 
     * @return string
     */
    public function getTitle() {
        return $this->_title;
    }

    
    /**
     * Sets new album title.
     * 
     * @param string $title New Value.
     * 
     * @return void
     */
    public function setTitle($title) {
        $this->_title = $title;
    }

    
    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() {
        return array(
            'id' => $this->_id,
            'artist' => $this->_artist,
            'title' => $this->_title);
    }
    

    /**
     * Populate from an array.
     *
     * @param mixed $data Populate the album values.
     * 
     * @return void
     */
    public function populate($data = array()) {
        $this->_id = $data['id'];
        $this->_artist = $data['artist'];
        $this->_title = $data['title'];
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
                'name'       => 'id',
                'required'   => true,
                'filters' => array(
                    array('name'    => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'artist',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'title',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $this->_inputFilter = $inputFilter;
        }
        
        return $this->_inputFilter;
    }
    
    
}
