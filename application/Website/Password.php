<?php
/**
 * Contains Password. 
 */

/**
 * Define the namespace. 
 */
namespace Website;

/**
 * Contains methods for dealing with passwords. 
 */
class Password
{
    /**
     * Encrypts the given password.
     * 
     * @param string $password The password to encrypt.
     * @return string The encrypted password.
     */
    public function encrypt($password)
    {
        return $this->_encrypt($password, substr(md5(time()), 10, 4));
    }

    /**
     * Compares the given password with the encrypted password.
     * 
     * @param string $password The unencrypted state of the password.
     * @param string $encryptedPassword The encrypted state of the password.
     * @return bool True if passwords are equal, false otherwise.
     */
    public function isEqual($password, $encryptedPassword)
    {
        return ($encryptedPassword == $this->_encrypt($password, substr($encryptedPassword, 28, 4)));
    }

    /**
     * Encrypts the password with the given salt.
     * 
     * @param string $password The password to encrypt.
     * @param string $salt The salt to encrypt the password with.
     * @return string The encrypted password.
     */
    protected function _encrypt($password, $salt)
    {
        return substr(md5($salt . $password), 0, 28) . $salt;
    }
}
