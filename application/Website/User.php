<?php
/**
 * Contains User. 
 */

/**
 * Define the namespace. 
 */
namespace Website;

/**
 * Contains CRUD methods related users.
 */
class User
{
    /**#@+
     * User session configuration.
     */
    const SESSION_NAMESPACE = 'user';
    const SESSION_EXPIRATION = 7200;
    /**#@-*/

    /**#@+
     * Boundry definitions.
     */
    const EMAIL_MAX_CHARS = 50;
    const PASSWORD_MAX_CHARS = 32;
    const PASSWORD_MIN_CHARS = 5;
    /**#@-*/

    /**
     * Creates a new user.
     * 
     * @param string $email The new user email. 
     * @param string $password The new user password.
     * @throws Website_Exception Failed to create new user.
     */
    public function create($email, $password)
    {
        $emailValidator = new \Zend_Validate_EmailAddress();
        if (!$emailValidator->isValid($email)) {
            throw new \Website\Exception('Invalid email address.');
        }

        if (strlen($email) > self::EMAIL_MAX_CHARS) {
            throw new \Website\Exception(
                'Email address cannot exceed more than ' . self::EMAIL_MAX_CHARS . ' characters.'
            );
        }

        if (!is_string($password)) {
            throw new \Website\Exception('Invalid password');
        }

        if (strlen($password) < self::PASSWORD_MIN_CHARS
            || strlen($password) > self::PASSWORD_MAX_CHARS
            || preg_match('/\d/', $password) != 1
        ) {
            throw new \Website\Exception(
                'Password must contain at least one number and be between ' .
                self::PASSWORD_MIN_CHARS . ' and ' . self::PASSWORD_MAX_CHARS . ' characters.'
            );
        }
        
        $userModel = \Zend_Registry::getInstance()->entityManager
            ->getRepository('\Model\User')->findOneBy(array('email' => $email));
        
        if (!is_null($userModel)) {
            throw new \Website\Exception('A user is already registered with this email.');
        }

        $passwordTool = new \Website\Password();

        $userModel = new \Model\User();
        $userModel->email = $email;
        $userModel->password = $passwordTool->encrypt($password);
        $userModel->role = \Website\Acl::ROLE_MEMBER; 
        $userModel->created = new \DateTime();
        \Zend_Registry::getInstance()->entityManager->persist($userModel);
        \Zend_Registry::getInstance()->entityManager->flush();
    }

    /**
     * Sets the current user session.
     * 
     * @param string $email The user email to base the session on.
     * @param string $password The password to base the session on.
     * @return bool True if the user was set. False otherwise.
     * @throws Website_Paramter_Exception Invalid method parameter.
     */
    public function setCurrentUser($email, $password)
    {
        if (!is_string($email)) {
            throw new \Website\Parameter\Exception('Invalid $email parameter. Expected a string.');
        }

        if (!is_string($password)) {
            throw new \Website\Parameter\Exception('Invalid $password parameter. Expected a string.');
        }

        $userModel = \Zend_Registry::getInstance()->entityManager
            ->getRepository('\Model\User')->findOneBy(array( 'email' => $email));
        if (is_null($userModel)) {
            return false;
        }

        $passwordTool = new \Website\Password();
        if ($passwordTool->isEqual($password, $userModel->password) == false) {
            return false;
        }

        $session = new \Zend_Session_Namespace(self::SESSION_NAMESPACE);
        $session->email = $userModel->email;
        $session->setExpirationSeconds(self::SESSION_EXPIRATION);
        return true;
    }

    /**
     * Clears the current user session.
     */
    public function unsetCurrentUser()
    {
        $session = new \Zend_Session_Namespace(self::SESSION_NAMESPACE);
        $session->unsetAll();
    }

    /**
     * Gets the current user session.
     * 
     * @return Zend_Session_Namespace The current user sesssion.
     */
    public function getCurrentUser()
    {
        return new \Zend_Session_Namespace(self::SESSION_NAMESPACE);
    }
}
