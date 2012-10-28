<?php
/**
 * Contains Admin_Home_Event_Controller 
 *
 * @package Controllers
 */

/**
 * The admin home event controller.
 * 
 * @package Controllers
 */
class Admin_Home_EventController extends Zend_Controller_Action
{
    /**
     * The event index action.
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        $this->view->headScript()->appendFile('/js/jquery_addons/datetime_picker.js');
        $this->view->headScript()->appendFile('/js/admin/home/event.js');
        $this->view->getHelper('headLink')->appendStylesheet('/css/admin/home/event.css');
        $this->view->getHelper('headLink')->appendStylesheet('/css/index/index/event.css');
        
        $this->view->expired = $request->getQuery('expired');
        $this->view->formValues = array('eventDate' => '', 'eventText' => '');
        $this->view->events = array();
        
        $event = new \Service\Event();
        if ($this->view->expired == 1) {
            $events = $event->getInActiveEvents()->get();
        } else {
            $events = $event->getActiveEvents()->get();
        }

        if (count($events['message']) > 0) {
            $this->view->events = $events['message'];
        }
    }

    /**
     * The event create action.
     */
    public function createAction()
    {
        $request = $this->getRequest();
        $this->view->formValues = array(
            'eventDate' => $request->getPost('eventDate'),
            'eventText' => $request->getPost('eventText')
        );

        if ($request->isPost()) {
            $event = new \Service\Event();
            $response = $event->create(
                strtotime($request->getPost('eventDate')),
                $request->getPost('eventText')
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
     * The event delete action.
     */
    public function deleteAction()
    {
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
    }
}
