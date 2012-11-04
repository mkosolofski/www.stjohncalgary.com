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
class Admin_FileController extends Zend_Controller_Action
{
    /**
     * The index action.
     */
    public function indexAction() {
        $files = array();
        
        //find image files
        if ($handle = opendir(APPLICATION_PATH.'/../public/images/admin/')) {

        while (false !== ($entry = readdir($handle))) {
                $files[] = $entry;
        }
        closedir($handle);
        }
        
        $imageFiles = array();
        //filter out non image files
        foreach($files as $value){
            if(strstr($value, '.gif') || strstr($value, '.jpg') || strstr($value, '.png'))
                $imageFiles[] = $value;
        }
        
        $this->view->getHelper('headScript')->appendFile('/js/admin/file/index.js');
        $this->view->images = $imageFiles;
    }
    
    public function uploadAction() {
        Zend_Layout::getMvcInstance()->disableLayout();
        $this->render('upload');
    }
    
}
