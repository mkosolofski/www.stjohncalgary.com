<?php
/**
 * Contains RegisterController 
 *
 * @package Controllers
 */

/**
 * The register controller.
 * 
 * @package Controllers
 */
class RegisterController extends Zend_Controller_Action
{
    /**
     * The index action.
     */
    public function indexAction()
    {
        $this->view->getHelper('headLink')->appendStylesheet('/css/register/index.css');
        $this->view->getHelper('headScript')->appendFile('/js/register/index.js');
        $this->view->form = new \Website\Form\Register();
    }

    /**
     * The welcome action.
     */
    public function welcomeAction() {}
}
