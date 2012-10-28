<?php
/**
 * Contains Model_Event. 
 */

/**
 * Define namespace for object. 
 */
namespace Model;

/**
 * @Entity 
 * @Table(name="event")
 */
class Event extends Abstrct
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /** 
     * @Column(type="string",nullable=false,length=200) 
     */
    protected $event;
    
    /**
     * @Column(type="datetime",nullable=false)
     */
    protected $date;

    /**
     * @Column(type="datetime")
     */
    protected $created;

    /**
     * @Column(type="integer",length=1)
     * @GeneratedValue
     */
    protected $isDeleted = 0;

    /**
     * Fields that can be set in the model. 
     * 
     * @var array
     */
    protected $_setableFields = array('event', 'is_archived', 'date', 'isDeleted');
}
