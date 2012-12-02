<?php
/**
 * Contains Ministries_EducationController 
 *
 * @package Controllers
 */

/**
 * The ministries education controller.
 * 
 * @package Controllers
 */
class Ministries_EducationController extends Zend_Controller_Action
{
    /**
     * The huff and puff page action.
     */
    public function huffAndPuffAction() {
        
        $this->view->getHelper('headLink')->appendStylesheet('/css/minitries/education/huff-and-puff.css');
        $this->view->getHelper('headScript')->appendFile('/js/slideshow.js');
        $this->view->getHelper('headScript')->appendFile('/js/ministries/education/huff-and-puff/index.js');
        
    }
    
    /**
     * The under 100 club page action.
     */
    public function under100ClubAction() {}

    /**
     * The woman bible study page action.
     */
    public function womanBibleStudyAction() {}
    
    /**
     * The confirmation and educational links page action.
     */
    public function confirmationAndEducationalLinksAction() {}
}
