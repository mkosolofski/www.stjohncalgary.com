<?php
/**
 * Contains Bootstrap
 *
 * @package Application
 */

/**
 * The admin module bootstrap object.
 * 
 * @package Application
 */
class Admin_Bootstrap extends Zend_Application_Module_Bootstrap
{
    /**
     * Bootstrap all plugins.
     */
    protected function _initPlugins()
    {
        Zend_Controller_Front::getInstance()
            ->registerPlugin(new Admin\Plugin\Access());
    }
}
