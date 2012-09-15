<?php
/**
 * Contains Service_User 
 */

/**
 * Deinfe the object namespace.
 */
namespace Service;

/**
 * Service for user specific requests. 
 */
class User
{
    /**
     * Logs a user in.
     * 
     * @param string $username The user name.
     * @param string $password The raw user password.
     * @return Service_Response The log in result.
     */
    public function logIn($username, $password)
    {
        $response = new Response(); 

        if (!is_string($username) || empty($username)) {
            return $response->setMessage('Invalid username. Expected a non-empty string.')
                ->setResult(false);
        }

        if (!is_string($password) || empty($password)) {
            return $response->setMessage('Invalid password. Expected a non-empty string.')
                ->setResult(false);
        }

        $userModel = \Zend_Registry::getInstance()->entityManager
            ->getRepository('\Model\User')->findOneBy(
                array(
                    'username' => $username,
                    'password' => $password
                )
            );
        
        if (is_null($userModel)) {
            return $response->setMessage('Invalid log in.')
                ->setResult(false); 
        }

        $session = new \Zend_Session_Namespace('user');
        $session->username = $userModel->username;

        return $response->setResult(true);
    }
}
