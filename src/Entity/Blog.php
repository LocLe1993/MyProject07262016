<?php

namespace MyProject\Entity;

/**
 * Blog
 */
class Blog
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
     * @var boolean
     */
    private $del_flg = false;

    /**
     * @var integer
     */
    private $updated_by;

    /**
     * @var \DateTime
     */
    private $update_at;

    /**
     * @var integer
     */
    private $created_by;

    /**
     * @var \DateTime
     */
    private $create_at;


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
        $this->blog_type_id = $blogTypeId;

        return $this;
    }

    /**
     * Get blogTypeId
     *
     * @return integer
     */
    public function getBlogTypeId()
    {
        return $this->blog_type_id;
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
        $this->field_id = $fieldId;

        return $this;
    }

    /**
     * Get fieldId
     *
     * @return integer
     */
    public function getFieldId()
    {
        return $this->field_id;
    }

    /**
     * Set delFlg
     *
     * @param boolean $delFlg
     *
     * @return Blog
     */
    public function setDelFlg($delFlg)
    {
        $this->del_flg = $delFlg;

        return $this;
    }

    /**
     * Get delFlg
     *
     * @return boolean
     */
    public function getDelFlg()
    {
        return $this->del_flg;
    }

    /**
     * Set updatedBy
     *
     * @param integer $updatedBy
     *
     * @return Blog
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updated_by = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return integer
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Blog
     */
    public function setUpdateAt($updateAt)
    {
        $this->update_at = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     *
     * @return Blog
     */
    public function setCreatedBy($createdBy)
    {
        $this->created_by = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Blog
     */
    public function setCreateAt($createAt)
    {
        $this->create_at = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->create_at;
    }
    /**
     * @ORM\PrePersist
     */
    public function doPrePersist()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function doPreUpdate()
    {
        // Add your code here
    }
}

