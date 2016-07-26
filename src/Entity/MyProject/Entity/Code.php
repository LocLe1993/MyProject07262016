<?php

namespace MyProject\Entity;

/**
 * Code
 */
class Code
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $kind;

    /**
     * @var string
     */
    private $no;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $memo;

    /**
     * @var integer
     */
    private $rank;

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
     * Set kind
     *
     * @param integer $kind
     *
     * @return Code
     */
    public function setKind($kind)
    {
        $this->kind = $kind;

        return $this;
    }

    /**
     * Get kind
     *
     * @return integer
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * Set no
     *
     * @param string $no
     *
     * @return Code
     */
    public function setNo($no)
    {
        $this->no = $no;

        return $this;
    }

    /**
     * Get no
     *
     * @return string
     */
    public function getNo()
    {
        return $this->no;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Code
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
     * Set memo
     *
     * @param string $memo
     *
     * @return Code
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;

        return $this;
    }

    /**
     * Get memo
     *
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     *
     * @return Code
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set delFlg
     *
     * @param boolean $delFlg
     *
     * @return Code
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
     * @return Code
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
     * @return Code
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
     * @return Code
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
     * @return Code
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

