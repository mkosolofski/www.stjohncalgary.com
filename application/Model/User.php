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
    protected $email;

    /**
     * @Column(type="string",nullable=false,length=32) 
     */
    protected $password;
    
    /**
     * @Column(type="integer",nullable=false,length=4) 
     */
    protected $role;

    /**
     * @Column(type="datetime",nullable=false)
     */
    protected $created;

    /**
     * @Column(type="datetime") 
     */
    protected $last_updated;

    /**
     * Fields that can be set in the model. 
     * 
     * @var array
     */
    protected $_setableFields = array('email', 'password', 'role', 'created');
}
