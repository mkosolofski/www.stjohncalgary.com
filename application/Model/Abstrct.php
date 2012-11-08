<?php
/**
 * Contains Abstract.
 */

/**
 * Define the namespace. 
 */
namespace Model;

/**
 * Abstract that all models extend.
 */
abstract class Abstrct
{
    /**
     * Getter for model fields.
     * 
     * @param string $field The name of the field to get the value of.
     * @return mixed The field value.
     */
    public function __get($field)
    {
        return $this->$field;
    }

    /**
     * Setter for model fields.
     * 
     * @param string $field The field name
     * @param mixed $value The field value
     */
    public function __set($field, $value)
    {
        if (in_array($field, $this->_setableFields)) {
            $this->$field = $value;
        }
    }

    /**
     * Returns a numerically index array of setable field names for the model.
     * 
     * @return array The setable field names.
     */
    public function getSetableFields()
    {
        return $this->_setableFields;
    }

    /**
     * Fields that can be set in the model. 
     * 
     * @var array
     */
    protected $_setableFields = array();
}
