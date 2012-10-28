<?php
/**
 * Contains Admin_Home_News_Controller 
 *
 * @package Controllers
 */

/**
 * The admin home news controller.
 * 
 * @package Controllers
 */
class Admin_Home_NewsController extends Zend_Controller_Action
{
    /**
     * The event index action.
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        $this->view->getHelper('headLink')->appendStylesheet('/css/admin/home/news.css');
        
        $this->view->formValues = array('newsTitle' => '', 'newsBody' => '');
    /*
        $this->view->headScript()->appendFile('/js/admin/home/event.js');
        $this->view->getHelper('headLink')->appendStylesheet('/css/admin/home/event.css');
        $this->view->getHelper('headLink')->appendStylesheet('/css/index/index/event.css');
        
        $this->view->inactive = $request->getQuery('inactive');
        $this->view->formValues = array('eventDate' => '', 'eventText' => '');
        $this->view->events = array();
        
        $event = new \Service\Event();
        if ($this->view->inactive == 1) {
            $events = $event->getInActiveEvents()->get();
        } else {
            $events = $event->getActiveEvents()->get();
        }

        if (count($events['message']) > 0) {
            $this->view->events = $events['message'];
        }
        */
    }

    /**
     * The news create action.
     */
    public function createAction()
    {
        $request = $this->getRequest();
        $this->view->formValues = array(
            'newsTitle' => $request->getPost('newsTitle'),
            'newsBody' => $request->getPost('newsBody')
        );

        if ($request->isPost()) {
            $news = new \Service\News();
            $response = $news->create(
                $request->getPost('newsTitle'),
                $request->getPost('newsBody')
            )->get();
            
            if ($response['result'] == false) {
                $this->view->error = $response['message'];
            } else {
                \Zend_Registry::getInstance()->entityManager->flush();
            }
        }
        
        $this->indexAction();
        $this->render('index');
    }
    
    /**
     * The news delete action.
     */
    public function deleteAction()
    {

    }

    /**
     * The news archive action.
     */
    public function archiveAction()
    {
    /*
        $request = $this->getRequest();
        $eventId = $request->getQuery('id');
        if (filter_var($eventId, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))) === false) {
            $this->_redirect('/admin/index/index');
            return;
        }
        
        $event = new \Service\Event();
        $response = $event->delete($eventId)->get();
        
        if ($response['result'] == true) {
            \Zend_Registry::getInstance()->entityManager->flush();
        }

        $this->indexAction();
        $this->render('index');
        */
    }
}
