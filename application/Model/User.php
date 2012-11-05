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
     * @Column(type="smallint",nullable=false) 
     */
    protected $role;
    
    /**
     * @Column(type="smallint",nullable=false) 
     */
    protected $status;

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
    protected $_setableFields = array('email', 'password', 'role', 'created', 'status');
}
