<?php
/**
 * Contains the Admin object. 
 */

/**
 * Define namespace for object.
 */
namespace Plugin;

/**
 * Plugin for admin related tasks.
 */
class Admin extends \Zend_Controller_Plugin_Abstract
{
    /**
     * Called after Zend_Controller_Router exits.
     *
     * Called after Zend_Controller_Front exits from the router.
     *
     * @param  Zend_Controller_Request_Abstract $request
     * @return void
     */
    public function routeShutdown(\Zend_Controller_Request_Abstract $request)
    {
        $view = \Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
        $view->headScript()->appendFile('/js/jquery.js');
    }
}
