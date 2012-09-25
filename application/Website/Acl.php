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
    const ROLE_MEMBER = 1;
    const ROLE_ADMIN = 2;
    /**#@-*/

    /**#@+
     * The site acl resources.
     */
    const RESOURCE_ADMIN_MODULE = 'adminModule';
    /**#@-*/

    /**
     * Builds and returns the site acl based on the current user.
     * 
     * @return Zend_Acl The site acl.
     */
    public function getAcl()
    {
        $acl = new \Zend_Acl();
        $acl->addRole(new \Zend_Acl_Role(self::ROLE_MEMBER))
            ->addRole(new \Zend_Acl_Role(self::ROLE_ADMIN))
            ->addResource(new \Zend_Acl_Resource(self::RESOURCE_ADMIN_MODULE))
            ->allow(self::ROLE_ADMIN, self::RESOURCE_ADMIN_MODULE);

        // Set up the acl for the currently logged in user.
        $user = new \Website\User();
        $userEmail = $user->getCurrentUser()->email;
         
         if (!is_null($userEmail)) {
            $userModel = \Zend_Registry::getInstance()->entityManager
                ->getRepository('\Model\User')->findOneBy(array('email' => $userEmail));
            if (!is_null($userModel)) {
                $acl->addRole(new \Zend_Acl_Role($userModel->email), array($userModel->role));
            }
        }

        return $acl;
    }
}
