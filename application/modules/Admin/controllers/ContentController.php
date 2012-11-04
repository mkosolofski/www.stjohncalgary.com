<?php
/**
 * Contains MiscController 
 *
 * @package Controllers
 */

/**
 * The misc controller.
 * 
 * @package Controllers
 */
class Admin_ContentController extends Zend_Controller_Action
{
    /**
     * The index action.
     */
    public function indexAction() {
    
        $files = array('Worship Time' => 'index/index/_worshiptime.phtml');
                       
        
        $rfiles = array();
        //find revert files
        if ($handle = opendir(APPLICATION_PATH.'/modules/Admin/views/scripts/content/index/revertfiles/')) {

        while (false !== ($entry = readdir($handle))) {
                $rfiles[] = $entry;
        }
        closedir($handle);
        }
        
        $revertFiles = array();
        //filter out non revert files
        foreach($rfiles as $value){
            if(strstr($value, '.phtml'))
                $revertFiles[] = $value;
        }

             
        $this->view->getHelper('headScript')->appendFile('/js/admin/content/index.js');
        $this->view->getHelper('headLink')->appendStylesheet('/css/admin/content/index.css');

        $this->view->menuItems = $files;
        $this->view->revertFiles = $revertFiles;

    }

}
