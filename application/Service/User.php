<?php
/**
 * Contains Service_User.
 */

/**
 * Define the object namespace.
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
     * @param string $email The user email.
     * @param string $password The raw user password.
     * @return Service_Response The log in result.
     */
    public function logIn($email, $password)
    {
        $response = new Response(); 
        $messages = array();
        $emailValidator = new \Zend_Validate_EmailAddress();

        if (!is_string($email) || empty($email)) {
            $messages[] = 'Invalid email address.';
        } else if (!$emailValidator->isValid($email)) {
            $messages[] = 'Invalid email address.';
        }

        if (!is_string($password) || empty($password)) {
            $messages[] = 'Invalid password.';
        }

        if (!empty($messages)) {
            return $response->setMessage(implode(' ', $messages))->setResult(false); 
        }

        $user = new \Website\User();
        if ($user->setCurrentUser($email, $password) == false) {
            return $response->setMessage('Given email/password combo not found.')->setResult(false); 
        }

        return $response->setResult(true);
    }

    /**
     * Logs the current user out.
     * 
     * @return void
     * @throws Istock_ _Exception
     */
    public function logOut()
    {
        $user = new \Website\User();
        $user->unsetCurrentUser();
        
        $response = new Response(); 
        return $response->setResult(true);
    }

    /**
     * Registers a new user.
     * 
     * @param string $email The user email.
     * @param string $password The raw user password.
     * @return Service_Response The registration result.
     */
    public function register($email, $password)
    {
        $response = new Response(); 
        $user = new \Website\User();

        try { 
            $user->create($email, $password);
        } catch (\Website\Exception $e) {
            return $response->setMessage($e->getMessage())->setResult(false);
        }

        return $response->setResult(true);
    }
}
