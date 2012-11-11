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
class Ministries_MissionsController extends Zend_Controller_Action
{
    /**
     * The index action.
     */
    public function indexAction()
    {
    }
    
    public function acadiaPlaceAction()
    {
        $this->render('acadia-place');
    }
    
    public function clwrAction()
    {
        $this->render('clwr');
    }

}
