<?php
/**
 * Contains AjaxController 
 */

/**
 * Controller object for handling all ajax requests.
 */
class Admin_AjaxController extends Zend_Controller_Action
{
    /**
     * Initializes the controller by disabling the view renderer.
     */
    public function init()
    {
        Zend_Layout::getMvcInstance()->disableLayout();
    }

    /**
     * Action to handle ajax requests. Always returns js.
     */
    public function indexAction()
    {
        $checkMethod = 'ajaxable';
        $request = $this->getRequest();
        $sub = $request->getParam('sub');
        $script = $request->getParam('script');
        if (empty($sub) || empty($script)) {
            die('Invalid request admin 1');
        }

        $params = $request->getParam('params');
        if (!empty($params)) {
            $this->view->params = $params;
        }

        try {
            $this->_helper->viewRenderer->renderScript(
                'ajax/' . strtolower($sub) . '/' . strtolower($script) . '.phtml'
            );
        } catch (Zend_View_Exception $e) {
            die('Invalid request admin 2'.$e->getMessage());
        }
    }
}
