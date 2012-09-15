<?php
/**
 * Contains the Admin object. 
 */

namespace Admin\Plugin;

/**
 * Plugin for admin related tasks.
 */

class Access extends \Zend_Controller_Plugin_Abstract

{
    /**
     * Called after Zend_Controller_Front exits from the router.
     *
     * @param  Zend_Controller_Request_Abstract $request
     * @return void
     */
    public function routeShutdown(\Zend_Controller_Request_Abstract $request)
    {
        if (strtolower($request->getModuleName()) !== 'admin') {
            return;
        }

        $request->setModuleName('Admin');

        // Add code here to see if the user is logged in.

        $view = \Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
        $view->headScript()->appendFile('/js/jquery.js');

        \Zend_Controller_Action_HelperBroker::getStaticHelper('Layout')
            ->setLayout('admin');
    }
}
