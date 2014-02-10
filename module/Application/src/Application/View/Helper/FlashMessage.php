<?php
/**
 * Sample Application for ZendFramework Testing.
 * 
 * PHP version 5
 * 
 * @category  Helper
 * @package   Application
 * @author    Vanaraj <vanaraj@assistanz.com>
 * @copyright 2005-2012 AssistanZ Networks Pvt Ltd. (http://www.assistanz.com)
 * @license   http://docs.assistanz.com/dev-license/standard AssistanZ Standard License
 * @version   SVN: <svn_id>
 * @link      http://track.assistanz.com/projects/{project-name} for the canonical source repository
 * 
 */

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * FlashMessage helper to convert the flash messages to HTML.
 */
class FlashMessage extends AbstractHelper {
    
    /**
     * Instance of the FlashMessenger which contains the messages.
     * 
     * @var \Zend\Mvc\Controller\Plugin\FlashMessenger.
     */
    private $_flashMessenger;

    
    /**
     * Constructs the helper with the instance of the FlashMessenger.
     * 
     * @param \Zend\Mvc\Controller\Plugin\FlashMessenger $flash The flashmessenger instance to read the messages.
     */
    public function __construct(\Zend\Mvc\Controller\Plugin\FlashMessenger $flash) {
         $this->_flashMessenger = $flash;
    } 
    
    
    /**
     * Shows flash messages in bootstrap style alerts. This can be any type as varied in the parameters.
     * 
     * @param string  $type   The type of the message to be disblayed. This can be 'info', 'error', 'all'.
     * @param boolean $single Specifies single item for each message or all messages in one. 
     *                        Default is true, so each message will be displayed in separate box.
     * 
     * @return string HTML content with style classes.
     */
    public function __invoke($type = 'all', $single = true) {
        
        $infoMessages = array();
        $errorMessages = array();
        $successMessages = array();
        $warningMessages = array();
        $allMessages = "";
                
        if ($type == 'info') {
            $infoMessages = $this->_flashMessenger->getInfoMessages();
            $allMessages = $this->getMessageHtml($infoMessages, 'info', $single);
        } else if ($type == 'error') {
            $errorMessages = $this->_flashMessenger->getErrorMessages();
            $allMessages = $this->getMessageHtml($errorMessages, 'error', $single);
        } else if ($type == 'success') {
            $successMessages = $this->_flashMessenger->getSuccessMessages();
            $allMessages = $this->getMessageHtml($successMessages, 'success', $single);
        } else if ($type == 'warning') {
            $warningMessages = $this->_flashMessenger->getMessages();
            $allMessages = $this->getMessageHtml($warningMessages, 'warning', $single);
        } else {
            $infoMessages = $this->_flashMessenger->getInfoMessages();
            $errorMessages = $this->_flashMessenger->getErrorMessages();
            $successMessages = $this->_flashMessenger->getSuccessMessages();
            $warningMessages = $this->_flashMessenger->getMessages();
            
            $allMessages = $this->getMessageHtml($infoMessages, 'info', $single);
            $allMessages .= $this->getMessageHtml($errorMessages, 'error', $single);
            $allMessages .= $this->getMessageHtml($successMessages, 'success', $single);
            $allMessages .= $this->getMessageHtml($warningMessages, 'warning', $single);
        }
        
        return $allMessages;
    }
    
    
    /**
     * Provides HTML for the array of messages based on the type.
     * 
     * @param array   $messages List of flash messages.
     * @param string  $type     Type of message 'info', 'success', 'warning' and 'error'.
     * @param boolean $isSingle Is single message or grouped message.
     * 
     * @return string
     */
    private function getMessageHtml(array $messages, $type, $isSingle) {
        
        $allMessages = "";
        $allSuccessMessages = "<ul>";
        foreach ($messages as $value) {
            if ($isSingle) {
                $allMessages .= '<div class="alert alert-' . $type . '">' . $value . '</div>';
            } else {
                $allSuccessMessages .= "<li>{$value}</li>";
            }
        }
        
        $allSuccessMessages .= "</ul>";
        
        if (!$isSingle && !empty($messages)) {
            return '<div class="alert alert-' . $type . '">' . $allSuccessMessages . '</div>';
        } 
        
        return $allMessages;
    }
    
    
}
