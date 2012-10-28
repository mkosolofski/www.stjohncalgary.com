<?php
/**
 * Contains Model_News. 
 */

/**
 * Define namespace for object. 
 */
namespace Model;

/**
 * @Entity 
 * @Table(name="news")
 */
class News extends Abstrct
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
    protected $title;
    
    /** 
     * @Column(type="string",nullable=false,length=20000) 
     */
    protected $body;
    
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
     * @Column(type="integer",length=1)
     * @GeneratedValue
     */
    protected $isArchived = 0;

    /**
     * Fields that can be set in the model. 
     * 
     * @var array
     */
    protected $_setableFields = array('title', 'body', 'is_archived', 'isDeleted');
}
