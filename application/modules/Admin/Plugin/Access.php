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
        
        $user = new \Website\User();
        $userEmail = $user->getCurrentUser()->email;

        if (\Zend_Registry::getInstance()->acl->isAllowed($userEmail, \Website\Acl::RESOURCE_ADMIN_MODULE) == false) {
            \Zend_Controller_Action_HelperBroker::getStaticHelper('redirector')->gotourl('/');
            return;
        }

        $request->setModuleName('Admin');

        $view = \Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
        $view->headScript()->appendFile('/js/jquery.js');

        \Zend_Controller_Action_HelperBroker::getStaticHelper('Layout')
            ->setLayout('admin');
    }
}
