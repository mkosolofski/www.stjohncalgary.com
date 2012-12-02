<?php
/**
 * Contains GivingController 
 *
 * @package Controllers
 */

/**
 * The giving controller.
 * 
 * @package Controllers
 */
class GivingController extends Zend_Controller_Action
{
    /**
     * The index page action.
     */
    public function indexAction()
    {
        $this->view->getHelper('headLink')->appendStylesheet('/css/giving/index.css');
    }
}
