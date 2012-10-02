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
class Admin_IndexController extends Zend_Controller_Action
{
    /**
     * The index action.
     */
    public function indexAction() {
    
        $path = APPLICATION_PATH.'/configs/navigation.xml';
        $xml = file_get_contents($path);
        $xml = new SimpleXmlElement($xml);
        //get all the file names
        $label = $xml->xpath('//file');
        
        $files = array();
        $file = array();
        //grab the file names from the strings
        foreach($label as $value){
            $strArray = explode(' - ', $value);
            foreach($strArray as $val){
                if(strstr($val, '.phtml'))
                $file[] = $val;
             }
        }
        //make on array with the files and labels/files
        for($i=0; $i<count($file); $i++){
            $files[$file[$i]] = $label[$i];
        }
             
        $this->view->getHelper('headScript')->appendFile('/js/admin/index.js');
        $this->view->getHelper('headLink')->appendStylesheet('/css/admin.css');

        $this->view->menuItems = $files;

    }
}
