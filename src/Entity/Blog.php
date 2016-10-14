<?php

namespace MyProject\Entity;

/**
 * Blog
 */
class Blog extends Entity
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $blog_type_id;

    /**
     * @var integer
     */
    private $field_id;

    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Blog
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set blogTypeId
     *
     * @param integer $blogTypeId
     *
     * @return Blog
     */
    public function setBlogTypeId($blogTypeId)
    {
        $this->blog_type_id = $blogTypeId->getId();

        return $this;
    }

    /**
     * Get blogTypeId
     *
     * @return integer
     */
    public function getBlogTypeId()
    {
    	if($this->blog_type_id != null)
    		return $GLOBALS['app']['Myproject.BlogType.Repository']->getById($this->blog_type_id);
    	return $this->blog_type_id;
        //return $this->blog_type_id;
    }

    /**
     * Set fieldId
     *
     * @param integer $fieldId
     *
     * @return Blog
     */
    public function setFieldId($fieldId)
    {
        $this->field_id = $fieldId->getId();

        return $this;
    }

    /**
     * Get fieldId
     *
     * @return integer
     */
    public function getFieldId()
    {
    	if($this->field_id != null)
        	return $GLOBALS['app']['Myproject.BlogType.Repository']->getById($this->field_id);
        return $this->field_id;
    }
}