<?php
/**
 * Contains RssController 
 *
 * @package Controllers
 */

/**
 * The rss feed controller.
 * 
 * @package Controllers
 */
class RssController extends Zend_Controller_Action
{
    /**
     * Set up the controller before any actions are called.
     */
    public function init()
    {
        header('Content-type: text/xml');
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
    }

    /**
     * The events rss feed action.  
     */
    public function eventsAction()
    {
        $feed = array(
            'title' => 'Upcoming St. John Events',
            'description' => '',
            'link' => 'http://www.stjohncalgary.com',
            'charset' => 'utf8',
            'entries' => array()
        );

        $eventService = new \Service\Event();
        $events = $eventService->getActiveEvents()->get();
        foreach ($events['message'] as $event) {
            $feed['entries'][] = array(
                'title' => $event->event . ' - ' . $event->date->format('M. d, Y g:ia'),
                'description' => '',
                'link' => 'http://www.stjohncalgary.com'
            );
        }

        echo Zend_Feed::importArray($feed, 'rss')->send();
    }
    
    /**
     * The news feed action. 
     */
    public function newsAction()
    {
        $feed = array(
            'title' => 'St. John News',
            'description' => '',
            'link' => 'http://www.stjohncalgary.com',
            'charset' => 'utf8',
            'entries' => array()
        );

        $newsService = new \Service\News();
        $news = $newsService->getActiveNews()->get();
        foreach ($news['message'] as $article) {
            $feed['entries'][] = array(
                'title' => $article->title . ' - ' . $article->created->format('M. d, Y g:ia'),
                'description' => $article->body,
                'link' => 'http://www.stjohncalgary.com'
            );
        }
        
        echo Zend_Feed::importArray($feed, 'rss')->send();
    }
}
