<?php
/**
 * Contains the Access object. 
 */

namespace Plugin;

/**
 * Plugin for access control.
 */
class Access extends \Zend_Controller_Plugin_Abstract
{
    /**
     * Called before the controller is dispatched.
     *
     * @param  Zend_Controller_Request_Abstract $request
     */
    public function preDispatch(\Zend_Controller_Request_Abstract $request)
    {
        $acl = \Zend_Registry::getInstance()->acl;
        $module = strtolower($request->getModuleName());
        $controller = strtolower($request->getControllerName());
        $action = strtolower($request->getActionName());
        
        $user = new \Website\User();
        $userEmail = $user->getCurrentUser()->email;
        
        if ($module == 'default') {
            $resources = array(
                ':' . $controller . ':*',
                ':' . $controller . ':' . $action,
            );
        } else {
            $resources = array(
                $module .':*:*',
                $module .':' . $controller . ':*',
                $module .':' . $controller . ':' . $action
            );
        }

        $failedCondition = false;
        foreach ($resources as $resource) {
            if ($acl->has($resource)) {
                if ($acl->isAllowed((string)$userEmail, $resource)) {
                    return;
                }
                $failedCondition = true;
            }
        }

        if ($failedCondition) {
            \Zend_Controller_Action_HelperBroker::getStaticHelper('redirector')->gotourl('/');
            return;
        }

        return;
    }
}
