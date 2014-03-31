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

namespace AppConfig\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A music album.
 *
 * @ORM\Entity
 * @ORM\Table(name="doctrine_migration_versions")
 * @property string $_artist
 * @property string $_title
 * @property int $version
 */
class Migration {
    
    /**
     * Migration unique identifier.
     * 
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer", name="version");
     */
    protected $version;

    public function getVersion() {
        return $this->version;
    }

    public function setVersion($version) {
        $this->version = $version;
    }


}
