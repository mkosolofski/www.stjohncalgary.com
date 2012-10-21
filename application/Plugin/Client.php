<?php
/**
 * Contains the Client object. 
 */

namespace Plugin;

/**
 * Plugin for client related tasks.
 */
class Client extends \Zend_Controller_Plugin_Abstract
{
    /**
     * Called after Zend_Controller_Router exits.
     *
     * @param  Zend_Controller_Request_Abstract $request
     */
    public function routeShutdown(\Zend_Controller_Request_Abstract $request)
    {
        if ($request->getModuleName() !== 'default') {
            return;
        }

        $view = \Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
        $view->headScript()->appendFile('/js/jquery.js');
        $view->headScript()->appendFile('/js/layout/nav.js');
        $view->headLink()->appendStylesheet('/css/master.css');

        $navigation = new \Zend_Navigation(
            new \Zend_Config_Xml(
                APPLICATION_PATH . '/configs/navigation.xml', 'nav'
            )
        );

        $view->navigation($navigation);
        $view->navigation()->menu()->setPartial(array('layout/navigation/_menu.phtml', 'default'));

        $user = new \Website\User();
        if ($user->isLoggedIn()) {
            $view->user = $user->getCurrentUser();
        } else {
            $view->loginForm = new \Website\Form\Login();
        }
    }
}
