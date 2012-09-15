<?php
/**
 * Contains Model_User. 
 */

/**
 * Define namespace for object. 
 */
namespace Model;

/**
 * @Entity 
 * @Table(name="user")
 */
class User extends Abstrct
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="string",nullable=false,length=50) 
     */
    protected $username;

    /**
     * @Column(type="string",nullable=false,length=32) 
     */
    protected $password;

    /**
     * Fields that can be set in the model. 
     * 
     * @var array
     */
    protected $_setableFields = array('username', 'password');
}
