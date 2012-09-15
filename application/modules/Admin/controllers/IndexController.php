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
            $menuItems = $xml->xpath('//label');

        $this->view->menuItems = $menuItems;

    }
}
