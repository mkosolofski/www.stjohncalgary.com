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
    public function huffAndPuffAction()
    {
        $this->view->getHelper('headLink')->appendStylesheet('/css/ministries/education/huff-and-puff.css');
        $this->view->getHelper('headScript')->appendFile('/js/slideshow.js');
        $this->view->getHelper('headScript')->appendFile('/js/ministries/education/huff-and-puff.js');
    }
    
    /**
     * The under 100 club page action.
     */
    public function under100ClubAction() {}

    /**
     * The womens group page action.
     */
    public function womensGroupAction() {}
    
    /**
     * The confirmation and educational links page action.
     */
    public function confirmationAndEducationalLinksAction() {}
}
