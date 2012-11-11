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
class Ministries_EducationController extends Zend_Controller_Action
{
    /**
     * The index action.
     */
    public function indexAction()
    {
    }
    
    public function huffAndPuffAction()
    {
        $this->render('huff-and-puff');
    }
    
    public function under100ClubAction()
    {
        $this->render('under-100-club');
    }

    public function womanBibleStudyAction()
    {
        $this->render('woman-bible-study');
    }
    
    public function confirmationAction()
    {
        $this->render('confirmation');
    }
}
