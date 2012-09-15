<?php
/**
 * Contains Response
 *
 * @package services
 */

namespace Service;

/**
 * Response object for service object calls.
 *
 * @package service
 */
class Response
{
    /**
     * Sets the response message.
     * 
     * @param mixed $message The message to set.
     * @return Service_Response The current object.
     */
    public function setMessage($message)
    {
        $this->_message = $message;
        return $this;
    }

    /**
     * Sets the response result.
     * 
     * @param bool $result The result.
     * @throws Service_Exception Invalid method parameter.
     * @return Service_Response The current object.
     */
    public function setResult($result)
    {
        if (!is_bool($result)) {
            throw new Exception('Invalid $result param. Expected a boolean value.');
        }

        $this->_result = $result;
        return $this;
    }

    /**
     * Returns the response condition.
     * Example return:
     * <pre>
     *     array(
     *         'message' => mixed,
     *         'result' => bool
     *     )
     * </pre>
     *
     * @return array The response condition.
     */
    public function get()
    {
        return array(
            'message' => $this->_message,
            'result' => $this->_result
        );
    }

    /**
     * The response result.
     * 
     * @var bool
     */
    protected $_result = false;

    /**
     * The response message.
     * 
     * @var mixed
     */
    protected $_message = null;

}
