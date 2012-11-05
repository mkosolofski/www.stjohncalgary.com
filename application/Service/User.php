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

    /**
     * Returns all users.
     *
     * @return Service_Response All users.
     */
    public function getAll()
    {
        $response = new Response(); 
        return $response->setMessage(
            \Zend_Registry::getInstance()->entityManager
                ->createQueryBuilder()
                ->select('u.id,u.email,u.status')
                ->from('\Model\User', 'u')
                ->orderBy('u.status', 'ASC')
                ->addOrderBy('u.email', 'ASC')
                ->getQuery()
                ->execute()
        )->setResult(true);
    }

    /**
     * Deactivates a user account.
     *
     * @param int $id The id of the user account to deactivate.
     * @return Service_Response If deactivation was successfull.
     */
    public function deactivate($id)
    {
        $response = new Response();

        if (filter_var($id, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))) === false) {
            return $response->setMessage('Invalid user id.')->setResult(false);
        }

        $entityManager = \Zend_Registry::getInstance()->entityManager;
        
        $userModel = $entityManager->getRepository('\Model\User')->find($id);
        if (is_null($userModel)) {
            return $response->setMessage('User not found')->setResult(false);
        }

        $userModel->status = \Website\User::STATUS_INACTIVE;
        $entityManager->persist($userModel);

        return $response->setResult(true);
    }

    /**
     * Reactivates a user account.
     *
     * @param int $id The id of the user account to reactivate.
     * @return Service_Response If reactivation was successfull.
     */
    public function reactivate($id)
    {
        $response = new Response();

        if (filter_var($id, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))) === false) {
            return $response->setMessage('Invalid user id.')->setResult(false);
        }

        $entityManager = \Zend_Registry::getInstance()->entityManager;
        
        $userModel = $entityManager->getRepository('\Model\User')->find($id);
        if (is_null($userModel)) {
            return $response->setMessage('User not found')->setResult(false);
        }

        $userModel->status = \Website\User::STATUS_ACTIVE;
        $entityManager->persist($userModel);

        return $response->setResult(true);
    }

    /**
     * Resets a user accounts password with a random password. The account is sent an email
     * with the new password.
     * 
     * @param int $id The id of the user account to reactivate.
     * @return Service_Response If password reset was successfull.
     */
    public function resetPassword($id)
    {
        $response = new Response();

        if (filter_var($id, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))) === false) {
            return $response->setMessage('Invalid user id.')->setResult(false);
        }

        $entityManager = \Zend_Registry::getInstance()->entityManager;
        
        $userModel = $entityManager->getRepository('\Model\User')->find($id);
        if (is_null($userModel)) {
            return $response->setMessage('User not found')->setResult(false);
        }

        $passwordObj = new \Website\Password();
        $newPassword = $passwordObj->generate();

        $userModel->password = $newPassword;
        $entityManager->persist($userModel);

        $mailer = new \Zend_Mail();
        $mailer->addTo($userModel->email)
            ->setFrom('donotreply@stjohncalgary.com')
            ->setSubject('Your New Password')
            ->setBodyText($newPassword);

        try {
            $mailer->send();
        } catch (Zend_Mail_Transport_Exception $e) {
            return $response->setMessage('Failed to send new password to ' . $userModel->email)
                ->setResult(false);
        }

        return $response->setResult(true);
    }
}
