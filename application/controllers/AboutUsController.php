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
    public function historyAction() {
        $this->view->getHelper('headLink')->appendStylesheet('/css/about-us/history.css');
    }
    
    /**
     * The pastor's page action. 
     */
    public function pastorsPageAction() {
        $this->view->getHelper('headLink')->appendStylesheet('/css/about-us/pastors-page.css');
    }
    
    /**
     * The contact us action. 
     */
    public function contactUsAction()
    {
        $this->view->getHelper('headLink')->appendStylesheet('/css/about-us/contact-us.css');
    }
}
