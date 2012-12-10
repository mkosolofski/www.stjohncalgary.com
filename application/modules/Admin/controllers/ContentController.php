<?php
/**
 * Contains Admin_ContentController 
 *
 * @package Controllers
 */

/**
 * The admin content controller.
 * 
 * @package Controllers
 */
class Admin_ContentController extends Zend_Controller_Action
{
    /**
     * The index action.
     */
    public function indexAction()
    {
        $this->view->getHelper('headScript')->appendFile('/js/admin/content/index.js');
        $this->view->getHelper('headLink')->appendStylesheet('/css/admin/content/index.css');

        $content = new \Admin\Website\Content();
        $this->view->menuItems = $content->getFiles();
        
        $backup = new \Admin\Website\Content\Backup();
        $this->view->revertFiles = $backup->getFiles();
    }
}
