<?php
/**
 * Contains AdminController 
 *
 * @package Controllers
 */

/**
 * The admin controller.
 * 
 * @package Controllers
 */
class AdminController extends Zend_Controller_Action
{
    /**
     * The admin action.
     */
    	
	public function init(){
		$this->_helper->layout->setLayout('admin');
	}
	
	public function indexAction() {
	
	$path = APPLICATION_PATH.'/configs/navigation.xml';
        $xml = file_get_contents($path);
        $xml = new SimpleXmlElement($xml);
        $menuItems = $xml->xpath('//label');

	$this->view->menuItems = $menuItems;
	}

}
