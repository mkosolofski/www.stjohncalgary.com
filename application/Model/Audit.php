<?php
/**
 * Contains Model_Audit. 
 */

/**
 * Define namespace for object. 
 */
namespace Model;

/**
 * @Entity 
 * @Table(name="audit")
 */
class Audit extends Abstrct
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
    protected $entity;

    /**
     * @Column(type="string",nullable=false,length=20) 
     */
    protected $field;

    /**
     * @Column(type="string",nullable=false,length=20000) 
     */
    protected $old_value;

    /**
     * @Column(type="string",nullable=false,length=20000) 
     */
    protected $new_value;

    /**
     * @Column(type="integer",nullable=false) 
     */
    protected $user_id;
    
    /**
     * @Column(type="integer",nullable=false) 
     */
    protected $entity_id;

    /**
     * @Column(type="datetime")
     */
    protected $updated;

    /**
     * Fields that can be set in the model. 
     * 
     * @var array
     */
    protected $_setableFields = array('entity', 'field', 'old_value', 'new_value', 'user_id', 'entity_id');
}
