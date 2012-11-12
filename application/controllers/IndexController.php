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
     * The index page action.
     */
    public function indexAction()
    {
        $this->view->getHelper('headLink')->appendStylesheet('/css/index/index.css');
        $this->view->getHelper('headLink')->appendStylesheet('/css/index/index/event.css');
        $this->view->getHelper('headLink')->appendStylesheet('/css/index/index/news.css');
        $this->view->getHelper('headScript')->appendFile('/js/slideshow.js');
        $this->view->getHelper('headScript')->appendFile('/js/index/index.js');
        
        $event = new \Service\Event();
        $events = $event->getActiveEvents()->get();
        $this->view->events = $events['message'];
        
        $event = new \Service\News();
        $events = $event->getActiveNews()->get();
        $this->view->news = $events['message'];
    }
}
