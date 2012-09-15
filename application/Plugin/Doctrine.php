<?php
/**
 * Contains the Doctrine object. 
 */

/**
 * Define namespace for object.
 */
namespace Plugin;

/**
 * Plugin for doctrine related tasks.
 */
class Doctrine extends \Zend_Controller_Plugin_Abstract
{
    /**
     * Called before Zend_Controller_Front exits its dispatch loop.
     */
    public function dispatchLoopShutdown()
    {
        \Zend_Registry::getInstance()->entityManager->flush();
    }
}
