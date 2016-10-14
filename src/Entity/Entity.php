<?php

namespace MyProject\Entity;

class Entity {
	
	/**
	 * @var boolean
	 */
	protected $del_flg = false;
	
	/**
	 * @var integer
	 */
	protected $updated_by;
	
	/**
	 * @var \DateTime
	 */
	protected $update_at;
	
	/**
	 * @var integer
	 */
	protected $created_by;
	
	/**
	 * @var \DateTime
	 */
	protected $create_at;
	
	public function __construct()
	{
		$this->del_flg = false;
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
	
	/** @PrePersist */
	public function doPrePersist()
	{
		try {
			$member_id = $this->getMemberId();
	
			$this->del_flg = false;
			$this->updated_by = $member_id;
			$this->created_by = $member_id;
		} catch (\Exception $ex) {
			return;
		}
	}
	
	/** @PreUpdate */
	public function doPreUpdate()
	{
		$member_id = $this->getMemberId();
	
		$this->updated_by = $member_id;
	}
	
	/** 更新者のメンバーID取得 */
	protected function getMemberId()
	{
		return $GLOBALS['app']['user']->getId();
	}
}