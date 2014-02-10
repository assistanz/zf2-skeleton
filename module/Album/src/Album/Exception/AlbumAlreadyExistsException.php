<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Controller
 * @package   Application
 * @author    Sujai SD <sujai@assistanz.com>
 * @copyright 2005-2013 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace Album\Exception;

/**
 * Exception to handle Already existing album.
 */
class AlbumAlreadyExistsException extends \Application\Exception\DomainException {
    
}
