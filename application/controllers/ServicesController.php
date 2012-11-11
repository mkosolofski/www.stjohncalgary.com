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
class ServicesController extends Zend_Controller_Action
{
    /**
     * The index action.
     */
    public function indexAction()
    {
    }
    
    public function baptismAction()
    {
        $this->render('baptism');
    }
    
    public function weddingAction()
    {
        $this->render('wedding');
    }
    
    public function funeralAction()
    {
        $this->render('funeral');
    }
}
