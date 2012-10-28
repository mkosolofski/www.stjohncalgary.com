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

        $view = \Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
        $view->headScript()->appendFile('/js/jquery.js');
        $view->headScript()->appendFile('/js/jquery_ui.js');
        $view->headLink()->appendStylesheet('/css/admin/master.css');
        $view->headLink()->appendStylesheet('/css/jquery_ui.css');
        $view->headLink()->appendStylesheet('/css/jquery_addons/datetime_picker.css');

        \Zend_Controller_Action_HelperBroker::getStaticHelper('Layout')
            ->setLayoutPath(APPLICATION_PATH . '/modules/Admin/layouts/scripts/');
    }
}
