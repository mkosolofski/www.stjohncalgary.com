<?php
/**
 * Contains IndexController 
 *
 * @package Controllers
 */

/**
 * The index controller.
 * 
 * @package Controllers
 */
class AboutUsController extends Zend_Controller_Action
{
    /**
     * The index action.
     */
    public function indexAction()
    {
    }
    
    public function historyAction()
    {
        $this->render('history');
    }
    
    public function pastorsPageAction()
    {
        $this->render('pastors-page');
    }
    
    public function contactUsAction()
    {
        $this->render('contact-us');
    }
}
