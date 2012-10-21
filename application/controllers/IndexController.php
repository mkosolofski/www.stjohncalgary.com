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
class IndexController extends Zend_Controller_Action
{
    /**
     * The index action.
     */
    public function indexAction()
    {
        $this->view->getHelper('headLink')->appendStylesheet('/css/index/index.css');
        $this->view->getHelper('headScript')->appendFile('/js/slideshow.js');
        $this->view->getHelper('headScript')->appendFile('/js/index/index.js');
    }
}
