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
    
        $files = array(
            'Acadia Place' => 'ministries/missions/acadia-place.phtml',
            'Baptism' => 'services/baptism.phtml',
            'CLWR' => 'ministries/missions/clwr.phtml',
            'Confirmation and Education' => 'ministries/education/confirmation-and-educational-links.phtml',
            'Contact Us' => 'about-us/contact-us.phtml',
            'Funeral' => 'services/funeral.phtml',
            'Giving' => 'giving/index.phtml',
            'History' => 'about-us/history.phtml',
            'Huff and Puff' => 'ministries/education/huff-and-puff.phtml',
            'Pastor\'s Page' => 'about-us/pastors-page.phtml',
            'Under 100 Club' => 'ministries/education/under-100-club.phtml',
            'Wedding' => 'services/wedding.phtml',
            'Welcome' => 'index/index/_welcome.phtml',
            'Women's Group' => 'ministries/education/womens-group.phtml',
            'Worship Time' => 'index/index/_worshiptime.phtml'
        );
                       
        
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
