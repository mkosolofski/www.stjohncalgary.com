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
        
        $this->view->headScript()->appendFile('/js/admin/home/news.js');
        $this->view->getHelper('headLink')->appendStylesheet('/css/admin/home/news.css');
        $this->view->getHelper('headLink')->appendStylesheet('/css/index/index/news.css');
        $this->view->archived = $request->getQuery('archived');
        $this->view->news = array();
        
        $news = new \Service\News();
        if ($this->view->archived == 1) {
            $news = $news->getArchivedNews()->get();
        } else {
            $news = $news->getActiveNews()->get();
        }
        
        if (count($news['message']) > 0) {
            $this->view->news = $news['message'];
        }
    }

    /**
     * The news create action.
     */
    public function createAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $news = new \Service\News();
            $response = $news->create(
                $request->getPost('newsTitle'),
                $request->getPost('newsBody')
            )->get();
            
            if ($response['result'] == false) {
                $this->view->formValues = array(
                    'newsTitle' => $request->getPost('newsTitle'),
                    'newsBody' => $request->getPost('newsBody')
                );
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
        $request = $this->getRequest();
        $newsId = $request->getQuery('id');
        if (filter_var($newsId, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))) === false) {
            $this->_redirect('/admin/index/index');
            return;
        }
        
        $news = new \Service\News();
        $response = $news->delete($newsId)->get();
        
        if ($response['result'] == true) {
            \Zend_Registry::getInstance()->entityManager->flush();
        }

        $this->indexAction();
        $this->render('index');
    }
}
