<?php
/**
 * Contains Acl. 
 */

/**
 *  Define the namespace.
 */
namespace Website;

/**
 * The site acl.
 * The site is so small that there is no need to use a db
 * for role\resource mapping.
 */
class Acl
{
    /**#@+
     * The site acl roles.
     */
    const ROLE_GUEST = 0;
    const ROLE_MEMBER = 1;
    const ROLE_ADMIN = 2;
    /**#@-*/

    /**#@+
     * The site acl resources.
     */
    const RESOURCE_ADMIN_MODULE = 'adminModule';
    /**#@-*/

    protected $_configuration = array(
        self::ROLE_GUEST => array(
            ':register:index'
        ),
        self::ROLE_MEMBER => array(
            ':register:welcome'
        ),
        self::ROLE_ADMIN => array(
            'admin:*:*'
        )
    );

    /**
     * Builds and returns the site acl based on the current user.
     * 
     * @return Zend_Acl The site acl.
     */
    public function getAcl()
    {
        $acl = new \Zend_Acl();

        // Build the acl.
        foreach ($this->_configuration as $role => $roleConfig) {
            $acl->addRole(new \Zend_Acl_Role($role));
            foreach ($roleConfig as $resource) {
                $acl->addResource(new \Zend_Acl_Resource($resource));
                $acl->allow($role, $resource);
            }
        }

        // Place the user in the acl.
        $user = new \Website\User();
        $userEmail = $user->getCurrentUser()->email;
         
         if (!is_null($userEmail)) {
            $userModel = \Zend_Registry::getInstance()->entityManager
                ->getRepository('\Model\User')->findOneBy(array('email' => $userEmail));
            if (!is_null($userModel)) {
                $acl->addRole(new \Zend_Acl_Role($userModel->email), $userModel->role);
            }
        } else {
            $acl->addRole(new \Zend_Acl_Role(''), self::ROLE_GUEST);
        }

        return $acl;
    }
}
