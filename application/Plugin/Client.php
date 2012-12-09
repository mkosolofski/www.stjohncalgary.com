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
        $view->headScript()->appendFile('/js/layout/display.js');

        // @todo IE6 displays conditional tags. Look into this further.
        //$view->headScript()->appendFile('/js/ie_png_fix.js', 'text/javascript', array('conditional' => 'lt IE7'));
        //$view->headScript()->appendFile('/js/ie_html5_fix.js', 'text/javascript', array('conditional' => 'lt IE9'));
        //$view->headLink()->appendStylesheet('/css/master_ie6.css', 'screen', 'lt IE7');

        $view->headLink()->appendStylesheet('/css/master.css');

        $view->headTitle($request->getControllerName() . '/' . $request->getActionName());

        $navigation = new \Zend_Navigation(
            new \Zend_Config_Xml(
                APPLICATION_PATH . '/configs/navigation.xml', 'nav'
            )
        );

        $view->navigation($navigation);
        $view->navigation()->menu()->setPartial(array('layout/navigation/_menu.phtml', 'default'));

        if ($request->getControllerName() == 'index') {
            $view->headLink()->appendStylesheet('/css/layout/home.css');
        }
    }
}
