<?php
/**
 * Contains UserController 
 *
 * @package Controllers
 */

/**
 * The user controller.
 * 
 * @package Controllers
 */
class Admin_UserController extends Zend_Controller_Action
{
    /**
     * The admin log in action.
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $this->view->getHelper('headLink')->appendStylesheet('/css/admin/user/login.css');
        $this->view->hideNav = true;

        if (!$request->isPost()) {
            return;
        }

        $userService = new \Service\User();
        $response = $userService->logIn(
            $request->getPost('email'),
            $request->getPost('password')
        )
        ->get();

        if (!$response['result']) {
            $this->view->error = $response['message'];
            return;
        }

        $this->_redirect('/admin/index/index');
    }

    /**
     * The admin log out action
     */
    public function logoutAction()
    {
        $userService = new \Service\User();
        $userService->logout();
        
        $this->_redirect('/');
    }
}
