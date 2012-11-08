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
        return $this->_encrypt($password, $this->_generateSalt());
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
        return ($encryptedPassword == $this->_encrypt($password, substr($encryptedPassword, 25, 7)));
    }

    /**
     * Generates a random password.
     * 
     * @return string The generated password.
     */
    public function generate()
    {
        return $this->encrypt(
            substr(md5(time() + mt_rand(1, 1000)), 10, 8),
            $this->_generateSalt()
        );
    }

    /**
     * Generates a random 7 character salt for the password.
     * 
     * @return string The salt.
     */
    protected function _generateSalt()
    {
        return substr(md5(time() + mt_rand(1000, 100000)), 10, 7);
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
        return substr(md5($salt . $password), 0, 25) . $salt;
    }
}
