<?php
/**
 * Contains AboutUsController 
 *
 * @package Controllers
 */

/**
 * The about us controller.
 * 
 * @package Controllers
 */
class AboutUsController extends Zend_Controller_Action
{
    /**
     * The history page action.  
     */
    public function historyAction() {}
    
    /**
     * The pastor's page action. 
     */
    public function pastorsPageAction() {}

    /**
     * The contact us action. 
     */
    public function contactUsAction()
    {
        $this->view->getHelper('headLink')->appendStylesheet('/css/about-us/contact-us.css');
    }
}
