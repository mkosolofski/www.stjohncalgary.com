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

    /**
     * The manage user action.
     */
    public function manageAction()
    {
        $this->view->getHelper('headLink')->appendStylesheet('/css/admin/user/manage.css');
        $userService = new \Service\User();
        $this->view->users = $userService->getAll()->get();
        $this->view->users = $this->view->users['message'];
    }

    /**
     * The admin create action.
     */
    public function createAction()
    {
        $request = $this->getRequest();
        $userService = new \Service\User();
        $response = $userService->register(
            $request->getPost('email'),
            $request->getPost('password')
        )
        ->get();
        
        \Zend_Registry::getInstance()->entityManager->flush();
        
        if (!$response['result']) {
            $this->view->formValues = array(
                'email' => $request->getPost('email'),
                'password' => $request->getPost('password')
            );
            $this->view->createError = $response['message'];
        }

        $this->manageAction();
        $this->render('manage');
    }

    /**
     * The account deactivate action.
     */
    public function deactivateAction()
    {
        $request = $this->getRequest();
        $userService = new \Service\User();
        $response = $userService->deactivate($request->get('id'))->get();
        
        if (!$response['result']) {
            $this->view->currentError = $response['message'];
        } else {
            \Zend_Registry::getInstance()->entityManager->flush();
        }

        $this->manageAction();
        $this->render('manage');
    }
    
    /**
     * The account reactivate action.
     */
    public function reactivateAction()
    {
        $request = $this->getRequest();
        $userService = new \Service\User();
        $response = $userService->reactivate($request->get('id'))->get();
        
        if (!$response['result']) {
            $this->view->currentError = $response['message'];
        } else {
            \Zend_Registry::getInstance()->entityManager->flush();
        }

        $this->manageAction();
        $this->render('manage');
    }

    /**
     * The reset password action.
     */
    public function resetPasswordAction()
    {
        $userId = $this->getRequest()->get('id');

        $user = new \Service\User();
        $response = $user->resetPassword($userId)->get();
        
        if (!$response['result']) {
            $this->view->currentError = $response['message'];
        } else {
            $this->view->currentMessage = array($userId => 'New password sent');
        }
 
        $this->manageAction();
        $this->render('manage');
    }
}
