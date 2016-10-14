<?php

namespace MyProject\Entity;

/**
 * Code
 */
class Code extends Entity
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

}

