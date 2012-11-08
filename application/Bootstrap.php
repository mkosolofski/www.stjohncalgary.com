<?php
/**
 * Contains Bootstrap
 *
 * @package Application
 */

/**
 * The application bootstrap object.
 * 
 * @package Application
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Bootstrap application.ini into config.
     */
    protected function _initConfig()
    {
        Zend_Registry::getInstance()->config = $this->getOptions();
    }

    /**
     * Start the session for reads and writes.
     */
    protected function _initSession()
    {
        Zend_Session::setOptions(
            array(
                'use_only_cookies' => 'on',
                'remember_me_seconds' => 864000
            )
        );
    }

    /**
     * Bootstrap the "view" module and set the site layout doc type.
     */
    protected function _initDocType()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }

    /**
     * Bootstrap doctrine.
     */
    protected function _initDoctrine()
    {
        // Include and register Doctrine's class loader
        require_once('Doctrine/Common/ClassLoader.php');
        $classLoader = new \Doctrine\Common\ClassLoader(
            'Doctrine',
            APPLICATION_PATH . '/../library/'
        );
        $classLoader->register();

        // Create the Doctrine configuration
        $config = new \Doctrine\ORM\Configuration();

        // Setting the cache ( to ArrayCache. Take a look at
        // the Doctrine manual for different options ! )
        $cache = new \Doctrine\Common\Cache\ArrayCache;
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);

        // Choosing the driver for our database schema
        // we'll use annotations
        $driver = $config->newDefaultAnnotationDriver(APPLICATION_PATH . '/Model');
        $config->setMetadataDriverImpl($driver);

        // Set the proxy dir and set some options
        $config->setProxyDir(APPLICATION_PATH . '/Model/Proxies');
        $config->setAutoGenerateProxyClasses(true);
        $config->setProxyNamespace('App\Proxies');

        // Now create the entity manager and use the connection
        // settings we defined in our application.ini
        $connectionSettings = $this->getOption('doctrine');
        $conn = array(
            'driver' => $connectionSettings['conn']['driv'],
            'user' => $connectionSettings['conn']['user'],
            'password' => $connectionSettings['conn']['pass'],
            'dbname' => $connectionSettings['conn']['dbname'],
            'host' => $connectionSettings['conn']['host']
        );
        $entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);
        $entityManager->getEventManager()
            ->addEventListener(
                \Doctrine\ORM\Events::onFlush,
                new \Website\Doctrine\EventListener()
            );

        // Push the entity manager into our registry for later use
        Zend_Registry::getInstance()->entityManager = $entityManager;
    }

    /**
     * Bootstrap the acl for the current user.
     */
    protected function _initAcl()
    {
        $acl = new \Website\Acl(); 
        Zend_Registry::getInstance()->acl = $acl->getAcl();
    }

    /**
     * Bootstrap all plugins.
     */
    protected function _initPlugins()
    {
        Zend_Controller_Front::getInstance()
            ->registerPlugin(new \Plugin\Client())
            ->registerPlugin(new \Plugin\Access());
    }
}
